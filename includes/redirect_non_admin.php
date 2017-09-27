<?php 
	
require_once("authorization.php");
	
if(!isset($user_id) || !isset($role)){
	header("location: ".$pathAPP."public/login.php?noPermission");
	return;
}

?>