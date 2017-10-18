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
	
	
	<section class="inner-menu">
		<?php include('inner_menu_admin.php');  ?>
	</section>
	
	
	
	<section class="tab-content-space clearfix">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4">
				<div class="form-label-head">Matches</div>
				<div class="form-box">
					<ul class="match-table" id="match_paginate">
						
                        <?php
						//date_default_timezone_set('America/Los_Angeles');
						$output = shell_exec('curl -X GET https://jsonodds.com/api/odds/nfl -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
						$matchArray=json_decode($output);
						$length=count($matchArray);
						//print_r($matchArray);
						
						foreach($matchArray as $mydata)
						{
							
							
							//echo $mydata->HomeTeam . "\n";
							$matchDatetime=$mydata->MatchTime;
							$splitVal=explode("T",$matchDatetime);
							
							$time=	date('g:i a', strtotime($splitVal[1]." GMT+3"));
						  
						  // $cdatetime=strtotime(date("Y-m-d H:i:s"));
						   
								$date1 = $splitVal[0]." ".$splitVal[1]; 
								$date2 = date("Y-m-d H:i:s"); 
								
								$time1=strtotime($splitVal[1]." GMT+3");
								$time2=strtotime(date("H:i:s")." GMT+3");
								
								$diff = abs((strtotime($date2)." GMT+3") -( strtotime($date1)." GMT+3")); 
								
								$years   = floor($diff / (365*60*60*24)); 
								$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
								$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
								
								$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
								$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

						  		$matchDate=$splitVal[0];
						  		$currentDate=date("Y-m-d");
								
							
										$date=date('d', strtotime($splitVal[0]));
										$month=date('m', strtotime($splitVal[0]));
										$year=date('Y', strtotime($splitVal[0]));
										$hr=date('H', strtotime($splitVal[1]));
										$min=date('i', strtotime($splitVal[1]));
										$sec=date('s', strtotime($splitVal[1]));
										
										$EasternTimeStamp =mktime($hr-4,$min,$sec,$month,$date,$year);

										$timeLive=	date('g:i A',$EasternTimeStamp) ; 
										$dateLive=	date('D M d', $EasternTimeStamp);
										
										 $staticEnddate = strtotime(date('Y-m-d',strtotime('this Sunday')));
										 $matchDateCheck=strtotime($splitVal[0]);
										 if($matchDateCheck<=$staticEnddate){
						  
							?>
                            
                            <li id="<?php echo $mydata->ID ?>" >
							<div class="match-name"><?php echo $mydata->HomeTeam ?> <span>vs</span> <?php echo $mydata->AwayTeam ?></div>
                           
							<p> <span class="fa fa-dot-circle-o"></span>
							<?php  if($matchDate==$currentDate){ if($time2>$time1){echo "Running";} else {echo $time." Starts in".$hours."h  ".$minuts."m";} }else{ ?>
							<?php echo $dateLive." ".$timeLive; ?>  
                            <?php }  ?>
                            
                             </p>
						</li> 
                            
                            <?php } }?>
                        
					</ul>
				</div>

			</div>
			
			<div class="col-lg-9 col-md-9 col-sm-8">
			

				<div class="form-label-head top-space">Running Leagues</div>
				<div class="form-box">
					<div class="lobby-table table-responsive">
						 <table class="table borderless lobby table-hover">
							<thead>
							  <tr>
								<th>League Name</th>
								 <th>Created By</th>
								<th>League Population</th>
								
								
								<th></th>
							  </tr>
							</thead>
							<tbody>
							   <?php
							$sql=@mysql_query("select * from league where status=1 ");
							$num=@mysql_num_rows($sql);
							if($num>0){
							while($data=@mysql_fetch_array($sql))
							{
								$end_date=strtotime($data['end_date']);
								$current_date=strtotime(date("Y-m-d H:i:s"));
								$added_user=$data['added_user'];
								$user_id=$_SESSION['user_id'];
								
								$added_user=$data['added_user'];
								
								$userLeague=@mysql_query("select first_name,last_name,id  from users where id='$added_user'");
								$userNum=@mysql_num_rows($userLeague);
								$dtUser=@mysql_fetch_array($userLeague);
								$first_name=$dtUser['first_name'];
								$last_name=$dtUser['last_name'];
								
								 $league_id=$data['id'];
								$population=@mysql_query("select count(*) as population from users where league_id='$league_id'");
								$dt=@mysql_fetch_array($population);
								$pcount=$dt['population'];
								if($userNum>0){
								
							?>
                              
                              <tr>
								<td><!--<span class="fa fa-futbol-o"></span>--> <img src="images/american-football.png">&nbsp; <a href="#" <?php if($added_user==$user_id){ ?>style="font-weight:bold;"<?php }  ?>><?php echo $data['league_name'] ?></a></td>
								<td><?php echo $first_name." ".$last_name; ?></td>
								<td><?php echo $pcount; ?></td>
								
								<td><a href="javascript:void(0);" data-toggle="modal" data-target="#viewDetails"  class="btn-com details" data-id="<?php echo $data['id']; ?>" >View</a></td>
							  </tr>
                               <?php }}  ?>
                              <?php } else  { ?>
                              <tr><td> No Future leagues found </td></tr>
                              <?php }  ?>
							  
							</tbody>
						  </table>
					</div>
				</div>
			  </div>
			
		</div>
	</section>
	
 <form method="post" action="live-betting.php" id="matchform">
    <input type="hidden" name="match_id" id="match_id" value="">
    </form>
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
<footer class="admin">
		<?php include('footer_admin.php'); ?>
	</footer>	
<style>
	.easyPaginateNav{ text-align:center}
	#easyPaginate {width:300px;}
	#easyPaginate img {display:block;margin-bottom:10px;}
	.easyPaginateNav a {padding:5px;}
	.easyPaginateNav a.current {font-weight:bold;text-decoration:underline;}
</style>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.bxslider.js"></script>
	
	<script src="js/responsiveslides.js"></script>
    <script src="js/jquery.easyPaginate.js"></script>
    <script>
	    $('#match_paginate').easyPaginate({
        paginateElement: 'li',
        elementsPerPage: 3,
        effect: 'climb'
    });
	</script>
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
	  
	  <?php
	  if(isset($_GET['score'])){
	  ?>
	  $('.viewScore').trigger('click');
	  <?php }  ?>
	  
	  
	   $('body').on('click', '.matchLi', function () {
		   var idVal=$(this).attr('id');
		   $('#match_id').val(idVal);
		 $('#matchform').submit();
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