<?php
ini_set('display_errors', '1');
require 'PHPMailer/PHPMailerAutoload.php';
include 'PHPMailer/class.smtp.php';
require("PHPMailer/class.PHPMailer.php");

// Set error reporting level to all errors
error_reporting(E_ALL);

// View php.ini and look for the mail settings


		$email='arunavkda@gmail.com';
        $first_name='Test';
		$last_name='User';
		$fullname=$first_name." ".$last_name;
		$username='test_user';
		$password='123456';
		
		$subject='Username/Password details for Underdog';
		$message = "Hi&nbsp;" . $fullname . "," . "<br/><br/>" . "Your login details for Underdog are ..<br><br><span><p>User Name : " . $username . "</p><p>Password :  " . $password . "</p><br/><br/>@" . date("Y") . " Underdog";
			

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
		echo "success";
?>