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
		<?php include('innerpage_header.php'); ?>
	</header>
	
	<section class="inner-menu">
		<?php include('inner_menu.php');  ?>
	</section>
		
	<section class="tab-content-space">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-label-head">Account Management</div>
				<div class="form-box">
					
					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="middle-name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="male"> &nbsp; Male &nbsp;
                            </label>
                            <label class="btn btn-warning" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="female"> Female
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-default" type="button">Cancel</button>
						  <button class="btn btn-danger" type="reset">Reset</button>
                          <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                      </div>

                    </form>
					
					
					<div class="lobby-table table-responsive">
						 <table class="table borderless lobby table-hover">
							<thead>
							  <tr>
								<th>League Name</th>
								<th>Entries</th>
								<th>Size</th>
								<th>Entry</th>
								<th>Prizes</th>
								<th>Start</th>
								<th></th>
							  </tr>
							</thead>
							<tbody>
							  <tr>
								<td><!--<span class="fa fa-futbol-o"></span>--> <img src="images/american-football.png">&nbsp; <a href="live-betting.php">$3M NFL Sunday Million</a></td>
								<td>1377</td>
								<td>13793</td>
								<td>$25</td>
								<td>$3,00,000</td>
								<td>Running</td>
								<td><a href="#" data-toggle="modal" data-target="#remove-league" class="edit-btn"><span class="fa fa-ban"></span></a> <a href="#" data-toggle="modal" data-target="#players-remove" class="delete-btn"><span class="fa fa-user-times"></span></a></td>
							  </tr>
							  <tr>
								<td><!--<span class="fa fa-futbol-o"></span>--> <img src="images/american-football.png">&nbsp; <a href="live-betting.php">$3M NFL Sunday Million</a></td>
								<td>10</td>
								<td>2777</td>
								<td>$200</td>
								<td>$5,000</td>
								<td>Running</td>
								<td><a href="#" data-toggle="modal" data-target="#remove-league" class="edit-btn"><span class="fa fa-ban"></span></a> <a href="#" data-toggle="modal" data-target="#players-remove" class="delete-btn"><span class="fa fa-user-times"></span></a></td>
							  </tr>
							  <tr>
								<td><!--<span class="fa fa-futbol-o"></span>--> <img src="images/american-football.png">&nbsp; <a href="live-betting.php">$12K NFL Bitz</a></td>
								<td>128</td>
								<td>11498</td>
								<td>$25</td>
								<td>$3,00,000</td>
								<td>Running</td>
								<td><a href="#" data-toggle="modal" data-target="#remove-league" class="edit-btn"><span class="fa fa-ban"></span></a> <a href="#" data-toggle="modal" data-target="#players-remove" class="delete-btn"><span class="fa fa-user-times"></span></a></td>
							  </tr>
							  <tr>
								<td><!--<span class="fa fa-futbol-o"></span>--> <img src="images/american-football.png">&nbsp; <a href="live-betting.php">$12K NFL Bomb</a></td>
								<td>84</td>
								<td>13793</td>
								<td>$5</td>
								<td>$3,00,000</td>
								<td>Running</td>
								<td><a href="#" data-toggle="modal" data-target="#remove-league" class="edit-btn"><span class="fa fa-ban"></span></a> <a href="#" data-toggle="modal" data-target="#players-remove" class="delete-btn"><span class="fa fa-user-times"></span></a></td>
							  </tr>
							</tbody>
						  </table>
					</div>
				</div>
			</div>
			
			<div class="col-lg-12">
				<div class="form-label-head">Upcoming League</div>
				<div class="form-box">
					<div class="lobby-table table-responsive">
						 <table class="table borderless lobby table-hover">
							<thead>
							  <tr>
								<th>League Name</th>
								<th>Entries</th>
								<th>Size</th>
								<th>Entry</th>
								<th>Prizes</th>
								<th>Start</th>
								<th></th>
							  </tr>
							</thead>
							<tbody>
							  <tr>
								<td><!--<span class="fa fa-futbol-o"></span>--> <img src="images/american-football.png">&nbsp; <a href="live-betting.php">$3M NFL Sunday Million</a></td>
								<td>1377</td>
								<td>13793</td>
								<td>$25</td>
								<td>$3,00,000</td>
								<td>Sun 1pm</td>
								<td><a href="#" class="btn-com">View</a></td>
							  </tr>
							  <tr>
								<td><!--<span class="fa fa-futbol-o"></span>--> <img src="images/american-football.png">&nbsp; <a href="live-betting.php">$3M NFL Sunday Million</a></td>
								<td>10</td>
								<td>2777</td>
								<td>$200</td>
								<td>$5,000</td>
								<td>Sun 1pm</td>
								<td><a href="#" class="btn-com">View</a></td>
							  </tr>
							  <tr>
								<td><!--<span class="fa fa-futbol-o"></span>--> <img src="images/american-football.png">&nbsp; <a href="live-betting.php">$12K NFL Bitz</a></td>
								<td>128</td>
								<td>11498</td>
								<td>$25</td>
								<td>$3,00,000</td>
								<td>Sun 1pm</td>
								<td><a href="#" class="btn-com">View</a></td>
							  </tr>
							  <tr>
								<td><!--<span class="fa fa-futbol-o"></span>--> <img src="images/american-football.png">&nbsp; <a href="live-betting.php">$12K NFL Bomb</a></td>
								<td>84</td>
								<td>13793</td>
								<td>$5</td>
								<td>$3,00,000</td>
								<td>Sun 1pm</td>
								<td><a href="#" class="btn-com">View</a></td>
							  </tr>
							</tbody>
						  </table>
					</div>
				</div>
			</div>
			
			<div class="col-lg-12 text-center">
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
			</div>
		</div>
	<section>
	
    <footer>
		<?php include('footer.php'); ?>
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