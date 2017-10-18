<?php
session_start();
include('db.php');
require 'PHPMailer/PHPMailerAutoload.php';
include 'PHPMailer/class.smtp.php';
require("PHPMailer/class.PHPMailer.php");


function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

/**
     * Basic functions of the  application.
     *
     * - login - The login script for underdog app.
     * - signup - The Registration script for underdog app.
	  * - adminlogin - The Admin section login script for underdog app.
     
     */

/*Underdog Login script*/
if(isset($_GET['login']))
{
	$username=$_POST['username'];
	$password=base64_encode($_POST['password']);
	
	
	 $get=@mysql_query("select * from users where username='$username' and password='$password' and status=1 and login_type in  (1,3)");
	 $num=@mysql_num_rows($get);
	 if($num>0)
	 {
		$dt=@mysql_fetch_array($get);
		  
		  $_SESSION['first_name']=$dt['first_name'];
		  $_SESSION['last_name']=$dt['last_name'];
		  $_SESSION['user_id']=$dt['id'];
		  $_SESSION['email']=$dt['email'];
		  $_SESSION['login_type']=$dt['login_type'];
		
		 echo "success";
		 
		//header("location:lobby.php?score");
		 
	 }
	 else
	 {
		 $checkUsername=@mysql_query("select * from users where username='$username' "); 
		 $udt=@mysql_fetch_array($checkUsername);
		 $status=$udt['status'];
		 $user_confirm=$udt['user_confirm'];
		 $numU=@mysql_num_rows($checkUsername);
		 $checkPassword=@mysql_query("select * from users where password='$password' and  status=1"); 
		 $numP=@mysql_num_rows($checkPassword);
		 
		 if($numU==0)
		 {
			
			echo "Invalid Username"; 
		 }
		 else if($numU>0)
		 {
			 
			  if($user_confirm==0)
			 {
				echo "Registration not completed";  
			 }
			 
			 else if($status==0)
			 {
				echo "Account has been blocked";  
			 }
			 
			 else if($numP==0)
			 {
				 echo "Invalid Password"; 
			 }
			 else
			 {
				 echo "Invalid username/password entered";  
			 }
		 }
		 else if($numP==0)
		 {
			 echo "Invalid Password"; 
		 }
		 else
		 {
			 echo "Invalid username/password entered"; 
		 }
		 
		 
		 
		//echo "Failed"; 
	 }
	
	
}


if(isset($_GET['reglogin']))
{
	 $username=$_POST['login_username'];
	 $password=base64_encode($_POST['login_password']);
	
	
	 $get=@mysql_query("select * from users where username='$username' and password='$password' and status=1 and login_type in (1,3)");
	 $num=@mysql_num_rows($get);
	 if($num>0)
	 {
		$dt=@mysql_fetch_array($get);
		  $_SESSION['first_name']=$dt['first_name'];
		  $_SESSION['last_name']=$dt['last_name'];
		  $_SESSION['user_id']=$dt['id'];
		  $_SESSION['email']=$dt['email'];
		  $_SESSION['login_type']=$dt['login_type'];
		
		 echo "success";
		 
	 }
	 else
	 {
		 $checkUsername=@mysql_query("select * from users where username='$username' "); 
		 $udt=@mysql_fetch_array($checkUsername);
		 $status=$udt['status'];
		 $user_confirm=$udt['user_confirm'];
		 $numU=@mysql_num_rows($checkUsername);
		 $checkPassword=@mysql_query("select * from users where password='$password' and  status=1"); 
		 $numP=@mysql_num_rows($checkPassword);
		 
		 if($numU==0)
		 {
			
			echo "Invalid Username"; 
		 }
		 else if($numU>0)
		 {
			 
			 if($user_confirm==0)
			 {
				echo "Registration not completed";  
			 }
			 
			 else if($status==0)
			 {
				echo "Account has been blocked";  
			 }
			 
			 else if($numP==0)
			 {
				 echo "Invalid Password"; 
			 }
			 else
			 {
				 echo "Invalid username/password entered";  
			 }
		 }
		 else if($numP==0)
		 {
			 echo "Invalid Password"; 
		 }
		 else
		 {
			 echo "Invalid username/password entered"; 
		 }
		 
		 
		 
		//echo "Failed"; 
	 }
	
	
}
/*Admin login script*/
if(isset($_GET['adminlogin']))
{
	$username=$_POST['username'];
	$password=base64_encode($_POST['password']);
	
	
	 $get=@mysql_query("select * from users where username='$username' and password='$password' and status=1 and login_type=2");
	 $num=@mysql_num_rows($get);
	 if($num>0)
	 {
		$dt=@mysql_fetch_array($get);
		  $_SESSION['first_name']=$dt['first_name'];
		  $_SESSION['last_name']=$dt['last_name'];
		  $_SESSION['user_id']=$dt['id'];
		  $_SESSION['email']=$dt['email'];
		  $_SESSION['login_type']=$dt['login_type'];
		
		 echo "success";
		 
	 }
	 else
	 {
		 $checkUsername=@mysql_query("select * from users where username='$username' and  status=1 login_type=2"); 
		 $numU=@mysql_num_rows($checkUsername);
		 $checkPassword=@mysql_query("select * from users where password='$password' and  status=1 login_type=2"); 
		 $numP=@mysql_num_rows($checkPassword);
		 
		 if($numU==0)
		 {
			echo "Invalid Username"; 
		 }
		 else if($numP==0)
		 {
			 echo "Invalid Password"; 
		 }
		 else
		 {
			 echo "Invalid username/password entered"; 
		 }
		 
		 
		 
		//echo "Failed"; 
	 }
	
	
}


/*Underdog Registration script*/




if(isset($_GET['signup']))
{
    /*Declaring Post variables*/
    $first_name=mysql_real_escape_string($_POST['first_name']);
	$last_name=mysql_real_escape_string($_POST['last_name']);
	$username=mysql_real_escape_string($_POST['username']);
	$password=base64_encode($_POST['password']);
	$email=$_POST['email'];
	$middile_name='';
	$gender='';
	$dob='';
	$added_date=date("Y-m-d H:i:s");
    $status=0;
	$login_type=1;
	$user_confirm=1;
	$random_string=random_string(50);
	
	$added_from='Underdog';
	//$league_id=mysql_real_escape_string($_POST['league_name']);
	
	$league_name=mysql_real_escape_string($_POST['league_name']);
	$min_entries=2;
	$prizes='';
	$entry_fee='';
	$tot_sizes='';
	$start_date='';
	$end_date='';
	$inputBody='';
	$added_user='';
	$added_date=date("Y-m-d H:i:s");
    $status=0;
	
	$invited_by='';
	 
	 
		    $insLeague="insert into league(`id`,`league_name`,`min_entries`,`prizes`,`entry_fee`,`tot_sizes`,`start_date`,`end_date`,`inputBody`,`added_user`,`added_date`,`status`) values('','".$league_name."','".$min_entries."','".$prizes."','".$entry_fee."','".$tot_sizes."','".$start_date."','".$end_date."','".$inputBody."','".$added_user."','".$added_date."','".$status."')";
		 
		  
		  
		//exit;   
		$qryLeague=@mysql_query($insLeague);
		 if($qryLeague)
		 {
			$league_id=@mysql_insert_id();
		 }
		else
		{
			$league_id='';
		}
		 
	 
	 //$random_number=rand ( 10000 , 99999 );
	 
	$getEmail=@mysql_query("select * from users where email='$email' and status=1");
	$emailNum=@mysql_num_rows($getEmail);
	
	$getUser=@mysql_query("select * from users where username='$username' and status=1");
	$userNum=@mysql_num_rows($getUser);
	
	
	if(($emailNum==0)&&($userNum==0)&&($league_id!=''))
	{
		 $ins=@mysql_query("insert into users(`id`,`league_id`,`invited_by`,`first_name`,`last_name`,`username`,`password`,`middile_name`,`gender`,`dob`,`email`,`added_from`,`added_date`,`status`,`login_type`,`user_confirm`) values('','".$league_id."','".$invited_by."','".$first_name."','".$last_name."','".$username."','".$password."','".$middile_name."','".$gender."','".$dob."','".$email."','".$added_from."','".$added_date."','".$status."','".$login_type."','".$user_confirm."')");
		   
		//$qry=@mysql_query($ins);
		 if($ins)
		 {
			 echo "success";
			 /*Creating session variables*/
			 $cretaed_user=@mysql_insert_id();
			 
			  /*$_SESSION['user_id']=@mysql_insert_id();
			  $_SESSION['first_name']=$first_name;
			  $_SESSION['last_name']=$last_name;
			  $_SESSION['email']=$email;
			  $_SESSION['login_type']=$login_type;*/
			  
			  
			  
			  $update=@mysql_query("update league set added_user =".$cretaed_user."  where id=".$league_id."");
			  
			   $leagueSQL=@mysql_query("select league_name from league where id='$league_id'");
			   $leagueDt=@mysql_fetch_array($leagueSQL);
			   $league_name= $leagueDt['league_name'];
			   
			  
			  
		$subject='Welcome to Underdog';
		
	  $link= $_SERVER['HTTP_HOST']."/projects/underdogv1/accept.php?token=".$random_string."&userId=".$cretaed_user."&league_id=".$league_id;

		$message = "Hi&nbsp;" . $first_name . "!," . "<br/><br/>" . " Welcome to Underdog.<br><br>Now You became a member  of the  league <b>".$league_name."</b> at Underdog.<span><br/><br/>Click Below link to confirm . <br/><br/><p>".$link."</p><br/><br/>@" . date("Y") . " Underdog";
			
		$FromName='Underdog';	  
	    $mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPSecure = "tls";
        $mail->Host= "smtp.ipage.com";
		$mail->SMTPAuth = true;
		$mail->Username = 'aruna@albertatechworks.com'; // SMTP username
		$mail->Password = 'Aruna123456'; // SMTP password
		$mail->From = 'aruna@albertatechworks.com'; 
		$mail->FromName = 'Underdog';
		$mail->AddAddress($email,$first_name);
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AltBody = $message;
		$mail->Send();
			  
			  
		 }
		 else
		 {
			echo  "Some thing went wrong.Please try again";
		 }
		
	}
	else if($emailNum>0)
	{
		echo  "Email you entered  already exists";
	}
	
	else if($userNum>0)
	{
		echo  "Username you entered  already exists";
	}
	

}


if(isset($_GET['usersignup']))
{
    /*Declaring Post variables*/
    $first_name=mysql_real_escape_string($_POST['first_name']);
	$last_name=mysql_real_escape_string($_POST['last_name']);
	$username=mysql_real_escape_string($_POST['username']);
	$password=base64_encode($_POST['password']);
	$email=$_POST['email'];
	$middile_name='';
	$gender='';
	$dob='';
	$added_date=date("Y-m-d H:i:s");
    $status=0;
	$login_type=3;
	$random_string=random_string(50);
	$user_confirm=0;
	
	$added_from='Invited';
	$league_id=$_GET['league_id'];
	$invited_by=$_GET['invited_by'];
	
	 //$random_number=rand ( 10000 , 99999 );
	 
	$getEmail=@mysql_query("select * from users where email='$email' and status=1");
	$emailNum=@mysql_num_rows($getEmail);
	
	$getUser=@mysql_query("select * from users where username='$username' and status=1");
	$userNum=@mysql_num_rows($getUser);
	
	
	if(($emailNum==0)&&($userNum==0))
	{
		 $insUser=@mysql_query("insert into users(`id`,`league_id`,`invited_by`,`first_name`,`last_name`,`username`,`password`,`middile_name`,`gender`,`dob`,`email`,`added_from`,`added_date`,`status`,`login_type`,`user_confirm`) values('','".$league_id."','".$invited_by."','".$first_name."','".$last_name."','".$username."','".$password."','".$middile_name."','".$gender."','".$dob."','".$email."','".$added_from."','".$added_date."','".$status."','".$login_type."','".$user_confirm."')");
		 $cretaed_invite_user=@mysql_insert_id();
		 $inviteSql=@mysql_query("update invites set accepted=1 where receiver_email='$email'");
		   
		//$qry=@mysql_query($ins);
		 if($insUser)
		 {
			 echo "success";
			 /*Creating session variables*/
			
			  /*$_SESSION['user_id']=@mysql_insert_id();
			  $_SESSION['first_name']=$first_name;
			  $_SESSION['last_name']=$last_name;
			  $_SESSION['email']=$email;
			  $_SESSION['login_type']=$login_type;*/
			  
			  
			  
			   $leagueSQL=@mysql_query("select league_name from league where   id='$league_id'");
			   $leagueDt=@mysql_fetch_array($leagueSQL);
			   $league_name= $leagueDt['league_name'];
			   
			  
			  
		$subject='Welcome to Underdog';
		
		$link= $_SERVER['HTTP_HOST']."/projects/underdogv1/accept.php?token=".$random_string."&userId=".$cretaed_invite_user;
		
			
		$message = "Hi&nbsp;" . $first_name . "!," . "<br/><br/>" . " Welcome to Underdog.<br><br>You have  successfully created a league   <b>".$league_name."</b><span><br/><br/>Click Below link to confirm . <br/><br/><p>".$link."</p><br/><br/>@" . date("Y") . " Underdog";
			
		$FromName='Underdog';	  
	    $mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPSecure = "tls";
        $mail->Host= "smtp.ipage.com";
		$mail->SMTPAuth = true;
		$mail->Username = 'aruna@albertatechworks.com'; // SMTP username
		$mail->Password = 'Aruna123456'; // SMTP password
		$mail->From = 'aruna@albertatechworks.com'; 
		$mail->FromName = 'Underdog';
		$mail->AddAddress($email,$first_name);
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AltBody = $message;
		$mail->Send();
		
		
		 }
		 else
		 {
			echo  "Some thing went wrong.Please try again";
		 }
		
	}
	else if($emailNum>0)
	{
		echo  " Email you entered  already exists";
	}
	
	else if($userNum>0)
	{
		echo  "Username you entered  already exists";
	}

}

/*check whether the email already exists */
if(isset($_GET['checkEmail']))
{
	$email=$_POST['email'];
	$get=@mysql_query("select * from users where email='$email' and status=1");
	$num=@mysql_num_rows($get);
	if($num>0)
	{
	echo "Failed";	
	}
	else
	{
		echo "success";
	}
	
	
}

/*check for league name*/


if(isset($_GET['checkLeaguename']))
{
	$league_name=$_POST['league_name'];
	$get=@mysql_query("select * from league where league_name='$league_name'");
	$num=@mysql_num_rows($get);
	if($num>0)
	{
	echo "Failed";	
	}
	else
	{
		echo "success";
	}
	
	
}
/*check whether the username already exists*/
if(isset($_GET['checkuserName']))
{
	$username=$_POST['username'];
	$get=@mysql_query("select * from users where username='$username' and status=1");
	$num=@mysql_num_rows($get);
	if($num>0)
	{
		echo "Failed";	
	}
	else
	{
		echo "success";
	}
	
}
/*Forgot password script*/
if(isset($_GET['forgot']))
{
    $email=$_POST['email_forgot'];
	$verify=@mysql_query("select * from users where email='$email'");
	$num=@mysql_num_rows($verify);
	if($num>0)
	{
		
		$dt=@mysql_fetch_array($verify);
		$first_name=$dt['first_name'];
		$last_name=$dt['last_name'];
		$fullname=$first_name." ".$last_name;
		$username=$dt['username'];
		$password=base64_decode($dt['password']);
		
		$subject='Username/Password details for Underdog';
		$message = "Hi&nbsp;" . $fullname . "," . "<br/><br/>" . "Your login details for Underdog are ..<br><br><span><p>User Name : " . $username . "</p><p>Password :  " . $password . "</p><br/><br/>@" . date("Y") . " Underdog";
			
		$FromName='Underdog';
		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPSecure = "tls";
        $mail->Host= "smtp.ipage.com";
		$mail->SMTPAuth = true;
		$mail->Username = 'aruna@albertatechworks.com'; // SMTP username
		$mail->Password = 'Aruna123456'; // SMTP password
		$mail->From = 'aruna@albertatechworks.com'; 
		$mail->FromName = 'Underdog';
		$mail->AddAddress($email,$username);
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AltBody = $message;
		
		if(!$mail->Send())
		echo "Message could not be sent.";
		else
		echo "Password has been sent to your registered email address";
		//echo "success";
	}
	else
	{
	   echo "The Email address you entered was not registered at Underdog.";
	}

}


/*send invite*/

if(isset($_GET['sendinvite']))
{
	
	$login_type=  $_SESSION['login_type'];
	$session_email= $_SESSION['email'];
	$email=$_POST['email'];
	$addr = explode(',',$email);
	$league_id=$_POST['league_name'];
	$user_id=$_SESSION['user_id'];
	$random_string=random_string(50);
	$sent_on=date("Y-m-d H:i:s");
	
		if($login_type==1)
		{
			$leader_accept=1;
		}
		else
		{
			$leader_accept=0;
			
		}
	
	    $leagueSql=@mysql_query("select league_name from league  where id='$league_id'");
		$leagueDt=@mysql_fetch_array($leagueSql);
		$league_name=$leagueDt['league_name'];
			
		$FromName='Underdog';
	foreach ($addr as $ad) {
		$checkLeagueUser=@mysql_query("select *  from users where email='$ad' and status=1 and league_id='$league_id'");
	    $league_chec_num=@mysql_num_rows($checkLeagueUser);
		
		
		if($session_email==$ad)
		{
			echo "You can not send invitation to your self";
		}
		else if($league_chec_num>0)
		{
			echo "This user is already league leader for the selected League";
		}

		else
		{
		$checkUser=@mysql_query("select *  from users where email='$ad' and status=1");
		$userDt=@mysql_fetch_array($checkUser);
		$invite_user_id=$userDt['id'];
	    $usernum=@mysql_num_rows($checkUser);
		$subject='Invitation from Underdog';
		
		$checkInvite=@mysql_query("select *  from invites where league_id='$league_id' and receiver_email='$ad' and accepted=1");
		$inviteDT=@mysql_fetch_array($checkInvite);
		$invitenum=@mysql_num_rows($checkInvite);
		if($invitenum==0)	
			{
			$del=@mysql_query("delete from invites where league_id='$league_id' and receiver_email='$ad' and accepted=0");
			$ins="insert into invites(`id`,`league_id`,`send_user`,`receiver_email`,`token`,`accepted`,`leader_accept`,`sent_on`) values('','".$league_id."','".$user_id."','".$ad."','".$random_string."','0','".$leader_accept."','".$sent_on."')";
			$qry=@mysql_query($ins);
			
			if($usernum==0)
			{
			
			$link= $_SERVER['HTTP_HOST']."/projects/underdogv1/signup.php?token=".$random_string."&league_id=".$league_id."&invited_by=".$user_id;
			$message = "Dear Friend&nbsp;," . "<br/><br/>" . "I would like to invite you  to create account at  Underdog...<br><br><p>Click below link to register at underdog </p><br/><br/><p>".$link."</p><br/><br/>
		
		@" . date("Y") . " Underdog";
			}
			else
			{
			
				
				
				
				$link= $_SERVER['HTTP_HOST']."/projects/underdogv1/acceptinvitation.php?token=".$random_string."&invite_user_id=".$invite_user_id."&league_id=".$league_id."&invited_by=".$user_id;
				
				$message = "Dear Friend&nbsp;," . "<br/><br/>" . "I would like to invite you  for the league <b>".$league_name." </b>...<br><br><p>Click below link to accept </p><br/><br/><p>".$link."</p><br/><br/>
			
			@" . date("Y") . " Underdog";
			
		
			}
		
		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPSecure = "tls";
        $mail->Host= "smtp.ipage.com";
		$mail->SMTPAuth = true;
		$mail->Username = 'aruna@albertatechworks.com'; // SMTP username
		$mail->Password = 'Aruna123456'; // SMTP password
		$mail->From = 'aruna@albertatechworks.com'; 
		$mail->FromName = 'Underdog';
		//$mail->AddAddress($email,$username);
	    $mail->AddAddress( trim($ad) );
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AltBody = $message;
		
		if(!$mail->Send()){
		echo "Message could not be sent.";
		
		}
		else
		{
			
		echo "success";
		}
		
	}
	 else
	 {
		 echo $ad." is already a member for this League";
	 }
	}	
		
		
}
		
		//echo "success";
	
}

/*resend mail */
if(isset($_GET['resendmail']))
{
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	 $message=$_POST['form_description'];
	$sent_on=date("Y-m-d H:i:s");
	
		$addr = explode(',',$email);

		
			
		$FromName='Underdog';
		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPSecure = "tls";
        $mail->Host= "smtp.ipage.com";
		$mail->SMTPAuth = true;
		$mail->Username = 'aruna@albertatechworks.com'; // SMTP username
		$mail->Password = 'Aruna123456'; // SMTP password
		$mail->From = 'aruna@albertatechworks.com'; 
		$mail->FromName = 'Underdog';
		//$mail->AddAddress($email,$username);
		foreach ($addr as $ad) {
			$mail->AddAddress( trim($ad) );       
		}
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AltBody = $message;
		
		if(!$mail->Send()){
		echo "Message could not be sent.";
		
		}
		else
		{
		echo "success";
		}
		//echo "success";
	
}

/*create league*/
if(isset($_GET['create_league']))
{
    /*Declaring Post variables*/
    $league_name=mysql_real_escape_string($_POST['league_name']);
	$min_entries=$_POST['min_entries'];
	$prizes=$_POST['prizes'];
	$entry_fee=$_POST['entry_fee'];
	$tot_sizes=$_POST['tot_sizes'];
	$start_date=$_POST['start_date'];
	$end_date=$_POST['end_date'];
	$inputBody=$_POST['inputBody'];
	$added_user=$_SESSION['user_id'];
	$added_date=date("Y-m-d H:i:s");
    $status=$_GET['status'];
	 
	 
		  $ins="insert into league(`id`,`league_name`,`min_entries`,`prizes`,`entry_fee`,`tot_sizes`,`start_date`,`end_date`,`inputBody`,`added_user`,`added_date`,`status`) values('','".$league_name."','".$min_entries."','".$prizes."','".$entry_fee."','".$tot_sizes."','".$start_date."','".$end_date."','".$inputBody."','".$added_user."','".$added_date."','".$status."')";
		   
		$qry=@mysql_query($ins);
		 if($qry)
		 {
			 echo "success";
		 }
		 else
		 {
			echo  "Some thing went wrong.Please try again";
		 }
		

}
/*Manage account*/
if(isset($_GET['my_account']))
{
	//print_r($_POST);
	//exit;
	
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$middile_name=$_POST['middile_name'];
	$gender=$_POST['gender'];
	$dob=$_POST['defaultsettings_birthDay'];	
	/*$month=$_POST['defaultsettings_birth[month]'];
	$year=$_POST['defaultsettings_birth[year]'];
	$day=$_POST['defaultsettings_birth[day]'];
	$dob=$year."-".$month."-".$day;*/
		
	$id=$_POST['user_id'];
	$sql=@mysql_query("update users set first_name='$first_name' , last_name='$last_name', middile_name='$middile_name', gender='$gender', dob='$dob' where id='$id'");
	if($sql)
	{
		echo "success";
	}
	else
	{
		echo "Something went wrong.Please try again";
	}
}


/*getting match results with its Id*/
if(isset($_GET['getLiveresults']))
{
	    $id=$_GET['id'];
	    $outputLive = shell_exec('curl -X GET https://jsonodds.com/api/odds/{'.$id.'} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
		$matchLiveArray=json_decode($outputLive);
		
		 foreach($matchLiveArray as $mydataLive) {
			 ?>
		<div class="col-lg-6 col-md-6 padding-remove" >
				
								 <?php  
								 foreach ( $mydataLive->Odds as $resultsLive )
									{	
									$match_date=$mydataLive->MatchTime;
							            $split=explode("T",$match_date);
										/*$timeLive=	date('g:i A', strtotime($split[1]." GMT+3"));
										$dateLive=	date('D M d', strtotime($split[0]));*/
								$date=date('d', strtotime($split[0]));
								$month=date('m', strtotime($split[0]));
								$year=date('Y', strtotime($split[0]));
								$hr=date('H', strtotime($split[1]));
								$min=date('i', strtotime($split[1]));
								$sec=date('s', strtotime($split[1]));
								
								$EasternTimeStamp =mktime($hr-4,$min,$sec,$month,$date,$year);
  
								$timeLiveSpread=	date('g:i A',$EasternTimeStamp) ; 
								$dateLiveSpread=	date('D M d', $EasternTimeStamp);
						  
						 $currentEasternTimeStamp =mktime(date('H')-6,date('i'),date('s'),date('m'),date('d'),date('Y'));
                                $currentHour = date(' h', $currentEasternTimeStamp);
								$currentMin = date(' i', $currentEasternTimeStamp);
								
								
							   //echo 'Current EST Time ' . date('m/d/Y H:i:s a',$currentEasternTimeStamp) ;	
							
								$currentDay=date('D', $currentEasternTimeStamp);
								$day=date('D', $EasternTimeStamp);
								
								
									
									if($day=='Thu'){
									$day_before = date( 'D M d', strtotime( $split[0] . ' -1 day' ) );
									//$thursdayDT= strtotime( $split[0] . ' -1 day' );
									$thursdayDT= mktime($hr-6,$min,$sec,$month,$date,$year);
									
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
								
								
								  if($day=='Sun'){
									//$timeLive=	date('g:i A', strtotime($split[1]." GMT+3"));
									// $sundayDT= strtotime( $split[0] ) ;
									// $dateDt=strtotime(date("Y-m-d"));
									 $sundayDT= mktime($hr-6,$min,$sec,$month,$date,$year);
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
								  
								  
								   if($day=='Mon'){
									//$timeLive=	date('g:i A', strtotime($split[1]." GMT+3"));
									// $sundayDT= strtotime( $split[0] ) ;
									// $dateDt=strtotime(date("Y-m-d"));
									 $mondayDT= mktime($hr-6,$min,$sec,$month,$date,$year);
									 $dateDt=$currentEasternTimeStamp;
									if($dateDt==$mondayDT)
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
									else if($dateDt<$mondayDT)
									{
										$class='';
									}
									else if($dateDt>$mondayDT)
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
                                  <tr>
									<td><?php echo $mydataLive->HomeTeam ?> </td>
									<td class="link-show"><button class="btn <?php if($pointsHome<$pointsAway){?>bet<?php } else{ echo 'unbet';} ?>" id="home" data-id="<?php echo $id; ?>"> <?php  echo $resultsLive->PointSpreadHome; ?> (<?php  echo $resultsLive->PointSpreadHomeLine; ?>)</button></td>
									<td class="link-show"><button class="btn"><?php  echo $resultsLive->MoneyLineHome; ?></button></td>
									<td class="link-show" rowspan="2"><button class="btn"> <?php  echo $resultsLive->TotalNumber; ?></button></td>
								  </tr>
                                 
								  <tr>
									<td><?php echo $mydataLive->AwayTeam ?></td>
									<td class="link-show"><button class="btn  <?php if($pointsAway<$pointsHome){?>bet<?php } else{ echo 'unbet';} ?>" id="away" data-id="<?php echo $id; ?>"><?php  echo $resultsLive->PointSpreadAway; ?> (<?php  echo $resultsLive->PointSpreadAwayLine; ?>)</button></td>
									<td class="link-show"><button class="btn"><?php  echo $resultsLive->MoneyLineAway; ?></button></td>
									
								  </tr>
								</tbody>
							  </table>
						</div>
						
					</div>
				</div>
			<?php }} ?>	
			</div>	 
			 
		 <?php
		 }
}
if(isset($_GET['live_betting']))
{
	
	//print_r($_POST);
	$league_session_id=$_GET['league_session_id'];
	
	$id=$_POST['id'];
	$user_id=$_SESSION['user_id'];
	$match_id=$_POST['match_id'];
	$event_id=$_POST['event_id'];
	$match_date=$_POST['match_date'];
	$home_team=$_POST['home_team'];
	$away_team=$_POST['away_team'];
	//$betting_team=$_POST['betting_team'];
	$opponent_team=$_POST['opponent_team'];
	$goal_spread_betting=$_POST['goal_spread_betting'];
	$goal_spread_opponent=$_POST['goal_spread_opponent'];
	$money_line_betting=$_POST['money_line_betting'];
	$money_line_opponent=$_POST['money_line_opponent'];
	$added_date=date("Y-m-d H:i:s");
	
	$betting_team=$_GET['team'];
	$status=1;
	/*check week limit of participation*/
	 $weekCheck=@mysql_query("select * from manage_league where user_id='$user_id' and YEARWEEK(added_date) = YEARWEEK(NOW())");
	 $weekNum=@mysql_num_rows($weekCheck);
	
	if($weekNum<4)
	{
			/*check whether the user has already participated for this game*/
			
			$check=@mysql_query("select * from manage_league where user_id='$user_id' and match_id='$match_id'");
			$num=@mysql_num_rows($check);
			$pid=random_string(6);
			if($num==0){
			$ins=@mysql_query("INSERT INTO `manage_league` (`id`,`league_id`,`pid`, `user_id`, `match_id`, `event_id`, `match_date`,`home_team`,`away_team`, `betting_team`, `opponent_team`, `goal_spread_betting`, `goal_spread_opponent`, `money_line_betting`, `money_line_opponent`, `added_date`, `status`) VALUES (NULL,'".$league_session_id."','".$pid."', '".$user_id."', '".$match_id."', '".$event_id."', '".$match_date."','".$home_team."','".$away_team."', '".$betting_team."', '".$opponent_team."', '".$goal_spread_betting."', '".$goal_spread_opponent."', '".$money_line_betting."', '".$money_line_opponent."', '".$added_date."','".$status."');");
		
				if($ins)
				{
					echo "Success";
				}
				else
				{
					echo  "Something went wrong";
				}
			}
			else
			{
				echo "You have already participated in  this game";
			}
	
	}
	else
	{
		echo "You cannot participate in  more than  4 games per week  ";
		
	}
	
}

/*getting match results by its id*/
if(isset($_GET['match_results']))
{
	//$id=$_GET['id'];
	//print_r($_POST);
	$id=$_POST['id'];
	$homeTeam=$_POST['homeTeam'];
	$awayTeam=$_POST['awayTeam'];
	$betTeam=$_POST['betTeam'];
	$matchDate=$_POST['matchDate'];
	$currentDate=date("Y-m-d H:i:s");

	$today_utc = date('Y-m-d H:i:s', strtotime( $matchDate." GMT+3"));
									
	if($betTeam=='home')
	{
		$opponentTeam=$awayTeam;
		$participatedTeam=$homeTeam;
	}
	else if($betTeam=='away')
	{
		$participatedTeam=$awayTeam;
		$opponentTeam=$homeTeam;
	}
	
	
	
	  $date=date('d', strtotime($matchDate));
	  $month=date('m', strtotime($matchDate));
	  $year=date('Y', strtotime($matchDate));
	  $hr=date('H', strtotime($matchDate));
	  $min=date('i', strtotime($matchDate));
	  $sec=date('s', strtotime($matchDate));
	  
	 $MatchEasternTimeStamp =mktime($hr-4,$min,$sec,$month,$date,$year);
     $currentEasternTimeStamp =mktime(date('H')-6,date('i'),date('s'),date('m'),date('d'),date('Y'));



	  $timeLive=	date('g:i A',$MatchEasternTimeStamp) ; 
	  $dateLive=	date('D M d', $MatchEasternTimeStamp);
	
	?>
		<div class="lobby-table table-responsive">
        <h2><?php echo $homeTeam;  ?> <span style="color:#900">VS </span> <?php echo $awayTeam; ?></h2>
						
          <?php
					
			if($MatchEasternTimeStamp>$currentEasternTimeStamp)
			{
				echo 'Match will be conducted on '.$dateLive." at ".$timeLive;
			}
	
	
			else 
			{
			
			/*$output = shell_exec('curl -X GET https://jsonodds.com/api/results/{'.$id.'} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
			$resultArray=json_decode($output);
			$count= count($resultArray);*/
			
			$getResult=@mysql_query("select * from results where match_id='$id'");
			
			$count= @mysql_num_rows($getResult);
			$matcharray=array();
			
			
			
			
			
			if($count>0){
				while($resultDt=@mysql_fetch_array($getResult))
			    //foreach($resultArray as $results) 
			   {
					/* $HomeScore=$results->HomeScore;
					 $AwayScore=$results->AwayScore;
					 $final=$results->Final;
					 $OddType=$results->OddType;*/
					 
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
					
					
					if($HomeScore>$AwayScore)
						{
							$winStatus=$homeTeam." Won the match";
						}
						else if($HomeScore<$AwayScore)
						{
							$winStatus=$awayTeam." Won the match";
						}
					
						
					
			?>
                        
                        
                        <table class="table borderless lobby table-striped" style="border:1px solid #999">
							<tbody>
							  <tr>
								<td><b>Selected Team </b></td>
                                <td><?php echo $participatedTeam; ?></td>
                               </tr>
                                <tr>
								<td><b>Opponent Team </b> </td>
                                <td><?php echo $opponentTeam; ?></td>
                               </tr>
                                <tr>
								<td><b>Match Date</b></td>
                                <td><?php echo $today_utc; ?></td>
                               </tr>
                                <tr>
								<td><b>Selected Team Score</b></td>
                                <td><?php echo $participatedTeamScore; ?></td>
                               </tr>
                                <tr>
								<td><b>Opponent Team  Score</b></td>
                                <td><?php echo $opponentTeamScore; ?></td>
                               </tr>
                                <tr>
								<td><b>Match Status</b></td>
                                <td><?php echo $matchStatus; ?></td>
                               </tr>
                                <tr>
								<td><b>Odd Type</b></td>
                                <td><?php echo $OddType; ?></td>
                               </tr>
                                <tr>
								<td><b>Win Status</b></td>
                                <td><?php echo $winStatus;  ?></td>
                               </tr>
                               
							</tbody>
							  

						</table>
                        <?php }}else {echo "No result Found";}} ?>
					</div>
      
<?php  
	
}
if(isset($_GET['league_details']))
{
	$id=$_GET['id'];
	$sql=@mysql_query("select * from league where id='$id'");
	$data=@mysql_fetch_array($sql);
	$league_leader=$data['added_user'];
	$league_added_date=$data['added_date'];
	
	$userSql=@mysql_query("select first_name,last_name from users where id='$league_leader'");
	$userDt=@mysql_fetch_array($userSql);
	$userName=$userDt['first_name']." ".$userDt['last_name'];
	
	$league_id=$data['id'];
	$population=@mysql_query("select count(*) as population from users where league_id='$league_id'");
	$dt=@mysql_fetch_array($population);
	$pcount=$dt['population'];
								
	?>
                            <table class="table borderless lobby table-striped" style="border:1px solid #999">
							<tbody>
							  <tr>
								<td><b>League Name</b></td>
                                <td><?php echo $data['league_name']; ?></td>
                               </tr>
                               <tr>
								<td><b>League Leader</b></td>
                                <td><?php echo $userName; ?></td>
                               </tr>
                                <tr>
								<td><b>League Population</b></td>
                                <td><?php echo $pcount; ?></td>
                               </tr>
                                <tr>
								<td><b>League Created on </b></td>
                                <td><?php echo $league_added_date; ?></td>
                               </tr>
                               
                               
							</tbody>
						</table>
    <?php
}

/* stop league*/

if(isset($_GET['league_delete']))
{
	
	$id=$_GET['id'];
	//$delete=@mysql_query("delete from league where id='".$id."'");
	$delete=@mysql_query("update league set status=0 where id='".$id."'");
	
	if($delete)
	{
		echo "League  has been stopped";
	}
	else
	{
		echo "Something went wrong.Please try again";
	}
}

/*Activate stopped league*/

if(isset($_GET['league_activate']))
{
	
	$id=$_GET['id'];
	//$delete=@mysql_query("delete from league where id='".$id."'");
	//echo "update league set status=1 where id='".$id."'";
	$delete=@mysql_query("update league set status=1 where id='".$id."'");
	
	if($delete)
	{
		echo "League  has been Activated";
	}
	else
	{
		echo "Something went wrong.Please try again";
	}
}

/*Get players assigned for a particular league*/

if(isset($_GET['players_details']))
{
	$id=$_GET['id'];
	$sql=@mysql_query("select * from users where league_id='$id' and status=1 and user_confirm=1");
	?>
   
   <?php
  if(@mysql_num_rows($sql)>0){
	  while($data=@mysql_fetch_array($sql)){
	   $uid=$data['id'];
	   $scoreSql=@mysql_query("select * from manage_league where user_id='".$uid."'");
		$scoreresults=array();
		 while($scoreData=@mysql_fetch_array($scoreSql))
		 {
			 $league_id=$scoreData['league_id'];
			 $match_id=$scoreData['match_id'];
			 $betTeam=$scoreData['betting_team'];
			 $home_team=$scoreData['home_team'];
			 $away_team=$scoreData['away_team'];
			 $goal_spread_betting=$scoreData['goal_spread_betting'];
			 $goal_spread_opponent=$scoreData['goal_spread_opponent'];
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
				$sum = 0;
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
					 
					$sum += $score;	
				$resultsData=array("score"=>$sum);	
				//$resultsData=array("score"=>$sum);
						
				array_push($matcharray,$sum);
				}
				array_push($scoreresults,$matcharray);
		    }
			}
		 }

$fsum = 0;

foreach($scoreresults as $num => $values) {
    $fsum += $values[ 0 ];
}
						?>
						  <tr>
							<td><?php  echo $data['first_name']." ".$data['last_name'] ?></td>
							
							<td><?php echo  $fsum; ?></td>
							<!--<td> <a href="#" data-toggle="modal" data-target="#delete" class="delete-btn"><span class="fa fa-trash"></span></a></td>-->
						  </tr>
						<?php } }else{   ?> 
                        <tr><td colspan="4">No Players Joined for this league</td></tr>
                        <?php }  ?>
						
    <?php
}
if(isset($_GET['scorestats']))
{
	
	     $scoreSql=@mysql_query("select * from manage_league where user_id='".$_SESSION['user_id']."'");
		 $scoreresults=array();
		 while($data=@mysql_fetch_array($scoreSql))
		 {
			 $match_id=$data['match_id'];
			 $betTeam=$data['betting_team'];
			 $home_team=$data['home_team'];
			 $away_team=$data['away_team'];
			 $output = shell_exec('curl -X GET https://jsonodds.com/api/results/{'.$match_id.'} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
	         $resultArray=json_decode($output);
			 $count= count($resultArray);
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
						
						
						if($HomeScore>$AwayScore)
							{
								$winStatus=$homeTeam."Won";
							}
							else if($HomeScore<$AwayScore)
							{
								$winStatus=$awayTeam."Loose";
							}
						
				array_push($scoreresults,array("winstatus"=>$winStatus),array("score"=>$participatedTeamScore),array('away_team'=>$away_team),array('home_team'=>$home_team));
				
				
				}
		    }
		 }
		
}
if(isset($_GET['user_delete']))
{
	$id=$_GET['id'];
	$delete=@mysql_query("update users set status=0 where id='$id'");
	if($delete)
	{
		echo "User has been blocked ";
	}
	else
	{
		echo "Something went wrong.Please try again .";
	}
}
if(isset($_GET['user_activate']))
{
	$id=$_GET['id'];
	$delete=@mysql_query("update users set status=1 where id='$id'");
	if($delete)
	{
		echo "User has been Activated";
	}
	else
	{
		echo "Something went wrong.Please try again .";
	}
}


if(isset($_GET['league_user_delete']))
{
	$league_id=$_GET['id'];
	$receiver_email=$_GET['userid'];
	$delete=@mysql_query("update invites set leader_accept=0 where league_id='$league_id' and receiver_email='$receiver_email'");
	if($delete)
	{
		echo "User has been blocked";
	}
	else
	{
		echo "Something went wrong.Please try again .";
	}
}

if(isset($_GET['league_user_activate']))
{
	$league_id=$_GET['id'];
	$receiver_email=$_GET['userid'];
	$delete=@mysql_query("update invites set leader_accept=1 where league_id='$league_id' and receiver_email='$receiver_email'");
	//$update=@mysql_query("update users set status=1 where email='$receiver_email'");
	if($delete)
	{
		echo "User has been Activated ";
	}
	else
	{
		echo "Something went wrong.Please try again .";
	}
}




?>