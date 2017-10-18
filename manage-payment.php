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
	
	
	<section class="inner-menu-admin">
		<?php include('inner_menu_admin.php');  ?>
	</section>
	
	<section class="tab-content-space">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-label-head">Payment Management</div>
				<div class="form-box">
					<div class="top-search-bar clearfix">
						<div class="col-lg-6 text-left">
							<form class="form-inline" role="form">
								<div class="form-group small-width-admin">
								  <select class="form-control" id="sel1">
									<option>A</option>
									<option>B</option>
									<option>C</option>
									<option>4</option>
								  </select>
								</div>
								<div class="input-group">
								  <input type="text" class="form-control" placeholder="Search for...">
								  <span class="input-group-btn">
									<button class="btn btn-danger" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
								  </span>
								</div>
							</form>
						</div>
						<div class="col-lg-6 text-right">
							<button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Send Payment</button>
							<button type="button" class="btn btn-warning"><i class="fa fa-times" aria-hidden="true"></i> Hold Payment</button>
						</div>
					</div>
					
				</div>
			</div>
			
			
			
			
		</div>
	<section>
	
	
	

	
	<footer class="admin">
		<div class="container copy-rights">
			<div class="col-lg-12">
				<div class="copy-text text-center small-d">Copyright &copy; 2017 <a href="#">Underdog</a> All rights reserved</div>
			</div>
		</div>
	</footer>
	
	
	<!-- Alert Modal -->
	  <div class="modal fade" id="remove-league" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-danger">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Attention</h4>
			</div>
			<div class="modal-body">
			    <div class="alert alert-danger">
				  <strong>Confirm!</strong> Are you sure want to Stop league.
				</div>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-warning" data-dismiss="modal">Yes</button> <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
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
	  <div class="modal fade" id="players-remove" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-success">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Joined Players</h4>
			</div>
			<div class="modal-body">
			    <div class="admin-table table-responsive">
					<table class="table table-admin-style table-striped">
						<thead>
						  <tr>
							<th></th>
							<th>Username</th>
							<th>Bet Slip</th>
							<th>Points</th>
							<th>Actions</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td class="select-all"><input type="checkbox" value=""></td>
							<td>gregorymkeller</td>
							<td><span class="active-user">$10</span></td>
							<td>12345</td>
							<td><a href="#" class="edit-btn"><span class="fa fa-pencil-square-o"></span></a> <a href="#" data-toggle="modal" data-target="#delete" class="delete-btn"><span class="fa fa-trash"></span></a></td>
						  </tr>
						  <tr>
							<td class="select-all"><input type="checkbox" value=""></td>
							<td>gregorymkeller</td>
							<td><span class="active-user">$10</span></td>
							<td>12345</td>
							<td><a href="#" class="edit-btn"><span class="fa fa-pencil-square-o"></span></a> <a href="#" data-toggle="modal" data-target="#delete" class="delete-btn"><span class="fa fa-trash"></span></a></td>
						  </tr>
						  <tr>
							<td class="select-all"><input type="checkbox" value=""></td>
							<td>gregorymkeller</td>
							<td><span class="active-user">$10</span></td>
							<td>12345</td>
							<td><a href="#" class="edit-btn"><span class="fa fa-pencil-square-o"></span></a> <a href="#" data-toggle="modal" data-target="#delete" class="delete-btn"><span class="fa fa-trash"></span></a></td>
						  </tr>
						  <tr>
							<td class="select-all"><input type="checkbox" value=""></td>
							<td>gregorymkeller</td>
							<td><span class="active-user">$10</span></td>
							<td>12345</td>
							<td><a href="#" class="edit-btn"><span class="fa fa-pencil-square-o"></span></a> <a href="#" data-toggle="modal" data-target="#delete" class="delete-btn"><span class="fa fa-trash"></span></a></td>
						  </tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
			  
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
	</script>
  </body>
</html>