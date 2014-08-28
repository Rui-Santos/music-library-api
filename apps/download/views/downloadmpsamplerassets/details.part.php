<?php
Part::input($downloadmpsamplerassets, 'downloadmpsamplerassets');
?>
<form method="POST" action="<?php echo Url::action('downloadmpsamplerassetsController::delete', $downloadmpsamplerassets->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('downloadmpsamplerassetsController::details', $downloadmpsamplerassets->id), 'downloadmpsamplerassets #' . $downloadmpsamplerassets->id) ?></h3>
	<p>
		<strong>Sampler Id</strong>: <?php echo $downloadmpsamplerassets->sampler_id; ?><br />
		<strong>Track Id</strong>: <?php echo $downloadmpsamplerassets->track_id; ?><br />
		<strong>Asset Key</strong>: <?php echo $downloadmpsamplerassets->asset_key; ?><br />
		<strong>Order Position</strong>: <?php echo $downloadmpsamplerassets->order_position; ?><br />
		<strong>Filename</strong>: <?php echo $downloadmpsamplerassets->filename; ?><br />
		<strong>Filepath</strong>: <?php echo $downloadmpsamplerassets->filepath; ?><br />
		<strong>Title</strong>: <?php echo $downloadmpsamplerassets->title; ?><br />
		<strong>Artist</strong>: <?php echo $downloadmpsamplerassets->artist; ?><br />
		<strong>Artist Id</strong>: <?php echo $downloadmpsamplerassets->artist_id; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('downloadmpsamplerassetsController::editForm', $downloadmpsamplerassets->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>