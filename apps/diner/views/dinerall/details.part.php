<?php
Part::input($dinerall, 'dinerall');
?>
<form method="POST" action="<?php echo Url::action('dinerallController::delete', $dinerall->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('dinerallController::details', $dinerall->RecID), 'dinerall #' . $dinerall->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $dinerall->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $dinerall->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $dinerall->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $dinerall->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $dinerall->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$dinerall->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$dinerall->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $dinerall->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $dinerall->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $dinerall->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $dinerall->Split; ?><br />
		<strong>Rating</strong>: <?php echo $dinerall->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $dinerall->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $dinerall->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $dinerall->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $dinerall->ChannelLayout; ?><br />
		<strong>Flat Category</strong>: <?php echo $dinerall->_FlatCategory; ?><br />
		<strong>Waveform Link</strong>: <?php echo $dinerall->_WaveformLink; ?><br />
		<strong>Picture Link</strong>: <?php echo $dinerall->_PictureLink; ?><br />
		<strong>U M I D</strong>: <?php echo $dinerall->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$dinerall->Time); ?><br />
		<strong>Volume</strong>: <?php echo $dinerall->Volume; ?><br />
		<strong>Track</strong>: <?php echo $dinerall->Track; ?><br />
		<strong>Index</strong>: <?php echo $dinerall->Index; ?><br />
		<strong>Dirty</strong>: <?php echo $dinerall->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $dinerall->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $dinerall->Description; ?><br />
		<strong>Source</strong>: <?php echo $dinerall->Source; ?><br />
		<strong>Category</strong>: <?php echo $dinerall->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $dinerall->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $dinerall->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $dinerall->Notes; ?><br />
		<strong>Show</strong>: <?php echo $dinerall->Show; ?><br />
		<strong>Library</strong>: <?php echo $dinerall->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $dinerall->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $dinerall->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $dinerall->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $dinerall->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $dinerall->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $dinerall->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $dinerall->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $dinerall->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $dinerall->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $dinerall->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $dinerall->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $dinerall->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $dinerall->BPM; ?><br />
		<strong>Key</strong>: <?php echo $dinerall->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $dinerall->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $dinerall->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $dinerall->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $dinerall->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $dinerall->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $dinerall->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $dinerall->Scene; ?><br />
		<strong>Take</strong>: <?php echo $dinerall->Take; ?><br />
		<strong>Tape</strong>: <?php echo $dinerall->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $dinerall->Mood; ?><br />
		<strong>Version</strong>: <?php echo $dinerall->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $dinerall->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $dinerall->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $dinerall->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $dinerall->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $dinerall->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $dinerall->BWDate; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('dinerallController::editForm', $dinerall->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>