<?php
session_start();
include('db.php');
	
	$invite_user_id=$_GET['invite_user_id'];
	$league_id=$_GET['league_id'];
	$invited_by=$_GET['invited_by'];
	
	$leagueSql=@mysql_query("select league_name from league  where id='$league_id'");
	$leagueDt=@mysql_fetch_array($leagueSql);
	$league_name=$leagueDt['league_name'];
	
	$get=@mysql_query("select email from users where  id='$invite_user_id' ");
	$user_dt=@mysql_fetch_array($get);
	$receiver_email=$user_dt['email'];
	
	$check=@mysql_query("select * from invites where receiver_email='$receiver_email' and accepted=1");
	$num=@mysql_num_rows($check);
	
	if($num==0){
	
	$inviteSql=@mysql_query("update invites set accepted=1 where receiver_email='$receiver_email'");
	$msg='<span style="color:green"> Thanks For accepting the invitation for the league '.$league_name.' .Click <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" id="loginlink">here</a> to login </span>';
	
	
	}
	else
	{
		$msg=" <span style='color:red'>Your  invitation was expired</span>";
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
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-2">
				<div class="inner-logo"><a href="index.php"><img src="images/logo-tagline-red.png" height="65" alt=""></a></div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-10 text-right">
				<ul class="top-nav-links top-space">
					<li><a href="#" target="_blank"><span class="fa fa-facebook"></span></a> <a href="#" target="_blank"><span class="fa fa-twitter"></span></a> <a href="#" target="_blank"><span class="fa fa-pinterest-p"></span></a> <a href="#" target="_blank"><span class="fa fa-instagram"></span></a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="admin-login.php"><span class="fa fa-lock"></span> Admin Login</a></li>
				</ul>
			</div>
		</div>
	</header>
	
	
	
	<section class="inner-content">
		<div class="row" style="height:150px">
        <?php if((isset($msg))&&($msg!='')) {  echo $msg;  } ?>
        </div>
	</section>
	
	<footer>
		<div class="container">
			<div class="col-lg-4 col-md-4">
				<div class="contact-details">
					<div class="footer-logo"><a href="#"><img src="images/logo-tagline-red.png" alt=""></a></div>
					
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
				<div class="copy-text text-right small-d">Designed and developed at <a href="#">Alberta TechWorks</a></div>
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
           <!-- <p id="login_error_msg" align="center" class="alert_msg" ></p>-->
            <div  class="alert_msg alert_msg_login alert_box"  style="display:none">
              <div class="col-md-8" id="login_error_msg"></div>
              <div class="col-md-4"><a class="close alertClose" aria-label="Close" style="color:red">x</a></div>
            </div>
            <p>&nbsp;</p> 
             
			<form class="form-login" action="" method="post" id="login_form">
				<label><input type="text" name="login_username" id="login_username" value="" placeholder="Username" class="validation_chk"></label>
				<label><input type="password" name="login_password" id="login_password" value="" placeholder="Password" class="validation_chk"></label>
				<label><button type="button" name="login" id="login" class="btn btn-secondary customs-btn">Login</button></label>
			</form>
		  </div>
		  <div class="modal-footer">
			<p><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal1">Forgot password?</a></p>
			<p>Not a member? <a href="register.php">Join today</a></p>
		  </div>
		</div>
	  </div>
	</div>
	
	<!-- Forgot Password Modal  -->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<a class="close" data-dismiss="modal" aria-label="Close"  id="forgot_close"><span class="fa fa-window-close-o" aria-hidden="true"></span></a>
			
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
            <p>&nbsp;</p>
            
			<form class="form-login" id="forgot_form">
				<label><input type="email" name="email_forgot" id="email_forgot" value="" placeholder="Enter your Email Address"></label>
                 <span id="email_errorMsg_forgot" align="center" class="error_msg"></span>
				<label><button type="button" name="forgot" id="forgot" class="btn btn-secondary customs-btn">Continue</button></label>
			</form>
		  </div>
          
		  <div class="modal-footer">
			<p><a id="back_login" style="cursor:pointer">Back to Login</a></p>
			<!--<p>Not a member? <a href="register.php">Join today</a></p>-->
		  </div>
		</div>
	  </div>
	</div>	
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.bxslider.js"></script>
	
	<script src="js/responsiveslides.js"></script>
     <script src="js/bootstrap-datepicker.js"></script>
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
 $(".validation_chk").val('');
	  
	  /*Removing validation on element keyup event*/
	  $(".validation_chk").keyup(function(){
		if(this.value!='')
		{
			$(this).css("border","");
		}
	
	 });	
	 /*Login form script -  validation check/login check*/ 
	  /*Login form script -  validation check/login check*/ 
	  $("#login").click(function(){
		
		
		var login_username=$('#login_username').val();
		var login_password=$('#login_password').val();
		
		
		if(login_username=='')
		{
			$('#login_username').focus();
			$('#login_username').css("border-color","red");
			return false;
		}
		
		else if(login_password=='')
		{
			$('#login_password').focus();
			$('#login_password').css("border-color","red");
			return false;
		}
		
		
		else
		{
		 $.ajax({
				type: "POST",
				url: "ajaxfunctions.php?reglogin",
				data: $('#login_form').serialize(),
				success: function(data) {
					// alert(data);
					if(data=='success')
					{
						window.location.href='lobby.php?score';	
					}
					else if(data=='Invalid Username')
					{
						//$('#login_error_msg').html(data).modal();
						$('.alert_msg_login').show().modal();
						$('#login_error_msg').html(data).modal();
						$("#login_username").val('');
						$("#login_password").val('');
					}
					else if(data=='Invalid Password')
					{
						//$('#login_error_msg').html(data).modal();
						$('.alert_msg_login').show().modal();
						$('#login_error_msg').html(data).modal();
						$("#login_username").val(login_username);
						$("#login_password").val('');
					}
					else
					{
						//$('#login_error_msg').html(data).modal();
						$('.alert_msg_login').show().modal();
						$('#login_error_msg').html(data).modal();
						$("#login_username,#login_password").val('');
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
	</script>
  </body>
</html>