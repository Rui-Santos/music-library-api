<?php
Part::input($downloadplaylists, 'downloadplaylists');
?>
<form method="POST" action="<?php echo Url::action('downloadplaylistsController::delete', $downloadplaylists->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('downloadplaylistsController::details', $downloadplaylists->id), 'downloadplaylists #' . $downloadplaylists->id) ?></h3>
	<p>
		<strong>Folder Id</strong>: <?php echo $downloadplaylists->folder_id; ?><br />
		<strong>Path</strong>: <?php echo $downloadplaylists->path; ?><br />
		<strong>Type</strong>: <?php echo $downloadplaylists->type; ?><br />
		<strong>Name</strong>: <?php echo $downloadplaylists->name; ?><br />
		<strong>Title</strong>: <?php echo $downloadplaylists->title; ?><br />
		<strong>Episode</strong>: <?php echo $downloadplaylists->episode; ?><br />
		<strong>Episode No</strong>: <?php echo $downloadplaylists->episode_no; ?><br />
		<strong>Production No</strong>: <?php echo $downloadplaylists->production_no; ?><br />
		<strong>Airdate</strong>: <?php echo date(DATE_ISO8601,$downloadplaylists->airdate); ?><br />
		<strong>Length</strong>: <?php echo date(DATE_ISO8601,$downloadplaylists->length); ?><br />
		<strong>Program Type</strong>: <?php echo $downloadplaylists->program_type; ?><br />
		<strong>Version Type</strong>: <?php echo $downloadplaylists->version_type; ?><br />
		<strong>Job No</strong>: <?php echo $downloadplaylists->job_no; ?><br />
		<strong>Station</strong>: <?php echo $downloadplaylists->station; ?><br />
		<strong>Producer</strong>: <?php echo $downloadplaylists->producer; ?><br />
		<strong>Distributor</strong>: <?php echo $downloadplaylists->distributor; ?><br />
		<strong>Director</strong>: <?php echo $downloadplaylists->director; ?><br />
		<strong>Isci</strong>: <?php echo $downloadplaylists->isci; ?><br />
		<strong>Contact</strong>: <?php echo $downloadplaylists->contact; ?><br />
		<strong>Contact Type</strong>: <?php echo $downloadplaylists->contact_type; ?><br />
		<strong>Notes</strong>: <?php echo $downloadplaylists->notes; ?><br />
		<strong>Created</strong>: <?php echo date(DATE_ISO8601,$downloadplaylists->created); ?><br />
		<strong>Updated</strong>: <?php echo date(DATE_ISO8601,$downloadplaylists->updated); ?><br />
		<strong>Updated By</strong>: <?php echo $downloadplaylists->updated_by; ?><br />
		<strong>Orig Id</strong>: <?php echo $downloadplaylists->orig_id; ?><br />
		<strong>Hash</strong>: <?php echo $downloadplaylists->hash; ?><br />
		<strong>Source</strong>: <?php echo $downloadplaylists->source; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('downloadplaylistsController::editForm', $downloadplaylists->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>