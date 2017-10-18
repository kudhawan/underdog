<?php
session_start();
include('db.php');
$login_type=$_SESSION['login_type'];

$user_id=$_SESSION['user_id'];
$sql=@mysql_query("select * from users where id='$user_id'");
$dt=@mysql_fetch_array($sql);
$first_name=$dt['first_name'];
$last_name=$dt['last_name'];
$middile_name=$dt['middile_name'];
$gender=$dt['gender'];
$dob=strtotime($dt['dob']);
$day=date('d', $dob); 
$month=date('m', $dob); 
$year=date('Y', $dob); 
if($day>9){$dateVal=$day;}else{$dateValSplit=split('0',$day);$dateVal=$dateValSplit[1];}
if($month>9){$monthVal=$day;}else{$monthValSplit=split('0',$month);$monthVal=$monthValSplit[1];}

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
	
	
<section class="inner-menu">
       <?php 
			if(($login_type==1)||($login_type==3)){
				include('inner_menu.php');
			}
			else if($login_type==2)
			{
				include('inner_menu_admin.php');
			}
		?>
        
	</section>
	
	<section class="tab-content-space">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-label-head">Account Management</div>
                <!-- <p align="center" id="success_msg" class="alert_msg" style="color:green"></p> 
                 <p align="center" id="error_msg" class="alert_msg"></p>-->
             
             <div  class="succ_msg alert_box" style="display:none">
              <div class="col-md-8"  id="succ_msg_user"></div>
              <div class="col-md-4"><a class="close alertClose" aria-label="Close" style="color:green">x</a></div>
            </div>
            
            <div  class="alert_msg alert_box"  style="display:none">
              <div class="col-md-8" id="alert_msg_user"></div>
              <div class="col-md-4"><a class="close alertClose" aria-label="Close" style="color:red">x</a></div>
            </div>
            <p>&nbsp;</p>
                 
                 
                 
				<div class="form-box">
					
					<form id="account_form" action="" class="form-horizontal form-label-left" method="post">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']  ?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first_name" name="first_name" required="required" class="form-control col-md-7 col-xs-12 validation_chk" value="<?php echo $first_name;  ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last_name" name="last_name" required="required" class="form-control col-md-7 col-xs-12 validation_chk" value="<?php echo $last_name; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middile_name" name="middile_name" class="form-control col-md-7 col-xs-12" type="text"  value="<?php echo $middile_name; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <?php if($gender=='male'){ ?>
                            <label class="btn btn-warning" data-toggle-class="btn-warning" data-toggle-passive-class="btn-default">
                            <?php } else{ ?>
                             <label class="btn btn-default" data-toggle-class="btn-default" data-toggle-passive-class="btn-primary">
                            <?php }  ?>
                           
                           
                            
                              <input type="radio" name="gender" value="male" <?php if($gender=='male'){echo "checked='checked'";} ?>> &nbsp; Male &nbsp;
                            </label>
                            <?php if($gender=='female'){ ?>
                            <label class="btn btn-warning" data-toggle-class="btn-warning" data-toggle-passive-class="btn-default">
                            <?php } else{ ?>
                             <label class="btn btn-default" data-toggle-class="btn-default" data-toggle-passive-class="btn-primary">
                            <?php }  ?>
                              <input type="radio" name="gender" value="female"  <?php if($gender=='female'){echo "checked='checked'";} ?>> Female
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
            <div id="default-settings"></div>
			
                          
                          
                          
                         <!-- <input id="dob" name="dob" class="date-picker form-control col-md-7 col-xs-12 validation_chk" required="required" type="text" value="<?php //echo $dob; ?>">-->
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         
						 <a href=""> <button class="btn btn-danger" type="button">Cancel</button></a>
                          <button type="button" class="btn btn-warning" name="submit" id="submit">Submit</button>
                        </div>
                      </div>

                    </form>
					
					
					
				</div>
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
	
	
	

	  
	<!-- Create League -->
	  <div class="modal fade" id="create-league" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-info">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Create League</h4>
			</div>
			<div class="modal-body">
			    <form role="form" class="form-horizontal">
					<div class="form-group">
					  <label class="col-sm-3" for="inputTo">League Name</label>
					  <div class="col-sm-9"><input type="email" class="form-control" id="inputTo"></div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3" for="inputSubject">Min Entries</label>
					  <div class="col-sm-3">
						  <select class="form-control">
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						  </select>
					  </div>
					  <label class="col-sm-3" for="inputSubject">Max Entries</label>
					  <div class="col-sm-3">
						  <select class="form-control">
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						  </select>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3" for="inputSubject">Entry Fees</label>
					  <div class="col-sm-3">
						  <input type="text" class="form-control">
					  </div>
					  <label class="col-sm-3" for="inputSubject">Total Sizes</label>
					  <div class="col-sm-3">
						  <input type="text" class="form-control">
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-12" for="inputBody">League Description</label>
					  <div class="col-sm-12"><textarea class="form-control" id="inputBody" rows="3"></textarea></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button> 
				<button type="button" class="btn btn-danger pull-left">Save Draft</button>
				<button type="button" class="btn btn-warning pull-right"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
			</div>
		  </div>
		  
		</div>
	  </div>
	  
	  <!-- Players Remove -->
	  <div class="modal fade" id="players-remove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-success">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Joined Players</h4>
			</div>
			<div class="modal-body">
			    <div class="admin-table table-responsive players_data">
					
				</div>
			</div>
			<div class="modal-footer">
			  
			</div>
		  </div>
		  
		</div>
	  </div>
      
      
      
      	<div class="modal fade" id="viewDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<a class="close" data-dismiss="modal" aria-label="Close" id="close"><span class="fa fa-window-close-o" aria-hidden="true"></span></a>
		  </div>
		  <div class="modal-body" id="detailsBody">
		  </div>
		  
		</div>
	  </div>
	</div>
    
    
	<!-- Alert Modal -->
	  <div class="modal fade" id="remove-league" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-danger" id="delete_header">
			  <button type="button" class="close delClose" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Attention</h4>
			</div>
			<div class="modal-body" >
			    <div class="alert alert-danger" id="delete_leg_body">
				  <strong>Confirm!</strong> Are you sure want to Stop league.
                 
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
      </form>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.bxslider.js"></script>
	
	<script src="js/responsiveslides.js"></script>
    <script src="js/jquery-birthday-picker.js"></script>
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">


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
	  
	  
	   $(".validation_chk").keyup(function(){
		if(this.value!='')
		{
			$(this).css("border","");
		}
		});
		
		$("#default-settings").birthdayPicker();	
				$("#default-birthday").birthdayPicker({"defaultDate": "01-03-1980",
					"maxYear": "2020",
					"maxAge": 65,
		});
				
		$('select.birthYear').val('<?php echo $year; ?>');      // 1980
		$('select.birthMonth').val('<?php echo $monthVal; ?>');    // 1-12 (not "Jan" which is the text)
		$('select.birthDate').val('<?php echo $dateVal; ?>');		
				
		
	  
	  $("#submit").click(function(){
		 
		var validation_chk=$('.validation_chk').val();
		if(validation_chk=='')
		{
			$('.validation_chk').css("border-color","red");
			return false;
		}
		
		var first_name=$('#first_name').val();
		var last_name=$('#last_name').val();
		var dob=$('#dob').val();
		
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
		
		else if(dob=='')
		{
			$('#dob').focus();
			$('#dob').css("border-color","red");
			return false;
		}
		
		
		
		else
		{
		  $('#succ_msg_user').html('');
		  $('#alert_msg_user').html('');
		  $('.succ_msg,.alert_msg').hide();
		 $.ajax({
				type: "POST",
				url: "ajaxfunctions.php?my_account",
				data: $('#account_form').serialize(),
				success: function(data) {
					//alert(data);
					if(data=='success')
					{
						//window.location.href='manage-account.php';
						//$('#success_msg').html('Your acoount details have been updated');
						$('.succ_msg').show('');
						$('#succ_msg_user').html('Your acoount details have been updated successfully');	
					}
					else
					{
						//$('#error_msg').html(data);
						$('.alert_msg').show('');
						$('#alert_msg_user').html(data);
						
					}
				}
		 });
		 
		}
	 });
	$('body').on('click', '.details', function () 
	    {
			$('#detailsBody').html('');
			var idVal=$(this).attr('data-id');
			$.ajax({
					type: "POST",
					url: "ajaxfunctions.php?league_details&id="+idVal,
					data: {id:idVal},
					success: function(data) {
						//alert(data);
						$('#detailsBody').html(data);
					}
			 });
	  }); 
	  
	  $(document).on("click", ".del_league", function () {
			 var idVal = $(this).attr('data-id');
			 $("#league_id").val( idVal );
			 $('#delete_header').show();
		     $('#delete_footer').show();
			
		});

	  
	  $('body').on('click', '#delete', function () 
	    {
	  	$('#delete_leg_body').html('');
		$('#delete_footer').hide();
		$('#delete_header').hide();
		$('#delete_footer').hide();
		var idVal=$("body").find(" #league_id"). val();
		//alert(idVal);
		//var formdata= $("body").find(".delete_form"). serialize();
		
		$.ajax({
				type: "POST",
				url: "ajaxfunctions.php?league_delete&id="+idVal,
				data: '',
				success: function(data) {
					//alert(data);
					$('#delete_header').show();
					$('#delete_leg_body').html(data);
				}
		 });
	  }); 
	$('body').on('click', '.delClose', function ()  {
		window.location.reload();
	
	 }); 
	 
	 
	 
	   $('body').on('click', '.view_players', function () 
	    {
			var idVal=$(this).attr('data-id');
			$('.players_data').html('');
			$.ajax({
					type: "POST",
					url: "ajaxfunctions.php?players_details&id="+idVal,
					data: '',
					success: function(data) {
						//alert(data);
						
						$('.players_data').html(data);
					}
			 });
	  });
	  
	</script>
  </body>
</html>