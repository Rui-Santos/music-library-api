<?php
Part::input($downloadpurchase, 'downloadpurchase');
?>
<form method="POST" action="<?php echo Url::action('downloadpurchaseController::delete', $downloadpurchase->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('downloadpurchaseController::details', $downloadpurchase->id), 'downloadpurchase #' . $downloadpurchase->id) ?></h3>
	<p>
		<strong>Log Id</strong>: <?php echo $downloadpurchase->log_id; ?><br />
		<strong>User Id</strong>: <?php echo $downloadpurchase->user_id; ?><br />
		<strong>Hash</strong>: <?php echo $downloadpurchase->hash; ?><br />
		<strong>Stripe Id</strong>: <?php echo $downloadpurchase->stripe_id; ?><br />
		<strong>Amount</strong>: <?php echo $downloadpurchase->amount; ?><br />
		<strong>Date</strong>: <?php echo date(DATE_ISO8601,$downloadpurchase->date); ?><br />

	</p>
	<?php echo Html::anchor(Url::action('downloadpurchaseController::editForm', $downloadpurchase->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>