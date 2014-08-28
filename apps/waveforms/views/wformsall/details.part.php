<?php
Part::input($wformsall, 'wformsall');
?>
<form method="POST" action="<?php echo Url::action('wformsallController::delete', $wformsall->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('wformsallController::details', $wformsall->RecID), 'wformsall #' . $wformsall->RecID) ?></h3>
	<p>
		<strong>Waveform Rep</strong>: <?php echo $wformsall->WaveformRep; ?><br />
		<strong>Spectro Rep</strong>: <?php echo $wformsall->SpectroRep; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('wformsallController::editForm', $wformsall->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>