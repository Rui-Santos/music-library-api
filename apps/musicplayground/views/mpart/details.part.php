<?php
Part::input($mpart, 'mpart');
?>
<form method="POST" action="<?php echo Url::action('mpartController::delete', $mpart->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('mpartController::details', $mpart->RecID), 'mpart #' . $mpart->RecID) ?></h3>
	<p>
		<strong>Hash</strong>: <?php echo $mpart->hash; ?><br />
<!-- 		<strong>Picture</strong>: <?php echo $mpart->Picture; ?><br /><br /> -->
		<?php
			$cachepath = "/PATH/GOES/HERE/api/img_cache/THE_MUSIC_PLAYGROUND/album_art/";
			$file = $cachepath . "image_full_" . $mpart->RecID . ".jpg";
			if( file_exists( $file ) ) $image = imagecreatefromjpeg($file);
			else {
				$meta_size = 256;
				$album_size = 160;
				$thumb_size = 80;
		 		$full = $cachepath . 'image_full_'.$mpart->RecID.'.jpg'; 
		 		$fp = fopen( $full, 'wb' ); 
		 		fwrite( $fp, $mpart->Picture ); 
		 		fclose($fp); 
		 		$fsize = getimagesize($full); 
		 		$imageFull = imagecreatefromjpeg($full); 
		 		$msize = $fsize[0] > $meta_size ? $meta_size : $fsize[0]; 
		 		$msize = $fsize[1] > $msize ? $msize : $fsize[1]; 
		 		$meta = $cachepath . 'image_meta_'.$mpart->RecID.'.jpg'; 
		 		$imageMeta = imagecreatetruecolor($msize, $msize); 
		 		imagecopyresampled( $imageMeta, $imageFull, 0, 0, 0, 0, $msize, $msize, $fsize[0], $fsize[1] ); 
		 		imagejpeg( $imageMeta, $meta, 100 ); 
		 		$asize = $fsize[0] > $album_size ? $album_size : $fsize[0]; 
		 		$asize = $fsize[1] > $asize ? $asize : $fsize[1]; 
		 		$album = $cachepath . 'image_album_'.$mpart->RecID.'.jpg'; 
		 		$imageAlbum = imagecreatetruecolor($asize, $asize); 
		 		imagecopyresampled( $imageAlbum, $imageFull, 0, 0, 0, 0, $asize, $asize, $fsize[0], $fsize[1] ); 
		 		imagejpeg( $imageAlbum, $album, 100 ); $tsize = $fsize[0] > $thumb_size ? $thumb_size : $fsize[0]; 
		 		$tsize = $fsize[1] > $tsize ? $tsize : $fsize[1]; 
		 		$thumb = $cachepath . 'image_thumb_'.$mpart->RecID.'.jpg'; 
		 		$imageThumb = imagecreatetruecolor($tsize, $tsize); 
		 		imagecopyresampled( $imageThumb, $imageFull, 0, 0, 0, 0, $tsize, $tsize, $fsize[0], $fsize[1] ); 
		 		imagejpeg( $imageThumb, $thumb, 100 ); 
			}
			echo "<img src='https://www.thedinermusic.com/api/img_cache/THE_MUSIC_PLAYGROUND/album_art/image_meta_".$mpart->RecID.".jpg' />";
			echo "<img src='https://www.thedinermusic.com/api/img_cache/THE_MUSIC_PLAYGROUND/album_art/image_album_".$mpart->RecID.".jpg' />";
			echo "<img src='https://www.thedinermusic.com/api/img_cache/THE_MUSIC_PLAYGROUND/album_art/image_thumb_".$mpart->RecID.".jpg' />";
		?>

	</p>
	<?php echo Html::anchor(Url::action('mpartController::editForm', $mpart->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>