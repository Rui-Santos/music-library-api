<?php
Part::input($mpsamplerassets, 'mpsamplerassets');
?>
<form method="POST" action="<?php echo Url::action('mpsamplerassetsController::delete', $mpsamplerassets->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('mpsamplerassetsController::details', $mpsamplerassets->id), 'mpsamplerassets #' . $mpsamplerassets->id) ?></h3>
	<p>
		<strong>Sampler Id</strong>: <?php echo $mpsamplerassets->sampler_id; ?><br />
		<strong>Asset Id</strong>: <?php echo $mpsamplerassets->asset_id; ?><br />
		<strong>Order Position</strong>: <?php echo $mpsamplerassets->order_position; ?><br />
		<strong>track</strong>: <?php echo $mpsamplerassets->getMeta()->TrackTitle; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('mpsamplerassetsController::editForm', $mpsamplerassets->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>