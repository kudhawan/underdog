<?php
session_start();
include('db.php');
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
?>

 <script src="js/jquery.min.js"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId:'823064124542994',
cookie:true,
status:true,
xfbml:true
});

function FBInvite(){
	var league_id=$('#league_name').val();
	var token="<?php echo random_string(50); ?>";
	if(league_id=='')
	{
		$('#league_name').css("border-color","red");
	}
	else
	{
		 $('#league_name').css("border-color","");
	  FB.ui({
	   method: 'send',
	   link: 'http://www.albertatechworks.com/projects/underdogv1/register.php?token='+token+'&league_id='+league_id,
	  },function(response) {
		  
	  $('.succ_msg').html('');
		   $('.alert_msg').html('');
	   if (response) {
		   $('.succ_msg').html('Successfully Invited');
	   } else {
		   $('.alert_msg').html('Failed To Invite');
	   }
	  });
   }
 }
</script>

         
         
         
         
<script src="https://apis.google.com/js/client.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>
  function auth() {
    var config = {
      'client_id': ' 747566786219-ke2cdnvc4n9tobo1borje1b5q87bvhjo.apps.googleusercontent.com ',
      'scope': 'https://www.google.com/m8/feeds'
    };
    gapi.auth.authorize(config, function() {
      fetch(gapi.auth.getToken());
    });
  }

  function fetch(token) {
    $.ajax({
    url: "https://www.google.com/m8/feeds/contacts/default/full?access_token=" + token.access_token + "&alt=json",
    dataType: "jsonp",
    success:function(data) {
              console.log(JSON.stringify(data));
    }
});
}
</script>

 <script type="text/javascript">

	function getUsers(){
		var limit=25;
	    	$.ajax({
	        	url: 'https://api.twitter.com/1/followers/ids.json',
		   	data: {screen_name: 'Arunavurukonda/1630333832', cursor:-1},
	        	dataType: 'jsonp',
	        	success: function(data) { 
					if (data.length > 0 ){
						try {
							
							for(i=0; i<limit; i++){ //*********************************
							  $.ajax({
								
								url: 'https://api.twitter.com/1/users/lookup.json',
								data: {user_id: data.ids[i],include_entities:1},
								dataType: 'jsonp',
								success: function(userData) { //*********
									if (userData.length > 0 ){ 
										try {
											//alert(userData[0].screen_name);
											$('#followersList').append('<iframe allowtransparency="true" frameborder="0" scrolling="no" '+'src="//platform.twitter.com/widgets/follow_button.html?screen_name=' +userData[0].screen_name + '"' + 'style="width:300px; height:20px;" class="followerButton"></iframe></br>');
										} 
										catch (e) {
											alert(e);
										}
									}
	
								} // End success 2 ***********************
							  }); // End Ajax 2
							} // End for loop ******************************************
							
						} ///end try {
						 catch (e) {
							alert(e);
						}	
					} //if (userData.length > 0 ){
	             } // End success 1-----------------------------------------------------
				  
	    }); // End Ajax 1

	} // End of the getUsers function
		
		
		$(document).ready(function() {
 	 		getUsers();
		});

	</script>
    
	<style type="text/css">
	
		div#followersList {
			margin: 100px auto 0;
			width: 400px;
		}
		
		iframe {
			display: block;
		}
	
	</style>
    
    <div id="followersList"></div>
<button onclick="auth();">GET CONTACTS FEED</button>
         

 <p align="center" id="alert_msg_invite" class="alert_msg"></p>
            <p id="succ_msg_invite" class="succ_msg" align="center" style="color:#3C0;"></p>
            <div id="fb-root"></div>
<div id="facebook_invite"></div>

<a href="#" onclick="FBInvite()">Invite Facebook Friends</a>
 <select name="league_name" id="league_name">
                    <option value="">Select League</option>
                    <?php
					$leagues=@mysql_query("select * from league where status=1");
					while($data=@mysql_fetch_array($leagues)){
					?>
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['league_name']; ?></option>
                    <?php
					}
					?>
                    </select>
