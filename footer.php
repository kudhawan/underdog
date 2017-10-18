		<div class="container">
			<div class="col-lg-4 col-md-4">
				<div class="contact-details">
					<div class="footer-logo"><a href="#"><img src="images/logo-tagline-red.png" alt=""></a></div>
					<!--<div class="address-detail">
						<p><span class="fa fa-map-marker"></span> 10187 104 St NW, Edmonton, AB T5J 0Z9</p>
						<p><span class="fa fa-mobile"></span> +1 379-226-1326</p>
						<p><span class="fa fa-envelope-o"></span> <a href="mailto:info@underdog.us" target="_blank">info@underdog.us</a></p>
					</div>-->
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="quick-links clearfix">
					<h3>QUICK LINKS</h3>
					<ul class="pull-left">
						<li><span class="fa fa-dot-circle-o"></span><a href="#">About Underdog</a></i>
						<li><span class="fa fa-dot-circle-o"></span><a href="#">NFL Teams</a></i>
						<li><span class="fa fa-dot-circle-o"></span><a href="#">Picks</a></i>
						<li><span class="fa fa-dot-circle-o"></span><a href="#">News</a></i>
					</ul>
					<ul class="pull-right">
						<!--<li><span class="fa fa-dot-circle-o"></span><a href="#">Payments</a></i>-->
						<li><span class="fa fa-dot-circle-o"></span><a href="#">Privacy Policy</a></i>
						<li><span class="fa fa-dot-circle-o"></span><a href="#">Terms &amp; Conditions</a></i>
						<li><span class="fa fa-dot-circle-o"></span><a href="#">Blog</a></i>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="newsletters">
					<h3>SIGN UP FOR LEAGUE ALERTS</h3>
					<p>Select topics and stay current with our latest news.</p>
					<div class="input-group">
					  <input type="text" class="form-control footer-inputs-customs" placeholder="Your email address">
					  <span class="input-group-btn">
						<button class="btn btn-secondary customs-btn" type="button">SUBMIT</button>
					  </span>
					</div>
				</div>
			</div>
		</div>
		<div class="container copy-rights">
			<div class="col-lg-4 col-md-4">
				<div class="copy-text text-left small-d">Copyright &copy; 2017 <a href="#">Underdog</a> All rights reserved</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="copy-text text-center">
					<ul class="social-links">
						<li><a href="#" target="_blank"><span class="fa fa-facebook"></span></a> </li>
						<li><a href="#" target="_blank"><span class="fa fa-twitter"></span></a></li>
						<li><a href="#" target="_blank"><span class="fa fa-pinterest-p"></span></a></li>
						<li><a href="#" target="_blank"><span class="fa fa-instagram"></span></a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="copy-text text-right small-d">designed and developed at <a target="_blank" href="http://www.albertatechworks.com">Alberta TechWorks</a></div>
			</div>
		</div>
        
        
        
        <div class="modal fade" id="viewScoreDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<a class="close" data-dismiss="modal" aria-label="Close" id="close"><span class="fa fa-window-close-o" aria-hidden="true"></span></a>
		  </div>
		  <div class="modal-body">
          <table class="table borderless lobby table-hover" id="scoreTable">
							<thead>
							  <tr>
								<th>Underdog Team</th>
								<th>Favorite Team</th>
                                <th>League Name</th>
								<th>Points</th>
								<!--<th>Win</th>-->
								<th></th>
							  </tr>
							</thead>
							<tbody>
							   <?php
							   if($resultsCount>0){
							for($i=0;$i<$resultsCount;$i++){
								
								$betTeam=$scoreresults[$i][0]['betTeam'];
								if($betTeam=='home')
								{
									$opponentTeam=$scoreresults[$i][0]['away_team'];
									$participatedTeam=$scoreresults[$i][0]['home_team'];
								}
								else if($betTeam=='away')
								{
									$participatedTeam=$scoreresults[$i][0]['away_team'];
									$opponentTeam=$scoreresults[$i][0]['home_team'];
								}
							?>
                              
                              <tr>
								<td><?php echo $participatedTeam; ?></td>
								<td><?php echo $opponentTeam; ?></td>
                                <td><?php echo $scoreresults[$i][0]['leaguename'];?></td>
								<td class="scoreVal"><?php echo $scoreresults[$i][0]['score']; ?></td>
								
							  </tr>
                               <?php }}else{echo "Not participated /completed any games";}  ?>
                               <tr bgcolor="#E9E9E9"><td>&nbsp;</td><td colspan="4" style="float:right"><b>Total Points Gained:</b></td><td colspan="2"><span class="totalscoreVal" style="font-weight:bold; color:#C00"></span> </td></tr>
							</tbody>
						  </table>
		  </div>
		  
		</div>
	  </div>
	</div>
    <script src="js/jquery.min.js"></script>
    <script>
	$(function() {
	 var sum = 0;
		// iterate through each td based on class and add the values
		$(".scoreVal").each(function() {
		
			var value = $(this).text();
			// add only if the value is number
			if(!isNaN(value) && value.length != 0) {
				sum += parseFloat(value);
			}
		});
	 $('.totalscoreVal').text(sum);
	 
	 });
	 </script>