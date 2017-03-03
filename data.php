<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
include_once "./models/User.class.php";
include_once "./conf.php";

if($_SESSION['authen']== true){
	try {
		$db = new PDO( $dbInfo, $dbUser, $dbPassword );
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$user = new User($db);
		echo $user->getUserData();
		
	}catch ( Exception $e ) {
			echo $e;
	}
}
else{
	echo "not signed in";
}
?>