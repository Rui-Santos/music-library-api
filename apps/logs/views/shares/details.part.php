<?php
Part::input($shares, 'shares');
?>
<form method="POST" action="<?php echo Url::action('sharesController::delete', $shares->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('sharesController::details', $shares->id), 'shares #' . $shares->id) ?></h3>
	<p>
		<strong>Log Id</strong>: <?php echo $shares->log_id; ?><br />
		<strong>Type</strong>: <?php echo $shares->type; ?><br />
		<strong>Value</strong>: <?php echo $shares->value; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('sharesController::editForm', $shares->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>