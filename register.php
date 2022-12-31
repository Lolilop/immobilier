<?php
	require_once 'include/config.php';
	$page_title = 'Registration';
	include 'include/shared/head.php';
	include 'include/shared/header.php';
?>
<?php
	if (is_post_request()) {
		$errors = [];
		$new_profile = [];
		$new_profile['first_name'] = $_POST['signup_firstname'] ?? "";
		$new_profile['last_name'] = $_POST['signup_lastname'] ?? "";
		$new_profile['company'] = $_POST['signup_company'] ?? "";
		$new_profile['email'] = $_POST['signup_email'] ?? "";
		$new_profile['password'] = $_POST['signup_password'] ?? "";
		$new_profile['password'] = password_hash($new_profile['password'], PASSWORD_BCRYPT);
		$new_profile['phone_number'] =  $_POST['phone_area_code'].$_POST['phone_number'];
		$new_profile['subject'] = $_POST['subject'] ?? "";
		$new_profile['existing_customer'] = $_POST['existing_customer'] ?? "";
		if ($_POST['signup_password']==$_POST['confirm_password']) {
			if (!check_user_exists($db_conn,$new_profile)) {
				if (create_user($db_conn,$new_profile)) {
					$success_message = "L'utilisateur a été créé avec succès";
				}else{
					$errors[] = "Echec sur la création de l'utilisateur. Reéssayez une nouvelle fois ";
				}
			}else{
				$errors[] = "Cet utilisateur existe déjà sur notre système";
			}
		}else{
			$errors[] = "Erreur dans la confirmation du mot de passe";
		}
		
		
	}
?>
<div class="flex justify-between align-stretch page-columns">
	<aside class="navigation-menu-column">
		<?php include SHARED_PATH .'/navigation_menu.php'; ?>
	</aside>
	<main class="main-column">
		<div class="registration-form-wrapper">
			<h1 class="text-center form-title">Registration Form</h1>
			<div id="error-message">
				<?php
					if (isset($errors)) {
						foreach ($errors as $error) {
							echo $error."<br>";
						}
					}
				?>
			</div>
			<div id="success-message">
				<?php
					if (isset($success_message)) {
						echo $success_message;
					}
				?>
			</div>
			<form action="<?php echo url_for('register.php'); ?>" method="POST" id="registration-form">
				<div class="flex align-center justify-between input-row">
					<div class="input-row-column">
						<div class="input-row-column-label">Name</div>
					</div>
					<div class="flex justify-between input-row-column">
						<div class="w-45 input-row-inner-column">
							<input type="text" name="signup_firstname" id="signup_firstname" placeholder="First Name">
							<div class="error-message error-firstname-msg"></div>
						</div>
						<div class="w-45 input-row-inner-column">
							<input type="text" name="signup_lastname" id="signup_lastname" placeholder="Last Name">
							<div class="error-message error-lastname-msg"></div>
						</div>
					</div>
				</div>
				<div class="flex align-center justify-between input-row">
					<div class="input-row-column">
						<div class="input-row-column-label">Company</div>
					</div>
					<div class="input-row-column">
						<input type="text" name="signup_company" id="signup_company" placeholder="Company">
						<div class="error-message error-company-msg"></div>
					</div>
				</div>
				<div class="flex align-center justify-between input-row">
					<div class="input-row-column">
						<div class="input-row-column-label">Email</div>
					</div>
					<div class="input-row-column">
						<input type="email" name="signup_email" id="signup_email" placeholder="Email">
						<div class="error-message error-email-msg"></div>
					</div>
				</div>
				<div class="flex align-center justify-between input-row">
					<div class="input-row-column">
						<div class="input-row-column-label">Password</div>
					</div>
					<div class="input-row-column">
						<input type="password" name="signup_password" id="signup_password" placeholder="Password">
						<div class="error-message error-password-msg"></div>
					</div>
				</div>
				<div class="flex align-center justify-between input-row">
					<div class="input-row-column">
						<div class="input-row-column-label">Confirm Password</div>
					</div>
					<div class="input-row-column">
						<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
						<div class="error-message error-confirm-password-msg"></div>
					</div>
				</div>
				<div class="flex align-center justify-between input-row">
					<div class="input-row-column">
						<div class="input-row-column-label">Phone</div>
					</div>
					<div class="flex justify-between input-row-column">
						<div class="w-30 input-row-inner-column">
							<input type="text" name="phone_area_code" id="phone_area_code" placeholder="Area Code">
						</div>
						<div class="w-60 input-row-inner-column">
							<input type="text" name="phone_number" id="phone_number" placeholder="Phone Number">
							<div class="error-message error-phone-msg"></div>
						</div>
					</div>
				</div>
				<div class="flex align-center justify-between input-row">
					<div class="input-row-column">
						<div class="input-row-column-label">Subject</div>
					</div>
					<div class="input-row-column">
						<select id="subject" name="subject">
							<option>choose option</option>
						</select>
					</div>
				</div>

				<label>Are you an existing customer?</label>
				<div class="flex align-center justify-start input-radio-row">
					<div class="flex justify-start align-center input-group">
						<input type="radio" name="existing_customer" id="existing_customer_yes" value="1" checked>
						<label for="existing_customer_yes" style="font-weight: 300;">Yes</label>
					</div>
					<div class="flex justify-start align-center input-group">
						<input type="radio" name="existing_customer" id="existing_customer_no" value="0">
						<label for="existing_customer_no" style="font-weight: 300;">No</label>
					</div>
				</div>
				<div class="flex align-center justify-between input-row">
					<button type="submit" class="register-button">Register</button>
					<a href="<?php echo url_for('login.php'); ?>" class="cancel-button">Return</a>
				</div>
				
			</form>
		</div>
	</main>
</div>
	
<?php
	include 'include/shared/footer.php';
?>