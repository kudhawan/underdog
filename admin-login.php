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
  <body class="admin-login">
	
	<header class="header-main">
    <div class="top-nav-bar">
			<div class="container">
             <div class="col-lg-4 col-md-4 col-sm-2" >
				<div class="inner-logo"><a href="index.php"><img src="images/logo-tagline-red.png" height="65" alt=""></a></div>
			</div>
            
				<div class="col-lg-20 text-right">
              
					<ul class="top-nav-links">
						<li><a href="#" target="_blank"><span class="fa fa-facebook"></span></a> <a href="#" target="_blank"><span class="fa fa-twitter"></span></a> <a href="#" target="_blank"><span class="fa fa-pinterest-p"></span></a> <a href="#" target="_blank"><span class="fa fa-instagram"></span></a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="index.php"><span class="fa fa-home"></span> Home</a></li>
					</ul>
				</div>
			</div>
		</div>
        
        
		<!--<div class="top-nav-bar">
			<div class="container">
             <div class="col-lg-4 col-md-4 col-sm-2" >
				<div class="inner-logo"><a href="index.php"><img src="images/logo-tagline-red.png" height="65" alt=""></a></div>
			</div>
				<div class="col-lg-12 text-right">
					<ul class="top-nav-links">
						<li><a href="#" target="_blank"><span class="fa fa-facebook"></span></a> <a href="#" target="_blank"><span class="fa fa-twitter"></span></a> <a href="#" target="_blank"><span class="fa fa-pinterest-p"></span></a> <a href="#" target="_blank"><span class="fa fa-instagram"></span></a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="index.php"><span class="fa fa-lock"></span> Home</a></li>
					</ul>
				</div>
			</div>
		</div>-->
		
	</header>
	
	<!-- Login Modal  -->
	<div>
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
		  </div>
		  <div class="modal-body">
			<h2 class="text-center"><span class="fa fa-lock"></span> Underdog Admin Management!</h2>
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
			<!--<p><a href="#" href="javascript:void(0);" data-toggle="modal" data-target="#myModal1">Forgot password?</a></p>-->
			<p>Copyright &copy; 2017 <a href="http://albertatechworks.com/" target="_blank">Alberta TechWorks</a></p>
		  </div>
		</div>
	  </div>
	</div>
	
	
	<!-- Forgot Password Modal  -->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<a class="close" data-dismiss="modal" aria-label="Close"><span class="fa fa-window-close-o" aria-hidden="true"></span></a>
			
		  </div>
		  <div class="modal-body">
			<h2 class="text-center">Forgot your login detail?</h2>
			<form class="form-login">
				<label><input type="email" value="" placeholder="Enter your Email Address"></label>
				<label><button type="submit" class="btn btn-secondary customs-btn">Continue</button></label>
			</form>
		  </div>
		  <div class="modal-footer">
			<p><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">Back to Login</a></p>
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
	   $(".validation_chk").val('');
	  
	  /*Removing validation on element keyup event*/
	  $(".validation_chk").keyup(function(){
		if(this.value!='')
		{
			$(this).css("border","");
		}
	
	 });
	  $('.succ_msg,.alert_msg').hide();
	   $(".alertClose").click(function(){
		 $(this).closest("div.alert_box").hide();
	  });
	  	
	 /*Login form script -  validation check/login check*/ 
	  $("#login").click(function(){
		  
		  $('#login_error_msg').html('');
		  $('.alert_msg_login').hide();
						
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
				url: "ajaxfunctions.php?adminlogin",
				data: $('#login_form').serialize(),
				success: function(data) {
					 //alert(data);
					if(data=='success')
					{
						window.location.href='admin-dashboard.php';	
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
	</script>
  </body>
</html>