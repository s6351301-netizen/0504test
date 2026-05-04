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
//echo $date("y-m-d",$start_time);
//
$diff = ($end - $start) / (60 * 60 * 24);
echo "<br>";   
echo "間隔天數為:".$diff."天";        
?>
    
<?php
$start = strtotime("Y-m-d 12:00:00");
$end = strtotime("2026-12-05"); 
//日期的字串無法計算,所以要轉換為可計算的格式.
$start_time=strtotime("start");
$end_time=strtotime("end");
$diff = ($end - $start) / (60 * 60 * 24);
echo "<br>";   
echo "距離下一次生日是間隔天數為:".$diff."天";        
?>

<hr><hr>
<h2>老師範例:給定兩個日期，計算中間間隔天數</h2>  
   <ul>
    <li>起始日期:2026-04-19</li>
    <li>結束時間:2026-05-04</li>
  </ul>
  <?php
    $start="2026-04-19";
    $end="2026-05-04";
    //日期的字串無法計算,所以要轉換為可計算的格式
    $start_time=strtotime($start);
    $end_time=strtotime($end);
    //echo  date("Y-m-d H:i:s",$start_time);
    //echo "<br>";
    //echo  date("Y-m-d H:i:s",$end_time);
    $diff=($end_time - $start_time)/(60*60*24);
    echo "<br>";
    echo "間隔天數:".$diff."天"
    ?>

    <h2>計算距離自己下一次生日還有幾天</h2>
    <?php
    $start=date("Y-m-d");
    $birthday="2000-4-06";

    //判斷今天的時間是否比生日還要大
    $start_time=strtotime($start);
    $birthday_string=date("Y") . date("-m-d",strtotime($birthday));
    $birthday_time=strtotime($birthday_string);
    //echo $start_time ."-". $birthday_time;
    if($birthday_time>$start_time){
        $diff=($birthday_time - $start_time)/(60*60*24);
    }else{
        //$birthday_string=(date("Y")+1) . date("-m-d",strtotime($birthday));
        $birthday_time=strtotime("+1 year",strtotime($birthday_string));

        $diff=($birthday_time - $start_time)/(60*60*24);
    }

    echo "<br>";
    echo "今天是".$start."<br>";
    echo "距離我的下一次生日".date("Y-m-d",$birthday_time)."還有".$diff."天";
    
    ?>

<h2>利用date()函式的格式化參數，完成以下的日期格式呈現</h2>

<ul>
    <li>2021/10/05</li>
    <li>10月5日 Tuesday</li>
    <li>2021-10-5 12:9:5</li>
    <li>2021-10-5 12:09:05</li>
    <li>今天是西元2021年10月5日 上班日(或假日)</li>
</ul>
<?php 

echo date("Y/m/d");
echo "<br>";
echo date("n月j日 l");
echo "<br>";
echo date("Y-m-d G:").(int)date("i").":".(int)date("s");
echo "<br>";
echo date("Y-m-d H:i:s");
echo "<br>";
echo "今天是西元";
echo  date("Y年m月d日");
echo  (date("N")>5)?" 假日":" 上班日";
echo "<br>";
?>
<h2>利用迴圈來計算連續五個周一的日期</h2>
例:

<ul>
    <li>2021-10-04 星期一</li>
    <li>2021-10-11 星期一</li>
    <li>2021-10-18 星期一</li>
    <li>2021-10-25 星期一</li>
    <li>2021-11-01 星期一</li>
</ul>
<?php 
$date="2026-05-04";
for($i=1;$i<=5;$i++){

    $timestring=strtotime("+$i weeks" , strtotime($date));
    echo  date("Y-m-d 星期一",$timestring);
    echo "<br>";
}

?>
</body>
</html>