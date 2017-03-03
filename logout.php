<?php
	session_start();
	$_SESSION['usr']="";
	$_SESSION['uid']="";
	$_SESSION['authen']=false;
	header("Location: ./login.html");
?>