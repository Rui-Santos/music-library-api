<?php
Part::input($downloadassets, 'downloadassets');
?>
<form method="POST" action="<?php echo Url::action('downloadassetsController::delete', $downloadassets->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('downloadassetsController::details', $downloadassets->id), 'downloadassets #' . $downloadassets->id) ?></h3>
	<p>
		<strong>Db Id</strong>: <?php echo $downloadassets->db_id; ?><br />
		<strong>Track Id</strong>: <?php echo $downloadassets->track_id; ?><br />
		<strong>Asset Key</strong>: <?php echo $downloadassets->asset_key; ?><br />
		<strong>Filename</strong>: <?php echo $downloadassets->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $downloadassets->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $downloadassets->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $downloadassets->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $downloadassets->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$downloadassets->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$downloadassets->ModificationDate); ?><br />
		<strong>Track Title</strong>: <?php echo $downloadassets->TrackTitle; ?><br />
		<strong>Composer</strong>: <?php echo $downloadassets->Composer; ?><br />
		<strong>Publisher</strong>: <?php echo $downloadassets->Publisher; ?><br />
		<strong>Rec I D</strong>: <?php echo $downloadassets->RecID; ?><br />
		<strong>Total Frames</strong>: <?php echo $downloadassets->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $downloadassets->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $downloadassets->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $downloadassets->Split; ?><br />
		<strong>Rating</strong>: <?php echo $downloadassets->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $downloadassets->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $downloadassets->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $downloadassets->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $downloadassets->ChannelLayout; ?><br />
		<strong>Flat Category</strong>: <?php echo $downloadassets->_FlatCategory; ?><br />
		<strong>Waveform Link</strong>: <?php echo $downloadassets->_WaveformLink; ?><br />
		<strong>Picture Link</strong>: <?php echo $downloadassets->_PictureLink; ?><br />
		<strong>U M I D</strong>: <?php echo $downloadassets->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$downloadassets->Time); ?><br />
		<strong>Volume</strong>: <?php echo $downloadassets->Volume; ?><br />
		<strong>Track</strong>: <?php echo $downloadassets->Track; ?><br />
		<strong>Index</strong>: <?php echo $downloadassets->Index; ?><br />
		<strong>Dirty</strong>: <?php echo $downloadassets->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $downloadassets->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $downloadassets->Description; ?><br />
		<strong>Source</strong>: <?php echo $downloadassets->Source; ?><br />
		<strong>Category</strong>: <?php echo $downloadassets->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $downloadassets->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $downloadassets->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $downloadassets->Notes; ?><br />
		<strong>Show</strong>: <?php echo $downloadassets->Show; ?><br />
		<strong>Library</strong>: <?php echo $downloadassets->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $downloadassets->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $downloadassets->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $downloadassets->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $downloadassets->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $downloadassets->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $downloadassets->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $downloadassets->Microphone; ?><br />
		<strong>Arranger</strong>: <?php echo $downloadassets->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $downloadassets->Conductor; ?><br />
		<strong>Performer</strong>: <?php echo $downloadassets->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $downloadassets->BPM; ?><br />
		<strong>Key</strong>: <?php echo $downloadassets->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $downloadassets->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $downloadassets->Designer; ?><br />
		<strong>C D Title</strong>: <?php echo $downloadassets->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $downloadassets->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $downloadassets->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $downloadassets->Scene; ?><br />
		<strong>Take</strong>: <?php echo $downloadassets->Take; ?><br />
		<strong>Tape</strong>: <?php echo $downloadassets->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $downloadassets->Mood; ?><br />
		<strong>Version</strong>: <?php echo $downloadassets->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $downloadassets->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $downloadassets->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $downloadassets->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $downloadassets->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $downloadassets->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $downloadassets->BWDate; ?><br />
		<strong>Split Channels</strong>: <?php echo $downloadassets->SplitChannels; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('downloadassetsController::editForm', $downloadassets->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>