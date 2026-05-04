<?php
function fetchHtml(string $url): string
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36');
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
        'Accept-Language: zh-TW,zh;q=0.9,en-US;q=0.8,en;q=0.7',
    ]);
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $html = curl_exec($ch);
    curl_close($ch);
    return $html ?: '';
}

function buildGoogleSearchUrl(string $query): string
{
    return 'https://www.google.com/search?q=' . urlencode($query) . '&hl=zh-TW&num=20';
}

function extractGoogleResultUrl(string $href): ?string
{
    if (strpos($href, '/url?') === 0) {
        $query = parse_url($href, PHP_URL_QUERY);
        parse_str($query, $params);
        if (!empty($params['q'])) {
            return $params['q'];
        }
        return null;
    }
    if (strpos($href, 'http://') === 0 || strpos($href, 'https://') === 0) {
        return $href;
    }
    return null;
}

function findDate(string $text): ?DateTime
{
    $patterns = [
        '/(\d{4})年\s*(\d{1,2})月\s*(\d{1,2})日/',
        '/(\d{4})[\/\-.年]\s*(\d{1,2})[\/\-.月]\s*(\d{1,2})/',
        '/(\d{1,2})月\s*(\d{1,2})日/',
        '/(\d{2})[\/\-.](\d{1,2})[\/\-.](\d{1,2})/',
    ];

    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $text, $matches)) {
            if (count($matches) === 4) {
                $year = (int)$matches[1];
                $month = (int)$matches[2];
                $day = (int)$matches[3];
                if ($year < 100) {
                    $year += 2000;
                }
                $date = DateTime::createFromFormat('Y-n-j', "$year-$month-$day");
                if ($date) {
                    return $date;
                }
            }
            if (count($matches) === 3) {
                $year = (int)date('Y');
                $month = (int)$matches[1];
                $day = (int)$matches[2];
                $date = DateTime::createFromFormat('Y-n-j', "$year-$month-$day");
                if ($date) {
                    return $date;
                }
            }
        }
    }

    return null;
}

function parseGoogleResults(string $html): array
{
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML('<?xml encoding="utf-8"?>' . $html);
    $xpath = new DOMXPath($doc);
    $resultAnchors = $xpath->query('//a[descendant::h3]');

    $announcements = [];
    $seenUrls = [];

    foreach ($resultAnchors as $anchor) {
        /** @var DOMElement $anchor */
        $href = trim($anchor->getAttribute('href'));
        $url = extractGoogleResultUrl($href);
        if (empty($url) || isset($seenUrls[$url])) {
            continue;
        }

        $h3 = $xpath->query('.//h3', $anchor)->item(0);
        $title = $h3 ? trim($h3->textContent) : trim($anchor->textContent);
        if ($title === '') {
            continue;
        }

        $snippet = '';
        $snippetNode = $xpath->query('.//div[contains(@class, "VwiC3b") or contains(@class, "IsZvec") or contains(@class, "aCOpRe") or contains(@class, "MUxGbd")]', $anchor);
        if ($snippetNode->length > 0) {
            $snippet = trim($snippetNode->item(0)->textContent);
        } else {
            $parent = $anchor->parentNode;
            if ($parent) {
                $moreSnippet = $xpath->query('.//span', $parent);
                if ($moreSnippet->length > 0) {
                    $snippet = trim($moreSnippet->item(0)->textContent);
                }
            }
        }

        $date = findDate($title . ' ' . $snippet);
        if (!$date) {
            $pageHtml = fetchHtml($url);
            if ($pageHtml !== '') {
                $pageText = strip_tags($pageHtml);
                $date = findDate($pageText);
            }
        }

        $announcements[] = [
            'title' => $title,
            'url' => $url,
            'date' => $date ? $date->format('Y-m-d') : '未知',
            'sort' => $date ? $date->getTimestamp() : 0,
        ];
        $seenUrls[$url] = true;
    }

    usort($announcements, function ($a, $b) {
        return $b['sort'] <=> $a['sort'];
    });

    return $announcements;
}

$query = '祭祀公業 公告';
$searchUrl = buildGoogleSearchUrl($query);
$searchHtml = fetchHtml($searchUrl);
$results = [];
if ($searchHtml !== '') {
    $results = parseGoogleResults($searchHtml);
}

?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google 搜尋祭祀公業公告</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        table { border-collapse: collapse; width: 100%; max-width: 1100px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #f4f4f4; }
        a { color: #0066cc; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .note { margin-bottom: 18px; color: #444; }
    </style>
</head>
<body>
    <h1>Google 搜尋：祭祀公業 公告</h1>
    <p class="note">本頁直接使用 Google 搜尋結果，並嘗試從標題或內容中擷取日期。標題可點選並在新分頁開啟。</p>
    <?php if (empty($results)): ?>
        <p>未抓到搜尋結果，可能是 Google 封鎖或頁面結構變動，請稍後再試。</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>公告日期</th>
                    <th>標題</th>
                    <th>來源網址</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['date'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><a href="<?php echo htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                        <td><a href="<?php echo htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
