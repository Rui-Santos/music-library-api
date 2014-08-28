<?php
Part::input($prosfxassets, 'prosfxassets');
?>
<form method="POST" action="<?php echo Url::action('prosfxassetsController::delete', $prosfxassets->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('prosfxassetsController::details', $prosfxassets->id), 'prosfxassets #' . $prosfxassets->id) ?></h3>
	<p>
		<strong>Db Id</strong>: <?php echo $prosfxassets->db_id; ?><br />
		<strong>Track Id</strong>: <?php echo $prosfxassets->track_id; ?><br />
		<strong>Asset Key</strong>: <?php echo $prosfxassets->asset_key; ?><br />
		<strong>Filename</strong>: <?php echo $prosfxassets->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $prosfxassets->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $prosfxassets->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $prosfxassets->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $prosfxassets->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$prosfxassets->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$prosfxassets->ModificationDate); ?><br />
		<strong>Track Title</strong>: <?php echo $prosfxassets->TrackTitle; ?><br />
		<strong>Composer</strong>: <?php echo $prosfxassets->Composer; ?><br />
		<strong>Publisher</strong>: <?php echo $prosfxassets->Publisher; ?><br />
		<strong>Rec I D</strong>: <?php echo $prosfxassets->RecID; ?><br />
		<strong>Total Frames</strong>: <?php echo $prosfxassets->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $prosfxassets->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $prosfxassets->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $prosfxassets->Split; ?><br />
		<strong>Rating</strong>: <?php echo $prosfxassets->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $prosfxassets->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $prosfxassets->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $prosfxassets->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $prosfxassets->ChannelLayout; ?><br />
		<strong>Flat Category</strong>: <?php echo $prosfxassets->_FlatCategory; ?><br />
		<strong>Waveform Link</strong>: <?php echo $prosfxassets->_WaveformLink; ?><br />
		<strong>Picture Link</strong>: <?php echo $prosfxassets->_PictureLink; ?><br />
		<strong>U M I D</strong>: <?php echo $prosfxassets->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$prosfxassets->Time); ?><br />
		<strong>Volume</strong>: <?php echo $prosfxassets->Volume; ?><br />
		<strong>Track</strong>: <?php echo $prosfxassets->Track; ?><br />
		<strong>Index</strong>: <?php echo $prosfxassets->Index; ?><br />
		<strong>Dirty</strong>: <?php echo $prosfxassets->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $prosfxassets->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $prosfxassets->Description; ?><br />
		<strong>Source</strong>: <?php echo $prosfxassets->Source; ?><br />
		<strong>Category</strong>: <?php echo $prosfxassets->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $prosfxassets->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $prosfxassets->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $prosfxassets->Notes; ?><br />
		<strong>Show</strong>: <?php echo $prosfxassets->Show; ?><br />
		<strong>Library</strong>: <?php echo $prosfxassets->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $prosfxassets->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $prosfxassets->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $prosfxassets->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $prosfxassets->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $prosfxassets->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $prosfxassets->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $prosfxassets->Microphone; ?><br />
		<strong>Arranger</strong>: <?php echo $prosfxassets->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $prosfxassets->Conductor; ?><br />
		<strong>Performer</strong>: <?php echo $prosfxassets->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $prosfxassets->BPM; ?><br />
		<strong>Key</strong>: <?php echo $prosfxassets->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $prosfxassets->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $prosfxassets->Designer; ?><br />
		<strong>C D Title</strong>: <?php echo $prosfxassets->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $prosfxassets->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $prosfxassets->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $prosfxassets->Scene; ?><br />
		<strong>Take</strong>: <?php echo $prosfxassets->Take; ?><br />
		<strong>Tape</strong>: <?php echo $prosfxassets->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $prosfxassets->Mood; ?><br />
		<strong>Version</strong>: <?php echo $prosfxassets->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $prosfxassets->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $prosfxassets->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $prosfxassets->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $prosfxassets->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $prosfxassets->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $prosfxassets->BWDate; ?><br />
		<strong>Split Channels</strong>: <?php echo $prosfxassets->SplitChannels; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('prosfxassetsController::editForm', $prosfxassets->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>