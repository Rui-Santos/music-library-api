<?php
Part::input($queries, 'queries');
?>
<form method="POST" action="<?php echo Url::action('queriesController::delete', $queries->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('queriesController::details', $queries->id), 'queries #' . $queries->id) ?></h3>
	<p>
		<strong>Databases</strong>: <?php echo $queries->databases; ?><br />
		<strong>Query</strong>: <?php echo $queries->query; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('queriesController::editForm', $queries->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>