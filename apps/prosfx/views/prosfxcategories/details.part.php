<?php
Part::input($prosfxcategories, 'prosfxcategories');
?>
<form method="POST" action="<?php echo Url::action('prosfxcategoriesController::delete', $prosfxcategories->RecID) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('prosfxcategoriesController::details', $prosfxcategories->RecID), 'prosfxcategories #' . $prosfxcategories->RecID) ?></h3>
	<p>
		<strong>Filename</strong>: <?php echo $prosfxcategories->Filename; ?><br />
		<strong>Pathname</strong>: <?php echo $prosfxcategories->Pathname; ?><br />
		<strong>File Path</strong>: <?php echo $prosfxcategories->FilePath; ?><br />
		<strong>Duration</strong>: <?php echo $prosfxcategories->Duration; ?><br />
		<strong>File Type</strong>: <?php echo $prosfxcategories->FileType; ?><br />
		<strong>Creation Date</strong>: <?php echo date(DATE_ISO8601,$prosfxcategories->CreationDate); ?><br />
		<strong>Modification Date</strong>: <?php echo date(DATE_ISO8601,$prosfxcategories->ModificationDate); ?><br />
		<strong>Total Frames</strong>: <?php echo $prosfxcategories->TotalFrames; ?><br />
		<strong>Entry Date</strong>: <?php echo $prosfxcategories->EntryDate; ?><br />
		<strong>Popularity</strong>: <?php echo $prosfxcategories->Popularity; ?><br />
		<strong>Split</strong>: <?php echo $prosfxcategories->Split; ?><br />
		<strong>Rating</strong>: <?php echo $prosfxcategories->Rating; ?><br />
		<strong>Sample Rate</strong>: <?php echo $prosfxcategories->SampleRate; ?><br />
		<strong>Channels</strong>: <?php echo $prosfxcategories->Channels; ?><br />
		<strong>Bit Depth</strong>: <?php echo $prosfxcategories->BitDepth; ?><br />
		<strong>Channel Layout</strong>: <?php echo $prosfxcategories->ChannelLayout; ?><br />
		<strong>Flat Category</strong>: <?php echo $prosfxcategories->_FlatCategory; ?><br />
		<strong>Waveform Link</strong>: <?php echo $prosfxcategories->_WaveformLink; ?><br />
		<strong>Picture Link</strong>: <?php echo $prosfxcategories->_PictureLink; ?><br />
		<strong>U M I D</strong>: <?php echo $prosfxcategories->_UMID; ?><br />
		<strong>Time</strong>: <?php echo date(DATE_ISO8601,$prosfxcategories->Time); ?><br />
		<strong>Volume</strong>: <?php echo $prosfxcategories->Volume; ?><br />
		<strong>Track</strong>: <?php echo $prosfxcategories->Track; ?><br />
		<strong>Index</strong>: <?php echo $prosfxcategories->Index; ?><br />
		<strong>Dirty</strong>: <?php echo $prosfxcategories->_Dirty; ?><br />
		<strong>Lyrics</strong>: <?php echo $prosfxcategories->Lyrics; ?><br />
		<strong>Description</strong>: <?php echo $prosfxcategories->Description; ?><br />
		<strong>Source</strong>: <?php echo $prosfxcategories->Source; ?><br />
		<strong>Category</strong>: <?php echo $prosfxcategories->Category; ?><br />
		<strong>Sub Category</strong>: <?php echo $prosfxcategories->SubCategory; ?><br />
		<strong>F X Name</strong>: <?php echo $prosfxcategories->FXName; ?><br />
		<strong>Notes</strong>: <?php echo $prosfxcategories->Notes; ?><br />
		<strong>Show</strong>: <?php echo $prosfxcategories->Show; ?><br />
		<strong>Library</strong>: <?php echo $prosfxcategories->Library; ?><br />
		<strong>Rec Type</strong>: <?php echo $prosfxcategories->RecType; ?><br />
		<strong>Short I D</strong>: <?php echo $prosfxcategories->ShortID; ?><br />
		<strong>Long I D</strong>: <?php echo $prosfxcategories->LongID; ?><br />
		<strong>Rec Medium</strong>: <?php echo $prosfxcategories->RecMedium; ?><br />
		<strong>Keywords</strong>: <?php echo $prosfxcategories->Keywords; ?><br />
		<strong>Location</strong>: <?php echo $prosfxcategories->Location; ?><br />
		<strong>Microphone</strong>: <?php echo $prosfxcategories->Microphone; ?><br />
		<strong>Composer</strong>: <?php echo $prosfxcategories->Composer; ?><br />
		<strong>Arranger</strong>: <?php echo $prosfxcategories->Arranger; ?><br />
		<strong>Conductor</strong>: <?php echo $prosfxcategories->Conductor; ?><br />
		<strong>Publisher</strong>: <?php echo $prosfxcategories->Publisher; ?><br />
		<strong>Performer</strong>: <?php echo $prosfxcategories->Performer; ?><br />
		<strong>B P M</strong>: <?php echo $prosfxcategories->BPM; ?><br />
		<strong>Key</strong>: <?php echo $prosfxcategories->Key; ?><br />
		<strong>Manufacturer</strong>: <?php echo $prosfxcategories->Manufacturer; ?><br />
		<strong>Designer</strong>: <?php echo $prosfxcategories->Designer; ?><br />
		<strong>Track Title</strong>: <?php echo $prosfxcategories->TrackTitle; ?><br />
		<strong>C D Title</strong>: <?php echo $prosfxcategories->CDTitle; ?><br />
		<strong>C D Description</strong>: <?php echo $prosfxcategories->CDDescription; ?><br />
		<strong>Featured Instrument</strong>: <?php echo $prosfxcategories->FeaturedInstrument; ?><br />
		<strong>Scene</strong>: <?php echo $prosfxcategories->Scene; ?><br />
		<strong>Take</strong>: <?php echo $prosfxcategories->Take; ?><br />
		<strong>Tape</strong>: <?php echo $prosfxcategories->Tape; ?><br />
		<strong>Mood</strong>: <?php echo $prosfxcategories->Mood; ?><br />
		<strong>Version</strong>: <?php echo $prosfxcategories->Version; ?><br />
		<strong>B W Description</strong>: <?php echo $prosfxcategories->BWDescription; ?><br />
		<strong>B W Originator</strong>: <?php echo $prosfxcategories->BWOriginator; ?><br />
		<strong>B W Originator Ref</strong>: <?php echo $prosfxcategories->BWOriginatorRef; ?><br />
		<strong>B W Time Stamp</strong>: <?php echo $prosfxcategories->BWTimeStamp; ?><br />
		<strong>B W Time</strong>: <?php echo $prosfxcategories->BWTime; ?><br />
		<strong>B W Date</strong>: <?php echo $prosfxcategories->BWDate; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('prosfxcategoriesController::editForm', $prosfxcategories->RecID), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>