<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>時間及日期處理</title>
</head>
<body>
   <h1>時間及日期處理/</h1> 
<p style="font-size:20px">
日期函式基本用法</br>
date(“Y-m-d”,$time)</br>
strtotime(“+1 days”,$date_string)</br>
日期函式參數表</br>
基本單位是秒</br>
date_default_timezone_set() - 設置程式執行期間的時區</br>
</p>
<ul>
<li>起始日期：2026-04-19</li>
<li>結束日期：2026-05-04</li>
</ul>

<?php
$start = strtotime("2024-04-19");
$end = strtotime("2024-05-04"); 
$dates = array();
for ($i = $start; $i <= $end; $i += 86400) {
    $dates[] = date("Y-m-d", $i);
}     
echo "<br>";  

?>

<?php
$start = strtotime("2024-04-19");
$end = strtotime("2024-05-04"); 
//日期的字串無法計算,所以要轉換為可計算的格式.
$start_time=strtotime("start");
$end_time=strtotime("end");
$diff = ($end - $start) / (60 * 60 * 24);
echo "<br>";   
echo "間隔天數為:".$diff."天";        
?>
    
<?php
$start = strtotime("2026-05-04");
$end = strtotime("2026-12-05"); 
//日期的字串無法計算,所以要轉換為可計算的格式.
$start_time=strtotime("start");
$end_time=strtotime("end");
$diff = ($end - $start) / (60 * 60 * 24);
echo "<br>";   
echo "距離下一次生日是間隔天數為:".$diff."天";        
?>


</body>
</html>