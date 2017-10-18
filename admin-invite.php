<?php
session_start();
include('db.php');
$login_type=$_SESSION['login_type'];

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
	
	
	
	
  
	
	<section class="inner-content">
		<div class="row">
			<h3 class="text-center black">Invite Friends. Get Premium for Free.</h3>
			<form class="register-form">
				<div class="form-label-head">Get Contacts</div>
				<div class="form-box">
					<p><span class="fa fa-smile-o"></span></p>
					<h3 class="text-center black">Invite your contacts from your Address Book</h3>
					<p><button class="btn facebook"><span class="fa fa-facebook-official"></span> Facebook</button><button class="btn gmail"><span class="fa fa-envelope"></span> Gmail</button><button class="btn twitter"><span class="fa fa-twitter-square"></span> Twitter</button></p>
					<p class="text-center"><input type="text" value="" placeholder="Email address"></p>
					<p class="text-center"><button class="btn btn-secondary customs-btn">Send Invitation</button></p>
				</div>
			</form>
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
	</script>
  </body>
</html>