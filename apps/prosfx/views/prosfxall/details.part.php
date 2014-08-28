<?php
Part::input($prosfxall, 'prosfxall');
?>
<form method="POST" action="<?php echo Url::action('prosfxallController::delete', $prosfxall->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('prosfxallController::details', $prosfxall->RecID), 'prosfxall #' . $prosfxall->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $prosfxall->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $prosfxall->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $prosfxall->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $prosfxall->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $prosfxall->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$prosfxall->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$prosfxall->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $prosfxall->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $prosfxall->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $prosfxall->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $prosfxall->Split; ?><br />
		<strong>Rating</strong>: <?php echo $prosfxall->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $prosfxall->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $prosfxall->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $prosfxall->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $prosfxall->ChannelLayout; ?><br />
		<strong>Flat Category</strong>: <?php echo $prosfxall->_FlatCategory; ?><br />
		<strong>Waveform Link</strong>: <?php echo $prosfxall->_WaveformLink; ?><br />
		<strong>Picture Link</strong>: <?php echo $prosfxall->_PictureLink; ?><br />
		<strong>U M I D</strong>: <?php echo $prosfxall->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$prosfxall->Time); ?><br />
		<strong>Volume</strong>: <?php echo $prosfxall->Volume; ?><br />
		<strong>Track</strong>: <?php echo $prosfxall->Track; ?><br />
		<strong>Index</strong>: <?php echo $prosfxall->Index; ?><br />
		<strong>Dirty</strong>: <?php echo $prosfxall->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $prosfxall->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $prosfxall->Description; ?><br />
		<strong>Source</strong>: <?php echo $prosfxall->Source; ?><br />
		<strong>Category</strong>: <?php echo $prosfxall->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $prosfxall->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $prosfxall->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $prosfxall->Notes; ?><br />
		<strong>Show</strong>: <?php echo $prosfxall->Show; ?><br />
		<strong>Library</strong>: <?php echo $prosfxall->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $prosfxall->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $prosfxall->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $prosfxall->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $prosfxall->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $prosfxall->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $prosfxall->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $prosfxall->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $prosfxall->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $prosfxall->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $prosfxall->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $prosfxall->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $prosfxall->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $prosfxall->BPM; ?><br />
		<strong>Key</strong>: <?php echo $prosfxall->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $prosfxall->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $prosfxall->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $prosfxall->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $prosfxall->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $prosfxall->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $prosfxall->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $prosfxall->Scene; ?><br />
		<strong>Take</strong>: <?php echo $prosfxall->Take; ?><br />
		<strong>Tape</strong>: <?php echo $prosfxall->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $prosfxall->Mood; ?><br />
		<strong>Version</strong>: <?php echo $prosfxall->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $prosfxall->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $prosfxall->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $prosfxall->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $prosfxall->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $prosfxall->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $prosfxall->BWDate; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('prosfxallController::editForm', $prosfxall->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>