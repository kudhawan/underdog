<?php
session_start();
include('db.php');
$login_type=$_SESSION['login_type'];
$user_id=$_SESSION['user_id'];
if(!isset($_SESSION['user_id']))
{
	header("location:register.php");
}
/* script for score board*/
	//$_SESSION['league_session_id']=$_POST['league_session_id'];
	$league_session_id=  $_POST['league_session_id'];
	
	$league=@mysql_query("select league_name from league  where id='$league_session_id'");
			  $lDt=@mysql_fetch_array($league);
		      $league_name_page=$lDt['league_name'];
			  
			  

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
			  
			  
			  $sb_getResult=@mysql_query("select * from results where match_id='$sb_match_id'");
			  $sb_count= @mysql_num_rows($sb_getResult);
			  $sb_matcharray=array();
			  if($sb_count>0)
			  {
				$sum = 0;
				while($sb_resultDt=@mysql_fetch_array($sb_getResult)){
				$sb_HomeScore=$sb_resultDt['home_score'];
				$sb_AwayScore=$sb_resultDt['away_score'];
				$sb_final=$sb_resultDt['final'];
				$final_type=$sb_resultDt['final_type'];
				$sb_OddType=$sb_resultDt['odd_type'];
			    if($sb_final=='1')
						{
							$sb_matchStatus='Finished';
						}
						else
						{
							$sb_matchStatus='Not Finished';	
						}
						
					if($sb_final=='1')
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
		<?php 
			if(($login_type==1)||($login_type==3)){
				include('innerpage_header.php');
			}
			else if($login_type==2)
			{
				include('innerpage_header_admin.php');
			}
		?>
	</header>
	
	<section class="inner-menu">
       <?php 
			if(($login_type==1)||($login_type==3)){
				include('inner_menu.php');
			}
			else if($login_type==2)
			{
				include('inner_menu_admin.php');
			}
		?>
        
	</section>
	<p id="redirect_msg" style="color:red" align="center"></p>
 <input type="hidden" name="league_session_id" id="league_session_id" value="<?php echo $league_session_id; ?>">
	
	<section class="tab-content-space">
    <div class="row"><h2><?php  echo $league_name_page; ?></h2></div>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="left-sidebar">
					<div class="form-label-head">Matches</div>
					<div class="form-box">
						<ul class="match-table" id="match_paginate">
						
                        <?php
						$output = shell_exec('curl -X GET https://jsonodds.com/api/odds/nfl -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
						$matchArray=json_decode($output);
						
						$length=count($matchArray);
						//print_r($matchArray);
						
						foreach($matchArray as $mydata)
						{
							//echo $mydata->HomeTeam . "\n";
							$matchDatetime=$mydata->MatchTime;
							$splitVal=explode("T",$matchDatetime);
							
							$time=	date('g:i a', strtotime($splitVal[1]." GMT+3"));
						  
						  // $cdatetime=strtotime(date("Y-m-d H:i:s"));
						   
								$date1 = $splitVal[0]." ".$splitVal[1]; 
								
										$date=date('d', strtotime($splitVal[0]));
										$month=date('m', strtotime($splitVal[0]));
										$year=date('Y', strtotime($splitVal[0]));
										$hr=date('H', strtotime($splitVal[1]));
										$min=date('i', strtotime($splitVal[1]));
										$sec=date('s', strtotime($splitVal[1]));
										
										$EasternTimeStamp =mktime($hr-4,$min,$sec,$month,$date,$year);

										$timeLive=	date('g:i A',$EasternTimeStamp) ; 
										$dateLive=	date('D M d', $EasternTimeStamp);
										
										
								$date2 = date("Y-m-d H:i:s"); 
								
								$time1=strtotime($splitVal[1]." GMT+3");
								$time2=strtotime(date("H:i:s")." GMT+3");
								
								$diff = abs((strtotime($date2)." GMT+3") - (strtotime($date1)." GMT+3")); 
								
								$years   = floor($diff / (365*60*60*24)); 
								$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
								$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
								
								$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
								$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

						  		$matchDate=$splitVal[0];
						  		$currentDate=date("Y-m-d");
								
								$staticEnddate = strtotime(date('Y-m-d',strtotime('this Sunday')));
							    $matchDateCheck=strtotime($splitVal[0]);
							    if($matchDateCheck<=$staticEnddate){
						  
							?>
                            
                            <li id="<?php echo $mydata->ID ?>" class="matchLi">
							<div class="match-name"><?php echo $mydata->HomeTeam ?> <span>vs</span> <?php echo $mydata->AwayTeam ?></div>
							<p> <span class="fa fa-dot-circle-o"></span>
							<?php  if($matchDate==$currentDate){ if($time2>$time1){echo "Running";} else {echo $time." Starts in".$hours."h  ".$minuts."m";} }else{ ?>
							<?php echo $dateLive." ".$timeLive; ?> 
                            <?php } } ?>
                            
                             </p>
						</li> 
                            
                            <?php } ?>
                        
					</ul>
					</div>
					
				</div>
			</div>
            <div id="liveData">
           
            
           <?php 
		   
		   if(isset($_POST['match_id']))
		   {
			$id=$_POST['match_id'];
		   }
		   else
		   {
			   $id=$matchArray[0]->ID; 
			   
		   }
			   
			$outputLive = shell_exec('curl -X GET https://jsonodds.com/api/odds/{'.$id.'} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
			   
$matchLiveArray=json_decode($outputLive);

		   foreach($matchLiveArray as $mydataLive) {
			
			   
			    ?> 
            
            
			<div class="col-lg-6 col-md-6 padding-remove" >

								 <?php  
								 foreach ( $mydataLive->Odds as $resultsLive )
									{	
									//if($resultsLive->OddType=='Game'){
										$match_date=$mydataLive->MatchTime;
							            $split=explode("T",$match_date);
										
										/*$timeLive=	date('g:i A', strtotime($split[1]." GMT+3"));
										$dateLive=	date('D M d', strtotime($split[0]));*/
						  
						  // $cdatetime=strtotime(date("Y-m-d H:i:s"));
						   //$datePart1=date('D M d', strtotime($split[0]." GMT+3"));
							$date1 = $split[0]." ".$split[1]; 
								
							
								
								$date=date('d', strtotime($split[0]));
								$month=date('m', strtotime($split[0]));
								$year=date('Y', strtotime($split[0]));
								$hr=date('H', strtotime($split[1]));
								$min=date('i', strtotime($split[1]));
								$sec=date('s', strtotime($split[1]));
								
								$EasternTimeStamp =mktime($hr-4,$min,$sec,$month,$date,$year);
  
								 $timeLiveSpread=	date('g:i A',$EasternTimeStamp) ; 
								 $dateLiveSpread=	date('D M d', $EasternTimeStamp);
								//date_default_timezone_set('America/Los_Angeles');
								
								$currentEasternTimeStamp =mktime(date('H')-6,date('i'),date('s'),date('m'),date('d'),date('Y'));
                                $currentHour = date(' h', $currentEasternTimeStamp);
								$currentMin = date(' i', $currentEasternTimeStamp);
								
								
							   //echo 'Current EST Time ' . date('m/d/Y H:i:s a',$currentEasternTimeStamp) ;	
							
								$day=date('D', $currentEasternTimeStamp);
								
								if($day=='Fri')
								{
									$day_before = date( 'D M d', strtotime( $split[0] . ' -1 day' ) );
									//$thursdayDT= strtotime( $split[0] . ' -1 day' );
									$thursdayDT= mktime($hr-6,$min,$sec,$month,$date-1,$year);
									
									$dateDt=$currentEasternTimeStamp;
									if($dateDt==$thursdayDT)
									{
										
										
										if ($currentHour < 17)
										{
											
											$class='';
										}
										else if (($currentHour == 17)&&($currentMin!='00'))
										{
											$class='disabled';
										}
										else
										{
											$class='disabled';
										}
									}
									else if($dateDt<$thursdayDT)
									{
										
										$class='';
									}
									else if($dateDt>$thursdayDT)
									{
										
										$class='disabled';
									}
								    
								}
								if($day=='Sun')
								{
									//$timeLive=	date('g:i A', strtotime($split[1]." GMT+3"));
									// $sundayDT= strtotime( $split[0] ) ;
									// $dateDt=strtotime(date("Y-m-d"));
									 $sundayDT= mktime($hr-6,$min,$sec,$month,$date-1,$year);
									 $dateDt=$currentEasternTimeStamp;
									if($dateDt==$sundayDT)
									{
										if ($currentHour < 9)
										{
											$class='';
										}
										else if (($currentHour == 9)&&($currentMin!='00'))
										{
											$class='disabled';
										}
										else
										{
											$class='disabled';
										}
									}
									else if($dateDt<$sundayDT)
									{
										$class='';
									}
									else if($dateDt>$sundayDT)
									{
										$class='disabled';
									}
									
								}
							 if($resultsLive->OddType=='Game'){
								 $pointsHome=$resultsLive->PointSpreadHome;
								 $pointsAway=$resultsLive->PointSpreadAway;
								 
								 ?>
				<div class="row" style="margin-top:15px; border-top:1px solid #A4A4A4">
					<div class="form-box">
						<div class="betting-table table-responsive">
							 
                       <form method="post" action="" id="<?php echo $id; ?>_form" class="betting_class">
                       
                         <input type="hidden" name="match_id" id="match_id" value="<?php echo $id; ?>">
                         <input type="hidden" name="event_id" id="event_id" value="<?php  echo $resultsLive->EventID; ?>">
                         <input type="hidden" name="match_date" id="match_date" value="<?php  echo $split[0]." ".$split[1]; ?>">
                         <input type="hidden" name="home_team" id="home_team" value="<?php echo $mydataLive->HomeTeam ?>">
                         <input type="hidden" name="away_team" id="away_team" value="<?php echo $mydataLive->AwayTeam ?>">
                         <input type="hidden" name="betting_team" id="betting_team" value="">
                         <input type="hidden" name="goal_spread_betting" id="goal_spread_betting" value="<?php  echo $resultsLive->PointSpreadHome; ?>">
                         <input type="hidden" name="goal_spread_opponent" id="goal_spread_opponent" value="<?php  echo $resultsLive->PointSpreadAway; ?>">
                         <input type="hidden" name="money_line_betting" id="money_line_betting" value="<?php  echo $resultsLive->MoneyLineHome; ?>">
                         <input type="hidden" name="money_line_opponent" id="money_line_opponent" value="<?php  echo $resultsLive->MoneyLineAway; ?>">
                      </form>
                             
                             
                             <table class="table borderless <?php  echo $class; ?>">
								<thead>
                                 <tr>
									<td colspan="4"><?php echo $timeLiveSpread; ?> ET, <?php echo $dateLiveSpread;  ?></td>
								  </tr>
                                  <tr>
									<th>Team Name</th>
									<th>Goal Spread</th>
									<th>Moneyline</th>
									<th>Total </th>
								  </tr>
								</thead>
								<tbody>
                                  <tr >
									<td><?php echo $mydataLive->HomeTeam ?> </td>
									<td class="link-show"><button class="btn <?php if($pointsHome<$pointsAway){?>bet<?php } ?>" id="home" data-id="<?php echo $id; ?>"> <?php  echo $resultsLive->PointSpreadHome; ?> (<?php  echo $resultsLive->PointSpreadHomeLine; ?>)</button></td>
									<td class="link-show"><button class="btn "><?php  echo $resultsLive->MoneyLineHome; ?></button></td>
									<td class="link-show" rowspan="2"><button class="btn"> <?php  echo $resultsLive->TotalNumber; ?></button></td>
								  </tr>
								  <tr>
									<td><?php echo $mydataLive->AwayTeam ?></td>
									<td class="link-show"><button class="btn <?php if($pointsAway<$pointsHome){?>bet<?php } ?>"  id="away" data-id="<?php echo $id; ?>"><?php  echo $resultsLive->PointSpreadAway; ?> (<?php  echo $resultsLive->PointSpreadAwayLine; ?>)</button></td>
									<td class="link-show"><button class="btn"><?php  echo $resultsLive->MoneyLineAway; ?></button></td>
								  </tr>
								</tbody>
							  </table>
						</div>
						
					</div>
				</div>
			<?php } }?>	
			</div>

		
        <?php  } ?>
    
    
    <div>&nbsp;</div>
    
            <div class="modal fade" id="view_league_Scores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<a class="close" data-dismiss="modal" aria-label="Close" id="close"><span class="fa fa-window-close-o" aria-hidden="true"></span></a>
		  </div>
		  <div class="modal-body">
          <h2 class="text-center">Leader Board</h2>
          <table class="table borderless lobby table-striped" id="score_league_board" style=" background-color:#fff;" >
     <thead>
       <tr>
         <th>User name</th>
         <th>Score</th>
         <th>Rank</th>
       </tr>
     </thead>
     <tbody id="score-table-div">
       <?php
						if($pointCount>0){	
							
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
       <?php } }else { echo "<tr><td colspan=3>No participations found for this league till now</td></tr>";  } ?>
     </tbody>
   </table></div>
		  
		</div>
	  </div>
	</div>   
     </div> 
        
        </div>
	</section>
	
	<?php if(($login_type==1)||($login_type==3)){ ?>
            <footer>
            <?php include('footer.php'); ?>
		    </footer>
            <?php  } else if($login_type==2) { 	?>
             <footer class="admin">
            <?php include('footer_admin.php'); } ?>     
            </footer>
<style>
	.easyPaginateNav{ text-align:center}
	#easyPaginate {width:auto;}
	#easyPaginate img {display:block;margin-bottom:10px;}
	.easyPaginateNav a {padding:5px;}
	.easyPaginateNav a.current {font-weight:bold;text-decoration:underline;}
	.disabled{ pointer-events:none;background-color: #fff;  /* the background          */
       filter:alpha(opacity=50);   /* Internet Explorer       */
       -moz-opacity:0.5;           /* Mozilla 1.6 and below   */
       opacity: 0.5; }
	   
	    #sidebar { width: auto; float: right; }
</style>

	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.bxslider.js"></script>
	
	<script src="js/responsiveslides.js"></script>
     <script src="js/jquery.easyPaginate.js"></script>
    <script>
	    $('#match_paginate').easyPaginate({
        paginateElement: 'li',
        elementsPerPage: 3,
        effect: 'climb'
    });
	</script>
	<script>
	   // $("body").delegate(".bxslider").bxSlider({
		   
      //Foating score board div script
         var offset = $("#sidebar").offset();
            var topPadding = 15;
            $(window).scroll(function() {
                if ($(window).scrollTop() > offset.top) {
                    $("#sidebar").stop().animate({
                        marginTop: $(window).scrollTop() - offset.top + topPadding
                    });
                } else {
                    $("#sidebar").stop().animate({
                        marginTop: 0
                    });
                };
            });
			
			
			

		$('.bxslider').bxSlider({
		  mode: 'vertical',
		  auto: true,
		  slideMargin: 5,
		  pager:false
		});
		
		$(".link-show").click(function(){
			$(".betslip-table").css("display","block");
			$(".betslip  p").css("display","none");
		});
	</script>
	<script>
	  $(function() {
		   $('.view_leader_board').trigger('click');
		   
		   
		$(".rslides").responsiveSlides();
	  });
	  
	  $('body').on('click', '.bet', function (e) 
	  {
		  e.preventDefault();
		 // alert(1);
		var team=$(this).attr('id');
		var idVal=$(this).attr('data-id');
		var league_session_id=$('#league_session_id').val();
		//alert(team);
		$('#betting_team').val(team);
		//var formdata= $("body").delegate("#"+idVal + "_form"). serialize();
		var formdata= $("body").find(".betting_class"). serialize();
		$.ajax({
				type: "POST",
				url: "ajaxfunctions.php?live_betting&team="+team+"&league_session_id="+league_session_id,
				data:  formdata,
				success: function(data) {
					//alert(data);
					$('#redirect_msg').html(data);
				}
		 });
	  });

	  $('body').on('click', '.matchLi', function () {
		  $('#redirect_msg').html('');
		  var idVal=$(this).attr('id');
		   $(".matchLi").css("background-color", "");
		  /* $(".match-table li div").css("color", "#000");
		   (".match-table li span").css("color", "#C11813");
		    (".match-table li p").css("color", "#000");
		   
		   
		   $("#"+idVal + " span").css("color", "#fff");
		   $("#"+idVal + " div").css("color", "#FFCC00");
		   $("#"+idVal + " p").css("color", "grey");*/
		   
		   
		  $("#"+idVal).css("background-color", "#333");
		  
	 // $(".matchLi").click(function(){
		  
		  //alert(idVal);
		   $.ajax({
				type: "POST",
				url: "ajaxfunctions.php?getLiveresults&id="+idVal,
				data: {id:idVal},
				success: function(data) {
					// alert(data);
						//startTimer();
						$('#liveData').html(data);
						
					
				}
		 });

	  });
	  /*document.getElementById('timer').innerHTML =
		  30 + ":" + 00;
		startTimer();*/

		/*function startTimer() {
		  var presentTime = document.getElementById('timer').innerHTML;
		  var timeArray = presentTime.split(/[:]+/);
		  var m = timeArray[0];
		  var s = checkSecond((timeArray[1] - 1));
		  if(s==59){m=m-1}
		  //if(m<0){alert('timer completed')}
		  
		  document.getElementById('timer').innerHTML =
			m + ":" + s;
		  setTimeout(startTimer, 1000);
		}*/

		function checkSecond(sec) {
		  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
		  if (sec < 0) {sec = "59"};
		  return sec;
		}
	</script>
  </body>
</html>