<?php
$login_type=  $_SESSION['login_type'];
$pageURL= $_SERVER['PHP_SELF'];
$pagename=basename($pageURL); 
 
		$scoreSql=@mysql_query("select * from manage_league where user_id='".$_SESSION['user_id']."'");
		$scoreresults=array();
		 while($data=@mysql_fetch_array($scoreSql))
		 {
			 $league_id=$data['league_id'];
			 $match_id=$data['match_id'];
			 $betTeam=$data['betting_team'];
			 $home_team=$data['home_team'];
			 $away_team=$data['away_team'];
			 $goal_spread_betting=$data['goal_spread_betting'];
			 $goal_spread_opponent=$data['goal_spread_opponent'];
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
					 
						
					
				$resultsData=array('betTeam'=>$betTeam,"winstatus"=>$winStatus,"matchStatus"=>$matchStatus,"score"=>$score,'away_team'=>$away_team,'home_team'=>$home_team,'HomeScore'=>$HomeScore,'AwayScore'=>$AwayScore,'leaguename'=>$league_name);
						
				array_push($matcharray,$resultsData);
				}
				array_push($scoreresults,$matcharray);
		    }
			}
		 }
		
	
$resultsCount=count($scoreresults);
//print_r($scoreresults);
//echo count($scoreresults);
 ?>

<div class="row">
			<div class="col-lg-12">
				<ul class="nav nav-tabs">
					<li  <?php if(($pagename=='lobby.php')){echo 'class="active"'; }?>><a  href="lobby.php" >League</a></li>
					<li  <?php if(($pagename=='live-betting.php')||($pagename=='upcoming.php')||($pagename=='history.php')||($pagename=='manage_league_users.php')){echo 'class="dropdown active"'; }else {echo 'class="dropdown"';}?>><a class="dropdown-toggle" data-toggle="dropdown" href="#">My Contest <span class="caret"></span></a>
						<ul class="dropdown-menu cust-ex">
						 
						  <li><a href="history.php">History</a></li> 
                          
                          <?php if($login_type==1){ ?>
                           <li><a href="manage_league_users.php">Manage Users</a></li>
                          <?php } ?>
                          <?php if($pagename=='live-betting.php'){ ?>
                          <li><a href="javascript:void(0);" data-toggle="modal" data-target="#view_league_Scores"  class="view_leader_board">Leader Board</a></li>
                          <?php }  ?>
						</ul>
					</li>
					<li  <?php if($pagename=='manage-account.php'){echo 'class="active"'; }?>><a href="manage-account.php">My Account</a></li>
                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#viewScoreDetails"  class=" viewScore" >My Scores</a></li>
                    
					<!--<li><a data-toggle="tab" href="#promotions">Promotions</a></li>-->
				</ul>
			</div>
		</div>