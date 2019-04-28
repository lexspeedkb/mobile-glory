<div class="wrapper-index">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
			<div class="col-12 col-sm-12 col-md-10 col-lg-10 textWhite">
				<h2 style="margin-top: 40px;">
					<?=$lang->index_start_project_of_dream ?>
				</h2>
			</div>
			<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>

			<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
			<div class="col-12 col-sm-12 col-md-10 col-lg-10 textWhite">
				<h2>
					<?=$lang->index_share_it_with_others ?>
				</h2>
			</div>
			<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
			

			<div class="col-12 col-sm-12 col-md-12 col-lg-1"></div>
			<div class="col-12 col-sm-1 col-md-1 col-lg-6"></div>
			<div class="col-12 col-sm-10 col-md-10 col-lg-4 indexSignUpCard bluredBgContainer textWhite">
				<!--<div class="back">&#8592;</div>-->
					
				<div class="row blurredContent">
					<div class="col-12 col-sm-12 col-md-6 col-lg-6">
						<h2><?= $lang->index_card_title ?></h2>
						<h3><?= $lang->index_card_subtitle ?></h3>
						<div class="card-text">
							<p align="justify">
								<?= $lang->index_card_text ?>
							</p>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-6">
						<h2 align="center" id="success-title">
							<?=$lang->index_sign_up_to_get_ready ?>
						</h2>
						<br>
						<?=$data['warning'];?>
						<div id="index-form">
							<div id="index-form-reg">
								<p align="center" class="inp-field">
									<input type="text" id="reg-login" placeholder="<?= $lang->login ?>*" value="<?=$_POST['login']?>">
									<p align="center" class="inputWarning" id="warning-login"></p>
								</p>
								<p align="center" class="inp-field">
									<input type="email" id="reg-email" placeholder="E-mail*" value="<?=$_POST['login']?>">
									<p align="center" class="inputWarning" id="warning-email"></p>
								</p>
								<p align="center" class="inp-field">
									<input type="password" id="reg-password1" placeholder="<?= $lang->password ?>*">
									<p align="center" class="inputWarning" id="warning-password1"></p>
								</p>
								<p align="center" class="inp-field">
									<input type="password" id="reg-password2" placeholder="<?= $lang->password_repeat ?>*">
									<p align="center" class="inputWarning" id="warning-password2"></p>
								</p>
								<center>
									<div class="rememberMe">
										<!-- <input id="anothers_pc" name="anothers_pc" type="checkbox"> -->
										<!-- <label for="anothers_pc"><?= $lang->remember_me ?></label> -->
									</div>
								</center>
								<center>
									<input type="submit" class="button" id="reg-submit" value="<?= $lang->registrate ?>">
									<input type="submit" class="button" id="openLoginForm" value="<?= $lang->entrance ?>">
								</center>								
							</div>

							<div id="index-form-log" style="display: none">
								<br>
								<p align="center" class="inp-field">
									<input type="text" id="log-login" class="shadowBlueIn" placeholder="<?= $lang->login ?>*">
									<p align="center" class="inputWarning" id="warning-log-login"></p>
								</p>
								<p align="center" class="inp-field">
									<input type="password" id="log-password" placeholder="<?= $lang->password ?>*">
									<p align="center" class="inputWarning" id="warning-log-password"></p>
								</p>
								<center>
									<div class="rememberMe">
										<!-- <input id="anothers_pc" type="checkbox"> -->
										<!-- <label for="anothers_pc"><?= $lang->remember_me ?></label> -->
									</div>
								</center>
								<center>
									<input type="submit" class="button" id="log-submit" value="<?= $lang->come_in ?>">
									<input type="submit" class="button" id="openRegForm" value="<?= $lang->registration ?>">
								</center>
							</div>

						</div>
							<!-- <a href="/recoveryPassword"><?= $lang->forget_password ?></a> -->
							
							<input type="hidden" name="form" value="1">
						</form>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('body').on('click', '#openLoginForm', function() {
			$('#index-form-log').css('display', 'block');
			$('#index-form-reg').css('display', 'none');
		});
		$('body').on('click', '#openRegForm', function() {
			$('#index-form-log').css('display', 'none');
			$('#index-form-reg').css('display', 'block');
		});

		$('body').on('click', '#reg-submit', function() {
			var inp_login = $('#reg-login').val();
			var inp_email = $('#reg-email').val();
			var inp_pass1 = $('#reg-password1').val();
			var inp_pass2 = $('#reg-password2').val();
			
			// var anothers_pc = $('#anothers_pc').val();

			function setError(field_id, text_error) {
				$('#reg-'+field_id).addClass('inputWrong');
				$('#warning-'+field_id).css('display', 'block');
				$('#warning-'+field_id).text(text_error)
			}

			function resetError() {
				$('.inputWrong').removeClass('inputWrong');
				$('.inputWarning').css('display', 'none');
				$('.inputWarning').text('');
			}

			resetError();

			$.ajax({
				url: '/api/register_check/',
				data: {login: inp_login, email: inp_email, pass1: inp_pass1, pass2: inp_pass2},
				success: function(data){
					if (inp_pass1 != ""){
						if (inp_pass2 != ""){
							if (inp_pass1 == inp_pass2){
								if(data==1){
									setError('email', 'E-mail занят');
								}else if(data==2){
									setError('password2', 'Пароли не совпадают');
								}else if(data==3){
									setError('login', 'Логин занят');
								}else if(data==4){
									setError('email', 'Некорректный E-mail');
								}else if(data==5){
									setError('login', 'Введите логин');
								}else if(data==6){
									setError('email', 'Введите E-mail');
								}else if(data==7){
									setError('password1', 'Введите пароль!');
								}else if(data==8){
									setError('password2', 'Повторите пароль!');
								}else if(data==0){
									$.ajax({
										url: '/api/userToDB',
										data: {login: inp_login, email: inp_email, pass1: inp_pass1, pass2: inp_pass2},
										success: function(data){
											$('#success-title').text('Превосходно! Теперь войдите');
											$('#index-form-log').css('display', 'block');
											$('#index-form-reg').css('display', 'none');
										}
									})
								}
							}else{
								setError('password2', 'Пароли не совпадают');
							}
						}else{
							setError('password2', 'Повторите пароль!');
						}
					}else{
						setError('password1', 'Введите пароль!');
					}
				}
			});
			
		});

		$('body').on('click', '#log-submit', function() {
			var inp_login = $('#log-login').val();
			var inp_pass  = $('#log-password').val();
			
			// var inp_anothers_pc = $('#anothers_pc').val();

			function setError(field_id, text_error) {
				$('#log-'+field_id).addClass('inputWrong');
				$('#warning-log-'+field_id).css('display', 'block');
				$('#warning-log-'+field_id).text(text_error)
			}

			function resetError() {
				$('.inputWrong').removeClass('inputWrong');
				$('.inputWarning').css('display', 'none');
				$('.inputWarning').text('');
			}

			resetError();

			$.ajax({
				url: '/api/entrance_check/',
				data: {login: inp_login, pass: inp_pass},
				success: function(data){
					if (inp_login != ""){
						if (inp_pass != ""){
							if (data==1) {
								setError('login', 'Пользователь неактивен!');
							} else if (data==2) {
								setError('login', 'Пользователь не найден!');
							} else if (data==3) {
								setError('password', 'Неверный пароль!');
							} else if (data==0) {
								window.location.replace('/api/login/?login='+inp_login+'&pass='+inp_pass);
							}
						}else{
							setError('password', 'Введите пароль!');
						}
					}else{
						setError('login', 'Введите пароль!');
					}
				}
			});
			
		});
	});
</script>