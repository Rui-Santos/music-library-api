<?php
Part::input($mplyrics, 'mplyrics');
?>
<form method="POST" action="<?php echo Url::action('mplyricsController::delete', $mplyrics->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('mplyricsController::details', $mplyrics->RecID), 'mplyrics #' . $mplyrics->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $mplyrics->Filename; ?><br />
		<strong>Track Title</strong>: <?php echo $mplyrics->TrackTitle; ?><br />
		<strong>Lyrics</strong>: <?php echo $mplyrics->Lyrics; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('mplyricsController::editForm', $mplyrics->RecID), 'Edit') ?>
	</fieldset>
</form>