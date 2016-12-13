<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!-- jQuery library (served from Google) -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<!-- bxSlider Javascript file -->
	<script src="lib/Bxslider/jquery.bxslider.min.js"></script>
	<!-- bxSlider CSS file -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href="lib/Bxslider/jquery.bxslider.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/style.css" />
	<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans' rel='stylesheet' type='text/css'>
    <script src="js/script.js"></script>
    <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  		<![endif]-->
  		<title>Metadonnées</title>
  	</head>
  	<body>
	<div id="entete">
		<h1><a href="">Crawler SérieBox</a></h1>
		<nav id="menu" class="clearfix">
			<ul>
				<li><a id="menu_services" href="upload.html">UPLOAD</a></li>
				<li><a id="menu_domaines" href="/#res">RESULTATS</a></li>
				<li><a id="menu_contact" href="/#apropos">A PROPOS</a></li>
				<li><a id="menu_informations" href="/informations">INFORMATIONS</a></li>
			</ul>
		</nav>
	</div>
	<ul class="bxslider">
		<?php 
			$files = glob('medias/images/*.{jpg,png,gif}', GLOB_BRACE);
			foreach($files as $file) {
				$img = explode('/',$file);
				$img = $img[2];
				echo '<li><a href="display.php?nom='.$img.'"><figure><img src="'.$file.'" width="800" height="500"/></figure></a></li>';
			}
		?>
	</ul>
	<div id="bx-pager">
		<?php 
		$i = 0;
			$files = glob('medias/images/*.{jpg,png,gif}', GLOB_BRACE);
			foreach($files as $file) {
				echo '<a data-slide-index="'.$i.'" href=""><img src="'.$file.'"  width="100" height="62"/></a>';
				$i ++;
			}
		?>
	</div>

	
</body>
</html>