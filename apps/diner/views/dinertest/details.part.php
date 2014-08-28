<?php
Part::input($dinertest, 'dinertest');
?>
<form method="POST" action="<?php echo Url::action('dinertestController::delete', $dinertest->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('dinertestController::details', $dinertest->RecID), 'dinertest #' . $dinertest->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $dinertest->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $dinertest->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $dinertest->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $dinertest->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $dinertest->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$dinertest->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$dinertest->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $dinertest->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $dinertest->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $dinertest->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $dinertest->Split; ?><br />
		<strong>Rating</strong>: <?php echo $dinertest->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $dinertest->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $dinertest->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $dinertest->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $dinertest->ChannelLayout; ?><br />
		<strong>Flat Category</strong>: <?php echo $dinertest->_FlatCategory; ?><br />
		<strong>Waveform Link</strong>: <?php echo $dinertest->_WaveformLink; ?><br />
		<strong>Picture Link</strong>: <?php echo $dinertest->_PictureLink; ?><br />
		<strong>U M I D</strong>: <?php echo $dinertest->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$dinertest->Time); ?><br />
		<strong>Volume</strong>: <?php echo $dinertest->Volume; ?><br />
		<strong>Track</strong>: <?php echo $dinertest->Track; ?><br />
		<strong>Index</strong>: <?php echo $dinertest->Index; ?><br />
		<strong>Dirty</strong>: <?php echo $dinertest->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $dinertest->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $dinertest->Description; ?><br />
		<strong>Source</strong>: <?php echo $dinertest->Source; ?><br />
		<strong>Category</strong>: <?php echo $dinertest->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $dinertest->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $dinertest->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $dinertest->Notes; ?><br />
		<strong>Show</strong>: <?php echo $dinertest->Show; ?><br />
		<strong>Library</strong>: <?php echo $dinertest->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $dinertest->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $dinertest->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $dinertest->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $dinertest->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $dinertest->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $dinertest->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $dinertest->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $dinertest->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $dinertest->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $dinertest->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $dinertest->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $dinertest->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $dinertest->BPM; ?><br />
		<strong>Key</strong>: <?php echo $dinertest->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $dinertest->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $dinertest->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $dinertest->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $dinertest->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $dinertest->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $dinertest->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $dinertest->Scene; ?><br />
		<strong>Take</strong>: <?php echo $dinertest->Take; ?><br />
		<strong>Tape</strong>: <?php echo $dinertest->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $dinertest->Mood; ?><br />
		<strong>Version</strong>: <?php echo $dinertest->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $dinertest->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $dinertest->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $dinertest->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $dinertest->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $dinertest->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $dinertest->BWDate; ?><br />
		<strong>assetID</strong>: <?php echo $dinertest->getAssetID(); ?><br />

	</p>
	<?php echo Html::anchor(Url::action('dinertestController::editForm', $dinertest->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>