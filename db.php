<?php
$con=@mysql_connect("localhost","root","") or die ("server not connected");
$db=@mysql_select_db("underdog",$con) or die("database not connected");


/*$con=@mysql_connect("albertatechworkscom.ipagemysql.com","underdog","underdog!@#") or die ("server not connected");
$db=@mysql_select_db("underdog",$con) or die("database not connected");*/

?>