<?php
Part::input($mpcategories, 'mpcategories');
?>
<form method="POST" action="<?php echo Url::action('mpcategoriesController::delete', $mpcategories->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('mpcategoriesController::details', $mpcategories->RecID), 'mpcategories #' . $mpcategories->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $mpcategories->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $mpcategories->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $mpcategories->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $mpcategories->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $mpcategories->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$mpcategories->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$mpcategories->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $mpcategories->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $mpcategories->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $mpcategories->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $mpcategories->Split; ?><br />
		<strong>Rating</strong>: <?php echo $mpcategories->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $mpcategories->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $mpcategories->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $mpcategories->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $mpcategories->ChannelLayout; ?><br />
		<strong>_ Flat Category</strong>: <?php echo $mpcategories->_FlatCategory; ?><br />
		<strong>_ Waveform Link</strong>: <?php echo $mpcategories->_WaveformLink; ?><br />
		<strong>_ Picture Link</strong>: <?php echo $mpcategories->_PictureLink; ?><br />
		<strong>_ U M I D</strong>: <?php echo $mpcategories->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$mpcategories->Time); ?><br />
		<strong>Volume</strong>: <?php echo $mpcategories->Volume; ?><br />
		<strong>Track</strong>: <?php echo $mpcategories->Track; ?><br />
		<strong>Index</strong>: <?php echo $mpcategories->Index; ?><br />
		<strong>_ Dirty</strong>: <?php echo $mpcategories->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $mpcategories->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $mpcategories->Description; ?><br />
		<strong>Source</strong>: <?php echo $mpcategories->Source; ?><br />
		<strong>Category</strong>: <?php echo $mpcategories->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $mpcategories->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $mpcategories->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $mpcategories->Notes; ?><br />
		<strong>Show</strong>: <?php echo $mpcategories->Show; ?><br />
		<strong>Library</strong>: <?php echo $mpcategories->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $mpcategories->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $mpcategories->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $mpcategories->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $mpcategories->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $mpcategories->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $mpcategories->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $mpcategories->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $mpcategories->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $mpcategories->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $mpcategories->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $mpcategories->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $mpcategories->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $mpcategories->BPM; ?><br />
		<strong>Key</strong>: <?php echo $mpcategories->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $mpcategories->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $mpcategories->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $mpcategories->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $mpcategories->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $mpcategories->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $mpcategories->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $mpcategories->Scene; ?><br />
		<strong>Take</strong>: <?php echo $mpcategories->Take; ?><br />
		<strong>Tape</strong>: <?php echo $mpcategories->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $mpcategories->Mood; ?><br />
		<strong>Version</strong>: <?php echo $mpcategories->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $mpcategories->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $mpcategories->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $mpcategories->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $mpcategories->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $mpcategories->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $mpcategories->BWDate; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('mpcategoriesController::editForm', $mpcategories->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>