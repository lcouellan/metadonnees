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
  		<h2>Images proposées par Flickr</h2>
  		<div id="gal-photos"></div>
  		<?php

		require_once("functions.php");

  		$json = explode('.',$_GET["nom"]);
		$json = $json[0].".json";
		$value = refresh($json);
		echo "<p id='keywords'>";
		$max = count($value[0]['XMP']['Subject']) -1;
		foreach ($value[0]['XMP']['Subject'] as $key=>$keyword) {
			$keyword = str_replace(' ', '%20', $keyword);
			if($key != $max) { $keyword .= ","; }
			echo $keyword;
		}
		echo "</p>";

  		$res = shell_exec("exiftool -h medias/images/".$_GET["nom"]);
  		echo $res;

  		echo '<figure><img src="medias/images/'.$_GET["nom"].'"></figure>';
  		?>
  	</body>
  	</html>