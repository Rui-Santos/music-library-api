<?php
Part::input($assets, 'assets');
?>
<form method="POST" action="<?php echo Url::action('assetsController::delete', $assets->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('assetsController::details', $assets->id), 'assets #' . $assets->id) ?></h3>
	<p>
		<strong>Db Id</strong>: <?php echo $assets->db_id; ?><br />
		<strong>Track Id</strong>: <?php echo $assets->track_id; ?><br />
		<strong>Asset Key</strong>: <?php echo $assets->asset_key; ?><br />
		<strong>Filename</strong>: <?php echo $assets->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $assets->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $assets->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $assets->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $assets->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$assets->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$assets->ModificationDate); ?><br />
		<strong>Track Title</strong>: <?php echo $assets->TrackTitle; ?><br />
		<strong>Composer</strong>: <?php echo $assets->Composer; ?><br />
		<strong>Publisher</strong>: <?php echo $assets->Publisher; ?><br />
		<strong>Rec I D</strong>: <?php echo $assets->RecID; ?><br />
		<strong>Total Frames</strong>: <?php echo $assets->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $assets->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $assets->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $assets->Split; ?><br />
		<strong>Rating</strong>: <?php echo $assets->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $assets->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $assets->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $assets->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $assets->ChannelLayout; ?><br />
		<strong>Flat Category</strong>: <?php echo $assets->_FlatCategory; ?><br />
		<strong>Waveform Link</strong>: <?php echo $assets->_WaveformLink; ?><br />
		<strong>Picture Link</strong>: <?php echo $assets->_PictureLink; ?><br />
		<strong>U M I D</strong>: <?php echo $assets->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$assets->Time); ?><br />
		<strong>Volume</strong>: <?php echo $assets->Volume; ?><br />
		<strong>Track</strong>: <?php echo $assets->Track; ?><br />
		<strong>Index</strong>: <?php echo $assets->Index; ?><br />
		<strong>Dirty</strong>: <?php echo $assets->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $assets->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $assets->Description; ?><br />
		<strong>Source</strong>: <?php echo $assets->Source; ?><br />
		<strong>Category</strong>: <?php echo $assets->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $assets->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $assets->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $assets->Notes; ?><br />
		<strong>Show</strong>: <?php echo $assets->Show; ?><br />
		<strong>Library</strong>: <?php echo $assets->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $assets->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $assets->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $assets->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $assets->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $assets->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $assets->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $assets->Microphone; ?><br />
		<strong>Arranger</strong>: <?php echo $assets->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $assets->Conductor; ?><br />
		<strong>Performer</strong>: <?php echo $assets->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $assets->BPM; ?><br />
		<strong>Key</strong>: <?php echo $assets->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $assets->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $assets->Designer; ?><br />
		<strong>C D Title</strong>: <?php echo $assets->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $assets->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $assets->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $assets->Scene; ?><br />
		<strong>Take</strong>: <?php echo $assets->Take; ?><br />
		<strong>Tape</strong>: <?php echo $assets->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $assets->Mood; ?><br />
		<strong>Version</strong>: <?php echo $assets->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $assets->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $assets->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $assets->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $assets->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $assets->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $assets->BWDate; ?><br />
		<strong>Split Channels</strong>: <?php echo $assets->SplitChannels; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('assetsController::editForm', $assets->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>