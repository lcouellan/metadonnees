<?php include("fragments/header.html");?>
	<div id="desc">
		<h1>Les métadonnées sur les images</h1>
		<div id="row" class="clearfix">
			<div class="colonne">
				<h3>Upload et Stockage</h3>
				<p>Possibilité d'upload <a href="https://ensweb.users.info.unicaen.fr/devoirs/m2-dnr-umdn3c/images.zip">d'images</a> et gestion de leurs métadonnées</p> 
				<img src="medias/icones/iconmonstr-picture.png" alt="upload" class="icons"/>
			</div>
			<div class="colonne">
				<h3>Métadonnées</h3>
				<p>Edition des métadonnées des images précedemment upload avec  <a href="http://www.sno.phy.queensu.ca/~phil/exiftool/">Exiftool</a></p>
				<img src="medias/icones/iconmonstr-pencil.png" alt="metadonnes" class="icons"/>
			</div>
			<div class="colonne">
				<h3>Visualisation</h3>
				<p>Affichage des images et de leurs métadonnées toujours via <a href="http://www.sno.phy.queensu.ca/~phil/exiftool/">Exiftool</a></p>
				<img src="medias/icones/iconmonstr-monitoring.png" alt="visualisation" class="icons"/>
			</div>
		</div>
	</div>
	<div id="bandeau">
		<h3> Banque d'images </h3>
	</div>
	<div id="fleche_bas"></div>

	<ul class="bxslider">
		<?php 
			$files = glob('medias/images/*.{jpg,png,gif}', GLOB_BRACE);
			foreach($files as $file) {
				$img = explode('/',$file);
				$img = $img[2];
				$title = exec("exiftool -title medias/images/".$img);
				$author = exec("exiftool -creator medias/images/".$img);
				echo '<li><a href="pages/display.php?nom='.$img.'"><figure><img src="'.$file.'" title="'.$img.'" width="800" height="500"/><figcaption>'.$title.' - '.$author.'</figcaption></figure></a></li>';
			}
		?>
	</ul>
	<div id="bx-pager">
		<?php 
		$i = 0;
			$files = glob('medias/images/*.{jpg,png,gif}', GLOB_BRACE);
			foreach($files as $file) {
				echo '<a data-slide-index="'.$i.'" href=""><img src="'.$file.'"  width="100" height="62"/></a>';
				$i ++;
			}
		?>
	</div>

	<?php include("fragments/footer.html");?>
	
	<script>
	$('.bxslider').bxSlider({
		pagerCustom: '#bx-pager',
    	mode: 'fade',
	});
	</script>	
</html>