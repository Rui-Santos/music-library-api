<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('id'); ?>		
				<p>
			<label for="<?php echo $form->db_id->getName(); ?>">Db Id</label><br />
			<?php $form->input('db_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->track_id->getName(); ?>">Track Id</label><br />
			<?php $form->input('track_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->asset_key->getName(); ?>">Asset Key</label><br />
			<?php $form->input('asset_key'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Filename->getName(); ?>">Filename</label><br />
			<?php $form->input('Filename'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Pathname->getName(); ?>">Pathname</label><br />
			<?php $form->input('Pathname'); ?>
		</p>
		<p>
			<label for="<?php echo $form->FilePath->getName(); ?>">File Path</label><br />
			<?php $form->input('FilePath'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Duration->getName(); ?>">Duration</label><br />
			<?php $form->input('Duration'); ?>
		</p>
		<p>
			<label for="<?php echo $form->FileType->getName(); ?>">File Type</label><br />
			<?php $form->input('FileType'); ?>
		</p>
		<p>
			<label for="<?php echo $form->CreationDate->getName(); ?>">Creation Date</label><br />
			<?php $form->input('CreationDate'); ?>
		</p>
		<p>
			<label for="<?php echo $form->ModificationDate->getName(); ?>">Modification Date</label><br />
			<?php $form->input('ModificationDate'); ?>
		</p>
		<p>
			<label for="<?php echo $form->TrackTitle->getName(); ?>">Track Title</label><br />
			<?php $form->input('TrackTitle'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Composer->getName(); ?>">Composer</label><br />
			<?php $form->input('Composer'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Publisher->getName(); ?>">Publisher</label><br />
			<?php $form->input('Publisher'); ?>
		</p>
		<p>
			<label for="<?php echo $form->RecID->getName(); ?>">Rec I D</label><br />
			<?php $form->input('RecID'); ?>
		</p>
		<p>
			<label for="<?php echo $form->TotalFrames->getName(); ?>">Total Frames</label><br />
			<?php $form->input('TotalFrames'); ?>
		</p>
		<p>
			<label for="<?php echo $form->EntryDate->getName(); ?>">Entry Date</label><br />
			<?php $form->input('EntryDate'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Popularity->getName(); ?>">Popularity</label><br />
			<?php $form->input('Popularity'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Split->getName(); ?>">Split</label><br />
			<?php $form->input('Split'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Rating->getName(); ?>">Rating</label><br />
			<?php $form->input('Rating'); ?>
		</p>
		<p>
			<label for="<?php echo $form->SampleRate->getName(); ?>">Sample Rate</label><br />
			<?php $form->input('SampleRate'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Channels->getName(); ?>">Channels</label><br />
			<?php $form->input('Channels'); ?>
		</p>
		<p>
			<label for="<?php echo $form->BitDepth->getName(); ?>">Bit Depth</label><br />
			<?php $form->input('BitDepth'); ?>
		</p>
		<p>
			<label for="<?php echo $form->ChannelLayout->getName(); ?>">Channel Layout</label><br />
			<?php $form->input('ChannelLayout'); ?>
		</p>
		<p>
			<label for="<?php echo $form->_FlatCategory->getName(); ?>">Flat Category</label><br />
			<?php $form->input('_FlatCategory'); ?>
		</p>
		<p>
			<label for="<?php echo $form->_WaveformLink->getName(); ?>">Waveform Link</label><br />
			<?php $form->input('_WaveformLink'); ?>
		</p>
		<p>
			<label for="<?php echo $form->_PictureLink->getName(); ?>">Picture Link</label><br />
			<?php $form->input('_PictureLink'); ?>
		</p>
		<p>
			<label for="<?php echo $form->_UMID->getName(); ?>">U M I D</label><br />
			<?php $form->input('_UMID'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Time->getName(); ?>">Time</label><br />
			<?php $form->input('Time'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Volume->getName(); ?>">Volume</label><br />
			<?php $form->input('Volume'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Track->getName(); ?>">Track</label><br />
			<?php $form->input('Track'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Index->getName(); ?>">Index</label><br />
			<?php $form->input('Index'); ?>
		</p>
		<p>
			<label for="<?php echo $form->_Dirty->getName(); ?>">Dirty</label><br />
			<?php $form->input('_Dirty'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Lyrics->getName(); ?>">Lyrics</label><br />
			<?php $form->input('Lyrics'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Description->getName(); ?>">Description</label><br />
			<?php $form->input('Description'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Source->getName(); ?>">Source</label><br />
			<?php $form->input('Source'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Category->getName(); ?>">Category</label><br />
			<?php $form->input('Category'); ?>
		</p>
		<p>
			<label for="<?php echo $form->SubCategory->getName(); ?>">Sub Category</label><br />
			<?php $form->input('SubCategory'); ?>
		</p>
		<p>
			<label for="<?php echo $form->FXName->getName(); ?>">F X Name</label><br />
			<?php $form->input('FXName'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Notes->getName(); ?>">Notes</label><br />
			<?php $form->input('Notes'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Show->getName(); ?>">Show</label><br />
			<?php $form->input('Show'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Library->getName(); ?>">Library</label><br />
			<?php $form->input('Library'); ?>
		</p>
		<p>
			<label for="<?php echo $form->RecType->getName(); ?>">Rec Type</label><br />
			<?php $form->input('RecType'); ?>
		</p>
		<p>
			<label for="<?php echo $form->ShortID->getName(); ?>">Short I D</label><br />
			<?php $form->input('ShortID'); ?>
		</p>
		<p>
			<label for="<?php echo $form->LongID->getName(); ?>">Long I D</label><br />
			<?php $form->input('LongID'); ?>
		</p>
		<p>
			<label for="<?php echo $form->RecMedium->getName(); ?>">Rec Medium</label><br />
			<?php $form->input('RecMedium'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Keywords->getName(); ?>">Keywords</label><br />
			<?php $form->input('Keywords'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Location->getName(); ?>">Location</label><br />
			<?php $form->input('Location'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Microphone->getName(); ?>">Microphone</label><br />
			<?php $form->input('Microphone'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Arranger->getName(); ?>">Arranger</label><br />
			<?php $form->input('Arranger'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Conductor->getName(); ?>">Conductor</label><br />
			<?php $form->input('Conductor'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Performer->getName(); ?>">Performer</label><br />
			<?php $form->input('Performer'); ?>
		</p>
		<p>
			<label for="<?php echo $form->BPM->getName(); ?>">B P M</label><br />
			<?php $form->input('BPM'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Key->getName(); ?>">Key</label><br />
			<?php $form->input('Key'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Manufacturer->getName(); ?>">Manufacturer</label><br />
			<?php $form->input('Manufacturer'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Designer->getName(); ?>">Designer</label><br />
			<?php $form->input('Designer'); ?>
		</p>
		<p>
			<label for="<?php echo $form->CDTitle->getName(); ?>">C D Title</label><br />
			<?php $form->input('CDTitle'); ?>
		</p>
		<p>
			<label for="<?php echo $form->CDDescription->getName(); ?>">C D Description</label><br />
			<?php $form->input('CDDescription'); ?>
		</p>
		<p>
			<label for="<?php echo $form->FeaturedInstrument->getName(); ?>">Featured Instrument</label><br />
			<?php $form->input('FeaturedInstrument'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Scene->getName(); ?>">Scene</label><br />
			<?php $form->input('Scene'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Take->getName(); ?>">Take</label><br />
			<?php $form->input('Take'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Tape->getName(); ?>">Tape</label><br />
			<?php $form->input('Tape'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Mood->getName(); ?>">Mood</label><br />
			<?php $form->input('Mood'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Version->getName(); ?>">Version</label><br />
			<?php $form->input('Version'); ?>
		</p>
		<p>
			<label for="<?php echo $form->BWDescription->getName(); ?>">B W Description</label><br />
			<?php $form->input('BWDescription'); ?>
		</p>
		<p>
			<label for="<?php echo $form->BWOriginator->getName(); ?>">B W Originator</label><br />
			<?php $form->input('BWOriginator'); ?>
		</p>
		<p>
			<label for="<?php echo $form->BWOriginatorRef->getName(); ?>">B W Originator Ref</label><br />
			<?php $form->input('BWOriginatorRef'); ?>
		</p>
		<p>
			<label for="<?php echo $form->BWTimeStamp->getName(); ?>">B W Time Stamp</label><br />
			<?php $form->input('BWTimeStamp'); ?>
		</p>
		<p>
			<label for="<?php echo $form->BWTime->getName(); ?>">B W Time</label><br />
			<?php $form->input('BWTime'); ?>
		</p>
		<p>
			<label for="<?php echo $form->BWDate->getName(); ?>">B W Date</label><br />
			<?php $form->input('BWDate'); ?>
		</p>
		<p>
			<label for="<?php echo $form->SplitChannels->getName(); ?>">Split Channels</label><br />
			<?php $form->input('SplitChannels'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>