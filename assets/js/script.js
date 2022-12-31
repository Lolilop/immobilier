$(document).ready(function(){
	var registrationForm = $("#registration-form");
	var registerFormButton = $(".register-button");
	var successMessage = $("#success-message");
	var error = 0;
	registerFormButton.on('click',function(e){
		e.preventDefault();
		var errorsString = "";
		if (registrationForm.find('#signup_firstname').val()=="") {
			$(".error-firstname-msg").html('Le prénom ne peut pas être vide');
			error = 1;
		}else{
			$(".error-firstname-msg").html('');
		}
		if (registrationForm.find('#signup_lastname').val()=="") {
			$(".error-lastname-msg").html('Le nom ne peut pas être vide');
			error = 1;
		}else{
			$(".error-lastname-msg").html('');
		}
		if (registrationForm.find('#signup_company').val()=="") {
			$(".error-company-msg").html('Company ne peut pas être vide');
			error = 1;
		}else{
			$(".error-company-msg").html('');
		}
		if (registrationForm.find('#signup_email').val()=="") {
			$(".error-email-msg").html('L\'email ne peut pas être vide');
			error = 1;
		}else{
			$(".error-email-msg").html('');
		}
		var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
		if (!registrationForm.find('#signup_email').val().match(emailRegex)) {
			$(".error-email-msg").html('L\'email n\'est pas au format valide');
			error = 1;
		}else{
			$(".error-email-msg").html('');
		}
		var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_!@#\$%\^&\*])(?=.{8,})/
		var passwordValue = registrationForm.find('#signup_password').val();
		if (!passwordValue.match(passwordRegex)) {
			$(".error-password-msg").html('Le mot de passe doit avoir minimum 8 caractères, une lettre en majuscule, une lettre en minuscule, un chiffre, et un caractère spécial: _!@#$%^&*');
			error = 1;
		}else{
			$(".error-password-msg").html('');
		}
		if (registrationForm.find("#phone_area_code").val()=="" || registrationForm.find("#phone_number").val()=="") {
			$(".error-phone-msg").html('Le numéro de téléphone ne peut pas être vide');
			error = 1;
		}else{
			$(".error-phone-msg").html('');
		}
		if (error) {
			window.scrollTo(0,0);
		}else if(error==0){
			registrationForm.submit();
		}
	})
	$('.js-tilt').tilt({
			scale: 1.1
		})
	//////////////////////////navigation menu/////////////////////////
	var toggleMenuButton = $(".menu-sidebar-toggle-icon");
	var iconBar1 = $(".icon-bar-1");
	var iconBar2  = $(".icon-bar-2");
	var iconbar3 = $(".icon-bar-3");
	var navigationMenu = $(".navigation-menu-column");
	toggleMenuButton.on('click',function(){
		toggleMenuButton.toggleClass("toggle-menu-btn-position");
		iconBar1.toggleClass("rotate-icon-bar-1");
		navigationMenu.toggleClass("toggle-navigation-menu");
		iconBar2.toggle();
		iconbar3.toggleClass("rotate-icon-bar-3");
	})

	var subNavigationLink = $(".sub-navigation-link");
	subNavigationLink.on('click',function(){
		var subNavigationMenu = $(this).find('.sub-navigation-menu');
		var navigationLinkIcon = $(this).find('.fa-solid');
		$(this).toggleClass('sub-navigation-link-activated')
		subNavigationMenu.toggle();
		navigationLinkIcon.toggleClass('rotate-icon');
	})
})