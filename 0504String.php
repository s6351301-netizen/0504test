<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <h1>字串常用函式</h1> 
<p style="font-size:20px">
函式	功能<br>
substr() / mb_substr()	從原字串中取出部份字串<br>
trim()	去除頭尾空白</br>
str_repeat()	重覆特定字元</br>
str_replace()	取代字串</br>
explode()	以特定字串/字元/符號分割字串</br>
implode() / join()	以特定字串/字元/符號將陣列元素合併成字串</br>
strpos()	返回某字元在字串中首次出現的位置</br>
strlen()	字串長度</br>
</p>

<?php
$srt="I am a student I am a teacher I am a programmer";
if(strpos($srt,"teacher")!==false){
    echo "有找到";
}else{
    echo "沒有找到";
}
$short=mb_substr($srt,0,15);
echo $short;
 echo "<br>";
?>
<hr>


<?php
$srt = " 今年五一勞動節是史上首次「全國統一放假」，</br>
此次五一勞工大遊行以「退休給付，增加！本勞移工，全保」為主題，</br>
並提出「勞退新制雇主提繳率從6%調至12%」等勞工8大訴求。</br>
作家漂浪島嶼今（2）日在臉書貼文開頭標註「人均GDP飆新高_街頭勞工沒有少」</br>
等標籤指出，台灣經濟繳出許多漂亮數據，甚至被拿下「全世界最不痛苦國家第一名」，</br>
然而，五一遊行勞工卻有約6000人走上街頭，打破「經濟大好」的宣傳。";

$keyword = "勞工";
$tem = "<a href='#' style='color:blue; text-decoration: underline;'>$keyword</a>";

// 修正 1：加上逗號
// 修正 2：使用 !== false 來判斷，確保位置為 0 時也能正確執行
if (strpos($srt, $keyword) !== false) {
    $srt = str_replace($keyword, $tem, $srt);
}

echo $srt;
echo "<br>";
?>

<hr><hr><hr><hr>
   <h2>以下是老師範例:字串取代</h2>
    <p>將”aaddw1123”改成”*********”</p>
    <?php 
    $str="aaddw1123adsfsdfasdf";
    $str=str_replace(["a","d","w",1,2,3],"*",$str);
    
    echo $str;
    
    echo "<br>";
    echo str_repeat("*",mb_strlen($str));
    ?>
    <h2>字串分割</h2>
    <p>將”this,is,a,book”依”,”切割後成為陣列</p>
    <?php 
    $str="this,is,a,book";
    $arr=explode(",",$str);
    echo "<pre>";
    print_r($arr);
    echo "</pre>";

    ?>
<h2></h2>
    <h2>字串組合</h2>
    <p>將上例陣列重新組合成“this is a book”</p>
    <?php 
        $str=join(" ", $arr);
        echo $str;
    ?>

<h2>子字串取用</h2>
<p>
    將” The reason why a great man is great is that he resolves to be a great man”只取前十字成為” The reason…”
</p>
<?php 
$str="The reason why a great man is great is that he resolves to be a great man";
$short=mb_substr($str,0,10);

echo $short . "...";
?>
<p>
    將”偉大的人之所以偉大，是因為他決心成為偉大的人。”只取前十字成為” 偉大的人之所以偉大，…”
</p>
<?php 
$str="偉大的人之所以偉大，是因為他決心成為偉大的人。";
$short=mb_substr($str,0,10);

echo $short . "...";
?>
<br>
<?php 
$str="偉大的人之所以偉大，是因為他決心成為偉大的人。";
$short=substr($str,0,10);

echo $short . "...";
?>
<br>
<?php 
$str="偉大的人之所以偉大，是因為他決心成為偉大的人。";
$short=mb_substr($str,10,-5);

echo $short . "...";
?>

<h2>尋找字串與HTML、css整合應用</h2>

<ul>
    <li>給定一個句子，將指定的關鍵字放大</li>
    <li>“學會PHP網頁程式設計，薪水會加倍，工作會好找”</li>
    <li>請將上句中的 “程式設計” 放大字型或變色.</li>
</ul>
<?php 

$str="學會PHP網頁程式設計，薪水會加倍，工作會好找，學程式設計真的是太好玩了";
$keyword="程式設計";
$tmp="<span style='color:blue;font-size:24px;'>$keyword</span>";
if(strpos($str,$keyword)>0){
    $str=str_replace($keyword,$tmp,$str);

}

echo $str;
?>
<br>
<style>
a{
    color:blue;
    text-decoration: none;
}
a:hover{
    text-decoration: underline;
}

</style>
<?php 

$str="學會PHP網頁程式設計，薪水會加倍，工作會好找，學程式設計真的是太好玩了";
$keyword="程式設計";
$tmp="<a href='#' style='color:blue;'>$keyword</a>";
if(strpos($str,$keyword)>0){
    $str=str_replace($keyword,$tmp,$str);

}

echo $str;
?>
<br>
<br>
<style>
a{
    color:blue;
    text-decoration: none;
}
a:hover{
    text-decoration: underline;
}

</style>
<?php 

$str="PHP 是一種廣泛應用於網頁開發的程式語言，具備語法簡單、學習門檻低的優點，特別適合初學者入門。它與資料庫整合能力強，能快速建立動態網站與互動功能。此外，PHP 擁有豐富的開源資源與框架支援，可有效提升開發效率，並降低開發成本，是企業與個人開發網站時常見且實用的選擇。";
echo $str;
echo "<br>";
$keyword=["PHP","網站","企業","初學者","框架"];

$tmp=[];
foreach($keyword as $k){
    $tmp[]="<a href='#' style='color:blue;'>$k</a>";
}
//print_r($tmp);
$str=str_replace($keyword,$tmp,$str);


echo $str;
?>

</body>
</html>