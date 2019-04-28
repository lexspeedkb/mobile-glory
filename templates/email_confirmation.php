<?php
$login 		= $_POST['login'];
$password 	= $_POST['password'];

if($_POST['form']!=""){
	if($login!=""&$password!=""){
		$result = Users::login($login, $password);
		if($result==1){
			$_SESSION['login']=$login;
			echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=/">';
			die;
		}elseif($result==0){
			$warning = "Неверный логин или пароль";
		}elseif($result==2){
			$warning = "E-mail не подтверждён";
		}
	}else{
		$warning =  "Заполнены не все поля";
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
						<h2>Подтверждение E-mail</h2>
						<ul>
							<li><a href="/">Главная</a></li>
							<li><span>Подтверждение E-mail</span></li>
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
						<h4>Пожалуйста, подтвердите Ваш E-mail.</h4>
			
						<form action="/login/" method="POST">
							<button>ВОЙТИ</button>
						</form>
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