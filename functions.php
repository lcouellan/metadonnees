<?php

function refresh($json) {

	$img = explode('.',$json);
	$img = $img[0].".jpg";
	exec("exiftool -g -json medias/images/".$img." > medias/json/".$json);
    // echo " Le fichier ".$json." a été créé.";

    $string = file_get_contents("medias/json/".$json);
    $value = json_decode($string, true);
	return $value;
}