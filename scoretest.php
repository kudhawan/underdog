<?php
session_start();
include('db.php');

		$sb_scoreSql=@mysql_query("select * from manage_league ");
		$sb_scoreresults=array();
		 while($sb_data=@mysql_fetch_array($sb_scoreSql))
		 {
			 $sb_league_id=$sb_data['league_id'];
			 $sb_league_user_id=$sb_data['user_id'];
			 $sb_match_id=$sb_data['match_id'];
			 $sb_betTeam=$sb_data['betting_team'];
			 $sb_home_team=$sb_data['home_team'];
			 $sb_away_team=$sb_data['away_team'];
			 $sb_goal_spread_betting=$sb_data['goal_spread_betting'];
			 $sb_goal_spread_opponent=$sb_data['goal_spread_opponent'];
			// echo "select id,first_name,last_name from users where id='sb_league_user_id'";
			 $userSql=@mysql_query("select id,first_name,last_name from users where id='$sb_league_user_id'");
			 $userDt=@mysql_fetch_array($userSql);
			 $sb_user_name=$userDt['first_name']." ".$userDt['last_name'];
			 
			  $leagueSql=@mysql_query("select league_name from league  where id='$sb_league_id'");
			  $leagueDt=@mysql_fetch_array($leagueSql);
		      $league_name=$leagueDt['league_name'];
			  
			 $sb_output = shell_exec('curl -X GET https://jsonodds.com/api/results/{'.$sb_match_id.'} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
	         $sb_resultArray=json_decode($sb_output);
			 $sb_count= count($sb_resultArray);
			 $sb_matcharray=array();
			if($sb_count>0)
			{
			//print_r($resultArray);
			 $sum = 0;
			  foreach($sb_resultArray as $sb_results) 
				{
						 $sb_HomeScore=$sb_results->HomeScore;
						 $sb_AwayScore=$sb_results->AwayScore;
						 $sb_final=$sb_results->Final;
						 $sb_OddType=$sb_results->OddType;
						if($sb_final=='true')
						{
							$sb_matchStatus='Finished';
						}
						else
						{
							$sb_matchStatus='Not Finished';	
						}
						
					if($sb_final=='true')
					{	
					  if($sb_HomeScore>$sb_AwayScore)
						{
							$sb_winStatus="Won the match";
							
						}
						else if($sb_HomeScore<$sb_AwayScore)
						{
							$sb_winStatus="Loose the match";
							
						}
					 }
					 else
					 {
						$sb_winStatus="Game Not completed"; 
						
					 }
					 
					if($sb_winStatus=="Won the match")
					{
						$sb_score=abs($sb_goal_spread_betting);
					}
					else
					{
						$sb_score='';
					}
					 $sum += $sb_score;
					 
					 
					$sb_resultsData=array("score"=>$sum,'username'=>$sb_user_name,'league_name'=>$league_name);
					
					//$sb_resultsData=array($league_name=>array($sum,$sb_user_name,$league_name));	
					
				//$sb_resultsData=array('betTeam'=>$sb_betTeam,"winstatus"=>$sb_winStatus,"matchStatus"=>$sb_matchStatus,"score"=>$sb_score,'away_team'=>$sb_away_team,'home_team'=>$sb_home_team,'HomeScore'=>$sb_HomeScore,'AwayScore'=>$sb_AwayScore,'username'=>$sb_user_name);
						
				array_push($sb_matcharray,$sum,$sb_user_name,$league_name);
				}
				array_push($sb_scoreresults,$sb_matcharray);
		    }
		 }
		
	
$sb_resultsCount=count($sb_scoreresults);



/*$arr = array();

foreach($sb_scoreresults as $key => $item)
{
   $arr[$item['2']][$key] = $item;
}*/

//ksort($arr, SORT_NUMERIC);




function array_group_by(array $array, $key)
	{
		if (!is_string($key) && !is_int($key) && !is_float($key) && !is_callable($key) ) {
			trigger_error('array_group_by(): The key should be a string, an integer, or a callback', E_USER_ERROR);
			return null;
		}
		$func = (!is_string($key) && is_callable($key) ? $key : null);
		$_key = $key;
		// Load the new array, splitting by the target key
		$grouped = array();
		foreach ($array as $value) {
			$key = null;
			if (is_callable($func)) {
				$key = call_user_func($func, $value);
			} elseif (is_object($value) && isset($value->{$_key})) {
				$key = $value->{$_key};
			} elseif (isset($value[$_key])) {
				$key = $value[$_key];
			}
			if ($key === null) {
				continue;
			}
			$grouped[$key][] = $value;
		}
		// Recursively build a nested grouping if more parameters are supplied
		// Each grouped array value is grouped according to the next sequential key
		if (func_num_args() > 2) {
			$args = func_get_args();
			foreach ($grouped as $key => $value) {
				$params = array_merge( $value , array_slice($args, 2, func_num_args()));
				$grouped[$key] = call_user_func_array('array_group_by', $params);
			}
		}
		return $grouped;
	}

$resultSubArray=array_group_by($sb_scoreresults,2);


function totalSort($a, $b) {
    if ($a['Total'] > $b['Total']) {
        return -1;
    } else if ($a['Total'] < $b['Total']) {
        return 1;
    } else {
        return 0;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Underdog -- App Management Sys</title>
    <link rel="shortcut icon" href="images/american-football.png" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/jquery.bxslider.css" rel="stylesheet">
	<link href="css/responsiveslides.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<header class="innerpage-header">
		<?php include('innerpage_header_admin.php'); ?>
	</header>
	
	
	<section class="inner-menu">
		<?php include('inner_menu_admin.php');  ?>
	</section>
	
	<section class="tab-content-space">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-label-head">Score Board</div>
				<div class="form-box">
					
                    <?php


			   ?>
					
					<div class="betting-table table-responsive">
						<table class="table borderless lobby table-hover" id="score_league_board" >
     <thead>
       <tr>
         <th>User name</th>
         <th>Score</th>
         <th>Rank</th>
       </tr>
     </thead>
     <tbody id="score-table-div">
       <?php
							
							foreach ($resultSubArray as $key => $value){
								
							$pointresults = array();
							
							foreach ($value as $keyname =>  $keyvalue)
							{
								
							  if( ! isset($pointresults[$keyvalue['1']]) )
							  {
								 $pointresults[$keyvalue['1']] = 0;
							  }
							
							  $pointresults[$keyvalue['1']] += $keyvalue['0'];
							
							}
							?>
                            <tr><td><h2><?php echo $key;  ?></h2></td></tr>
       
       <?php
	                       arsort($pointresults);
							$rank = 1;
							$tie_rank = 0;
							$prev_score = -1;
							
							foreach ($pointresults as $keyFname => $keyFvalue){
	   ?>
       
       <tr>
         <td><?php echo $keyFname;  ?></td>
         <td><?php echo $keyFvalue;  ?></td>
         <td><?php if ($keyFvalue != $prev_score) {  //this score is not a tie
							$count = 0;
							$prev_score = $keyFvalue;
							echo $rank ;
						} else { //this score is a tie
							$prev_score = $keyFvalue;
							if ($count++ == 0) {
								$tie_rank = $rank-1;
							}
							echo $tie_rank ;
						}
						$rank++;
	 ?></td>
       </tr>
       
       <?php }  ?>
       <?php }  ?>
     </tbody>
   </table>
					</div>
					
				</div>
			
            <div>&nbsp;</div>
			
			</div>
			
		</div>	
		</div>
	</section>
	
	
	

	
	<footer class="admin">
		<?php include('footer_admin.php'); ?>
	</footer>
	
	
	<!-- Live Match Modal -->
    
    
	  
	  
	
	  
	  
	
	
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.bxslider.js"></script>
	
	<script src="js/responsiveslides.js"></script>
	<script>
		$('.bxslider').bxSlider({
		  mode: 'vertical',
		  auto: true,
		  slideMargin: 5,
		  pager:false
		});
	</script>
	<script>
	  $(function() {
		$(".rslides").responsiveSlides();
		
		document.getElementById('timer').innerHTML =
		  30 + ":" + 00;
		startTimer();

		function startTimer() {
		  var presentTime = document.getElementById('timer').innerHTML;
		  var timeArray = presentTime.split(/[:]+/);
		  var m = timeArray[0];
		  var s = checkSecond((timeArray[1] - 1));
		  if(s==59){m=m-1}
		  //if(m<0){alert('timer completed')}
		  
		  document.getElementById('timer').innerHTML =
			m + ":" + s;
		  setTimeout(startTimer, 1000);
		}

		function checkSecond(sec) {
		  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
		  if (sec < 0) {sec = "59"};
		  return sec;
		}
	  });
	  
	 
	</script>
  </body>
</html>