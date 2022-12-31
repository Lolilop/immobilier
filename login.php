<?php
	require_once 'include/config.php';
	$page_title = 'Connexion';
	include SHARED_PATH . '/head.php';
	include SHARED_PATH . '/header.php';
?>
<?php
	if (is_post_request()) {
		$login_creds = [];
		$login_creds['email'] = $_POST['login_email'] ?? "";
		$login_creds['password'] = $_POST['login_password'] ?? "";
		if (check_user_exists($db_conn,$login_creds)) {
			if (check_user_password($db_conn,$login_creds)) {
				$user = select_user_by_email($db_conn,$login_creds['email']);
				/**** Mettre l'utilisateur 3 heure en ligne ****/
				setcookie('user_id',$user['id'],time()+10800);
			}
		}
	}
?>
<div class="flex justify-between align-stretch page-columns">
	<aside class="navigation-menu-column">
		<?php include SHARED_PATH .'/navigation_menu.php'; ?>
	</aside>

	<main class="main-column">
		<div class="flex justify-between align-center login-form-columns"> 
			<div class="login-form-column">
				<div class="login100-pic js-tilt login-form-img"  data-tilt>
					<img src="<?php echo url_for('assets/img/login-form-img.png');?>" data-tilt>
				</div>
			</div>
			<div class="login-form-column">
				<h1 class="text-center form-title">Member Login</h1>
				<form action="login.php" method="POST" id="login-form">
					<div class="input-wrapper">
						<input type="email" name="login_email" class="input-padding-left" id="login_email" placeholder="Email">
						<div class="input-icon"></div>
					</div>
					<div class="input-wrapper">
						<input type="password" name="login_password" class="input-padding-left" id="login_password" placeholder="Password">
						<div class="input-icon"></div>
					</div>
					
					<button type="submit" class="login-button">login</button>
				</form>
				<p class="text-center form-text">Forgot <a href="<?php echo url_for('forgot_password.php'); ?>" class="form-link">Username / Password?</a></p>

				<p class="text-center form-text"><a href="<?php echo url_for('register.php'); ?>" class="form-link">Create your Account</a></p>
			</div>
		</div>
	</main>
</div>
<?php
	include SHARED_PATH .'/footer.php';
?>