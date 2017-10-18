<?php
session_start();
include('db.php');
$login_type=$_SESSION['login_type'];
	$league_session_id=  1;

		$sb_scoreSql=@mysql_query("select * from manage_league where league_id='".$league_session_id."'");
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
					$sb_resultsData=array("score"=>$sum,'username'=>$sb_user_name);	
					
				//$sb_resultsData=array('betTeam'=>$sb_betTeam,"winstatus"=>$sb_winStatus,"matchStatus"=>$sb_matchStatus,"score"=>$sb_score,'away_team'=>$sb_away_team,'home_team'=>$sb_home_team,'HomeScore'=>$sb_HomeScore,'AwayScore'=>$sb_AwayScore,'username'=>$sb_user_name);
						
				array_push($sb_matcharray,$sum,$sb_user_name);
				}
				array_push($sb_scoreresults,$sb_matcharray);
		    }
		 }
		
	
$sb_resultsCount=count($sb_scoreresults);


$pointresults = array();
foreach ($sb_scoreresults as $value)
{
  if( ! isset($pointresults[$value['1']]) )
  {
     $pointresults[$value['1']] = 0;
  }

  $pointresults[$value['1']] += $value['0'];

}

//var_dump($results);
//print_r($pointresults);

 $pointCount=count($pointresults);

function totalSort($a, $b) {
    if ($a['Total'] > $b['Total']) {
        return -1;
    } else if ($a['Total'] < $b['Total']) {
        return 1;
    } else {
        return 0;
    }
}

//$finalArray=uasort($pointresults, 'totalSort');
//print_r($finalArray);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Untitled Document</title>
 </head>
 
 <body>
 <div>
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
							arsort($pointresults);
							$rank = 1;
							$tie_rank = 0;
							$prev_score = -1;
							foreach ($pointresults as $key => $value){
							?>
       <tr>
         <td><?php echo $key;  ?></td>
         <td><?php echo $value;  ?></td>
         <td><?php if ($value != $prev_score) {  //this score is not a tie
							$count = 0;
							$prev_score = $value;
							echo $rank ;
						} else { //this score is a tie
							$prev_score = $value;
							if ($count++ == 0) {
								$tie_rank = $rank-1;
							}
							echo $tie_rank ;
						}
						$rank++;
	 ?></td>
       </tr>
       <?php }  ?>
     </tbody>
   </table>
 </div>
</body>
 </html>
<script src="js/jquery.min.js"></script>
<script>
 $(document).ready(function() { 

});
 </script>