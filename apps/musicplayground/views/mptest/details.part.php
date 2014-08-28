<?php
Part::input($mptest, 'mptest');
?>
<form method="POST" action="<?php echo Url::action('mptestController::delete', $mptest->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('mptestController::details', $mptest->RecID), 'mptest #' . $mptest->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $mptest->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $mptest->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $mptest->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $mptest->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $mptest->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$mptest->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$mptest->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $mptest->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $mptest->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $mptest->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $mptest->Split; ?><br />
		<strong>Rating</strong>: <?php echo $mptest->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $mptest->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $mptest->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $mptest->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $mptest->ChannelLayout; ?><br />
		<strong>_ Flat Category</strong>: <?php echo $mptest->_FlatCategory; ?><br />
		<strong>_ Waveform Link</strong>: <?php echo $mptest->_WaveformLink; ?><br />
		<strong>_ Picture Link</strong>: <?php echo $mptest->_PictureLink; ?><br />
		<strong>_ U M I D</strong>: <?php echo $mptest->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$mptest->Time); ?><br />
		<strong>Volume</strong>: <?php echo $mptest->Volume; ?><br />
		<strong>Track</strong>: <?php echo $mptest->Track; ?><br />
		<strong>Index</strong>: <?php echo $mptest->Index; ?><br />
		<strong>_ Dirty</strong>: <?php echo $mptest->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $mptest->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $mptest->Description; ?><br />
		<strong>Source</strong>: <?php echo $mptest->Source; ?><br />
		<strong>Category</strong>: <?php echo $mptest->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $mptest->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $mptest->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $mptest->Notes; ?><br />
		<strong>Show</strong>: <?php echo $mptest->Show; ?><br />
		<strong>Library</strong>: <?php echo $mptest->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $mptest->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $mptest->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $mptest->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $mptest->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $mptest->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $mptest->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $mptest->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $mptest->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $mptest->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $mptest->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $mptest->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $mptest->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $mptest->BPM; ?><br />
		<strong>Key</strong>: <?php echo $mptest->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $mptest->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $mptest->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $mptest->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $mptest->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $mptest->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $mptest->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $mptest->Scene; ?><br />
		<strong>Take</strong>: <?php echo $mptest->Take; ?><br />
		<strong>Tape</strong>: <?php echo $mptest->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $mptest->Mood; ?><br />
		<strong>Version</strong>: <?php echo $mptest->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $mptest->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $mptest->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $mptest->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $mptest->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $mptest->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $mptest->BWDate; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('mptestController::editForm', $mptest->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>