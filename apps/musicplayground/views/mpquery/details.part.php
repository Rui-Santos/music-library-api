<?php
Part::input($mpquery, 'mpquery');
?>
<form method="POST" action="<?php echo Url::action('mpqueryController::delete', $mpquery->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('mpqueryController::details', $mpquery->RecID), 'mpquery #' . $mpquery->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $mpquery->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $mpquery->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $mpquery->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $mpquery->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $mpquery->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$mpquery->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$mpquery->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $mpquery->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $mpquery->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $mpquery->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $mpquery->Split; ?><br />
		<strong>Rating</strong>: <?php echo $mpquery->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $mpquery->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $mpquery->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $mpquery->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $mpquery->ChannelLayout; ?><br />
		<strong>_ Flat Category</strong>: <?php echo $mpquery->_FlatCategory; ?><br />
		<strong>_ Waveform Link</strong>: <?php echo $mpquery->_WaveformLink; ?><br />
		<strong>_ Picture Link</strong>: <?php echo $mpquery->_PictureLink; ?><br />
		<strong>_ U M I D</strong>: <?php echo $mpquery->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$mpquery->Time); ?><br />
		<strong>Volume</strong>: <?php echo $mpquery->Volume; ?><br />
		<strong>Track</strong>: <?php echo $mpquery->Track; ?><br />
		<strong>Index</strong>: <?php echo $mpquery->Index; ?><br />
		<strong>_ Dirty</strong>: <?php echo $mpquery->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $mpquery->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $mpquery->Description; ?><br />
		<strong>Source</strong>: <?php echo $mpquery->Source; ?><br />
		<strong>Category</strong>: <?php echo $mpquery->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $mpquery->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $mpquery->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $mpquery->Notes; ?><br />
		<strong>Show</strong>: <?php echo $mpquery->Show; ?><br />
		<strong>Library</strong>: <?php echo $mpquery->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $mpquery->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $mpquery->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $mpquery->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $mpquery->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $mpquery->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $mpquery->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $mpquery->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $mpquery->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $mpquery->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $mpquery->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $mpquery->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $mpquery->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $mpquery->BPM; ?><br />
		<strong>Key</strong>: <?php echo $mpquery->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $mpquery->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $mpquery->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $mpquery->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $mpquery->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $mpquery->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $mpquery->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $mpquery->Scene; ?><br />
		<strong>Take</strong>: <?php echo $mpquery->Take; ?><br />
		<strong>Tape</strong>: <?php echo $mpquery->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $mpquery->Mood; ?><br />
		<strong>Version</strong>: <?php echo $mpquery->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $mpquery->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $mpquery->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $mpquery->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $mpquery->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $mpquery->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $mpquery->BWDate; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('mpqueryController::editForm', $mpquery->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>