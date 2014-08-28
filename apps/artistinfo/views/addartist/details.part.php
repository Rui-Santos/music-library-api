<?php
Part::input($addartist, 'addartist');
?>
<form method="POST" action="<?php echo Url::action('addartistController::delete', $addartist->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('addartistController::details', $addartist->id), 'addartist #' . $addartist->id) ?></h3>
	<p>
		<strong>Artist</strong>: <?php echo $addartist->artist; ?><br />
		<strong>Filename</strong>: <?php echo $addartist->filename; ?><br />
		<strong>Bio</strong>: <?php echo $addartist->bio; ?><br />
		<strong>Photo</strong>: <?php echo $addartist->photo; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('addartistController::editForm', $addartist->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>