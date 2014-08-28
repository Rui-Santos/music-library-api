<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('id'); ?>		
				<p>
			<label for="<?php echo $form->type->getName(); ?>">Type</label><br />
			<?php $form->input('type'); ?>
		</p>
		<p>
			<label for="<?php echo $form->email->getName(); ?>">Email</label><br />
			<?php $form->input('email'); ?>
		</p>
		<p>
			<label for="<?php echo $form->name->getName(); ?>">Name</label><br />
			<?php $form->input('name'); ?>
		</p>
		<p>
			<label for="<?php echo $form->company->getName(); ?>">Company</label><br />
			<?php $form->input('company'); ?>
		</p>
		<p>
			<label for="<?php echo $form->phone->getName(); ?>">Phone</label><br />
			<?php $form->input('phone'); ?>
		</p>
		<p>
			<label for="<?php echo $form->client->getName(); ?>">Client</label><br />
			<?php $form->input('client'); ?>
		</p>
		<p>
			<label for="<?php echo $form->product->getName(); ?>">Product</label><br />
			<?php $form->input('product'); ?>
		</p>
		<p>
			<label for="<?php echo $form->num_spots->getName(); ?>">Num Spots</label><br />
			<?php $form->input('num_spots'); ?>
		</p>
		<p>
			<label for="<?php echo $form->titles->getName(); ?>">Titles</label><br />
			<?php $form->input('titles'); ?>
		</p>
		<p>
			<label for="<?php echo $form->description->getName(); ?>">Description</label><br />
			<?php $form->input('description'); ?>
		</p>
		<p>
			<label for="<?php echo $form->lengths->getName(); ?>">Lengths</label><br />
			<?php $form->input('lengths'); ?>
		</p>
		<p>
			<label for="<?php echo $form->isci->getName(); ?>">Isci</label><br />
			<?php $form->input('isci'); ?>
		</p>
		<p>
			<label for="<?php echo $form->num_tracks->getName(); ?>">Num Tracks</label><br />
			<?php $form->input('num_tracks'); ?>
		</p>
		<p>
			<label for="<?php echo $form->tags->getName(); ?>">Tags</label><br />
			<?php $form->input('tags'); ?>
		</p>
		<p>
			<label for="<?php echo $form->territories->getName(); ?>">Territories</label><br />
			<?php $form->input('territories'); ?>
		</p>
		<p>
			<label for="<?php echo $form->media->getName(); ?>">Media</label><br />
			<?php $form->input('media'); ?>
		</p>
		<p>
			<label for="<?php echo $form->date_start->getName(); ?>">Date Start</label><br />
			<?php $form->input('date_start'); ?>
		</p>
		<p>
			<label for="<?php echo $form->duration->getName(); ?>">Duration</label><br />
			<?php $form->input('duration'); ?>
		</p>
		<p>
			<label for="<?php echo $form->budget->getName(); ?>">Budget</label><br />
			<?php $form->input('budget'); ?>
		</p>
		<p>
			<label for="<?php echo $form->post->getName(); ?>">Post</label><br />
			<?php $form->input('post'); ?>
		</p>
		<p>
			<label for="<?php echo $form->tracks_direction->getName(); ?>">Tracks Direction</label><br />
			<?php $form->input('tracks_direction'); ?>
		</p>
		<p>
			<label for="<?php echo $form->message->getName(); ?>">Message</label><br />
			<?php $form->input('message'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>