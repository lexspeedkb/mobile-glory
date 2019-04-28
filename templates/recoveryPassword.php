<?php
$email 		= $_POST['email'];

if($_POST['form']!=""){
	if($email!=""){
		$result = Users::recoveryPassword($email);
		if($result==1){
			$warning = '<span style="color: green">Новый пароль выслан Вам на E-mail!</span> <a href="/login">На страницу входа</a>';
		}elseif($result==0){
			$warning = '<span style="color: red">Пользователя с такие E-mail не существует</span>';
		}
	}else{
		$warning = '<span style="color: red">Пустой E-mail</span>';
	}
}

?>

<!doctype html>
<html class="no-js" lang="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Sajuguju - LogIn</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/png" href="/templates/assets/images/favicon.png">
	<!-- Place favicon.ico in the root directory -->
	<!-- all css here -->
	<!-- bootstrap v3.3.7 css -->
	<link rel="stylesheet" href="/templates/assets/css/bootstrap.min.css">
	<!-- owl.carousel.2.0.0-beta.2.4 css -->
	<link rel="stylesheet" href="/templates/assets/css/owl.carousel.min.css">
	<!-- font-awesome v4.6.3 css -->
	<link rel="stylesheet" href="/templates/assets/css/font-awesome.min.css">
	<!-- flaticon.css -->
	<link rel="stylesheet" href="/templates/assets/css/flaticon.css">
	<!-- jquery-ui.css -->
	<link rel="stylesheet" href="/templates/assets/css/jquery-ui.css">
	<!-- metisMenu.min.css -->
	<link rel="stylesheet" href="/templates/assets/css/metisMenu.min.css">
	<!-- slicknav.min.css -->
	<link rel="stylesheet" href="/templates/assets/css/slicknav.min.css">
	<!-- swiper.min.css -->
	<link rel="stylesheet" href="/templates/assets/css/swiper.min.css">
	<!-- style css -->
	<link rel="stylesheet" href="/templates/assets/css/styles.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="/templates/assets/css/responsive.css">
	<!-- modernizr css -->
	<script src="/templates/assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
	<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
	<!--Start Preloader-->
	<div class="preloader-wrap">
		<div class="spinner"></div>
	</div>
	<!-- header-area start -->
	<?php Templates::render_header();?>
	<!-- header-area end -->
	<!-- .breadcumb-area start -->
	<div class="breadcumb-area bg-img-1 black-opacity ptb-100">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="breadcumb-wrap text-center">
						<h2>Восстановление доступа к аккаунту</h2>
						<ul>
							<li><a href="/">Главная</a></li>
							<li><span>Восстановление доступа к аккаунту</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .breadcumb-area end -->
	<!-- checkout-area start -->
	<div class="account-area ptb-100">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
					<div class="account-form form-style">
						<p class="warning"><?=$warning;?></p>
			
						<form action="/recoveryPassword/" method="POST">
							<p>E-mail, на который прийдёт новый пароль <span style="color: red">*</span></p>
							<input type="email" name="email" placeholder="E-mail">							
							<input type="hidden" name="form" value="1">
							<button>ВОССТАНОВИТЬ</button>
						</form>

						<div class="text-center">
							<a href="/logup">Или зарегистрироваться</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- checkout-area end -->
	<?php Templates::render_footer();?>
	<!-- jquery latest version -->
	<script src="/templates/assets/js/vendor/jquery-2.2.4.min.js"></script>
	<!-- bootstrap js -->
	<script src="/templates/assets/js/bootstrap.min.js"></script>
	<!-- owl.carousel.2.0.0-beta.2.4 css -->
	<script src="/templates/assets/js/owl.carousel.min.js"></script>
	<!-- mouse_scroll.js -->
	<!-- scrollup.js -->
	<script src="/templates/assets/js/scrollup.js"></script>
	<!-- slicknav.js -->
	<script src="/templates/assets/js/slicknav.js"></script>
	<!-- jquery.zoom.min.js -->
	<script src="/templates/assets/js/jquery.zoom.min.js"></script>
	<!-- swiper.min.js -->
	<script src="/templates/assets/js/swiper.min.js"></script>
	<!-- metisMenu.min.js -->
	<script src="/templates/assets/js/metisMenu.min.js"></script>
	<!-- mailchimp.js -->
	<script src="/templates/assets/js/mailchimp.js"></script>
	<!-- jquery-ui.min.js -->
	<script src="/templates/assets/js/jquery-ui.min.js"></script>
	<!-- main js -->
	<script src="/templates/assets/js/scripts.js"></script>
</body>

</html>