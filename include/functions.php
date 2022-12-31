<?php
	function url_for($url){
		global $root_url;
		return $root_url . '/'.$url;
	}
	function redirect_to($url){
		header("Location: ".url_for($url));
	}
	function is_post_request(){
		return $_SERVER['REQUEST_METHOD'] == "POST";
	}
	function h($string){
		return htmlspecialchars($string);
	}
	function e_s($string){
		global $db_conn;
		return mysqli_real_escape_string($db_conn,$string);
	}
	function sanitize_create_query($columns,$fields){
		$sanitized_fields= [];
		foreach ($columns as $column) {
			$sanitized_fields[] = e_s($fields[$column]);
		}
		$sanitized_query = implode("','", $sanitized_fields);
		return $sanitized_query;
	}
?>