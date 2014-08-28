<?php
Part::input($downloadtracks, 'downloadtracks');
?>
<form method="POST" action="<?php echo Url::action('downloadtracksController::delete', $downloadtracks->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('downloadtracksController::details', $downloadtracks->id), 'downloadtracks #' . $downloadtracks->id) ?></h3>
	<p>
		<strong>Playlist Id</strong>: <?php echo $downloadtracks->playlist_id; ?><br />
		<strong>Path</strong>: <?php echo $downloadtracks->path; ?><br />
		<strong>Asset Id</strong>: <?php echo $downloadtracks->asset_id; ?><br />
		<strong>Db Id</strong>: <?php echo $downloadtracks->db_id; ?><br />
		<strong>Track Id</strong>: <?php echo $downloadtracks->track_id; ?><br />
		<strong>Ndx</strong>: <?php echo $downloadtracks->ndx; ?><br />
		<strong>Usage</strong>: <?php echo $downloadtracks->usage; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$downloadtracks->time); ?><br />
		<strong>Created</strong>: <?php echo date(DATE_ISO8601,$downloadtracks->created); ?><br />
		<strong>Updated</strong>: <?php echo date(DATE_ISO8601,$downloadtracks->updated); ?><br />
		<strong>Updated By</strong>: <?php echo $downloadtracks->updated_by; ?><br />
		<strong>Orig Id</strong>: <?php echo $downloadtracks->orig_id; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('downloadtracksController::editForm', $downloadtracks->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>