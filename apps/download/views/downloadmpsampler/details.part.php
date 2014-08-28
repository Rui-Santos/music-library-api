<?php
Part::input($downloadmpsampler, 'downloadmpsampler');
?>
<form method="POST" action="<?php echo Url::action('downloadmpsamplerController::delete', $downloadmpsampler->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('downloadmpsamplerController::details', $downloadmpsampler->id), 'downloadmpsampler #' . $downloadmpsampler->id) ?></h3>
	<p>
		<strong>Type</strong>: <?php echo $downloadmpsampler->type; ?><br />
		<strong>State</strong>: <?php echo $downloadmpsampler->state; ?><br />
		<strong>Name</strong>: <?php echo $downloadmpsampler->name; ?><br />
		<strong>Description</strong>: <?php echo $downloadmpsampler->description; ?><br />
		<strong>Artwork</strong>: <?php echo $downloadmpsampler->artwork; ?><br />
		<strong>Date Created</strong>: <?php echo date(DATE_ISO8601,$downloadmpsampler->date_created); ?><br />
		<strong>Date Modified</strong>: <?php echo date(DATE_ISO8601,$downloadmpsampler->date_modified); ?><br />
		<strong>Slug</strong>: <?php echo $downloadmpsampler->slug; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('downloadmpsamplerController::editForm', $downloadmpsampler->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>