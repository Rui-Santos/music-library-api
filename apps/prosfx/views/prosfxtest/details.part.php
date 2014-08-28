<?php
Part::input($prosfxtest, 'prosfxtest');
?>
<form method="POST" action="<?php echo Url::action('prosfxtestController::delete', $prosfxtest->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('prosfxtestController::details', $prosfxtest->RecID), 'prosfxtest #' . $prosfxtest->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $prosfxtest->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $prosfxtest->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $prosfxtest->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $prosfxtest->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $prosfxtest->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$prosfxtest->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$prosfxtest->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $prosfxtest->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $prosfxtest->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $prosfxtest->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $prosfxtest->Split; ?><br />
		<strong>Rating</strong>: <?php echo $prosfxtest->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $prosfxtest->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $prosfxtest->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $prosfxtest->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $prosfxtest->ChannelLayout; ?><br />
		<strong>Flat Category</strong>: <?php echo $prosfxtest->_FlatCategory; ?><br />
		<strong>Waveform Link</strong>: <?php echo $prosfxtest->_WaveformLink; ?><br />
		<strong>Picture Link</strong>: <?php echo $prosfxtest->_PictureLink; ?><br />
		<strong>U M I D</strong>: <?php echo $prosfxtest->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$prosfxtest->Time); ?><br />
		<strong>Volume</strong>: <?php echo $prosfxtest->Volume; ?><br />
		<strong>Track</strong>: <?php echo $prosfxtest->Track; ?><br />
		<strong>Index</strong>: <?php echo $prosfxtest->Index; ?><br />
		<strong>Dirty</strong>: <?php echo $prosfxtest->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $prosfxtest->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $prosfxtest->Description; ?><br />
		<strong>Source</strong>: <?php echo $prosfxtest->Source; ?><br />
		<strong>Category</strong>: <?php echo $prosfxtest->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $prosfxtest->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $prosfxtest->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $prosfxtest->Notes; ?><br />
		<strong>Show</strong>: <?php echo $prosfxtest->Show; ?><br />
		<strong>Library</strong>: <?php echo $prosfxtest->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $prosfxtest->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $prosfxtest->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $prosfxtest->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $prosfxtest->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $prosfxtest->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $prosfxtest->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $prosfxtest->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $prosfxtest->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $prosfxtest->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $prosfxtest->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $prosfxtest->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $prosfxtest->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $prosfxtest->BPM; ?><br />
		<strong>Key</strong>: <?php echo $prosfxtest->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $prosfxtest->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $prosfxtest->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $prosfxtest->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $prosfxtest->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $prosfxtest->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $prosfxtest->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $prosfxtest->Scene; ?><br />
		<strong>Take</strong>: <?php echo $prosfxtest->Take; ?><br />
		<strong>Tape</strong>: <?php echo $prosfxtest->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $prosfxtest->Mood; ?><br />
		<strong>Version</strong>: <?php echo $prosfxtest->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $prosfxtest->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $prosfxtest->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $prosfxtest->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $prosfxtest->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $prosfxtest->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $prosfxtest->BWDate; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('prosfxtestController::editForm', $prosfxtest->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>