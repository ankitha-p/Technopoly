<?php
session_unset();
session_start();
$_SESSION['usr']="";
$_SESSION['authen']=false;
error_reporting(E_ALL);
ini_set("display_errors",1);
include_once "./models/User.class.php";
include_once "./conf.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	try {
		$db = new PDO( $dbInfo, $dbUser, $dbPassword );
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$user = new User($db);
		if($user->authen($_POST['usrname'],$_POST['passwd'])){
			$_SESSION['authen']=true;
			$_SESSION['usr']=$_POST['usrname'];
			$_SESSION['uid']=$user->getUid();			
			header("Location: ./index.html");
		}
		else
		{	echo "error";
		}
	}catch ( Exception $e ) {
			echo $e;
	}
}
?>