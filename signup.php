<?php
session_start();
include('db.php');

$token=$_GET['token'];

	if(isset($_GET['token']))
	{
		$tokenVal=1;
	}
	else
	{
		$tokenVal='';
	}
	if(isset($_GET['league_id']))
	{
		$league_id=$_GET['league_id'];
	}
	else
	{
		$league_id='';
		
	}
	$invited_by=$_GET['invited_by'];
	
	$getMail=@mysql_fetch_array(@mysql_query("select receiver_email from invites where token='$token' and league_id='$league_id'"));
	$receiver_email=$getMail['receiver_email'];
	
	
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
		<div class="row">
			<h3 class="text-center black">Already a member? <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="orange">LOGIN HERE</a></h3>
                    <!--<p align="center" id="error_msg" class="alert_msg"></p>
                     <p align="center" id="succ_msg" class="alert_msg" style="color:green"></p>-->
             <div  class="succ_msg alert_box" style="display:none">
              <div class="col-md-8"  id="succ_msg_invite"></div>
              <div class="col-md-4"><a class="close alertClose" aria-label="Close" style="color:green">x</a></div>
            </div>
            
            <div  class="alert_msg alert_box"  style="display:none">
              <div class="col-md-8" id="alert_msg_invite"></div>
              <div class="col-md-4"><a class="close alertClose" aria-label="Close" style="color:red">x</a></div>
            </div>
            <p>&nbsp;</p>   

			<form class="register-form" id="signup_form" method="post" action="">
				<div class="form-label-head">Account Information</div>
				<div class="form-box">
                   
                    
                    
                    <label>
						<span>First Name :</span>
						<input type="text" name="first_name" id="first_name" value="" placeholder="First Name" class="validation_chk">
					</label>
					<label>
						<span>Last Name :</span>
						<input type="text" value="" name="last_name" id="last_name" placeholder="Last Name" class="validation_chk">
					</label>
					<label>
						<span>Username :</span>
						<input type="text" value="" name="username" id="username" placeholder="Username" class="validation_chk">
					</label>
                     <span id="username_errorMsg" class="error_msg"> </span>
					<label>
						<span>Password :</span>
						<input type="password" value="" name="password" id="password" placeholder="Password" class="validation_chk">
					</label>
					<label>
						<span>Re-Password :</span>
						<input type="password" value="" name="re_password" id="re_password" placeholder="Re enter Password" class="validation_chk">
					</label>
                    <span id="password_errorMsg" class="error_msg"></span>
					<label>
						<span>Email address :</span>
						<input type="email"  name="email" id="email" placeholder="Email address" value="<?php echo $receiver_email; ?>" readonly>
					</label>
                    <span id="email_errorMsg" class="error_msg"> </span>
                   
                    
				</div>

				<p>By joining, I accept the <a href="#">Rules Agreement</a> and <a href="#">Privacy Policy.</a> You may receive account updates and special offers by email.</p>
				<p><button class="btn btn-secondary customs-btn" type="button"  id="submit" name="submit">Join Now !</button></p>
			</form>
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
						<li><span class="fa fa-dot-circle-o"></span><a href="#">Betting</a></i>
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
				<div class="copy-text text-right small-d">designed and developed at <a href="#">Alberta TechWorks</a></div>
			</div>
		</div>
	</footer>
	
	
		<!-- Login Modal  -->
	<div class="modal " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
	<div class="modal " id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<a class="close" data-dismiss="modal" aria-label="Close"  id="forgot_close"><span class="fa fa-window-close-o" aria-hidden="true"></span></a>
			
		  </div>
		  <div class="modal-body">
			<h2 class="text-center">Forgot your login detail?</h2>
            
           
            <!--<p id="alert_msg_forgot" align="center" class="alert_msg" ></p>-->
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
			<p>Not a member? <a href="register.php">Join today</a></p>
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
	  $("#first_name,#last_name,#username,#password,#re_password,#email_forgot,#alert_msg_forgot").val('');
	  $('.error_msg').html("");
	  $('.error_msg').hide();
	  $(".validation_chk").keyup(function(){
		if(this.value!='')
		{
			$(this).css("border","");
		}
	
		});	
	
		
		$('#password, #re_password').keyup(function(){
			$('#password_errorMsg').html("");
			
		});	
		$('#email').keyup(function(){
			$('#email_errorMsg').html("");
		});
		$('#email_forgot').keyup(function(){
			$('#email_errorMsg_forgot').html("");
		});
			
		
		
	
	
	  /*script for registraion form validation/submit*/
	  $("#submit").click(function(){
		var validation_chk=$('.validation_chk').val();
		if(validation_chk=='')
		{
			$('.validation_chk').css("border-color","red");
			return false;
		}
		
		var first_name=$('#first_name').val();
		var last_name=$('#last_name').val();
		var username=$('#username').val();
		var password=$('#password').val();
		var re_password=$('#re_password').val();
		var email=$('#email').val();
		
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		 if(first_name=='')
		{
			$('#first_name').focus();
			$('#first_name').css("border-color","red");
			return false;
		}
		else if(last_name=='')
		{
			$('#last_name').focus();
			$('#last_name').css("border-color","red");
			return false;
		}
		else if(username=='')
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
		else if(re_password=='')
		{
			$('#re_password').focus();
			$('#re_password').css("border-color","red");
			return false;
		}
		else if(password!=re_password)
		{
			$('#re_password').focus();
			$('#re_password').css("border-color","red");
			$('#password_errorMsg').html('Password and confirm password should be same');
			return false;
		}
		else if(email=='')
		{
			$('#email').focus();
			$('#email').css("border-color","red");
			return false;
		}
		else if ( !emailReg.test( email ) ) {
            $('#email').focus();
			$('#email').css("border-color","red");
			$('#email_errorMsg').html('Enter a valid email address');
			return false;
        }
		else
		{
		 $('#email_errorMsg_forgot').html('');
		 $.ajax({
				type: "POST",
				url: "ajaxfunctions.php?usersignup&token=<?php echo $tokenVal; ?>&league_id=<?php  echo $league_id; ?>&invited_by=<?php  echo $invited_by; ?>",
				data: $('#signup_form').serialize(),
				success: function(data) {
					// alert(data);
					$("#first_name,#last_name,#username,#password,#re_password").val('');
					if(data=='success')
					{
						//window.location.href='lobby.php?score';
						/*$('#succ_msg').show();	
						$('#succ_msg').html("Confirmation mail has been sent to your registered email address");*/
						
						$('.succ_msg').show('');
						$('#succ_msg_invite').html('Confirmation mail has been sent to your registered email address');
						
						
					}
					else
					{
						/*$('#error_msg').show();
						$('#error_msg').html(data);*/
						
						$('.alert_msg').show('');
						$('#alert_msg_invite').html(data);
						
					}
				}
		 });
		 
		}
	 });
	 
	 	$("#email").blur(function(){
		  var email=this.value;
		  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		  if(email!='')
		  {
				 $.ajax({
						type: "POST",
						url: "ajaxfunctions.php?checkEmail",
						data: {'email':email},
						success: function(data) {
							//alert(data);
							if(data=='Failed')
							{
							 $('#email').val('');
							 $('#email_errorMsg').show();
							 $('#email_errorMsg').html('Email Already Exists');
							 $('#email').focus();
							 $('#email').css("border-color","red");
							}
							else
							{
							$('#email_errorMsg').hide();
							$('#email').css("border","");	
							}
						}
				 });
		  }
	 });
	 
	 
	  $("#username").blur(function(){
		  var username=this.value;
		  if(username!='')
			{
				  $.ajax({
						type: "POST",
						url: "ajaxfunctions.php?checkuserName",
						data: {'username':username},
						success: function(data) {
							//alert(data);
							if(data=='Failed')
							{
							 $('#username').val('');
							 $('#username_errorMsg').show();
							 $('#username_errorMsg').html('This user name has already taken.Please try with another user name');
							 $('#username').focus();
							 $('#username').css("border-color","red");
							}
							else
							{
							$('#username_errorMsg').hide();
							$('#username').css("border","");	
							}
						}
				 });
		 
			}
	 });
	 
	 
	 
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
	</script>
  </body>
</html>