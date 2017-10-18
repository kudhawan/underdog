<?php
session_start();
/*if((isset($_SESSION['user_id']))&&($_SESSION['user_id']!=''))
{
	if( $_SESSION['login_type']==1)
	{
		header("location:lobby.php");
	}
	else if($_SESSION['login_type']==2)
	{
		header("location:admin-dashboard.php");
		
	}
}*/
$output = shell_exec('curl -X GET https://jsonodds.com/api/odds/nfl -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
$matchArray=json_decode($output);
$id=$matchArray[0]->ID;

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
	
	<header class="header-main">
    
    
<!--    <div class="row " style="background-color:#000;">
			<div class="col-lg-4 col-md-4 col-sm-2">
				<div class="inner-logo"><a href="admin-dashboard.php"><img src="images/logo-tagline-red.png" height="65" alt=""></a></div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-10 text-right">
				<ul class="top-inner-navbar">
					<li><a href="#" target="_blank"><span class="fa fa-facebook"></span></a> <a href="#" target="_blank"><span class="fa fa-twitter"></span></a> <a href="#" target="_blank"><span class="fa fa-pinterest-p"></span></a> <a href="#" target="_blank"><span class="fa fa-instagram"></span></a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="admin-login.php"><span class="fa fa-home"></span> Admin Login</a></li>
				</ul>
			</div>
		</div>-->
        
        
        
		<div class="top-nav-bar">
			<div class="container">
             <div class="col-lg-4 col-md-4 col-sm-2" >
				<div class="inner-logo"><a href="index.php"><img src="images/logo-tagline-red.png" height="65" alt=""></a></div>
			</div>
            
				<div class="col-lg-20 text-right">
              
					<ul class="top-nav-links">
						<li><a href="#" target="_blank"><span class="fa fa-facebook"></span></a> <a href="#" target="_blank"><span class="fa fa-twitter"></span></a> <a href="#" target="_blank"><span class="fa fa-pinterest-p"></span></a> <a href="#" target="_blank"><span class="fa fa-instagram"></span></a></li>
						<li><a href="#">Contact</a></li>
                        <?php
						   if(!isset($_SESSION['user_id'])){
						 ?>
						<li><a href="admin-login.php"><span class="fa fa-lock"></span> Admin Login</a></li>
                        <?php }else { ?>
                        <li><a href="logout.php"><span class="fa fa-sign-out"></span> Logout</a></li>
                        <?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="container">
			<nav class="navbar" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  
				</div>
				<!--<a class="navbar-brand" href="index.php">
					
				</a>-->
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="navbar-collapse-1">
				 
				  <ul class="nav navbar-nav  custom-menu">
					<!--<li><a href="#">News</a></li>
					<li><a href="#">Team</a></li>
					<li><a href="#">Match Result</a></li>-->
                    <?php
				   if((isset($_SESSION['user_id']))&&($_SESSION['user_id']!='')){
					   if($_SESSION['login_type']==2){
				   ?>
					<li><a href="manage-league.php">League</a></li>
                    <?php } else { ?>
                    <li><a href="lobby.php">League</a></li>
                    <?php } ?>
                    <li><a href="invite.php">Invite Friends</a></li>
                    <?php }  ?>
                    
					<?php
				   if(!isset($_SESSION['user_id'])){
				   ?>
                    <li><a href="register.php">League Leader Signup</a></li>
					<li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" id="loginlink">Login</a></li>
                     <?php } ?>
                    
					<li><a href="#">Underdog</a></li>
				  </ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</div>
	</header>
  
	<section class="banner">
		<ul class="rslides">
		  <li><img src="images/popular_video_banner1.jpg" alt=""></li>
		  <li><img src="images/popular_video_banner.jpg" alt=""></li>
		</ul>
	</section>
  
	<section class="top-headlines">
		<div class="container">
			<div class="col-lg-12 clearfix">
				<div class="top-headlines-ani"><span class="fa fa-dot-circle-o animated pulse infinite"></span> Top Headlines :</div>
				<div class="news-content">
					<ul class="bxslider">
						<li>DeShone Kizer got the somewhat surprising nod to start at quarterback for the Browns in Week 3. </li>
						<li>Jamaal Charles hasn't taken a meaningful, early season snap in what seems like forever.</li>
						<li>The Texans are heading to Dallas due to flooding in the Houston area, according to NFL Network Insider </li>
						<li>For a moment on Saturday, there were fears Paxton Lynch might have lost some future availability. </li>
					</ul>
				</div>
				<div class="view-all"><a href="#">Readmore<span class="fa fa-angle-double-right"></span></a></div>
			</div>
		</div>
	</section>
	
	<section class="upcoming-matches">
		 <?php
		 $outputLive = shell_exec('curl -X GET https://jsonodds.com/api/odds/{'.$id.'} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
			   
           $matchLiveArray=json_decode($outputLive);

		   foreach($matchLiveArray as $mydataLive) {
			   
			    foreach ( $mydataLive->Odds as $resultsLive )
									{	
									    $match_date=$mydataLive->MatchTime;
							            $split=explode("T",$match_date);
										
										$date1 = $split[0]." ".$split[1];
										
										$date=date('d', strtotime($split[0]));
										$month=date('m', strtotime($split[0]));
										$year=date('Y', strtotime($split[0]));
										$hr=date('H', strtotime($split[1]));
										$min=date('i', strtotime($split[1]));
										$sec=date('s', strtotime($split[1]));
										
										$EasternTimeStamp =mktime($hr-4,$min,$sec,$month,$date,$year);

										$timeLive=	date('g:i A',$EasternTimeStamp) ; 
										$dateLive=	date('D M d', $EasternTimeStamp);

										
										/*$timeLive=	date('g:i A', strtotime($split[1]." GMT+3"));
										$dateLive=	date('D M d', strtotime($split[0]));*/
						  
						  // $cdatetime=strtotime(date("Y-m-d H:i:s"));
						   //$datePart1=date('D M d', strtotime($split[0]." GMT+3"));
								 
								
								$day=date('D', strtotime($split[0]));
								date_default_timezone_set('America/Los_Angeles');
                                $currentHour = date(' h', time());
            
            if($resultsLive->OddType=='Game'){
			
			?>
            
        <div class="container">
			<div class="col-lg-2 col-md-2 upcom">
				<h3>Next Game <span class="fa fa-flag-checkered"></span></h3>
			</div>
           
            <div class="col-lg-8 col-md-8">
				<div class="col-lg-12 next-title">Next Game</div>
				<div class="col-lg-4 col-md-3 col-sm-4 text-center">
					<div class="left-team">
						
						<p><?php echo $mydataLive->HomeTeam ?></p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-4 text-center">
					<div class="match-sheducle">
						<div><span class="fa fa-at"></span></div>
						<div class="label-sheducle">
							<p><span class="fa fa-calendar-o"></span><?php echo $dateLive;  ?></p>
							<p><span class="fa fa-clock-o"></span><?php echo $timeLive; ?>   ET</p>
							<!--<p><span class="fa fa-map-marker"></span>LUCAS OIL STADIUM</p>-->
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-3 col-sm-4 text-center">
					<div class="right-team">
						
						<p><?php echo $mydataLive->AwayTeam ?></p>
					</div>
				</div>
                
                
                
				<div class="col-lg-12 next-title">Next Game </div>
			</div>
			<div class="col-lg-2 col-md-2 text-right upcom">
				<h3><a  id="<?php echo $mydataLive->ID ?>" class="matchLi" style="cursor:pointer">Start <br>Bet Now</a></h3>
			</div>
		</div>
        <?php }  } } ?>
	</section>
    
	<section class="content-part">
		<div class="container">
			<div class="col-lg-5 col-md-6">
				<div class="about-underdog">
					<h2 class="line-light">Welcome to Underdog Online Betting</h2>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
					<button class="btn btn-secondary customs-btn">Viewmore</button>
				</div>
			</div>
			
			<div class="col-lg-7 col-md-6">
				
                 <?php
						//date_default_timezone_set('America/Los_Angeles');
						$outputPart = shell_exec('curl -X GET https://jsonodds.com/api/odds/nfl -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
						$matchPartArray=json_decode($outputPart);
						$lengthPart=count($matchPartArray);
						//print_r($matchArray);
						$i = 0;
						foreach($matchPartArray as $mydataPart)
						{
							if($i <= 4) {
							
							//echo $mydata->HomeTeam . "\n";
							$matchDatetime=$mydataPart->MatchTime;
							$splitVal=explode("T",$matchDatetime);
							
							$time=	date('g:i a', strtotime($splitVal[1]." GMT+3"));
						  
						  // $cdatetime=strtotime(date("Y-m-d H:i:s"));
						   
								$date1 = $splitVal[0]." ".$splitVal[1]; 
								$date2 = date("Y-m-d H:i:s"); 
								
								$time1=strtotime($splitVal[1]." GMT+3");
								$time2=strtotime(date("H:i:s")." GMT+3");
								
								$diff = abs((strtotime($date2)." GMT+3") -( strtotime($date1)." GMT+3")); 
								
								$years   = floor($diff / (365*60*60*24)); 
								$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
								$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
								
								$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
								$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

						  		$matchDate=$splitVal[0];
						  		$currentDate=date("Y-m-d");
								
										$date=date('d', strtotime($splitVal[0]));
										$month=date('m', strtotime($splitVal[0]));
										$year=date('Y', strtotime($splitVal[0]));
										$hr=date('H', strtotime($splitVal[1]));
										$min=date('i', strtotime($splitVal[1]));
										$sec=date('s', strtotime($splitVal[1]));
										
										$EasternTimeStamp =mktime($hr-4,$min,$sec,$month,$date,$year);

										$timeLive=	date('g:i A',$EasternTimeStamp) ; 
										$dateLive=	date('D M d', $EasternTimeStamp);
						  
							?>
                            
                
                
                <div class="game-list">
                    <div class="part-a clearfix">
						<div class="team-logo-left pull-left vs"> <span><?php echo $mydataPart->HomeTeam ?></span></div>
						<div class="team-logo-right pull-right"><span><?php echo $mydataPart->AwayTeam ?></span></div>
					</div>
					<div class="part-b clearfix">
						<div class="team-logo-left pull-left"><?php echo $dateLive ."  At ".$timeLive; ?> ET </div>
						<div class="team-logo-right pull-right">
                       <?php if(isset($_SESSION['user_id'])){ ?>
                        <a href="lobby.php"><button class="btn btn-secondary customs-btn "  id="<?php echo $mydataPart->ID ?>"  style="cursor:pointer">Bet Now / Ticket</button></a>
                        <?php }else {  ?>
                        <button class="btn btn-secondary customs-btn " >Bet Now / Ticket</button>
                        <?php } ?>
                        </div>
					</div>
				</div>
                
              <?php } $i++;}  ?>  
			</div>
			
		</div>
	</section>
	
	<footer>
		<div class="container">
			<div class="col-lg-4 col-md-4">
				<div class="contact-details">
					<div class="footer-logo"><a href="#"><img src="images/logo-tagline-red.png" alt=""></a></div>
					<!--<div class="address-detail">
						<p><span class="fa fa-map-marker"></span> 10187 104 St NW, Edmonton, AB T5J 0Z9</p>
						<p><span class="fa fa-mobile"></span> +1 379-226-1326</p>
						<p><span class="fa fa-envelope-o"></span> <a href="mailto:info@underdog.us" target="_blank">info@underdog.us</a></p>
					</div>-->
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="quick-links clearfix">
					<h3>QUICK LINKS</h3>
					<ul class="pull-left">
						<li><span class="fa fa-dot-circle-o"></span><a href="#">About Underdog</a></i>
						<li><span class="fa fa-dot-circle-o"></span><a href="#">NFL Teams</a></i>
						<li><span class="fa fa-dot-circle-o"></span><a href="#">Picks</a></i>
						<li><span class="fa fa-dot-circle-o"></span><a href="#">News</a></i>
					</ul>
					<ul class="pull-right">
						<li><span class="fa fa-dot-circle-o"></span><a href="#">Payments</a></i>
						<li><span class="fa fa-dot-circle-o"></span><a href="#">Privacy Policy</a></i>
						<li><span class="fa fa-dot-circle-o"></span><a href="#">Terms &amp; Conditions</a></i>
						<li><span class="fa fa-dot-circle-o"></span><a href="#">Blog</a></i>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="newsletters">
					<h3>SIGN UP FOR LEAGUE ALERTS</h3>
					<p>Select topics and stay current with our latest news.</p>
					<div class="input-group">
					  <input type="text" class="form-control footer-inputs-customs" placeholder="Your email address">
					  <span class="input-group-btn">
						<button class="btn btn-secondary customs-btn" type="button">SUBMIT</button>
					  </span>
					</div>
				</div>
			</div>
		</div>
		<div class="container copy-rights">
			<div class="col-lg-4 col-md-4">
				<div class="copy-text text-left small-d">Copyright &copy; 2017 <a href="#">Underdog</a> All rights reserved</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="copy-text text-center">
					<ul class="social-links">
						<li><a href="#" target="_blank"><span class="fa fa-facebook"></span></a> </li>
						<li><a href="#" target="_blank"><span class="fa fa-twitter"></span></a></li>
						<li><a href="#" target="_blank"><span class="fa fa-pinterest-p"></span></a></li>
						<li><a href="#" target="_blank"><span class="fa fa-instagram"></span></a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="copy-text text-right small-d">designed and developed at <a href="#">Alberta TechWorks</a></div>
			</div>
		</div>
	</footer>
	
	
	<!-- Login Modal  -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<a class="close" data-dismiss="modal" aria-label="Close"><span class="fa fa-window-close-o" aria-hidden="true"></span></a>
			
		  </div>
		  <div class="modal-body" >
			<h2 class="text-center">Welcome to Underdog !</h2>
            
            
            <!-- <p align="center" id="error_msg" class="alert_msg"></p>-->
             
             <div  class="alert_msg alert_msg_login alert_box"  style="display:none">
              <div class="col-md-8" id="login_error_msg"></div>
              <div class="col-md-4"><a class="close alertClose" aria-label="Close" style="color:red">x</a></div>
            </div>
            <p>&nbsp;</p>
             
			<form class="form-login" action="" method="post" id="login_form">
				<label><input type="text" name="username" id="username" value="" placeholder="Username" class="validation_chk"></label>
				<label><input type="password" name="password" id="password" value="" placeholder="Password" class="validation_chk"></label>
				<label><button type="button" name="login" id="login" class="btn btn-secondary customs-btn">Login</button></label>
			</form>
		  </div>
		  <div class="modal-footer">
			<p><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal1">Forgot password?</a></p>
			<p>Not a League Leader? <a href="register.php">Join today</a></p>
		  </div>
		</div>
	  </div>
	</div>
	
	<!-- Forgot Password Modal  -->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<a class="close" data-dismiss="modal" aria-label="Close" id="forgot_close"><span class="fa fa-window-close-o" aria-hidden="true"></span></a>
			
		  </div>
		  <div class="modal-body">
			<h2 class="text-center">Forgot your login detail?</h2>
            <!-- <p id="alert_msg_forgot" align="center" class="alert_msg" ></p>-->
             
             <div  class="succ_msg succ_msg_fgt alert_box" style="display:none">
              <div class="col-md-10"  id="succ_msg_forgot"></div>
              <div class="col-md-1"><a class="close alertClose" aria-label="Close" style="color:green">x</a></div>
            </div>
            
            <div  class="alert_msg alert_msg_fgt alert_box"  style="display:none">
              <div class="col-md-10" id="alert_msg_forgot"></div>
              <div class="col-md-1"><a class="close alertClose" aria-label="Close" style="color:red">x</a></div>
            </div>
            
            
			<form class="form-login" id="forgot_form">
				<label><input type="email" name="email_forgot" id="email_forgot" value="" placeholder="Enter your Email Address"></label>
                 <span id="email_errorMsg_forgot" align="center" class="error_msg"></span>
				<label><button type="button" name="forgot" id="forgot" class="btn btn-secondary customs-btn">Continue</button></label>
			</form>
		  </div>
		  <div class="modal-footer">
			<p><a id="back_login" style="cursor:pointer">Back to Login</a></p>
			<p>Not a member? <a href="register.php">Join today</a></p>
		  </div>
		</div>
	  </div>
	</div>
	<form method="post" action="live-betting.php" id="matchform">
    <input type="hidden" name="match_id" id="match_id" value="">
    </form>
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
	  });
	   $('body').click(function(e){
		   if ($(e.target).attr('class') != 'modal') {
		     $('.modal-backdrop.in').remove();
		   }
	  });
	  
	   $('.succ_msg,.alert_msg').hide();
	   $(".alertClose").click(function(){
		 $(this).closest("div.alert_box").hide();
	  });
	  
	  /*clearing all validation msgs/error msgs on page load */
	  
	  $(".validation_chk").val('');
	  
	  /*Removing validation on element keyup event*/
	  $(".validation_chk").keyup(function(){
		if(this.value!='')
		{
			$(this).css("border","");
		}
	
	 });	
	 /*Login form script -  validation check/login check*/ 
	  $("#login").click(function(){
		var validation_chk=$('.validation_chk').val();
		if(validation_chk=='')
		{
			$('.validation_chk').css("border-color","red");
			return false;
		}
		
		
		var username=$('#username').val();
		var password=$('#password').val();
		
		
		if(username=='')
		{
			$('#username').focus();
			$('#username').css("border-color","red");
			return false;
		}
		
		else if(password=='')
		{
			$('#password').focus();
			$('#password').css("border-color","red");
			return false;
		}
		
		
		else
		{
		 $.ajax({
				type: "POST",
				url: "ajaxfunctions.php?login",
				data: $('#login_form').serialize(),
				success: function(data) {
					 //alert(data);
					if(data=='success')
					{
						window.location.href='lobby.php?score';	
					}
					else if(data=='Invalid Username')
					{
						//$('#error_msg').html(data);
						$('.alert_msg_login').show();
						$('#login_error_msg').html(data);
						
						
						$("#username").val('');
						$("#password").val('');
					}
					else if(data=='Invalid Password')
					{
						//$('#error_msg').html(data);
						$('.alert_msg_login').show();
						$('#login_error_msg').html(data);
						
						$("#username").val(username);
						$("#password").val('');
					}
					else
					{
						//$('#error_msg').html(data);
						$('.alert_msg_login').show();
						$('#login_error_msg').html(data);
						
						$("#username,#password").val('');
					}
				}
		 });
		 
		}
	 });
	 /* forgot password script*/
	 $("#email_forgot").keyup(function(){
		if(this.value!='')
		{
			$(this).css("border","");
		}
	
	});	
	$("#back_login").click(function(){
		$('#forgot_close').trigger('click');
	
	});	
	
	
	
	$("#email_forgot").blur(function(){
		 var email_forgot=this.value;
		 var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		 if(email_forgot=='')
			{
				$('#email_forgot').focus();
				$('#email_forgot').css("border-color","red");
				return false;
			}
			else if ( !emailReg.test( email_forgot ) ) {
				$('#email_forgot').focus();
				$('#email_forgot').css("border-color","red");
				return false;
			}
			else
			{
				$(this).css("border","");
			}
	
	});	
	
	
	$('#email_errorMsg_forgot').hide();
	$("#forgot").click(function(){
		
		var email_forgot=$('#email_forgot').val();
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		if(email_forgot=='')
		{
			$('#email_forgot').focus();
			$('#email_forgot').css("border-color","red");
			return false;
		}
		else if ( !emailReg.test( email_forgot ) ) {
            $('#email_forgot').focus();
			$('#email_forgot').css("border-color","red");
			$('#email_errorMsg_forgot').html('Please enter a valid email address').modal();
			return false;
        }
		
		else
		{
			$('#email_errorMsg_forgot').html('').modal();
		    $.ajax({
				type: "POST",
				url: "ajaxfunctions.php?forgot",
				data: $('#forgot_form').serialize(),
				success: function(data) {
					// alert(data);
					if(data=='success')
					{
						//window.location.href='email_confirmation.php';	
						//$('#alert_msg_forgot').html(data).modal();
						
						$('.succ_msg_fgt').show().modal();	
						$('#succ_msg_forgot').html(data).modal();
						
					}
					else
					{
						//$('#alert_msg_forgot').html(data).modal();
						$('.alert_msg_fgt').show().modal();
						$('#alert_msg_forgot').html(data).modal();
						$('#email_forgot').val('');
						
					}
				}
		     });
		 
		}
	 });
	 $('body').on('click', '.matchLi', function () {
		   var idVal=$(this).attr('id');
		   <?php
		   if((isset($_SESSION['user_id']))&&($_SESSION['user_id']!='')){
		   ?>
		    $('#match_id').val(idVal);
		    $('#matchform').submit();
		   <?php }else{  ?>
		   $('#loginlink').trigger('click');
		   <?php }  ?>
		  
	  });
	</script>
  </body>
</html>