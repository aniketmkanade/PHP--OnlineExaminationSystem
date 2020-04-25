<!DOCTYPE html>
<html>
<head>
<title>Online Examination</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Awareness Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--flexslider-->
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<!--//flexslider-->
<link href='//fonts.googleapis.com/css?family=Arimo:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Raleway:400,700,800,600,500' rel='stylesheet' type='text/css'>
</head>
<body> 
<!--header-->	
<div class="header" >
	<div class="col-md-3 header-top cbp-spmenu-push">
		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<a  href="index.html"  >Home</a>
			<a  href="about.html"  >About</a>
			<a  href="services.html"  >Services</a>
			<a  href="gallery.html" >Gallery</a>
			<a  href="codes.html" > Short Codes</a>
			<a  href="contact.html" >Contact</a>
		</nav>
		<!-- /script-nav -->
			<div class="main">
				<section class="buttonset">
					<button id="showLeftPush"><i  class="glyphicon glyphicon-menu-hamburger"></i></button>
				</section>
			</div>
			<!-- Classie - class helper functions by @desandro https://github.com/desandro/classie -->
				<script src="js/classie.js"></script>
					<script>
						var	menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
						showLeftPush = document.getElementById( 'showLeftPush' ),
						body = document.body;
							
						showLeftPush.onclick = function() {
							classie.toggle( this, 'active' );
							classie.toggle( body, 'cbp-spmenu-push-toright' );
							classie.toggle( menuLeft, 'cbp-spmenu-open' );
							disableOther( 'showLeftPush' );
						};
					</script>
	</div>
	<div class="col-md-6 logo">
		<h1><a href="index.html"><span>E</span>XAM POINT</a></h1>
	</div>
	<div class="col-md-3 search">
		<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon
	<?php
		if(!SESSION_START())
			SESSION_START();

		if(!isset($_SESSION['studId']))
			echo 'glyphicon-user';
		else
			echo 'glyphicon-log-in';
	?>
		"></i></a>
	</div>
	<div class="clearfix"> </div>
</div>
	<!---pop-up-box---->					  
	<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
	<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
	<!---//pop-up-box---->
	<div id="small-dialog" class="mfp-hide">
		<div class="search-top">
			<?php
			if(!isset($_SESSION['studId']))
			{
				include ('login.php');
			}
			else
			{
				include('profile.php');
			}
			?>
		</div>				
	</div>
	
	 <script>
		$(document).ready(function() {
		$('.popup-with-zoom-anim').magnificPopup({
		type: 'inline',
		fixedContentPos: false,
		fixedBgPos: true,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in'
		});																					
		});
	</script>		
<!--//header-->