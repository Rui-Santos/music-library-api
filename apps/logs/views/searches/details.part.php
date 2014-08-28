<?php
Part::input($searches, 'searches');
?>
<form method="POST" action="<?php echo Url::action('searchesController::delete', $searches->log_id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('searchesController::details', $searches->log_id), 'searches #' . $searches->log_id) ?></h3>
	<p>
		<strong>Query Id</strong>: <?php echo $searches->query_id; ?><br />
		<strong>Lock</strong>: <?php echo $searches->lock; ?><br />
		<strong>Text</strong>: <?php echo $searches->text; ?><br />
		<strong>Total</strong>: <?php echo $searches->total; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('searchesController::editForm', $searches->log_id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>