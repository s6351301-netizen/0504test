<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
</head>
<body>
<h2>月曆</h2>
<?php
$today=date("Y-m-d");
$month=$_GET['month'];
if(isset($_GET['month'])){
    $month=$_GET['month'];
}else{
    $month=date("Y-m");
}
$FirstDay=$month."-01";
$m=date("m",strtotime($FirstDay));
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
<h3>
<?php 
    if($m-1>0){
        $prevMonth=date("Y-",strtotime($FirstDay)).($m-1);
    }else{
        $prevMonth=(date("Y",strtotime($FirstDay))-1)."-12";
    }
?>

    <a href="05-calendar3.php?month=<?= $prevMonth ?>">上一個月</a>

<?php 
    if($m+1<=12){

        $nextMonth=date("Y-",strtotime($FirstDay)).($m+1);
    }else{
        $nextMonth=(date("Y",strtotime($FirstDay))+1)."-01";

    }

?>
    <a href="05-calendar3.php?month=<?= $nextMonth ?>">下一個月</a>
</h3>
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


</body>