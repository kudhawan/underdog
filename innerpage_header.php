<?php
//date_default_timezone_set('America/Los_Angeles');
?>
<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-2">
				<div class="inner-logo"><a href="index.php"><img src="images/logo-tagline-red.png" height="65" alt=""></a></div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-10 text-right">
				<ul class="top-inner-navbar">
					<li><?php  echo $_SESSION['first_name'].'&nbsp;'.$_SESSION['last_name'] ?> <a href="logout.php">[Logout]</a></li>
					<!--<li>Balance: $25.00</li>
					<li><a href="#" class="btn-com">ADD CASH</a></li>-->
                    <li><a href="lobby.php" class="btn-com-red">League</a></li>
                    
					<li><a href="invite.php" class="btn-com-red">Invite Friends</a></li>
                    
                    
                    
				</ul>
			</div>
		</div>