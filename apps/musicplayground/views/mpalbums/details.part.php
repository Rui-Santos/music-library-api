<?php
Part::input($mpalbums, 'mpalbums');
?>
<form method="POST" action="<?php echo Url::action('mpalbumsController::delete', $mpalbums->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('mpalbumsController::details', $mpalbums->RecID), 'mpalbums #' . $mpalbums->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $mpalbums->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $mpalbums->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $mpalbums->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $mpalbums->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $mpalbums->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$mpalbums->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$mpalbums->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $mpalbums->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $mpalbums->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $mpalbums->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $mpalbums->Split; ?><br />
		<strong>Rating</strong>: <?php echo $mpalbums->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $mpalbums->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $mpalbums->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $mpalbums->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $mpalbums->ChannelLayout; ?><br />
		<strong>_ Flat Category</strong>: <?php echo $mpalbums->_FlatCategory; ?><br />
		<strong>_ Waveform Link</strong>: <?php echo $mpalbums->_WaveformLink; ?><br />
		<strong>_ Picture Link</strong>: <?php echo $mpalbums->_PictureLink; ?><br />
		<strong>_ U M I D</strong>: <?php echo $mpalbums->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$mpalbums->Time); ?><br />
		<strong>Volume</strong>: <?php echo $mpalbums->Volume; ?><br />
		<strong>Track</strong>: <?php echo $mpalbums->Track; ?><br />
		<strong>Index</strong>: <?php echo $mpalbums->Index; ?><br />
		<strong>_ Dirty</strong>: <?php echo $mpalbums->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $mpalbums->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $mpalbums->Description; ?><br />
		<strong>Source</strong>: <?php echo $mpalbums->Source; ?><br />
		<strong>Category</strong>: <?php echo $mpalbums->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $mpalbums->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $mpalbums->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $mpalbums->Notes; ?><br />
		<strong>Show</strong>: <?php echo $mpalbums->Show; ?><br />
		<strong>Library</strong>: <?php echo $mpalbums->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $mpalbums->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $mpalbums->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $mpalbums->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $mpalbums->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $mpalbums->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $mpalbums->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $mpalbums->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $mpalbums->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $mpalbums->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $mpalbums->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $mpalbums->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $mpalbums->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $mpalbums->BPM; ?><br />
		<strong>Key</strong>: <?php echo $mpalbums->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $mpalbums->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $mpalbums->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $mpalbums->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $mpalbums->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $mpalbums->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $mpalbums->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $mpalbums->Scene; ?><br />
		<strong>Take</strong>: <?php echo $mpalbums->Take; ?><br />
		<strong>Tape</strong>: <?php echo $mpalbums->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $mpalbums->Mood; ?><br />
		<strong>Version</strong>: <?php echo $mpalbums->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $mpalbums->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $mpalbums->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $mpalbums->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $mpalbums->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $mpalbums->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $mpalbums->BWDate; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('mpalbumsController::editForm', $mpalbums->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>