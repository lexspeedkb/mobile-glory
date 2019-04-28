<style>
	*{
		font-family:arial;
	}
	body{
		background:url('/templates/assets/images/mac.jpg');
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-size:cover;
	}
</style>

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
					<h2>Your project</h2>
					<h3>Your project is about...</h3>
					<p align="justify">
						This is my project  lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Quam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
					</p>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6">
					<h2 align="center">
						<?=$lang->index_sign_up_to_get_ready ?>
					</h2>
					<br>
					<!--<a class="button" href="/login"><?=$lang->entrance ?></a>-->
					<!--<br>-->
					<!--<br>-->
					<!--<a class="button" href="/logup"><?=$lang->registration ?></a>-->
					<!--<p align="center">-->
					<!--	<input type="text" name="login" placeholder="login or E-mail">-->
					<!--</p>-->
					<!--<p align="center">-->
					<!--	<input type="password" name="password" placeholder="Password">-->
					<!--</p>-->
					<?=$data['warning'];?>
					<form action="/login" method="POST">
						<br>
						<p align="center">
							<input type="text" name="login" class="shadowBlueIn" placeholder="<?= $lang->login ?> *" value="<?=$_POST['login']?>">
						</p>
						<p align="center">
							<input type="password" name="password" placeholder="<?= $lang->password ?> *" value="<?=$_POST['password']?>">
							<p align="center" class="inputWarning">asd</p>
						</p>
						<center>
							<div class="rememberMe">
								<input id="anothers_pc" name="anothers_pc" type="checkbox">
								<label for="anothers_pc"><?= $lang->remember_me ?></label>
							</div>
						</center>
						<center>
							<input type="submit" class="button" value="<?= $lang->come_in ?>">
						</center>
						<a href="/recoveryPassword"><?= $lang->forget_password ?></a>
						
						<input type="hidden" name="form" value="1">
					</form>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
	</div>
</div>
<!-- 
<script type="text/javascript">
	$(document).ready(function(){
		// Открываем окно входа
		$("#Log_in").click(function(){
			$("#popup_login").show();
		});
		// Закрываем окно входа
		$(".js_popupClose").click(function(){
			$("#popup_login").hide();
		})
	});
</script>

<div id="popup_login" class="popup">
	<div class="block_login">
		<div id="popup_close_img" class="js_popupClose"></div>
		<div class="right">
			<div class="title">
				LogIn Form
			</div>
			<input type="text" size="40" placeholder="Email">
			<input type="password" size="40" placeholder="Password">
			<div class="popup_forgout">Forgot your password?</div>
			<center><button id="popup_close">Log In</button></center>
		</div>	
	</div>
</div>
<header>
	<div id="logo">
		My
		<div class="title">Real Motivation</div>
	</div>
	<div id="Log_in">
		<div class="text">
			Log In
		</div>
	</div>
</header>
<main>
	<div id="main_text">
		Start project of Your dream now!
		</br>
		Share it with others.
	</div>
	<div id="sign_up">
		<div class="gg"></div>
		<div style="position: absolute; z-index: 10;"> 
			<div class="left">
				<h1>Your Project</h1>
				<h2>Your project is about...</h2>
				<p>Google Cloud Text-to-Speech enables developers to synthesize natural-sounding speech with 32 voices, available in multiple languages and variants. It applies DeepMind groundbreaking research in WaveNet and Google powerful neural networks to deliver the highest fidelity possible. As an easy-to-use API, you can create lifelike interactions with your users, across many applications and devices. As an easy-to-use API, you can create lifelike interactions with your users, across many applications and devices. As an easy-to-use API, you can create lifelike interactions with your users, across many applications and devices. As an easy-to-use API, you can create lifelike interactions with your users, across many applications and devices.</p>
			</div>
			<div class="right">
				<div class="title">
					Sign up
					</br>
					to get ready
				</div>
				<input type="text" size="40" placeholder="Email">
				<input type="password" size="40" placeholder="Password">
				<input type="password" size="40" placeholder="Password">
				<center><button>Sign in</button></center>
			</div>
		</div>
	</div>
</main> -->