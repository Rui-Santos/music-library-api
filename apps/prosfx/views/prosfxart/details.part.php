<?php
Part::input($prosfxart, 'prosfxart');
?>
<form method="POST" action="<?php echo Url::action('prosfxartController::delete', $prosfxart->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('prosfxartController::details', $prosfxart->RecID), 'prosfxart #' . $prosfxart->RecID) ?></h3>
	<p>
		<strong>Hash</strong>: <?php echo $prosfxart->hash; ?><br />
		<strong>Picture</strong>: <?php echo $prosfxart->Picture; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('prosfxartController::editForm', $prosfxart->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>