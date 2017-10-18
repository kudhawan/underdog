
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"
type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"
rel="Stylesheet"type="text/css"/>
<script type="text/javascript">
$(function () {
   /* $("#start_date").datepicker({
        dateFormat: 'yy-mm-dd',
		minDate: 0,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#end_date").datepicker("option", "minDate", dt);
        }
    });
    $("#end_date").datepicker({
        dateFormat: 'yy-mm-dd',
		minDate: 0,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#start_date").datepicker("option", "maxDate", dt);
        }
    });*/
	
	
	  
    $("body").delegate("#start_date", "focusin", function(){
        $("#start_date").datepicker({ 
		dateFormat: 'yy-mm-dd',
		minDate: 0,
		onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#end_date").datepicker("option", "minDate", dt);
        }
		
		
		
		});
    });
	
	 $("body").delegate("#end_date", "focusin", function(){
        $("#end_date").datepicker({ 
		dateFormat: 'yy-mm-dd',
		minDate: 0,
		onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#start_date").datepicker("option", "maxDate", dt);
		}
		});
    });
	
});
</script>
<input type="text" name="start_date" id="start_date" />
<input type="text" name="end_date" id="end_date" />

<?php

$fruits = array("b"=>"banana", "a"=>"apple", "d"=>"dog", "c"=>"cat");

 

// Sorting the array by value

asort($fruits);

print_r($fruits);




   echo $currentEasternTimeStamp =mktime(date('H')-6,date('i'),date('s'),date('m'),date('d'),date('Y'));
echo '<br />';
   echo $thursdayDT= mktime(date('H')-6,date('i'),date('s'),date('m'),date('d')-1,date('Y'));
echo '<br />';
echo 'last day EST Time ' . date('m/d/Y H:i:s a',$thursdayDT) ;

echo '<br />';

echo 'Current EST Time ' . date('m/d/Y H:i:s a',$currentEasternTimeStamp) ;

exit;

function x_week_range($date) {
    $ts = strtotime($date);
    $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
    return array(date('Y-m-d', $start),
                 date('Y-m-d', strtotime('next saturday', $start)));
}


$test=x_week_range('2017-28-09');


echo $staticstart = date('Y-m-d',strtotime('this Sunday'));
exit;
//date_default_timezone_set('America/Chicago'); //server time zone
echo 'Current Server Time:' . date('m/d/Y H:i:s a') ;
$date='01';
$month='10';
$year='2017';
$hr='13';
$min='30';
$sec='00';

$EasternTimeStamp =mktime(date('H')-4,date('i'),date('s'),date('m'),date('d'),date('Y'));
echo '<br />';
echo 'Current EST Time ' . date('m/d/Y H:i:s a',$EasternTimeStamp) ;

exit;


//echo $_SERVER['HTTP_HOST']."/projects/underdogv1/register.php";
$date1 = "2017-09-22 13:45:00"; 
$date2 = "2017-09-22 12:30:01"; 

$diff = abs(strtotime($date2) - strtotime($date1)); 

$years   = floor($diff / (365*60*60*24)); 
$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 

$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 

printf("%d years, %d months, %d days, %d hours, %d minuts\n, %d seconds\n", $years, $months, $days, $hours, $minuts, $seconds);

echo $hours."h  ".$minuts."m";
?>