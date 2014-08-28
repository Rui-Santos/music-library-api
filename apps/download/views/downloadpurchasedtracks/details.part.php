<?php
Part::input($downloadpurchasedtracks, 'downloadpurchasedtracks');
?>
<form method="POST" action="<?php echo Url::action('downloadpurchasedtracksController::delete', $downloadpurchasedtracks->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('downloadpurchasedtracksController::details', $downloadpurchasedtracks->id), 'downloadpurchasedtracks #' . $downloadpurchasedtracks->id) ?></h3>
	<p>
		<strong>Purchase Id</strong>: <?php echo $downloadpurchasedtracks->purchase_id; ?><br />
		<strong>Asset Id</strong>: <?php echo $downloadpurchasedtracks->asset_id; ?><br />
		<strong>User Id</strong>: <?php echo $downloadpurchasedtracks->user_id; ?><br />
		<strong>Db Id</strong>: <?php echo $downloadpurchasedtracks->db_id; ?><br />
		<strong>Created</strong>: <?php echo date(DATE_ISO8601,$downloadpurchasedtracks->created); ?><br />

	</p>
	<?php echo Html::anchor(Url::action('downloadpurchasedtracksController::editForm', $downloadpurchasedtracks->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>