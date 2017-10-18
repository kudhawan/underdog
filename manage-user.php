<?php
session_start();
include('db.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Underdog -- App Management Sys</title>
    <title>Underdog -- App Management Sys</title>
    <link rel="shortcut icon" href="images/american-football.png" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/jquery.bxslider.css" rel="stylesheet">
	<link href="css/responsiveslides.css" rel="stylesheet">
    <link href="css/datatables.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
	.fa{ padding-right:5px;}
	</style>
    
  </head>
  <body>
	
<header class="innerpage-header">
		<?php include('innerpage_header_admin.php'); ?>
	</header>
	
	
	<section class="inner-menu">
		<?php include('inner_menu_admin.php');  ?>
	</section>
	
	<section class="tab-content-space">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-label-head">User Management</div>
				<div class="form-box">
					<div class="top-search-bar clearfix">
						<div class="col-lg-6 text-left">
							<form class="form-inline" role="form">
								<!--<div class="form-group small-width-admin">
								  <select class="form-control" id="sel1">
									<option>A</option>
									<option>B</option>
									<option>C</option>
									<option>4</option>
								  </select>
								</div>-->
								
                               <!-- <div class="input-group">
								  <input type="text" class="form-control" placeholder="Search for..." id="myInput" onkeyup="myFunction()">
								  <span class="input-group-btn">
									<button class="btn btn-danger" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
								  </span>
								</div>-->
                                
							</form>
						</div>
						<div class="col-lg-6 text-right">
							<!--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#invite-users"><i class="fa fa-users" aria-hidden="true"></i> Invite User's</button>-->
                           <a href="invite.php"> <button type="button" class="btn btn-success"><i class="fa fa-users" aria-hidden="true"></i> Invite Users</button></a>
                            
							<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#mail-users"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Send Mail</button>
							<button type="button" class="btn btn-danger" id="downloadTable"><i class="fa fa-download" aria-hidden="true"></i> Export</button>
						</div>
					</div>
					<div class="admin-table table-responsive">
						<table class="table table-admin-style table-striped" id="myTable" data-tableName="Users Table ">
							<thead>
							  <tr>
								
								<th>Username</th>
								<th>Email Address</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>User Type</th>
								<th>Status</th>
								<th class="noExl">Actions</th>
							  </tr>
							</thead>
							<tbody>
                            <?php
							$sql=@mysql_query("select * from users  where id!='".$_SESSION['user_id']."'");
							while($data=@mysql_fetch_array($sql)){
								$userstatus=$data['status'];
								$added_from=$data['added_from'];
								$user_confirm=$data['user_confirm'];
								$email=$data['email'];
								
								if($user_confirm=='1')
								{
									  if($userstatus==1)
										{ 
											$userStausText='Active';
											$userclass='active-user';
											$action=1;
										}
										else
										{
											$userStausText='Blocked';
											$userclass='inactive-user';
											$action=1;
										}
								}
								else
								{
									        $userStausText='Incomplete Registration';
											$userclass='inactive-user';
											$action=0;
									
								}
								
								
								/*if($added_from=='Invited')
								{
									$inviteCheck=@mysql_query("select * from invites where receiver_email='$email' and accepted=1");
									$inviteDt=@mysql_fetch_array($inviteCheck);
									$inviteNum=@mysql_num_rows($inviteCheck);
									if($inviteNum==0)
									{
										$userStausText='Blocked';
										$userclass='inactive-user';
										$action=1;
										
									}
									else
									{
										$invite_accepted=$inviteDt['accepted'];
										if($userstatus==1)
										{ 
											$userStausText='Active';
											$userclass='active-user';
											$action=1;
										}
										else
										{
											$userStausText='Incomplete Registration';
											$userclass='inactive-user';
											$action=0;
										}
									}
								}
								else
								{
									   if($userstatus==1)
										{ 
											$userStausText='Active';
											$userclass='active-user';
											$action=1;
										}
										else
										{
											$userStausText='Blocked';
											$userclass='inactive-user';
											$action=1;
										}
									
								}*/
								$login_type=$data['login_type'];
								if($login_type==1)
								{
									$usertype='League Leader';
								}
								else
								{
									$usertype='Normal User';
								}
							?>
							  <tr>
								
								<td><?php echo $data['username']; ?></td>
								<td><?php echo $data['email']; ?></td>
								<td><?php echo $data['first_name']; ?></td>
								<td><?php echo $data['last_name']; ?></td>
                                <td><?php echo $usertype; ?></td>
                                
								<td>
                                 <span class="<?php echo $userclass; ?>"><?php echo $userStausText; ?></span>
                                
                                
                               
                                </td>
								<td class="noExl"><!--<a href="#" class="edit-btn"><span class="fa fa-pencil-square-o"></span></a>--> 
                                
                             <?php if($userstatus==1){  ?>
                                <a href="#" data-toggle="modal" data-target="#delete"  class="edit-btn del_ud_user" data-id="<?php echo $data['id']; ?>" data-tooltip="Block" > <span class="fa fa-ban"></span></a>
                                <?php }  else{ if($action==1){ ?>
                                
                               <a href="#" data-toggle="modal" data-target="#active"  class="edit-btn act_ud_user" data-id="<?php echo $data['id']; ?>" data-tooltip="Activate" > <span class="fa fa-toggle-on"></span></a>
                                <?php }else{ ?> <a href="#"  class="delete-btn "  data-tooltip="Incomplete" style="cursor:default" > <span class="fa fa-toggle-on"></span></a>  <?php }}  ?>   
                                
                                </td>
							  </tr>
<?php }  ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!--<div class="col-lg-12 text-center">
				<div class="pagination">
				  <a href="#">&laquo;</a>
				  <a href="#">1</a>
				  <a class="active" href="#">2</a>
				  <a href="#">3</a>
				  <a href="#">4</a>
				  <a href="#">5</a>
				  <a href="#">6</a>
				  <a href="#">&raquo;</a>
				</div>
			</div>-->
		</div>
	</section>
	
	<footer class="admin">
		<div class="container copy-rights">
			<div class="col-lg-12">
				<div class="copy-text text-center small-d">Copyright &copy; 2017 <a href="#">Underdog</a> All rights reserved</div>
			</div>
		</div>
	</footer>
	
	
	<!-- Alert Modal -->
	  <div class="modal fade" id="delete" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-danger"  id="delete_header">
			  <button type="button" class="close delClose" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Attention</h4>
			</div>
			<div class="modal-body">
			    <div class="alert alert-danger" id="delete_user_body">
				  <strong>Confirm!</strong> Are you sure want to block this user?
				</div>
			</div>
			<div class="modal-footer"  id="delete_footer">
			  <button type="button" id="delUser" class="btn btn-warning">Yes</button> <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</div>
		  </div>
		  
		</div>
	  </div>
      
      <div class="modal fade" id="active" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-info"  id="active_header">
			  <button type="button" class="close actClose" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Attention</h4>
			</div>
			<div class="modal-body">
			    <div class="alert alert-info" id="active_user_body">
				  <strong>Confirm!</strong> Are you sure want to activate this user?
				</div>
			</div>
			<div class="modal-footer"  id="active_footer">
			  <button type="button" id="actUser" class="btn btn-warning">Yes</button> <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</div>
		  </div>
		  
		</div>
	  </div>
        <form method="post" action="" id="" class="delete_user_form">
                  <input type="hidden" name="del_user_id" id="del_user_id" value="">
      </form>
	  
	<!-- Invite User -->
	  <div class="modal fade" id="invite-users" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header ">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  
			</div>
			<div class="modal-body">
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
			<div class="modal-footer">
			  
			</div>
		  </div>
		  
		</div>
	  </div>
	  
	  <!-- Send Main User -->
	  <div class="modal fade" id="mail-users" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-success">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Compose Mail</h4>
              
              
              <!-- <p id="alert_msg_resend" align="center" class="alert_msg" ></p>
               <p id="succ_msg_resend" align="center"  style="color:green" ></p>-->
               
             <div  class="succ_msg alert_box" style="display:none">
              <div class="col-md-8"  id="succ_msg_resend"></div>
              <div class="col-md-4"><a class="close alertClose" aria-label="Close" style="color:green">x</a></div>
            </div>
            
            <div  class="alert_msg alert_box"  style="display:none">
              <div class="col-md-8" id="alert_msg_resend"></div>
              <div class="col-md-4"><a class="close alertClose" aria-label="Close" style="color:red">x</a></div>
            </div>
			</div>
			<div class="modal-body">
			    <form role="form" class="form-horizontal" id="resenmail_form">
					<div class="form-group">
					  <label class="col-sm-2" for="inputTo">To</label>
					  <div class="col-sm-10"><input type="email" name="email" id="email" class="form-control"  placeholder="comma separated list of recipients"></div>
					</div>
					<div class="form-group">
					  <label class="col-sm-2" for="inputSubject">Subject</label>
					  <div class="col-sm-10"><input type="text" class="form-control" id="subject" name="subject" placeholder="subject"></div>
					</div>
					<div class="form-group">
					  <label class="col-sm-12" for="inputBody">Message</label>
					  <div class="col-sm-12" id="editor">
                      <textarea class="form-control" id="description" name="description" rows="8" style="width:570px; height: 150px;"></textarea>
                      </div>
                      
					</div>
                    <input type="hidden" class="form-control" id="form_description" name="form_description"  >
                    
                    
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button> 
				<!--<button type="button" class="btn btn-warning pull-left">Save Draft</button>-->
				<button type="button" class="btn btn-primary pull-right" id="sendmail">Send <i class="fa fa-arrow-circle-right fa-lg"></i></button>
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
    <script src="js/jquery.table2excel.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <script type="text/javascript" src="js/nicEdit.js"></script>

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
		$('#myTable').DataTable();
		//tinymce.init({ selector:'textarea' });
		
		bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
		
		
	  });
	  

			
			
	  $('body').click(function(e){
		   if ($(e.target).attr('class') != 'form-control') {
		     $('.modal-backdrop.in').remove();
		   }
	  });
	  $('body').tooltip({
		selector: "[data-tooltip=tooltip]",
		container: "body"
	});
	
	/*script to export table*/
	$("#downloadTable").click(function(){
		$("#myTable").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "myFileName",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
		});
	
	 });
	
	  
	   $('.succ_msg,.alert_msg').hide();
	   $(".alertClose").click(function(){
		 $(this).closest("div.alert_box").hide();
	  });
	 // $(".nicEdit-panelContain").css("display", "none");
	  $("#sendmail").click(function(){
			
			   var description=$('.nicEdit-main').html();
			   $('#form_description').val(description);
				
				var email=$('#email').val();
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				
				if(email=='')
				{
					$('#email').focus();
					$('#email').css("border-color","red");
					return false;
				}
				/*else if ( !emailReg.test( email_forgot ) ) {
					$('#email_forgot').focus();
					$('#email_forgot').css("border-color","red");
					$('#email_errorMsg_forgot').html('Please enter a valid email address').modal();
					return false;
				}*/
				else if(subject=='')
				{
					$('#subject').focus();
					$('#subject').css("border-color","red");
					return false;
				}
				else if(description=='')
				{
					$('#description').focus();
					$('#description').css("border-color","red");
					return false;
				}
				
				else
				{
					$('#alert_msg_resend').html('').modal();
					
					var formdata=$("body").find("#resenmail_form"). serialize();
					$.ajax({
						type: "POST",
						url: "ajaxfunctions.php?resendmail",
						data: formdata,
						success: function(data) {
							// alert(data);
							$('#email,#subject,#description').val('');
							$('.nicEdit-main').html('');
							//$(".nicEdit-panelContain").css("display", "none");
							
							if(data=='success')
							{
								//$('#succ_msg_resend').html('Message  has been sent successfully');
								$('.succ_msg').show('');
								$('#succ_msg_resend').html('Message  has been sent successfully');
								
							}
							else
							{
								$('.alert_msg').show('');
								$('#alert_msg_resend').html(data);
								
								
							}
						}
					 });
				 
				}
	 });
	  $(document).on("click", ".del_ud_user,.act_ud_user", function () {
			 var idVal = $(this).attr('data-id');
			 $("#del_user_id").val( idVal );
			 $('#delete_header').show();
		     $('#delete_footer').show();
			 
			 $('#active_header').show();
		     $('#active_footer').show();
			
		});
		
	 
	  $('body').on('click', '#delUser', function () 
	    {
	  	$('#delete_user_body').html('');
		$('#delete_footer').hide();
		$('#delete_header').hide();
		$('#delete_footer').hide();
		
		
		var idVal=$("body").find(" #del_user_id"). val();
		//alert(idVal);
		//var formdata= $("body").find(".delete_form"). serialize();
		
		$.ajax({
				type: "POST",
				url: "ajaxfunctions.php?user_delete&id="+idVal,
				data: '',
				success: function(data) {
					//alert(data);
					$('#delete_header').show();
					$('#delete_user_body').html(data);
				}
		 });
	  }); 
	  
	  $('body').on('click', '#actUser', function () 
	    {
	  	$('#active_user_body').html('');
		$('#active_footer').hide();
		$('#active_header').hide();
		$('#active_footer').hide();
		var idVal=$("body").find(" #del_user_id"). val();
		//alert(idVal);
		//var formdata= $("body").find(".delete_form"). serialize();
		
		$.ajax({
				type: "POST",
				url: "ajaxfunctions.php?user_activate&id="+idVal,
				data: '',
				success: function(data) {
					//alert(data);
					$('#active_header').show();
					$('#active_user_body').html(data);
				}
		 });
	  }); 
	$('body').on('click', '.delClose,.actClose', function ()  {
		window.location.reload();
	
	 });
	 
	 /*Function for table search filter*/	  
	  
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
	</script>
  </body>
</html>