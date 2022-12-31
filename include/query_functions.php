<?php
	function check_user_exists($db_conn,$user_creds){
		$sql = "SELECT * FROM users WHERE email='".e_s($user_creds['email'])."';";
		$result = query($db_conn,$sql);
		confirm_no_query_error($db_conn,$result);
		if (mysqli_num_rows($result)>0) {
			mysqli_free_result($result);
			return true;
		}else{
			mysqli_free_result($result);
			return false;
		}
	}

	function check_user_password($db_conn,$user_creds){
		$sql = "SELECT * FROM users WHERE email='".e_s($user_creds['email'])."';";
		$result = query($db_conn,$sql);
		confirm_no_query_error($db_conn,$result);
		$user = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		if (password_verify(e_s($user_creds['password']), $user['password'])) {
			return true;
		}else{
			return false;
		}
	}
	function select_user_by_email($db_conn,$user_email){
		$sql = "SELECT * FROM users WHERE email='".$user_email."';";
		$result = query($db_conn,$sql);
		if (confirm_no_query_error($db_conn,$result)) {
			$user = mysqli_fetch_assoc($result);
			mysqli_free_result($result);
			return $user;
		}
	}
	function create_user($db_conn,$new_user){
		$columns = ['first_name','last_name','company','email','password','phone_number','subject','existing_customer'];
		$sanitized_query = sanitize_create_query($columns,$new_user);
		$sql = "INSERT INTO users (".implode(',', $columns).") VALUES ('".$sanitized_query."');";
		$result = query($db_conn,$sql);
		if (confirm_no_query_error($db_conn,$result)) {
			return true;
		}else{
			return false;
		}
	}

?>