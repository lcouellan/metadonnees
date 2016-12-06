<!DOCTYPE html>
<html>
  <body>

    <?php

        /**
            Gestion de l'upload
        */
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "Image - " . $check["mime"] . ". ";
                $uploadOk = 1;
            } else {
                echo "Ceci n'est pas une image malotru !";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Image déjà existante. ";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Image trop volumineuse.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Seul les formats JPG, JPEG, PNG & GIF sont autorisés.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Désolé, votre fichier n'a pas pu être uploadé.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "L'image ". basename( $_FILES["fileToUpload"]["name"]). " à été ajoutée dans le dossier /images.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        /**
            Récupération des métadonnées et création du json
        */
        $json = explode('.',$_FILES["fileToUpload"]["name"]);
        $json = $json[0].".json";
        exec("exiftool -g -json images/".$_FILES["fileToUpload"]["name"]." > json/".$json);
        echo " Le fichier ".$json." a été créé.";

        $string = file_get_contents("json/".$json);
        $value = json_decode($string, true);

        $titre = $value[0]['File']['FileName'];
        $description = $value[0]['EXIF']['ImageDescription'];
        $copyright = $value[0]['EXIF']['Copyright'];
    ?>

    <form action="upload.php" method="post">
        <p>
            <label for="titre">Titre :</label>
            <input type="text" name="titre" value=<?php echo $titre ; ?> id="titre"/>
        </p>
         <p>
            <label for="description">Description :</label>
            <input type="textarea" name="description" value=<?php echo $description ; ?> id="description"/>
        </p>
         <p>
            <label for="copyright">Copyright :</label>
            <input type="text" name="copyright" value=<?php echo $copyright ; ?> id="copyright"/>
        </p>
        <input type="submit" value="Editer metadonnees" name="Editer">
    </form>

    <?php
        /**
            Modification du json selon les données entrées dans le form
        */
        //exec('exiftool -File:filename='.$_POST['titre'].' -XMP:description='.$_POST['description'].' -IPTC:CopyrightNotice='.$_POST['copyright'].' '.$_POST['fileName']);
    ?>

  </body>
</html>

