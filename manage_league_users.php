<?php
session_start();
include('db.php');
$league_name_sql=@mysql_fetch_array(@mysql_query("select league_name from league where added_user='".$_SESSION['user_id']."'"));
$session_league_name=$league_name_sql['league_name'];
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
     <link href="css/datatables.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<header class="innerpage-header">
		<?php include('innerpage_header.php'); ?>
	</header>
	<section class="inner-menu">
		<?php include('inner_menu.php');  ?>
	</section>
	
	<section class="tab-content-space">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-label-head">League User Management</div>
                
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
								<!--<div class="input-group">
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
                            
							
						</div>
					</div>
					<div class="admin-table table-responsive">
                    <h2><?php echo $session_league_name;  ?></h2>
						<table class="table table-admin-style table-striped"  id="myTable">
							<thead>
							  <tr>
								
								<th>Username</th>
								<th>Email Address</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Status</th>
                                <th>Action</th>
							  </tr>
							</thead>
							<tbody>
                            <?php
							$sql=@mysql_query("select * from users  where id='".$_SESSION['user_id']."'");
							$data=@mysql_fetch_array($sql);
							
								 $league_id=$data['league_id'];
								
								$leagueUser=@mysql_query("select * from invites where league_id='$league_id' and accepted=1");
								if(@mysql_num_rows($leagueUser)>0){
								while($leagueData=@mysql_fetch_array($leagueUser)){
									$receiver_email=$leagueData['receiver_email'];
									$accepted=$leagueData['accepted'];
									$leader_accept=$leagueData['leader_accept'];
									$send_user=$leagueData['send_user'];
									$userSql=@mysql_query("select * from users  where email='$receiver_email'");
									$userDt=@mysql_fetch_array($userSql);
									$status=$userDt['status'];
									if($leader_accept==1)
									{
										if($status==1)
										{
										$approveStatus='Approved';
										}
										else
										{
											$approveStatus='Blocked By Admin';
										}
									}
									else
									{
										$approveStatus='Blocked';
									}
							?>
							  <tr>
								
								<td><?php echo $userDt['username']; ?></td>
								<td><?php echo $userDt['email']; ?></td>
								<td><?php echo $userDt['first_name']; ?></td>
								<td><?php echo $userDt['last_name']; ?></td>
                                <td>
                                 <?php  echo $approveStatus; ?>
                                </td>
                                
                                
                                
								<td>
                                
                                 <?php  
								 if(($leader_accept==1)&&($status==1)){ 
								?>
                                <a href="#" data-toggle="modal" data-target="#remove-league-user" class="edit-btn del_league_user" data-id="<?php echo $league_id; ?>" data-user="<?php echo $userDt['email']; ?>" data-tooltip="Block" ><span class="fa fa-ban"></span></a>
                                 
                                 <?php }else{ if($status==1){?>
                                <a href="#" data-toggle="modal" data-target="#activate-league-user" class="edit-btn act_league_user"  data-id="<?php echo $league_id; ?>" data-user="<?php echo $userDt['email']; ?>" data-tooltip="Activate" ><span class="fa fa-check-circle"></span></a>
                                
                               <?php } else{ ?>
                               <a href="#"  data-tooltip="Blocked" class="delete-btn " style="cursor: default"><span class="fa fa-ban" style="color:red; opacity:0.7"></span></a>
                               <?php } ?>
                                
                                
                                <?php } ?>
                                
                                </td>
								
							  </tr>
<?php } }else { ?>
<tr><td colspan="6" align="center">Not joined any users till now for this league</td></tr>
<?php } ?>


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
	
	 <footer>
		<?php include('footer.php'); ?>
	</footer>
	
	
	<!-- Alert Modal -->
	<!-- Alert Modal - stop league-->
	   <div class="modal fade" id="remove-league-user" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-danger" id="delete_header">
			  <button type="button" class="close delClose" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Attention</h4>
			</div>
			<div class="modal-body" >
			    <div class="alert alert-danger" id="delete_leg_body">
				  <strong>Confirm!</strong> Are you sure want to Block this user?
                 
				</div>
			</div>
			<div class="modal-footer" id="delete_footer">
			  <button type="button" class="btn btn-warning"  id="delete">Yes</button> <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</div>
		  </div>
		  
		</div>
	  </div>
      <form method="post" action="" id="" class="delete_form">
         <input type="hidden" name="league_id" id="league_id" value="">
         <input type="hidden" name="user_id" id="user_id" value="">
      </form> 
      <!-- Alert Modal - Activate league-->
	  <div class="modal fade" id="activate-league-user" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-info" id="activate_header">
			  <button type="button" class="close actClose" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Attention</h4>
			</div>
			<div class="modal-body" >
			    <div class="alert alert-info" id="activate_leg_body">
				  <strong>Confirm!</strong> Are you sure want to Activate This user?
                 
				</div>
			</div>
			<div class="modal-footer" id="activate_footer">
			  <button type="button" class="btn btn-warning"  id="activate">Yes</button> <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
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
     <script src="js/datatables.min.js"></script>
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
	  });
	  $('body').tooltip({
		selector: "[data-tooltip=tooltip]",
		container: "body"
	});
	  
	  	   $(document).on("click", ".del_league_user,.act_league_user", function () {
			 var idVal = $(this).attr('data-id');
			  var userVal = $(this).attr('data-user');
			 $("#league_id").val( idVal );
			 $("#user_id").val( userVal );
			 $('#delete_header').show();
		     $('#delete_footer').show();
			  $('#activate_header').show();
		     $('#activate_footer').show();
			
		});

	  
	  $('body').on('click', '#delete', function () 
	    {
	  	$('#delete_leg_body').html('');
		$('#delete_footer').hide();
		$('#delete_header').hide();
		$('#delete_footer').hide();
		var idVal=$("body").find(" #league_id"). val();
		var userId=$("body").find(" #user_id"). val();
		//alert(idVal);
		//var formdata= $("body").find(".delete_form"). serialize();
		
		$.ajax({
				type: "POST",
				url: "ajaxfunctions.php?league_user_delete&id="+idVal+"&userid="+userId,
				data: '',
				success: function(data) {
					//alert(data);
					$('#delete_header').show();
					$('#delete_leg_body').html(data);
				}
		 });
	  }); 
	  
	  
	   $('body').on('click', '#activate', function () 
	    {
	  	$('#activate_leg_body').html('');
		$('#activate_footer').hide();
		$('#activate_header').hide();
		$('#activate_footer').hide();
		var idVal=$("body").find(" #league_id"). val();
		var userId=$("body").find(" #user_id"). val();
		//alert(idVal);
		//var formdata= $("body").find(".delete_form"). serialize();
		
		$.ajax({
				type: "POST",
				url: "ajaxfunctions.php?league_user_activate&id="+idVal+"&userid="+userId,
				data: '',
				success: function(data) {
					//alert(data);
					$('#activate_header').show();
					$('#activate_leg_body').html(data);
				}
		 });
	  }); 
	  
	  
	$('body').on('click', '.actClose,.delClose', function ()  {
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