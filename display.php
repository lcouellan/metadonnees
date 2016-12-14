<?php
$meta ="<meta charset='utf-8' /><meta property='og:title' content='".$_GET["nom"]."' /><meta property='og:type' content='creativework.article' /><meta property='og:url' content='"dirname($_SERVER['SERVER_PROTOCOL']) . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']."' /><meta property='og:image' conten='medias/images/'".$_GET["nom"]."' /><meta name='twitter:card' content='summary' /><meta name='twitter:title' content='".$_GET["nom"]."' /><meta name='twitter:description' content='En savoir plus...' />";
$lienImg = "<a href='medias/images/".$_GET["nom"]."' download='".$_GET["nom"]."'>Télécharger l'image</a></br>";
$json = explode('.',$_GET["nom"]);
$json = $json[0].".json";
$lienJson = "<a href='medias/json/".$json."' download='".$json."'>Télécharger les métadonnées de l'image</a>";
$resultat = shell_exec("exiftool -h medias/images/".$_GET["nom"]);
$image = '<figure><img src="medias/images/'.$_GET["nom"].'"></figure>';

// inclusion du squelette
require_once("squelette_meta.html");