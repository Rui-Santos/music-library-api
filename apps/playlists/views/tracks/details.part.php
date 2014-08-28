<?php
Part::input($tracks, 'tracks');
?>
<form method="POST" action="<?php echo Url::action('tracksController::delete', $tracks->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('tracksController::details', $tracks->id), 'tracks #' . $tracks->id) ?></h3>
	<p>
		<strong>Playlist Id</strong>: <?php echo $tracks->playlist_id; ?><br />
		<strong>Path</strong>: <?php echo $tracks->path; ?><br />
		<strong>Asset Id</strong>: <?php echo $tracks->asset_id; ?><br />
		<strong>Db Id</strong>: <?php echo $tracks->db_id; ?><br />
		<strong>Track Id</strong>: <?php echo $tracks->track_id; ?><br />
		<strong>Ndx</strong>: <?php echo $tracks->ndx; ?><br />
		<strong>Usage</strong>: <?php echo $tracks->usage; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$tracks->time); ?><br />
		<strong>Created</strong>: <?php echo date(DATE_ISO8601,$tracks->created); ?><br />
		<strong>Updated</strong>: <?php echo date(DATE_ISO8601,$tracks->updated); ?><br />
		<strong>Updated By</strong>: <?php echo $tracks->updated_by; ?><br />
		<strong>Orig Id</strong>: <?php echo $tracks->orig_id; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('tracksController::editForm', $tracks->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>