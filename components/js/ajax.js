<script type="text/javascript">
	$(document).ready(function(){
		var pieces = window.location.pathname.split('/');

		//REGISTER

		function register_check(){
			/**	
			 * 0 - correct
			 * 1 - email exists
			 * 2 - different passwords
			 * 3 - login exists
			 * 4 - invalid email
			 */

			//register different passwords
			var password1 = $('[name = password1F]').val();
			var password2 = $('[name = password2F]').val();
			if(password1!=password2){
				$('[data-type = warning_password1]').text('<?=$lang->passwords_do_not_match?>');
				$('[data-type = warning_password2]').text('<?=$lang->passwords_do_not_match?>');
				warning_input_fadeIn('[name = password1F]', '[data-type = warning_password1]', '[name = password2F]', '[data-type = warning_password2]');
			}else{
				$('[data-type = warning_password1]').text("");
				$('[data-type = warning_password2]').text("");
				warning_input_fadeOut('[name = password1F]', '[data-type = warning_password1]', '[name = password2F]', '[data-type = warning_password2]');
			}

			//register existing login
			var login = $('[name = loginF]').val();
			$.ajax({
				url: '/api/register_check/?get=login&login='+login,
				success: function(data){
					if(data==1){
						$('[data-type = warning_login]').text('<?=$lang->email_already_exist?>');
						warning_input_fadeIn('[name = loginF]', '[data-type = warning_login]');
					}else if(data==3){
						$('[data-type = warning_login]').text('<?=$lang->user_already_exist?>');
						warning_input_fadeIn('[name = loginF]', '[data-type = warning_login]');
					}else if(data==4){
						$('[data-type = warning_login]').text('<?=$lang->invalid_email?>');
						warning_input_fadeIn('[name = loginF]', '[data-type = warning_login]');
					}else{
						$('[data-type = warning_login]').text("");
						warning_input_fadeOut('[name = loginF]', '[data-type = warning_login]');
					}
				}
			});

			//register existing email
			var email = $('[name = emailF]').val();
			$.ajax({
				url: '/api/register_check/?get=email&email='+email,
				success: function(data){
					if(data==1){
						$('[data-type = warning_email]').text('<?=$lang->email_already_exist?>');
						warning_input_fadeIn('[name = emailF]', '[data-type = warning_email]');
					}else if(data==3){
						$('[data-type = warning_email]').text('<?=$lang->user_already_exist?>');
						warning_input_fadeIn('[name = emailF]', '[data-type = warning_email]');
					}else if(data==4){
						$('[data-type = warning_email]').text('<?=$lang->invalid_email?>');
						warning_input_fadeIn('[name = emailF]', '[data-type = warning_email]');
					}else{
						$('[data-type = warning_email]').text("");
						warning_input_fadeOut('[name = emailF]', '[data-type = warning_email]');
					}
					
				}
			});
		}

		var warning_fio 		= $('[data-type = warning_full_name]').html();
		var warning_login 		= $('[data-type = warning_login]').html();
		var warning_email 		= $('[data-type = warning_email]').html();
		var warning_password1 	= $('[data-type = warning_password1]').html();
		var warning_password2 	= $('[data-type = warning_password2]').html();
		
		if(warning_fio!=""){
			warning_input_fadeIn('[name = fioF]', '[data-type = warning_full_name]');
		}
		if(warning_login!=""){
			warning_input_fadeIn('[name = loginF]', '[data-type = warning_login]');
		}
		if(warning_email!=""){
			warning_input_fadeIn('[name = emailF]', '[data-type = warning_email]');
		}
		if(warning_password1!=""){
			warning_input_fadeIn('[name = password1F]', '[data-type = warning_password1]');
		}
		if(warning_password2!=""){
			warning_input_fadeIn('[name = password2F]', '[data-type = warning_password2]');
		}

		//INPUT WARNINGS
		function warning_input_fadeIn(form1, warning1, form2="", warning2=""){
			$(form1).addClass('inputWrong');
			$(form2).addClass('inputWrong');
			$(warning1).css('display','block');
			$(warning1).css('height','1.5em');
			$(warning2).css('display','block');
			$(warning2).css('height','1.5em');
		}

		function warning_input_fadeOut(form1, warning1, form2="", warning2=""){
			
			
			$(warning1).css('height','0px');
			setTimeout(function(){
				$(warning1).css('display','none');
				$(form1).removeClass('inputWrong');
			}, 200);

			$(warning2).css('height','0px');
			setTimeout(function(){
				$(warning2).css('display','none');
				$(form2).removeClass('inputWrong');
			}, 200);
		}
		
		if(pieces[1]=='logup'){
			register_check();

			$("body").on("change",".logupInput", function(){
				register_check();
			});
		}

		//Check promo code

		//with change handler
		$('.promoCodeInput').change(function(){
			var promoCode = $('.promoCodeInput').val();
			$.ajax({
				url: '/scripts/checkPromoCode.php?promoCode='+promoCode,
				success: function(data){
					if(data=="1"){
						$('.validePromoCode').css("display", "block");
						$('.inValidePromoCode').css("display", "none");
						$('.priceWithPromo').css("display", "block");
					}else{
						$('.validePromoCode').css("display", "none");
						$('.inValidePromoCode').css("display", "block");
						$('.priceWithPromo').css("display", "none");
					}
				}
			});
		});


		$('.sizesChange').change(function(){
			var href = $('.sizesChange').val();
			location.href = href;
		});
	

		$(".brovse").click(function(){
			$("input[type='file'").trigger('click');
		});

		$(".inputFile").change(function(){
			var input = document.getElementById("inputFile");
			var fReader = new FileReader();
			fReader.readAsDataURL(input.files[0]);
			fReader.onloadend = function(event){
				var img = document.getElementById("brovse");
				img.src = event.target.result;
			}
		})

		/*PAGES LOAD*/
		// function includeTo(div, path){
		// 	divToLoad = $(div);
		// 	divToLoad.load(path+"/?ajax=1");
		// }

		// $('html').on('click', '.header .login', function(){
		// 	includeTo('.loadLoginLogup', '/login');
		// });

	});
</script>