<?php

 $pageURL= $_SERVER['PHP_SELF'];
 $pagename=basename($pageURL); 
 $class='dropdown active';
 
 		 $scoreSql=@mysql_query("select * from manage_league where user_id='".$_SESSION['user_id']."'");
		$scoreresults=array();
		 while($data=@mysql_fetch_array($scoreSql))
		 {
			 $match_id=$data['match_id'];
			 $betTeam=$data['betting_team'];
			 $home_team=$data['home_team'];
			 $away_team=$data['away_team'];
			 $goal_spread_betting=$data['goal_spread_betting'];
			 $goal_spread_opponent=$data['goal_spread_opponent'];
			 
			 $output = shell_exec('curl -X GET https://jsonodds.com/api/results/{'.$match_id.'} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
	         $resultArray=json_decode($output);
			 $count= count($resultArray);
			 $matcharray=array();
			if($count>0)
			{
			//print_r($resultArray);
			 
			  foreach($resultArray as $results) 
				{
						 $HomeScore=$results->HomeScore;
						 $AwayScore=$results->AwayScore;
						 $final=$results->Final;
						 $OddType=$results->OddType;
						if($final=='true')
						{
							$matchStatus='Finished';
						}
						else
						{
							$matchStatus='Not Finished';	
						}
							
						if($betTeam=='home')
						{
							$participatedTeamScore=$HomeScore;
							$opponentTeamScore=$AwayScore;
							
						}
						else if($betTeam=='away')
						{
							$participatedTeamScore=$AwayScore;
							$opponentTeamScore=$HomeScore;
							
							
						}
						
					if($final=='true')
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
				if($winStatus=="Won the match")
					{
						$score=abs($goal_spread_betting);
					}
					else
					{
						$score='';
					}		
					
				$resultsData=array('betTeam'=>$betTeam,"winstatus"=>$winStatus,"matchStatus"=>$matchStatus,"score"=>$score,'away_team'=>$away_team,'home_team'=>$home_team,'HomeScore'=>$HomeScore,'AwayScore'=>$AwayScore);
						
				array_push($matcharray,$resultsData);
				}
				array_push($scoreresults,$matcharray);
		    }
		 }
		
	
$resultsCount=count($scoreresults);
//print_r($scoreresults);
//echo count($scoreresults);
?>

<div class="row">
			<div class="col-lg-12">
				<ul class="nav nav-tabs">
					<li <?php if($pagename=='manage-league.php'){echo 'class="dropdown active"'; }?>><a href="manage-league.php"><span class="fa fa-futbol-o white"></span> League</a></li>
					<li <?php if($pagename=='manage-betting.php'){echo 'class="dropdown active"'; }?>><a href="manage-betting.php"><span class="fa fa-trophy white"></span> Picks</a></li>
					<li <?php if($pagename=='manage-user.php'){echo 'class="dropdown active"'; }?>><a href="manage-user.php"> <span class="fa fa-user white"></span> User</a></li>
					<!--<li><a href="manage-payment.html"> <span class="fa fa-money white"></span> Payment</a></li>-->
					<li <?php if($pagename=='manage-account.php'){echo 'class="dropdown active"'; }?>><a href="manage-account.php"><span class="fa fa-cog white"></span> My Account</a></li>
                    <li <?php if($pagename=='league_score_board.php'){echo 'class="dropdown active"'; }?>><a href="league_score_board.php"><span class="fa fa-cog white"></span> Score Board</a></li>
                   <!-- <li><a href="javascript:void(0);" data-toggle="modal" data-target="#viewScoreDetails"  class="btn-com viewScore" >My Scores</a></li>-->
				</ul>
			</div>
		</div>