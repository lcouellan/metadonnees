<?php include("../fragments/header.html");?>
<h1 class="titre">Avant modification : </h1>
<?php

require_once("functions.php");

$json = $_POST["fileToEdit"];
$value = refresh($json);

echo '<p> Titre : '.$value[0]['XMP']['Title'].'</p>';
echo '<p> Auteur : '.$value[0]['XMP']['Creator'].'</p>';
echo '<p> Lieu : '.$value[0]['XMP']['Location'].'</p>';
echo '<p> Copyright : '.$value[0]['XMP']['Rights'].'</p>';
echo '<p> Description : '.$value[0]['XMP']['Description'].'</p>';

echo '<h1>Après modification : </h1>';

$img = explode('.',$json);
$img = $img[0].".jpg";

exec("exiftool -title=\"".$_POST["title"]."\" -creator=".$_POST["author"]." -location=\"".$_POST["location"]."\" -description=\"".$_POST["description"]."\" -Rights=".$_POST["copyright"]." ../medias/images/".$img);

$value = refresh($json);

//var_dump($value);

echo '<p> Titre : '.$value[0]['XMP']['Title'].'</p>';
echo '<p> Auteur : '.$value[0]['XMP']['Creator'].'</p>';
echo '<p> Lieu : '.$value[0]['XMP']['Location'].'</p>';
echo '<p> Copyright : '.$value[0]['XMP']['Rights'].'</p>';
echo '<p> Description : '.$value[0]['XMP']['Description'].'</p>';
?>
<?php include("../fragments/footer.html");?>