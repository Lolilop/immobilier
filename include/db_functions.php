<?php
	include 'db_credentials.php';
	function db_connect(){
		$db_conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if (!$db_conn) {
			echo "MySQL connect error: ". mysqli_connect_error(). " connect error # ". mysqli_connect_errno();
		}else{
			return $db_conn;
		}
	}
	function query($db_conn,$sql){
		return mysqli_query($db_conn,$sql);
	}
	function confirm_no_query_error($db_conn,$result){
		if (!$result) {
			echo "Error query: ". mysqli_error($db_conn). " query error number: ".mysqli_errno($db_conn);
			return false;
		}else{
			return true;
		}
	}
	function db_connect_close($db_conn){
		mysqli_close($db_conn);
	}
?>