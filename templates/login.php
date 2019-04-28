<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
		<div class="col-12 col-sm-12 col-md-10 col-lg-10 textBlue">
			<h2 style="margin-top: 40px;">
				<?=$lang->index_start_project_of_dream ?>
			</h2>
		</div>
		<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>

		<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
		<div class="col-12 col-sm-12 col-md-10 col-lg-10 textBlue">
			<h2>
				<?=$lang->index_share_it_with_others ?>
			</h2>
		</div>
		<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
		

		<div class="col-12 col-sm-12 col-md-12 col-lg-1"></div>
		<div class="col-12 col-sm-1 col-md-1 col-lg-6"></div>
		<div class="col-12 col-sm-10 col-md-10 col-lg-4 indexSignUpCard gragientBlue textWhite shadowBlueOut">
			<div class="row">
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
					
					<?=$data['warning'];?>
					<form action="/login" method="POST">
						<br>
						<input type="text" name="login" class="shadowBlueIn" placeholder="<?= $lang->login ?> *" value="<?=$_POST['login']?>">
						<br>
						<br>
						<input type="password" name="password" class="shadowBlueIn" placeholder="<?= $lang->password ?> *" value="<?=$_POST['password']?>">
						<p align="center" class="inputWarning">asd</p>
						<br>
						<br>
						<center>
							<div class="rememberMe">
								<input id="anothers_pc" name="anothers_pc" type="checkbox">
								<label for="anothers_pc"><?= $lang->remember_me ?></label>
							</div>
						</center>
						<br>
						<a href="/recoveryPassword"><?= $lang->forget_password ?></a>
						<br>
						<input type="hidden" name="form" value="1">
						<br>
						<center>
							<input type="submit" value="<?= $lang->come_in ?>">
						</center>
					</form>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-1"></div>
		<div class="col-12 col-sm-1 col-md-1 col-lg-6"></div>
		<div class="col-12 col-sm-10 col-md-10 col-lg-4 login_button_back shadowBlueOut">
			<a href="/">&larr;<?=$lang->back ?></a>
		</div>
		<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
	</div>
</div>