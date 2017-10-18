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
    <!--  <link href="css/datepicker.css" rel="stylesheet">-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
	.datepicker{ z-index:99999 !important; }
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
				<div class="form-label-head">League Management</div>
				<div class="form-box">
					
					<div class="lobby-table table-responsive">
						 <table class="table borderless lobby table-hover" id="myTable" data-tableName="Users Table ">
							<thead>
							  <tr>
								<th>League Name</th>
								
								<th>League Population</th>
								
								
								<th></th>
							  </tr>
							</thead>
							<tbody>
							
                            
                            
                            <?php
							$sql=@mysql_query("select * from league ");
							$num=@mysql_num_rows($sql);
							if($num>0){
							while($data=@mysql_fetch_array($sql))
							{
								$status=$data['status'];
								//echo $data['end_date'];
								 $end_date=strtotime($data['end_date']);
								
								 $current_date=strtotime(date("Y-m-d H:i:s"));
								 $league_id=$data['id'];
								 $added_user=$data['added_user'];
								 
								$userLeague=@mysql_query("select *  from users where id='$added_user' and status=1");
								$userNum=@mysql_num_rows($userLeague); 
								 
								 
								$population=@mysql_query("select count(*) as population from users where league_id='$league_id'");
								$dt=@mysql_fetch_array($population);
								$pcount=$dt['population'];
								if($end_date>$current_date)
								{
									$running='Running';
								}
								else
								{
									$running='Closed';
								}
							if($added_user>0){
							?>
                            
                              <tr>
								<td> <img src="images/american-football.png">&nbsp; <a ><?php echo $data['league_name'] ?></a></td>
								<td><?php echo $pcount; ?></td>
								<td>
                                <?php  if($status==1){?>
                                <a href="#" data-toggle="modal" data-target="#remove-league" class="edit-btn del_league" data-id="<?php echo $data['id']; ?>" data-tooltip="Stop League" ><span class="fa fa-ban"></span></a>&nbsp;
                                <?php }else {  ?>
                                <a href="#" data-toggle="modal" data-target="#activate-league" class="edit-btn act_league"  data-id="<?php echo $data['id']; ?>" data-tooltip="Activate League" ><span class="fa fa-check-circle"></span></a>&nbsp;
                                <?php } ?>
                                 <a href="javascript:void(0);" data-toggle="modal" data-target="#players-remove" class="delete-btn playerdetails" data-id="<?php echo $data['id']; ?>" data-tooltip="View Players" ><span class="fa fa-user-times"></span></a>&nbsp;<a href="javascript:void(0);" data-toggle="modal" data-target="#viewDetails"  class="btn-com details" data-id="<?php echo $data['id']; ?>" data-tooltip="View" title="View"><span class="fa fa-eye"></span></a></td>
							  </tr>
                                <?php  } ?>
							  <?php  } ?>
                              <?php } else  { ?>
                              <tr><td> No leagues Added </td></tr>
                              <?php }  ?>
							</tbody>
						  </table>
					</div>
				</div>
			</div>
			
		</div>
	</section>
	<footer class="admin">
		<?php include('footer_admin.php'); ?>
	</footer>
	
	
	<!-- Alert Modal - stop league-->
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
      <!-- Alert Modal - Activate league-->
	  <div class="modal fade" id="activate-league" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-info" id="activate_header">
			  <button type="button" class="close actClose" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Attention</h4>
			</div>
			<div class="modal-body" >
			    <div class="alert alert-info" id="activate_leg_body">
				  <strong>Confirm!</strong> Are you sure want to Activate league.
                 
				</div>
			</div>
			<div class="modal-footer" id="activate_footer">
			  <button type="button" class="btn btn-warning"  id="activate">Yes</button> <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</div>
		  </div>
		  
		</div>
	  </div>
      
	  
	<!-- Create League -->
	  <div class="modal fade" id="create-league" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-info">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Create League</h4>
              
                 <p align="center" id="error_msg" class="alert_msg"></p>
			</div>
			<div class="modal-body">
			    <form role="form" class="form-horizontal" id="create_league" method="post" action="">
					<div class="form-group">
					  <label class="col-sm-3" for="inputTo">League Name</label>
					  <div class="col-sm-9"><input type="text" name="league_name" id="league_name" class="form-control validation_chk"></div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3" for="inputSubject"> Entries</label>
					  <div class="col-sm-9">
						  
                        <input type="text" name="min_entries" id="min_entries" class="form-control " value="2" readonly>
                         <input type="hidden" name="prizes" id="prizes" class="form-control validation_chk" value="0"> 
                        <input type="hidden" class="form-control validation_chk"  name="entry_fee" id="entry_fee" value="0">   
                        </div>  
                         
					 
					</div>
                    <!--<div class="form-group">
					  <label class="col-sm-3" for="inputSubject"> Prizes</label>
					  <div class="col-sm-9">
						  
                        <input type="hidden" name="prizes" id="prizes" class="form-control validation_chk" value="0"> 
                        </div>  
                       <p id="min_entries_error" class="errorMsg"></p>  
					 
					</div>-->
                    
					<div class="form-group">
					 <!-- <label class="col-sm-3" for="inputSubject">Entry Fees</label>
					  <div class="col-sm-3">
						  <input type="hidden" class="form-control validation_chk"  name="entry_fee" id="entry_fee" value="0">
					  </div>-->
					  <label class="col-sm-3" for="inputSubject">Total Sizes</label>
					  <div class="col-sm-9">
						  <input type="text" class="form-control validation_chk" name="tot_sizes" id="tot_sizes">
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-3" for="inputSubject">Start Date</label>
					  <div class="col-sm-3">
						  <input type="text" class="form-control validation_chk datepicker" name="start_date" id="start_date" placeholder="yyyy-mm-dd" data-date="<?php echo date('Y-m-d');  ?>" data-date-format="yyyy-mm-dd" data-date-start-date="+1d">
					  </div>
					  <label class="col-sm-3" for="inputSubject">End Date</label>
					  <div class="col-sm-3">
						  <input type="text" class="form-control validation_chk datepicker" name="end_date" id="end_date" placeholder="yyyy-mm-dd" data-date-start-date="+1d" data-date-format="yyyy-mm-dd">
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-12" for="inputBody">League Description</label>
					  <div class="col-sm-12"><textarea class="form-control validation_chk" id="inputBody" rows="3" name="inputBody"></textarea></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button> 
				<button type="button" class="btn btn-danger pull-left addleague" name="savedraft" id="savedraft">Save Draft</button>
				<button type="button" class="btn btn-warning pull-right addleague" name="saveleague" id="saveleague"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                <input type="hidden" name="status" id="status" value="">
			</div>
		  </div>
		  
		</div>
	  </div>
	  
	  <!-- Players Remove -->
	  <div class="modal fade" id="players-remove" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-success">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Joined Players</h4>
			</div>
			<div class="modal-body">
			    <div class="admin-table table-responsive" >
                 <table class="table table-admin-style table-striped" id="playerTable" data-tableName="Users Table ">
						<thead>
						  <tr>
							<th>Username</th>
							<th>Points</th>
							<!--<th>Actions</th>-->
						  </tr>
						</thead>
						<tbody id="players_details">
                        </tbody>
                </table>
					
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
	
<!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>-->


	
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
	$('body').tooltip({
		selector: "[data-tooltip=tooltip]",
		container: "body"
	});

     /* $("body").delegate("#start_date", "focusin", function(){
        $("#start_date").datepicker({ 
		dateFormat: 'yy-mm-dd',
		minDate: 0,
		onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
             $("body").delegate("#end_date", "focusin", function(){
				$("#end_date").datepicker("option", "minDate", dt); 
			 });	 
        }
		
		
		
		});
    });
	
	 $("body").delegate("#end_date", "focusin", function(){
        $("#end_date").datepicker({ 
		dateFormat: 'yy-mm-dd',
		minDate: 0,
		onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
			
			$("body").delegate("#start_date", "focusin", function(){
				 $("#start_date").datepicker("option", "maxDate", dt);
			 });
			 
           
		}
		});
    });*/
	    
		
	  $(function() {
		$(".rslides").responsiveSlides();
		$('#myTable').DataTable();
		$('#playerTable').DataTable();
	  });
	   $(".validation_chk").keyup(function(){
		if(this.value!='')
		{
			$(this).css("border","");
		}
	
		});	
		
    /* $("#min_entries,#max_entries").change(function(){
		if(this.value!='')
		{
			$(this).css("border","");
		}
	
		});	*/
		
	  $('.validation_chk').val('')
	  	  /*script for registraion form validation/submit*/
			 
	  $(".addleague").click(function(){
		  var idval=$(this).attr('id');
		 // alert(idval);
		  if(idval=='saveleague')
		  {
			  var status=1;
		  }
		  else if(idval=='savedraft')
		  {
			var status=2;  
		  }
		  
		var validation_chk=$('.validation_chk').val();
		if(validation_chk=='')
		{
			$('.validation_chk').css("border-color","red");
			return false;
		}
		
		var league_name=$('#league_name').val();
		var min_entries=$('#min_entries').val();
		var prizes=$('#prizes').val();
		var entry_fee=$('#entry_fee').val();
		var tot_sizes=$('#tot_sizes').val();
		var start_date=$('#start_date').val();
		var end_date=$('#end_date').val();
		var inputBody=$('#inputBody').val();
		
		
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(league_name=='')
		{
			$('#league_name').focus();
			$('#league_name').css("border-color","red");
			return false;
		}
		else if(min_entries=='')
		{
			$('#min_entries').focus();
			$('#min_entries').css("border-color","red");
			return false;
		}
		else if(min_entries<2)
		{
			$('#min_entries').focus();
			$('#min_entries_error').html('Min value is 2');
			$('#min_entries').css("border-color","red");
			return false;
		}
		else if(prizes=='')
		{
			$('#prizes').focus();
			$('#prizes').css("border-color","red");
			return false;
		}
		
		else if(entry_fee=='')
		{
			$('#entry_fee').focus();
			$('#entry_fee').css("border-color","red");
			return false;
		}
		else if(tot_sizes=='')
		{
			$('#tot_sizes').focus();
			$('#tot_sizes').css("border-color","red");
			return false;
		}
		
		else if(start_date=='')
		{
			$('#start_date').focus();
			$('#start_date').css("border-color","red");
			return false;
		}
		else if(end_date=='')
		{
			$('#end_date').focus();
			$('#end_date').css("border-color","red");
			return false;
		}
		else if(inputBody=='')
		{
			$('#inputBody').focus();
			$('#inputBody').css("border-color","red");
			return false;
		}
		
		else
		{
		 $('#errorMsg').html('');
		 $.ajax({
				type: "POST",
				url: "ajaxfunctions.php?create_league&status="+status,
				data: $('#create_league').serialize(),
				success: function(data) {
					// alert(data);
					if(data=='success')
					{
						window.location.href='manage-league.php';	
					}
					else
					{
						$('#error_msg').html(data);
						$("#league_name,#prizes,#entry_fee,#tot_sizes,#start_date,#end_date,#inputBody").val('');
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
	  
	  $('body').on('click', '.playerdetails', function () 
	    {
	    $('#players_details').html('');
		var idVal=$(this).attr('data-id');
		//alert(idVal);
		$.ajax({
				type: "POST",
				url: "ajaxfunctions.php?players_details&id="+idVal,
				data: {id:idVal},
				success: function(data) {
					//alert(data);
					$('#players_details').html(data);
				}
		 });
	  });
	  
	  
	  
	   $(document).on("click", ".del_league,.act_league", function () {
			 var idVal = $(this).attr('data-id');
			 $("#league_id").val( idVal );
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
	  
	  
	   $('body').on('click', '#activate', function () 
	    {
	  	$('#activate_leg_body').html('');
		$('#activate_footer').hide();
		$('#activate_header').hide();
		$('#activate_footer').hide();
		var idVal=$("body").find(" #league_id"). val();
		//alert(idVal);
		//var formdata= $("body").find(".delete_form"). serialize();
		
		$.ajax({
				type: "POST",
				url: "ajaxfunctions.php?league_activate&id="+idVal,
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