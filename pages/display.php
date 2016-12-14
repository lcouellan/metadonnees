<?php
$meta ="<meta charset='utf-8' /><meta property='og:title' content='".$_GET["nom"]."' /><meta property='og:type' content='creativework.article' /><meta property='og:url' content='". dirname($_SERVER['SERVER_PROTOCOL']) . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']."' /><meta property='og:image' content='https://dev-21509740.users.info.unicaen.fr/M2/metadonnees/medias/images/".$_GET["nom"]."' width='200' height='200' /><meta name='twitter:card' content='summary' /><meta name='twitter:title' content='".$_GET["nom"]."' /><meta name='twitter:description' content='En savoir plus...' /><meta name='twitter:image' content='https://dev-21509740.users.info.unicaen.fr/M2/metadonnees/medias/images/".$_GET["nom"]."' />";
$lienImg = "<a id='first' class='telechargement' href='/M2/metadonnees/medias/images/".$_GET["nom"]."' download='".$_GET["nom"]."'>Télécharger l'image</a></br>";
$json = explode('.',$_GET["nom"]);
$json = $json[0].".json";
$lienJson = "<a class='telechargement' href='/M2/metadonnees/medias/json/".$json."' download='".$json."'>Télécharger les métadonnées de l'image</a>";
$resultat = shell_exec("exiftool -h ../medias/images/".$_GET["nom"]);
$image = '<figure><img src="/M2/metadonnees/medias/images/'.$_GET["nom"].'"></figure>';

// inclusion du squelette
require_once("../fragments/squelette_meta.html");
require_once("functions.php");

$value = refresh($json);
echo "<p id='keywords'>";
$max = count($value[0]['XMP']['Subject']) -1;
foreach ($value[0]['XMP']['Subject'] as $key=>$keyword) {
	$keyword = str_replace(' ', '%20', $keyword);
	if($key != $max) { $keyword .= ","; }
	echo $keyword;
}
echo "</p>";