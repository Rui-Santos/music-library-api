<?php
Part::input($logpurchases, 'logpurchases');
?>
<form method="POST" action="<?php echo Url::action('logpurchasesController::delete', $logpurchases->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('logpurchasesController::details', $logpurchases->id), 'logpurchases #' . $logpurchases->id) ?></h3>
	<p>
		<strong>Log Id</strong>: <?php echo $logpurchases->log_id; ?><br />
		<strong>User Id</strong>: <?php echo $logpurchases->user_id; ?><br />
		<strong>Hash</strong>: <?php echo $logpurchases->hash; ?><br />
		<strong>Stripe Id</strong>: <?php echo $logpurchases->stripe_id; ?><br />
		<strong>Amount</strong>: <?php echo $logpurchases->amount; ?><br />
		<strong>Date</strong>: <?php echo date(DATE_ISO8601,$logpurchases->date); ?><br />

	</p>
	<?php echo Html::anchor(Url::action('logpurchasesController::editForm', $logpurchases->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>