<?php
Part::input($mpartists, 'mpartists');
?>
<form method="POST" action="<?php echo Url::action('mpartistsController::delete', $mpartists->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('mpartistsController::details', $mpartists->RecID), 'mpartists #' . $mpartists->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $mpartists->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $mpartists->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $mpartists->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $mpartists->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $mpartists->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$mpartists->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$mpartists->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $mpartists->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $mpartists->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $mpartists->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $mpartists->Split; ?><br />
		<strong>Rating</strong>: <?php echo $mpartists->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $mpartists->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $mpartists->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $mpartists->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $mpartists->ChannelLayout; ?><br />
		<strong>_ Flat Category</strong>: <?php echo $mpartists->_FlatCategory; ?><br />
		<strong>_ Waveform Link</strong>: <?php echo $mpartists->_WaveformLink; ?><br />
		<strong>_ Picture Link</strong>: <?php echo $mpartists->_PictureLink; ?><br />
		<strong>_ U M I D</strong>: <?php echo $mpartists->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$mpartists->Time); ?><br />
		<strong>Volume</strong>: <?php echo $mpartists->Volume; ?><br />
		<strong>Track</strong>: <?php echo $mpartists->Track; ?><br />
		<strong>Index</strong>: <?php echo $mpartists->Index; ?><br />
		<strong>_ Dirty</strong>: <?php echo $mpartists->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $mpartists->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $mpartists->Description; ?><br />
		<strong>Source</strong>: <?php echo $mpartists->Source; ?><br />
		<strong>Category</strong>: <?php echo $mpartists->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $mpartists->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $mpartists->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $mpartists->Notes; ?><br />
		<strong>Show</strong>: <?php echo $mpartists->Show; ?><br />
		<strong>Library</strong>: <?php echo $mpartists->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $mpartists->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $mpartists->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $mpartists->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $mpartists->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $mpartists->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $mpartists->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $mpartists->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $mpartists->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $mpartists->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $mpartists->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $mpartists->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $mpartists->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $mpartists->BPM; ?><br />
		<strong>Key</strong>: <?php echo $mpartists->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $mpartists->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $mpartists->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $mpartists->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $mpartists->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $mpartists->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $mpartists->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $mpartists->Scene; ?><br />
		<strong>Take</strong>: <?php echo $mpartists->Take; ?><br />
		<strong>Tape</strong>: <?php echo $mpartists->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $mpartists->Mood; ?><br />
		<strong>Version</strong>: <?php echo $mpartists->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $mpartists->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $mpartists->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $mpartists->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $mpartists->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $mpartists->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $mpartists->BWDate; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('mpartistsController::editForm', $mpartists->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>