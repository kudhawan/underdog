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
				<div class="form-label-head">Upcming Matches</div>
				<div class="form-box">
					<div class="lobby-table table-responsive">
						<table class="table borderless lobby table-striped">
							<thead>
							  <tr>
								<th>Contest Name</<th>Entries</th>
								<th>League Population</th>
								
								
								<th></th>
							  </tr>
							</thead>
							<tbody>
                          <?php
						  $user_id=$_SESSION['user_id'];   
						  $lsql=@mysql_query("select league_id from users where id='$user_id' ");
						  if(@mysql_num_rows($lsql)>0){
						  $ldt=@mysql_fetch_array($lsql);  
						  $league_id=$ldt['league_id'];
						  }
						  else
						  {
							$league_id='';  
						  }
						  
							$sql=@mysql_query("select * from league where added_user='$user_id' or id='$league_id' and  status=1  ");
							$num=@mysql_num_rows($sql);
							if($num>0){
							while($data=@mysql_fetch_array($sql))
							{
								
								
								$end_date=strtotime($data['end_date']);
								$current_date=strtotime(date("Y-m-d H:i:s"));
								$league_id=$data['id'];
								$population=@mysql_query("select count(*) as population from users where league_id='$league_id'");
								$dt=@mysql_fetch_array($population);
								$pcount=$dt['population'];
								
							?>
							   <tr>
								<td><!--<span class="fa fa-futbol-o"></span>--> <img src="images/american-football.png">&nbsp; <a href="live-betting.php" ><?php echo $data['league_name'] ?></a></td>
								
								<td><?php echo $pcount; ?></td>
								
								
								<td><a href="javascript:void(0);" data-toggle="modal" data-target="#viewDetails"  class="btn-com details" data-id="<?php echo $data['id']; ?>" >Details</a></td>
							  </tr>
							   <?php }  ?>
                              <?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</section>
	
	
	

	
	<footer>
		<?php include('footer.php'); ?>
	</footer>
	
	
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
	  
	</script>
  </body>
</html>