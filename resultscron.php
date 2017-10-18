<?php
include('db.php');

$output = shell_exec('curl -X GET https://jsonodds.com/api/results/nfl -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
$resultsArray=json_decode($output);
$date=date("Y-m-d H:i:s");
foreach ($resultsArray as $results) {
	
	 $home_score=$results->HomeScore;
	 $away_score=$results->AwayScore;
	 $final=$results->Final;
	 $final_type=$results->FinalType;
	 $odd_type=$results->OddType;
	 $match_id=$results->ID;
	 $EventID=$results->EventID;
	 
	 $check=@mysql_query("select * from results where match_id='$match_id'");
	 $dt=@mysql_fetch_array($check);
	 $num=@mysql_num_rows($check);
	 if($num==0)
	 {
	 	 $ins=@mysql_query("insert into results(`id`,`match_id`,`event_id`,`home_score`,`away_score`,`final`,`final_type`,`odd_type`,`added_date`) values('','$match_id','$EventID','$home_score','$away_score','$final','$final_type','$odd_type','$date')");
      // echo "Inserted ".mysql_affected_rows()." rows";
     }
	 else if($num>0)
	 {
		$final_type_db=$dt['final_type'];
		if($final_type_db!='Finished')
		{
			$ins=@mysql_query("update results set event_id='$EventID', home_score='$home_score' , away_score='$away_score', final='$final', final_type='$final_type',odd_type='$odd_type' where match_id='$match_id' ");
			//echo "Updated ".mysql_affected_rows()." rows";
			
		}
		 
	 }
	
	//$qry=@mysql_query($ins);
   
    // ... Run query etc..
}


?>
