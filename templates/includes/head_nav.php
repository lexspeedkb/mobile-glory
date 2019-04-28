<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-1"></div>
				
				<div class="col-2 col-sm-4 col-md-4 col-lg-3 myrmFull">
					<h1>Mobile <b>Glory</b></h1>
				</div>
				<div class="col-2 col-sm-4 col-md-4 col-lg-3 myrmShort">
					<h1>My<b>RM</b></h1>
				</div>

				<div class="col-3 col-sm-3 col-md-4 col-lg-5"></div>
				<div class="col-2 col-sm-2 col-md-2 col-lg-2 fallMenu">
					<?php
					if(!empty($data['MyAccount'])){
						echo '
							<div class="dropdown">
								<div class="mainmenubtn">'.$data['MyAccount']['email'].'</div>
								<div class="dropdown-child">
									<a href="/exit">'.$lang->exit.'</a>
									<a href="/exit">'.$lang->exit.'</a>
									<a href="/exit">'.$lang->exit.'</a>
								</div>
							</div>';
					}
					?>
					
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-1"></div>
			</div>
		</div>
	</div>
</div>

<style>

.mainmenubtn {
	cursor: pointer;
	background-color: transparent;
}

.dropdown {
	position: relative;
	z-index: 2;
	display: inline-block;
}

.dropdown-child{
	position: absolute;
	top: -200px;
	background-color: black;
	margin-top:10px;
	width: 100%;
}

.dropdown-child a {
	color: white;
	padding: 5px 10px 5px 10px;
	text-decoration: none;
	display: block;
	
}

.dropdown:hover .dropdown-child {
	top: 27px;
	z-index: -1;
}
</style>

<!--<script>-->
<!--	$('.dropdown').mouseenter(function () {-->
<!--		$('.dropdown-child').slideDown();-->
<!--	})-->
<!--	$(document).on('hover' , '.dropdown' , function ( ) {-->
		
<!--	})-->
<!--</script>-->


