<h1>Avant</h1>
<?php
$json = $_POST["fileToEdit"];
$string = file_get_contents("medias/json/".$json);
$value = json_decode($string, true);

echo '<p> Titre : '.$titre = $value[0]['File']['FileName'].'</p>';
echo '<p> Description : '.$value[0]['EXIF']['ImageDescription'].'</p>';
echo '<p> Copyright : '.$value[0]['EXIF']['Copyright'].'</p>';


echo '<h1>Après : </h1>';

$value[0]['File']['FileName'] = $_POST["titre"];
$value[0]['EXIF']['ImageDescription'] = $_POST["description"];
$value[0]['EXIF']['Copyright'] = $_POST["copyright"];


$string = json_encode($value, true);

file_put_contents("medias/json/".$json, $string);


$string = file_get_contents("medias/json/".$json);
$value = json_decode($string, true);

echo '<p> Titre : '.$value[0]['File']['FileName'].'</p>';
echo '<p> Description : '.$value[0]['EXIF']['ImageDescription'].'</p>';
echo '<p> Copyright : '.$value[0]['EXIF']['Copyright'].'</p>';

$img = explode('.',$json);
$img = $json[0].".jpg";

exec("exiftool -json=medias/json/".$json." medias/images/".$img);