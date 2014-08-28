<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('id'); ?>		
				<p>
			<label for="<?php echo $form->artist->getName(); ?>">Artist</label><br />
			<?php $form->input('artist'); ?>
		</p>
		<p>
			<label for="<?php echo $form->filename->getName(); ?>">Filename</label><br />
			<?php $form->input('filename'); ?>
		</p>
		<p>
			<label for="<?php echo $form->bio->getName(); ?>">Bio</label><br />
			<?php $form->input('bio'); ?>
		</p>
		<p>
			<label for="<?php echo $form->photo->getName(); ?>">Photo</label><br />
			<?php $form->input('photo'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>