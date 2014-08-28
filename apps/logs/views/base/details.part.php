<?php
Part::input($base, 'base');
?>
<form method="POST" action="<?php echo Url::action('baseController::delete', $base->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('baseController::details', $base->id), 'base #' . $base->id) ?></h3>
	<p>
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$base->time); ?><br />
		<strong>Event</strong>: <?php echo $base->event; ?><br />
		<strong>User Id</strong>: <?php echo $base->user_id; ?><br />
		<strong>Group Id</strong>: <?php echo $base->group_id; ?><br />
		<strong>Role Id</strong>: <?php echo $base->role_id; ?><br />
		<strong>Host Id</strong>: <?php echo $base->host_id; ?><br />
		<strong>Browser Id</strong>: <?php echo $base->browser_id; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('baseController::editForm', $base->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>