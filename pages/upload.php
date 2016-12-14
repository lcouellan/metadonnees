<?php include("../fragments/header.html");?>
    <?php

        require_once("functions.php");
        /*
            Gestion de l'upload
        */
        $target_dir = "../medias/images/";
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
                echo "Ceci n'est pas une image !";
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

        /*
            Récupération des métadonnées et création du json
        */
        $json = explode('.',$_FILES["fileToUpload"]["name"]);
        $json = $json[0].".json";

        $value = refresh($json);

        $title = $value[0]['XMP']['Title'];
        $description = $value[0]['XMP']['Description'];
        $author = $value[0]['XMP']['Creator'];
        $location = $value[0]['XMP']['Location'];
        $copyright = $value[0]['XMP']['Rights'];
    ?>

    <form action="edit.php" id="formEdit" method="post">
        <p>
            <label for="title">Titre :</label>
            <input type="text" name="title" value="<?php echo $title; ?>" id="title"/>
        </p>
        <p>
            <label for="author">Auteur :</label>
            <input type="text" name="author" value="<?php echo $author; ?>" id="author"/>
        </p>
        <p>
            <label for="location">Lieu :</label>
            <input type="text" name="location" value="<?php echo $location; ?>" id="location"/>
        </p>
        <p>
            <label for="copyright">Copyright :</label>
            <input type="text" name="copyright" value="<?php echo $copyright; ?>" id="copyright"/>
        </p>
        <p>
            <label for="description">Description :</label>
            <input type="text" name="description" value="<?php echo $description; ?>" id="description"/>
        </p>
        <input type="hidden" name="fileToEdit" value="<?php echo $json;?>" />
        <input type="submit" value="Editer metadonnees" name="Editer">
    </form>

    <?php
        /*
            Modification du json selon les données entrées dans le form
        */
        //exec('exiftool -File:filename='.$_POST['title'].' -XMP:author='.$_POST['author'].' -IPTC:CopyrightNotice='.$_POST['copyright'].' '.$_POST['fileName']);
    ?>
    <?php include("../fragments/footer.html");?>
</html>