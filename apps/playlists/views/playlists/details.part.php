<?php
Part::input($playlists, 'playlists');
?>
<form method="POST" action="<?php echo Url::action('playlistsController::delete', $playlists->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('playlistsController::details', $playlists->id), 'playlists #' . $playlists->id) ?></h3>
	<p>
		<strong>Folder Id</strong>: <?php echo $playlists->folder_id; ?><br />
		<strong>Path</strong>: <?php echo $playlists->path; ?><br />
		<strong>Type</strong>: <?php echo $playlists->type; ?><br />
		<strong>Name</strong>: <?php echo $playlists->name; ?><br />
		<strong>Title</strong>: <?php echo $playlists->title; ?><br />
		<strong>Episode</strong>: <?php echo $playlists->episode; ?><br />
		<strong>Episode No</strong>: <?php echo $playlists->episode_no; ?><br />
		<strong>Production No</strong>: <?php echo $playlists->production_no; ?><br />
		<strong>Airdate</strong>: <?php echo date(DATE_ISO8601,$playlists->airdate); ?><br />
		<strong>Length</strong>: <?php echo date(DATE_ISO8601,$playlists->length); ?><br />
		<strong>Program Type</strong>: <?php echo $playlists->program_type; ?><br />
		<strong>Version Type</strong>: <?php echo $playlists->version_type; ?><br />
		<strong>Job No</strong>: <?php echo $playlists->job_no; ?><br />
		<strong>Station</strong>: <?php echo $playlists->station; ?><br />
		<strong>Producer</strong>: <?php echo $playlists->producer; ?><br />
		<strong>Distributor</strong>: <?php echo $playlists->distributor; ?><br />
		<strong>Director</strong>: <?php echo $playlists->director; ?><br />
		<strong>Isci</strong>: <?php echo $playlists->isci; ?><br />
		<strong>Contact</strong>: <?php echo $playlists->contact; ?><br />
		<strong>Contact Type</strong>: <?php echo $playlists->contact_type; ?><br />
		<strong>Notes</strong>: <?php echo $playlists->notes; ?><br />
		<strong>Created</strong>: <?php echo date(DATE_ISO8601,$playlists->created); ?><br />
		<strong>Updated</strong>: <?php echo date(DATE_ISO8601,$playlists->updated); ?><br />
		<strong>Updated By</strong>: <?php echo $playlists->updated_by; ?><br />
		<strong>Orig Id</strong>: <?php echo $playlists->orig_id; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('playlistsController::editForm', $playlists->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>