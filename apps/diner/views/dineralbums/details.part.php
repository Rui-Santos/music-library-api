<?php
Part::input($dineralbums, 'dineralbums');
?>
<form method="POST" action="<?php echo Url::action('dineralbumsController::delete', $dineralbums->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('dineralbumsController::details', $dineralbums->RecID), 'dineralbums #' . $dineralbums->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $dineralbums->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $dineralbums->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $dineralbums->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $dineralbums->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $dineralbums->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$dineralbums->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$dineralbums->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $dineralbums->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $dineralbums->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $dineralbums->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $dineralbums->Split; ?><br />
		<strong>Rating</strong>: <?php echo $dineralbums->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $dineralbums->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $dineralbums->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $dineralbums->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $dineralbums->ChannelLayout; ?><br />
		<strong>Flat Category</strong>: <?php echo $dineralbums->_FlatCategory; ?><br />
		<strong>Waveform Link</strong>: <?php echo $dineralbums->_WaveformLink; ?><br />
		<strong>Picture Link</strong>: <?php echo $dineralbums->_PictureLink; ?><br />
		<strong>U M I D</strong>: <?php echo $dineralbums->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$dineralbums->Time); ?><br />
		<strong>Volume</strong>: <?php echo $dineralbums->Volume; ?><br />
		<strong>Track</strong>: <?php echo $dineralbums->Track; ?><br />
		<strong>Index</strong>: <?php echo $dineralbums->Index; ?><br />
		<strong>Dirty</strong>: <?php echo $dineralbums->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $dineralbums->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $dineralbums->Description; ?><br />
		<strong>Source</strong>: <?php echo $dineralbums->Source; ?><br />
		<strong>Category</strong>: <?php echo $dineralbums->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $dineralbums->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $dineralbums->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $dineralbums->Notes; ?><br />
		<strong>Show</strong>: <?php echo $dineralbums->Show; ?><br />
		<strong>Library</strong>: <?php echo $dineralbums->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $dineralbums->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $dineralbums->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $dineralbums->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $dineralbums->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $dineralbums->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $dineralbums->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $dineralbums->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $dineralbums->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $dineralbums->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $dineralbums->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $dineralbums->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $dineralbums->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $dineralbums->BPM; ?><br />
		<strong>Key</strong>: <?php echo $dineralbums->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $dineralbums->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $dineralbums->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $dineralbums->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $dineralbums->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $dineralbums->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $dineralbums->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $dineralbums->Scene; ?><br />
		<strong>Take</strong>: <?php echo $dineralbums->Take; ?><br />
		<strong>Tape</strong>: <?php echo $dineralbums->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $dineralbums->Mood; ?><br />
		<strong>Version</strong>: <?php echo $dineralbums->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $dineralbums->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $dineralbums->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $dineralbums->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $dineralbums->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $dineralbums->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $dineralbums->BWDate; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('dineralbumsController::editForm', $dineralbums->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>