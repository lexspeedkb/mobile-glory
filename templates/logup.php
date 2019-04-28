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
					
					<form action="/logup" method="POST">
						<br>
						<input type="text"		class="logupInput shadowBlueIn" name="fioF" 	 placeholder="<?=$lang->full_name ?>" 		 value="<?=$_POST['fioF'];?>"><br>
						<p align="center" class="inputWarning" data-type="warning_full_name"><?=$data['warning']['full_name']?></p>
						
						<br>
						<input type="text" 		class="logupInput shadowBlueIn" name="loginF" 	 placeholder="<?=$lang->login ?>" 			 value="<?=$_POST['loginF'];?>"><br>
						<p align="center" class="inputWarning" data-type="warning_login"><?=$data['warning']['login']?></p>
						
						<br>
						<input type="email" 	class="logupInput shadowBlueIn" name="emailF" 	 class="" placeholder="E-mail" 				 value="<?=$_POST['emailF'];?>"><br>
						<p align="center" class="inputWarning" data-type="warning_email"><?=$data['warning']['email']?></p>
						
						<br>
						<input type="password" 	class="logupInput shadowBlueIn" name="password1F" placeholder="<?=$lang->password ?>" 		 value="<?=$_POST['password1F'];?>"><br>
						<p align="center" class="inputWarning" data-type="warning_password1"><?=$data['warning']['password1']?></p>
						
						<br>
						<input type="password" 	class="logupInput shadowBlueIn" name="password2F" placeholder="<?=$lang->repeat_password ?>" value="<?=$_POST['password2F'];?>"><br>
						<p align="center" class="inputWarning" data-type="warning_password2"><?=$data['warning']['password2']?></p>

						<input type="hidden" name="form" value="1">
					<!--  	DEBUG VERSION
						<input type="text" name="fio" placeholder="fio" value="test"><br>
						<p class="warningL"></p>
						<input type="text" class="login" name="login" placeholder="login" value="test"><br>
						<p class="warningE"></p>
						<input type="email" class="email" name="email" placeholder="email" value="test@gmail.com"><br>
						<p class="warningP"></p>
						<input type="password" class="password1" name="password1" placeholder="password1" value="test"><br>
						<input type="password" class="password2" name="password2" placeholder="password2" value="test"><br>
						<input type="hidden" name="form" value="1">
						<input type="submit"> -->
						<br>
						<center>
							<input type="submit" class="shadowBlueIn" value="<?=$lang->entrance ?>">
						</center>
						<br>
					</form>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>

		<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
		<div class="col-12 col-sm-1 col-md-1 col-lg-6"></div>
		<div class="col-12 col-sm-10 col-md-10 col-lg-4 login_button_back shadowBlueOut">
			<a href="/">&larr;<?=$lang->back ?></a>
		</div>
		<div class="col-12 col-sm-12 col-md-1 col-lg-1"></div>
	</div>
</div>
<!-- <form>
	<input type="text" class="" placeholder="E-mail">
	<input type="text" class="" placeholder="<?=$lang->password ?>">
	<input type="text" class="" placeholder="<?=$lang->repeat_password ?>">
	<center>
		<input type="submit" class="shadowBlueIn" value="<?=$lang->entrance ?>">
	</center>
</form> -->