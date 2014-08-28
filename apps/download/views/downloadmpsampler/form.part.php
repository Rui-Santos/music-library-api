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
			<label for="<?php echo $form->state->getName(); ?>">State</label><br />
			<?php $form->input('state'); ?>
		</p>
		<p>
			<label for="<?php echo $form->name->getName(); ?>">Name</label><br />
			<?php $form->input('name'); ?>
		</p>
		<p>
			<label for="<?php echo $form->description->getName(); ?>">Description</label><br />
			<?php $form->input('description'); ?>
		</p>
		<p>
			<label for="<?php echo $form->artwork->getName(); ?>">Artwork</label><br />
			<?php $form->input('artwork'); ?>
		</p>
		<p>
			<label for="<?php echo $form->date_created->getName(); ?>">Date Created</label><br />
			<?php $form->input('date_created'); ?>
		</p>
		<p>
			<label for="<?php echo $form->date_modified->getName(); ?>">Date Modified</label><br />
			<?php $form->input('date_modified'); ?>
		</p>
		<p>
			<label for="<?php echo $form->slug->getName(); ?>">Slug</label><br />
			<?php $form->input('slug'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>