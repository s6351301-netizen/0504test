<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>線上月曆與萬年曆製作</title>
</head>
<body>

  <h2>日曆如果不使用TABLE表格方式,可以用什麼來寫PHP程式</h2>  
<?php
// 設定年月
$year = date('Y');
$month = date('m');

// 1. 取得該月的第一天是星期幾 (0 是週日, 6 是週六)
$firstDayOfMonth = date('w', strtotime("$year-$month-01"));

// 2. 取得該月總共有幾天
$daysInMonth = date('t', strtotime("$year-$month-01"));

// 定義星期標題
$daysOfWeek = ['日', '一', '二', '三', '四', '五', '六'];
?>

<style>
    /* 設定日曆的外框為 Grid 佈局 */
    .calendar-container {
        display: grid;
        grid-template-columns: repeat(7, 1fr); /* 切分為 7 等份 */
        width: 100%;
        max-width: 400px;
        border: 1px solid #ccc;
    }

    .grid-item {
        padding: 10px;
        text-align: center;
        border: 0.5px solid #eee;
    }

    .header {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    .empty {
        background-color: #fafafa;
    }

    .today {
        background-color: #ffeb3b;
        font-weight: bold;
    }
</style>

<div class="calendar-header">
    <h3><?php echo "$year 年 $month 月"; ?></h3>
</div>

<div class="calendar-container">
    <!-- 印出星期標題 -->
    <?php foreach ($daysOfWeek as $day): ?>
        <div class="grid-item header"><?php echo $day; ?></div>
    <?php endforeach; ?>

    <!-- 印出第一天之前的空白格子 -->
    <?php for ($i = 0; $i < $firstDayOfMonth; $i++): ?>
        <div class="grid-item empty"></div>
    <?php endfor; ?>

    <!-- 印出日期 -->
    <?php for ($day = 1; $day <= $daysInMonth; $day++): ?>
        <?php $isToday = ($day == date('j') && $month == date('n')) ? 'today' : ''; ?>
        <div class="grid-item <?php echo $isToday; ?>">
            <?php echo $day; ?>
        </div>
    <?php endfor; ?>
</div>

<br><br>
<hr><hr>

  <h2>線上月曆製作</h2>  
  <?php
  $today=date("Y-m-d");
  $week=date("w",strtotime($today));
  $month=date("m");
  $year = date("Y");
  $weeks = array("日","一","二","三","四","五","六");
  echo "今天是".$today."，星期".$weeks[$week]."，".$month."月，".$year."年";
  echo "<br>";      
    $first_day = date("Y-m-01");      
    ?>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>日</th>
            <th>一</th>
            <th>二</th>
            <th>三</th>
            <th>四</th>
            <th>五</th>
            <th>六</th>
        </tr>
        <?php
        $first_week = date("w", strtotime($first_day));
        $days_in_month = date("t", strtotime($first_day));
        $day = 1;
        for ($i = 0; $i < 6; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 7; $j++) {
                if ($i === 0 && $j < $first_week) {
                    echo "<td></td>";
                } elseif ($day > $days_in_month) {
                    echo "<td></td>";
                } else {
                    echo "<td>$day</td>";
                    $day++;
                }
            }
            echo "</tr>";
        }
        ?>      
    </table>

<hr>
<h2>萬年曆製作</h2>
<?php
$year = 2024; // 可以修改為任意年份 
echo "<h3>$year 年萬年曆</h3>";
for ($month = 1; $month <= 12; $month++) {
    echo "<h4>$month 月</h4>";
    $first_day = date("$year-$month-01");
    $first_week = date("w", strtotime($first_day));
    $days_in_month = date("t", strtotime($first_day));
    echo "<table border='1' cellspacing='0' cellpadding='5'>";
    echo "<tr><th>日</th><th>一</th><th>二</th><th>三</th><th>四</th><th>五</th><th>六</th></tr>";
    $day = 1;
    for ($i = 0; $i < 6; $i++) {
        echo "<tr>";
        for ($j = 0; $j < 7; $j++) {
            if ($i === 0 && $j < $first_week) {
                echo "<td></td>";
            } elseif ($day > $days_in_month) {
                echo "<td></td>";
            } else {
                echo "<td>$day</td>";
                $day++;
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}       
?>
<hr><hr><hr>
<h2>老師範例_月曆</h2>

<?php
//定義變數
$today=date("Y-m-d");
$MonthDays=date("t");
$FirstDayWeek=date("w",strtotime(date("Y-m-01")));
$LastDay=date("Y-m-$MonthDays");
$LastDayWeek=date('w',strtotime($LastDay));
$TotalDays=$MonthDays+$FirstDayWeek+(6-$LastDayWeek);
$TotalWeeks=$TotalDays/7
?>

<h3>今天是<?= $today; ?></h3>
<ul>
    <li>這個月的天數一共有<?= $MonthDays; ?></li>
    <li>這個月的第1天是<?= date("Y-m-01"); ?></li>
    <li>這個月的第1天是星期<?=$FirstDayWeek ;?></li>
    <li>這個月的最後1天是<?= $LastDay ?></li>
    <li>這個月的最後1天是星期<?=$LastDayWeek ;?></li>
    <li>這個月曆一共要畫出(含空白)<?=$TotalDays ;?>格子</li>
</ul>
<style>
    table{
        border-collapse: collapse;
    }
    table td{
        padding:5px 10px;
        border:1px solid #999;
    }
</style>
<table>
    <tr>
        <td>日</td>
        <td>一</td>
        <td>二</td>
        <td>三</td>
        <td>四</td>
        <td>五</td>
        <td>六</td>
    </tr>
    <?php 
    for($i=0;$i<$TotalWeeks;$i++){
        echo "<tr>";
        for($j=0;$j<7;$j++){
            echo "<td>";
            $DayNumber=($i*7+$j)-($FirstDayWeek-1);
            if($DayNumber>0 && $DayNumber<=$MonthDays){
                echo $DayNumber;
            }
            echo "</td>";
        }
        echo "</tr>";
    }

    ?>
</table>

 <h2>月曆</h2>
<?php
$today=date("Y-m-d");
$month="2026-09";
$FirstDay=$month."-01";
$FirstDayWeek=date("w",strtotime($FirstDay));
$MonthDays=date("t",strtotime($FirstDay));
$LastDay=$month."-".$MonthDays;
$LastDayWeek=date('w',strtotime($LastDay));
$TotalDays=$MonthDays+$FirstDayWeek+(6-$LastDayWeek);
$TotalWeeks=$TotalDays/7
?>

<h2>月曆</h2>
<?php
$today=date("Y-m-d");
$month="2026-09";
$FirstDay=$month."-01";
$FirstDayWeek=date("w",strtotime($FirstDay));
$MonthDays=date("t",strtotime($FirstDay));
$LastDay=$month."-".$MonthDays;
$LastDayWeek=date('w',strtotime($LastDay));
$TotalDays=$MonthDays+$FirstDayWeek+(6-$LastDayWeek);
$TotalWeeks=$TotalDays/7
?>

<h3>今天是<?= $today; ?></h3>
<ul>
    <li>這個月的天數一共有<?= $MonthDays; ?></li>
    <li>這個月的第1天是<?= $FirstDay; ?></li>
    <li>這個月的第1天是星期<?=$FirstDayWeek ;?></li>
    <li>這個月的最後1天是<?= $LastDay ?></li>
    <li>這個月的最後1天是星期<?=$LastDayWeek ;?></li>
    <li>這個月曆一共要畫出(含空白)<?=$TotalDays ;?>格子</li>
</ul>
<style>
    table{
        border-collapse: collapse;
        font-size:16px;
    }
    table td{
        padding:5px 13px;
        border:1px solid #999;
    }

</style>
<h2><?= $month; ?>月</h2>
<table>
    <tr>
        <td>日</td>
        <td>一</td>
        <td>二</td>
        <td>三</td>
        <td>四</td>
        <td>五</td>
        <td>六</td>
    </tr>
    <?php 
    for($i=0;$i<$TotalWeeks;$i++){
        echo "<tr>";
        for($j=0;$j<7;$j++){
            echo "<td data-date=''>";
            $DayNumber=($i*7+$j)-($FirstDayWeek-1);
            if($DayNumber>0 && $DayNumber<=$MonthDays){
                echo $DayNumber;
            }
            echo "</td>";
        }
        echo "</tr>";
    }

    ?>
</table>
<hr>
<hr>       
        
</body>
</html>