<?php include("../fragments/header.html");?>
<form action="upload.php" method="post" id="uploadForm" enctype="multipart/form-data">
	Sélectionnez une image à upload : 
	<input type="file" name="fileToUpload" id="fileToUpload">
	<input type="submit" value="Upload Image" name="Upload">
</form>
<?php include("../fragments/footer.html");?>
</html>