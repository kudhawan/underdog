<div class="container copy-rights">
			<div class="col-lg-12">
				<div class="copy-text text-center small-d">Copyright &copy; 2017 <a href="#">Underdog</a> All rights reserved</div>
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
								<th>Underdog  Team</th>
								<th>Favorite Team</th>
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
								<td class="scoreVal"><?php echo $scoreresults[$i][0]['score']; ?></td>
								<!--<td><?php //echo $scoreresults[$i][0]['winstatus']; ?></td>-->
							  </tr>
                               <?php }}else{echo "Not participated /completed any games";}  ?>
                               <tr bgcolor="#E9E9E9"><td>&nbsp;</td><td colspan="3" style="float:right"><b>Total Points Gained:</b></td><td colspan="2"><span class="totalscoreVal" style="font-weight:bold; color:#C00"></span> </td></tr>
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