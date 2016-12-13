<?php

$res = shell_exec("exiftool -h medias/images/".$_GET["nom"]);
echo $res;

echo '<figure><img src="medias/images/'.$_GET["nom"].'"></figure>';