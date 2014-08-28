<?php
Part::input($prosfxquery, 'prosfxquery');
?>
<form method="POST" action="<?php echo Url::action('prosfxqueryController::delete', $prosfxquery->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('prosfxqueryController::details', $prosfxquery->RecID), 'prosfxquery #' . $prosfxquery->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $prosfxquery->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $prosfxquery->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $prosfxquery->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $prosfxquery->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $prosfxquery->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$prosfxquery->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$prosfxquery->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $prosfxquery->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $prosfxquery->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $prosfxquery->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $prosfxquery->Split; ?><br />
		<strong>Rating</strong>: <?php echo $prosfxquery->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $prosfxquery->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $prosfxquery->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $prosfxquery->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $prosfxquery->ChannelLayout; ?><br />
		<strong>Flat Category</strong>: <?php echo $prosfxquery->_FlatCategory; ?><br />
		<strong>Waveform Link</strong>: <?php echo $prosfxquery->_WaveformLink; ?><br />
		<strong>Picture Link</strong>: <?php echo $prosfxquery->_PictureLink; ?><br />
		<strong>U M I D</strong>: <?php echo $prosfxquery->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$prosfxquery->Time); ?><br />
		<strong>Volume</strong>: <?php echo $prosfxquery->Volume; ?><br />
		<strong>Track</strong>: <?php echo $prosfxquery->Track; ?><br />
		<strong>Index</strong>: <?php echo $prosfxquery->Index; ?><br />
		<strong>Dirty</strong>: <?php echo $prosfxquery->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $prosfxquery->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $prosfxquery->Description; ?><br />
		<strong>Source</strong>: <?php echo $prosfxquery->Source; ?><br />
		<strong>Category</strong>: <?php echo $prosfxquery->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $prosfxquery->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $prosfxquery->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $prosfxquery->Notes; ?><br />
		<strong>Show</strong>: <?php echo $prosfxquery->Show; ?><br />
		<strong>Library</strong>: <?php echo $prosfxquery->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $prosfxquery->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $prosfxquery->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $prosfxquery->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $prosfxquery->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $prosfxquery->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $prosfxquery->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $prosfxquery->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $prosfxquery->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $prosfxquery->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $prosfxquery->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $prosfxquery->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $prosfxquery->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $prosfxquery->BPM; ?><br />
		<strong>Key</strong>: <?php echo $prosfxquery->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $prosfxquery->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $prosfxquery->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $prosfxquery->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $prosfxquery->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $prosfxquery->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $prosfxquery->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $prosfxquery->Scene; ?><br />
		<strong>Take</strong>: <?php echo $prosfxquery->Take; ?><br />
		<strong>Tape</strong>: <?php echo $prosfxquery->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $prosfxquery->Mood; ?><br />
		<strong>Version</strong>: <?php echo $prosfxquery->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $prosfxquery->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $prosfxquery->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $prosfxquery->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $prosfxquery->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $prosfxquery->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $prosfxquery->BWDate; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('prosfxqueryController::editForm', $prosfxquery->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>