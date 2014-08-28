<?php
Part::input($downloads, 'downloads');
?>
<form method="POST" action="<?php echo Url::action('downloadsController::delete', $downloads->log_id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('downloadsController::details', $downloads->log_id), 'downloads #' . $downloads->log_id) ?></h3>
	<p>
		<strong>Asset Id</strong>: <?php echo $downloads->asset_id; ?><br />
		<strong>Db Id</strong>: <?php echo $downloads->db_id; ?><br />
		<strong>Track Id</strong>: <?php echo $downloads->track_id; ?><br />
		<strong>File Path</strong>: <?php echo $downloads->file_path; ?><br />
		<strong>File Size</strong>: <?php echo $downloads->file_size; ?><br />
		<strong>File Type</strong>: <?php echo $downloads->file_type; ?><br />
		<strong>Completed</strong>: <?php echo $downloads->completed; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('downloadsController::editForm', $downloads->log_id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>