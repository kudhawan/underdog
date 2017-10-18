<?php
session_start();
include('db.php');
$login_type=$_SESSION['login_type'];
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
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
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
	FB.init({
	appId:'1418460641816089',
	//appId:'823064124542994',
	cookie:true,
	status:true,
	xfbml:true
	});
	
function FBInvite(){
	var league_id=$('#league_name').val();
	var token="<?php echo random_string(50); ?>";
	var invited_by="<?php echo $_SESSION['user_id']; ?>";
	if(league_id=='')
	{
		$('#league_name').css("border-color","red");
	}
	else
	{
	  $('#league_name').css("border-color","");
	  FB.ui({
	   method: 'send',
	   link: 'http://www.albertatechworks.com/projects/underdogv1/signup.php?token='+token+'&league_id='+league_id+'&invited_by='+invited_by,
	  },function(response) {
	       $('.succ_msg').hide('');
		   $('.alert_msg').hide('');
	   if (response) {
		   $('.succ_msg').show();
		   $('#succ_msg_invite').html('Your Invitation has been sent successfully');
		   
	   } /*else {
		   $('.alert_msg').html('Failed To Invite');
	   }*/
	  });
   }
 }
</script>




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
	
	<section class="inner-content">
		<div class="row">
			<h3 class="text-center black">Invite Friends. Get Premium for Free.</h3>
           <!-- <div align="center" id="alert_msg_invite" class="alert_msg"></div>
            <div id="succ_msg_invite" class="succ_msg" align="center" style="color:#3C0; ">successfully sent</div>-->
            
            <div  class="succ_msg alert_box" style="display:none">
              <div class="col-md-8"  id="succ_msg_invite"></div>
              <div class="col-md-4"><a class="close alertClose" aria-label="Close" style="color:green">x</a></div>
            </div>
            
            <div  class="alert_msg alert_box"  style="display:none">
              <div class="col-md-8" id="alert_msg_invite"></div>
              <div class="col-md-4"><a class="close alertClose" aria-label="Close" style="color:red">x</a></div>
            </div>
            



            <p>&nbsp;</p>
            
            
			<form class="register-form">
				<div class="form-label-head">Get Contacts</div>
				<div class="form-box">
					<p><span class="fa fa-smile-o"></span></p>
					<h3 class="text-center black">Invite your contacts from your Address Book</h3>
                     <p class="text-center">
                    <!--YmFkbmFyODk=-->
                    <?php
					if($login_type==2)
					{
					$leagues=@mysql_query("select * from league where status=1");	
					}
					else if(($login_type==1)||($login_type==3))
					{
						$user_id=$_SESSION['user_id']; 
						$session_email=$_SESSION['email'] ; 
						$leagueqry='';
						 $lsql=@mysql_query("select league_id from users where id='$user_id' ");
						  if(@mysql_num_rows($lsql)>0){
						  $ldt=@mysql_fetch_array($lsql);  
						  $league_id=$ldt['league_id'];
						  }
						  else
						  {
							$league_id='';  
						  }
						
						$tags = array();
						  $invite=@mysql_query("select league_id from invites where receiver_email='$session_email' and accepted=1");
						  while($inviteDt=@mysql_fetch_array($invite))
						  {
							  $tags[] =$inviteDt['league_id']; 
						  }
						  $league_array="(".implode(',', $tags).")";
						  if(count($tags)>0){
						  $leagueqry="or id in $league_array ";
						  }
						   
						     
						 
						 // echo "select * from league where status=1 and ( added_user='$user_id' or id='$league_id' $leagueqry )";
							$leagues=@mysql_query("select * from league where status=1 and ( added_user='$user_id' or id='$league_id' $leagueqry )");
					}
					
					?>
                    <select name="league_name" id="league_name" class="form-control ">
                    <option value="">Select League</option>
                    <?php
					
					while($data=@mysql_fetch_array($leagues)){
					?>
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['league_name']; ?></option>
                    <?php
					}
					?>
                    </select>
                    
                    </p>
                    
					<p><button type="button" class="btn facebook" id="facebook_but" onclick="FBInvite()" ><span class="fa fa-facebook-official"></span> Facebook</button><button type="button" class="btn gmail" id="email_but" ><span class="fa fa-envelope" ></span> Email</button></p>
					
                   
                   <span id="emailDiv"> 
                    <p class="text-center"><input type="text" value="" id="email" name="email"  placeholder="abc@web,com,xyz@web.com....." class="form-control"></p>
                    <p>&nbsp;</p>
					<p class="text-center"><button type="button" id="send_invite" class="btn btn-secondary customs-btn">Send Invitation</button></p>
                    
                    </span>
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
	  $('.succ_msg,.alert_msg').hide();
	  
	   $(".alertClose").click(function(){
		 
		 
		 $(this).closest("div.alert_box").hide();
		 
	  }); 
	  
	  $("#emailDiv").hide();
	  
	   $("#facebook_but").click(function(){
		  $("#emailDiv").hide(); 
		  $('#email').val('');
	  }); 
	  $("#email_but").click(function(){
		  $("#emailDiv").show(); 
	  });  
	  	$("#send_invite").click(function(){
			var league_name=$('#league_name').val();
			var email=$('#email').val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			 if(league_name=='')
				{
					$('#league_name').focus();
					$('#league_name').css("border-color","red");
					return false;
				}
			else if(email=='')
				{
					$('#email').focus();
					$('#email').css("border-color","red");
					return false;
				}
				
				/*else if ( !emailReg.test( email ) ) {
					$('#email').focus();
					$('#email').css("border-color","red");
					return false;
				}*/
			else{
					$('.succ_msg').hide('');
					$('.alert_msg').hide('');
					
					$.ajax({
						type: "POST",
						url: "ajaxfunctions.php?sendinvite",
						data:{email:email,league_name:league_name},
						success: function(data) {
							//alert(data);
						   $('#email').val('');
						   $('#league_name').val("");
						   $('#league_name').css("border-color","");
						      
		   
						   $('#succ_msg_invite').html('');
		   				   $('#alert_msg_invite').html('');
							if(data=='success')
							
							{
								$('.succ_msg').show('');
								$('#succ_msg_invite').html('Your Invitation has been sent successfully');
								
							}
							else
							{
								$('.alert_msg').show('');
								$('#alert_msg_invite').html(data);
								
								
							}
							 //alert(data);
						}
				 });
		 
			}
		});
	</script>
  </body>
</html>