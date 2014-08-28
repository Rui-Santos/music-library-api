<?php
Part::input($logpurchasedtracks, 'logpurchasedtracks');
?>
<form method="POST" action="<?php echo Url::action('logpurchasedtracksController::delete', $logpurchasedtracks->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('logpurchasedtracksController::details', $logpurchasedtracks->id), 'logpurchasedtracks #' . $logpurchasedtracks->id) ?></h3>
	<p>
		<strong>Purchase Id</strong>: <?php echo $logpurchasedtracks->purchase_id; ?><br />
		<strong>Asset Id</strong>: <?php echo $logpurchasedtracks->asset_id; ?><br />
		<strong>User Id</strong>: <?php echo $logpurchasedtracks->user_id; ?><br />
		<strong>Db Id</strong>: <?php echo $logpurchasedtracks->db_id; ?><br />
		<strong>Created</strong>: <?php echo date(DATE_ISO8601,$logpurchasedtracks->created); ?><br />

	</p>
	<?php echo Html::anchor(Url::action('logpurchasedtracksController::editForm', $logpurchasedtracks->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>