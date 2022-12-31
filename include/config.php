<?php 
	define('PRIVATE_PATH', dirname(__FILE__));
	define('SHARED_PATH',PRIVATE_PATH.'/shared');
	$root_url = substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], 'french_investing')+16) ;
	include 'functions.php';
	include 'db_functions.php';
	include 'query_functions.php';
	$db_conn = db_connect();
	
	session_start();
?>