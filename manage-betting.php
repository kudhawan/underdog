<?php
session_start();
include('db.php');
$output = shell_exec('curl -X GET https://jsonodds.com/api/odds/nfl -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
$matchArray=json_decode($output);
$id=$matchArray[0]->ID;
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
	
	<section class="tab-content-space">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-label-head">Spread For Next Match  </div>
				<div class="form-box">
					
                    <?php
					$outputLive = shell_exec('curl -X GET https://jsonodds.com/api/odds/{'.$id.'} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
			   
$matchLiveArray=json_decode($outputLive);

		   foreach($matchLiveArray as $mydataLive) {
			   
			    foreach ( $mydataLive->Odds as $resultsLive )
									{	
			   //if($resultsLive->OddType=='Game'){
										$match_date=$mydataLive->MatchTime;
							            $split=explode("T",$match_date);
										$date=date('d', strtotime($split[0]));
										$month=date('m', strtotime($split[0]));
										$year=date('Y', strtotime($split[0]));
										$hr=date('H', strtotime($split[1]));
										$min=date('i', strtotime($split[1]));
										$sec=date('s', strtotime($split[1]));
										
										$EasternTimeStamp =mktime($hr-4,$min,$sec,$month,$date,$year);
		  
										$timeLiveSpread=	date('g:i A',$EasternTimeStamp) ; 
										$dateLiveSpread=	date('D M d', $EasternTimeStamp);
										
										/*$timeLive=	date('g:i A', strtotime($split[1]." GMT+3"));
										$dateLive=	date('D M d', strtotime($split[0]));*/
						  
						  // $cdatetime=strtotime(date("Y-m-d H:i:s"));
						   //$datePart1=date('D M d', strtotime($split[0]." GMT+3"));
								$date1 = $split[0]." ".$split[1]; 
								
								$day=date('D', strtotime($split[0]));
								date_default_timezone_set('America/Los_Angeles');
                                $currentHour = date(' h', time());
								
								if($day=='Fri')
								{
									$day_before = date( 'D M d', strtotime( $split[0] . ' -1 day' ) );
									$thursdayDT= strtotime( $split[0] . ' -1 day' );
									
									$dateDt=strtotime(date("Y-m-d"));
									if($dateDt==$thursdayDT)
									{
										
										
										if ($currentHour < 17)
										{
											
											$class='';
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
								if($day=='Sun')
								{
									$timeLive=	date('g:i A', strtotime($split[1]." GMT+3"));
									 $sundayDT= strtotime( $split[0] ) ;
									 $dateDt=strtotime(date("Y-m-d"));
									if($dateDt==$sundayDT)
									{
										if ($currentHour < 9)
										{
											$class='';
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
								if($resultsLive->OddType=='Game'){
			   ?>
					
					<div class="betting-table table-responsive">
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
                                  <tr >
									<td><?php echo $mydataLive->HomeTeam ?> </td>
									<td class="link-show"><button class="btn " id="home" data-id="<?php echo $id; ?>"> <?php  echo $resultsLive->PointSpreadHome; ?> (<?php  echo $resultsLive->PointSpreadHomeLine; ?>)</button></td>
									<td class="link-show"><button class="btn "><?php  echo $resultsLive->MoneyLineHome; ?></button></td>
									<td class="link-show" rowspan="2"><button class="btn"> <?php  echo $resultsLive->TotalNumber; ?></button></td>
								  </tr>
								  <tr>
									<td><?php echo $mydataLive->AwayTeam ?></td>
									<td class="link-show"><button class="btn "  id="away" data-id="<?php echo $id; ?>"><?php  echo $resultsLive->PointSpreadAway; ?> (<?php  echo $resultsLive->PointSpreadAwayLine; ?>)</button></td>
									<td class="link-show"><button class="btn"><?php  echo $resultsLive->MoneyLineAway; ?></button></td>
								  </tr>
								</tbody>
							  </table>
					</div>
					
				</div>
			
			<?php }}} ?>
            <div>&nbsp;</div>
			<div class="col-lg-12">
				<div class="form-label-head">Live Picks</div>
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
								<div class="input-group">
								  <input type="text" class="form-control" placeholder="Search for..."  id="myInput" onkeyup="myFunction()">
								  <span class="input-group-btn">
									<button class="btn btn-danger" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
								  </span>
								</div>
							</form>
						</div>
						<!--<div class="col-lg-6 text-right">
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#live-match"><i class="fa fa-eye" aria-hidden="true"></i> Live Match</button>
						</div>-->
					</div>
					<div class="lobby-table table-responsive">
						 <table class="table borderless lobby table-hover" id="myTable">
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
								$league_id=$data['id'];
								$added_user=$data['added_user'];
								
								$userLeague=@mysql_query("select first_name,last_name,id  from users where id='$added_user'");
								$userNum=@mysql_num_rows($userLeague);
								$dtUser=@mysql_fetch_array($userLeague);
								$first_name=$dtUser['first_name'];
								$last_name=$dtUser['last_name'];
								
								
								$population=@mysql_query("select count(*) as population from users where league_id='$league_id' and status=1");
								$dt=@mysql_fetch_array($population);
								$pcount=$dt['population'];
								if($userNum>0){
								
							?>
                              
                              <tr>
								<td><img src="images/american-football.png">&nbsp; <a ><?php echo $data['league_name'] ?></a></td>
								<td><?php echo $first_name." ".$last_name; ?></td>
								<td><?php echo $pcount; ?></td>
								
								<td><a href="javascript:void(0);" data-toggle="modal" data-target="#viewDetails"  class="btn-com details" data-id="<?php echo $data['id']; ?>" >View</a></td>
							  </tr>
                               <?php } } ?>
                              <?php } else  { ?>
                              <tr><td> No  leagues found </td></tr>
                              <?php }  ?>
							 
							</tbody>
						  </table>
                          </div>
					</div>
				</div>
			</div>
			
		</div>	
		</div>
	</section>
	<footer class="admin">
		<?php include('footer_admin.php'); ?>
	</footer>
	
	<!-- Live Match Modal -->
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
    
	  <div class="modal fade" id="live-match" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header alert-danger">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Live Match</h4>
			</div>
			<div class="modal-body" style="padding:0px;">
			    <div class="row betting-bg">
					<div class="col-lg-4 col-md-3 col-sm-3">
						<div class="small-size">
							<div class="team-name"><img src="team-img/cin-logo.png" alt="">Cincinnati Bengals</div>
							<div class="score">0</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="match-details">
							<div class="time" id="timer"></div>
							<div class="clearfix"><span class="pull-left redcard">1</span><span class="cards-pen">RED CARDS</span><span class="pull-right redcard">0</span></div>
							<div class="clearfix"><span class="pull-left yellowcard">0</span><span class="cards-pen">Yellow CARDS</span><span class="pull-right yellowcard">0</span></div>
							<div class="clearfix"><span class="pull-left corner">0</span><span class="cards-pen">Corners</span><span class="pull-right corner">0</span></div>
						</div>
					</div>
					<div class="col-lg-4 col-md-3 col-sm-3">
						<div class="small-size">
							<div class="team-name"><img src="team-img/colt-logo.png" alt="">Indianapolis Colts</div>
							<div class="score">1</div>
						</div>
					</div>
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
		
		document.getElementById('timer').innerHTML =
		  30 + ":" + 00;
		startTimer();

		function startTimer() {
		  var presentTime = document.getElementById('timer').innerHTML;
		  var timeArray = presentTime.split(/[:]+/);
		  var m = timeArray[0];
		  var s = checkSecond((timeArray[1] - 1));
		  if(s==59){m=m-1}
		  //if(m<0){alert('timer completed')}
		  
		  document.getElementById('timer').innerHTML =
			m + ":" + s;
		  setTimeout(startTimer, 1000);
		}

		function checkSecond(sec) {
		  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
		  if (sec < 0) {sec = "59"};
		  return sec;
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