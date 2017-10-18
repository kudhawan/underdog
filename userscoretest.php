<?php
include('db.php');

$uid=59;
		$scoreSql=@mysql_query("select * from manage_league where user_id='".$uid."'");
		$scoreresults=array();
		 while($scoreData=@mysql_fetch_array($scoreSql))
		 {
			 $league_id=$scoreData['league_id'];
			 $match_id=$scoreData['match_id'];
			 $betTeam=$scoreData['betting_team'];
			 $home_team=$scoreData['home_team'];
			 $away_team=$scoreData['away_team'];
			 $goal_spread_betting=$scoreData['goal_spread_betting'];
			 $goal_spread_opponent=$scoreData['goal_spread_opponent'];
			  $leagueSql=@mysql_query("select league_name,status from league  where id='$league_id' ");
			  $leagueDt=@mysql_fetch_array($leagueSql);
		      $league_name=$leagueDt['league_name'];
			  $match_league_status=$leagueDt['status'];
	 if($match_league_status!=0){ 
			
			$getResult=@mysql_query("select * from results where match_id='$match_id'");
			
			$count= @mysql_num_rows($getResult);
			$matcharray=array();
		 if($count>0)
			{
				$sum = 0;
		    while($resultDt=@mysql_fetch_array($getResult)){
			$HomeScore=$resultDt['home_score'];
			$AwayScore=$resultDt['away_score'];
			$final=$resultDt['final'];
			$final_type=$resultDt['final_type'];
			$OddType=$resultDt['odd_type'];
			
						if($final=='1')
						{
							$matchStatus='Finished';
						}
						else
						{
							$matchStatus='Not Finished';	
						}
							
					if($final=='1')
					{	
					  if($HomeScore>$AwayScore)
						{
							$winStatus="Won the match";
							
						}
						else if($HomeScore<$AwayScore)
						{
							$winStatus="Loose the match";
							
						}
					 }
					 else
					 {
						$winStatus="Game Not completed"; 
						
					 }
					// echo $winStatus;
					if($winStatus=="Won the match")
					{
						$score=abs($goal_spread_betting);
					}
					else
					{
						$score='0';
					}
					 
					$sum += $score;	
				$resultsData=array("score"=>$sum);	
				//$resultsData=array("score"=>$sum);
						
				array_push($matcharray,$sum);
				}
				array_push($scoreresults,$matcharray);
		    }
			}
		 }

$fsum = 0;

foreach($scoreresults as $num => $values) {
    $fsum += $values[ 0 ];
}
echo $fsum;

?>

							