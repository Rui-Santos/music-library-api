<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('id'); ?>		
				<p>
			<label for="<?php echo $form->folder_id->getName(); ?>">Folder Id</label><br />
			<?php $form->input('folder_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->path->getName(); ?>">Path</label><br />
			<?php $form->input('path'); ?>
		</p>
		<p>
			<label for="<?php echo $form->type->getName(); ?>">Type</label><br />
			<?php $form->input('type'); ?>
		</p>
		<p>
			<label for="<?php echo $form->name->getName(); ?>">Name</label><br />
			<?php $form->input('name'); ?>
		</p>
		<p>
			<label for="<?php echo $form->title->getName(); ?>">Title</label><br />
			<?php $form->input('title'); ?>
		</p>
		<p>
			<label for="<?php echo $form->episode->getName(); ?>">Episode</label><br />
			<?php $form->input('episode'); ?>
		</p>
		<p>
			<label for="<?php echo $form->episode_no->getName(); ?>">Episode No</label><br />
			<?php $form->input('episode_no'); ?>
		</p>
		<p>
			<label for="<?php echo $form->production_no->getName(); ?>">Production No</label><br />
			<?php $form->input('production_no'); ?>
		</p>
		<p>
			<label for="<?php echo $form->airdate->getName(); ?>">Airdate</label><br />
			<?php $form->input('airdate'); ?>
		</p>
		<p>
			<label for="<?php echo $form->length->getName(); ?>">Length</label><br />
			<?php $form->input('length'); ?>
		</p>
		<p>
			<label for="<?php echo $form->program_type->getName(); ?>">Program Type</label><br />
			<?php $form->input('program_type'); ?>
		</p>
		<p>
			<label for="<?php echo $form->version_type->getName(); ?>">Version Type</label><br />
			<?php $form->input('version_type'); ?>
		</p>
		<p>
			<label for="<?php echo $form->job_no->getName(); ?>">Job No</label><br />
			<?php $form->input('job_no'); ?>
		</p>
		<p>
			<label for="<?php echo $form->station->getName(); ?>">Station</label><br />
			<?php $form->input('station'); ?>
		</p>
		<p>
			<label for="<?php echo $form->producer->getName(); ?>">Producer</label><br />
			<?php $form->input('producer'); ?>
		</p>
		<p>
			<label for="<?php echo $form->distributor->getName(); ?>">Distributor</label><br />
			<?php $form->input('distributor'); ?>
		</p>
		<p>
			<label for="<?php echo $form->director->getName(); ?>">Director</label><br />
			<?php $form->input('director'); ?>
		</p>
		<p>
			<label for="<?php echo $form->isci->getName(); ?>">Isci</label><br />
			<?php $form->input('isci'); ?>
		</p>
		<p>
			<label for="<?php echo $form->contact->getName(); ?>">Contact</label><br />
			<?php $form->input('contact'); ?>
		</p>
		<p>
			<label for="<?php echo $form->contact_type->getName(); ?>">Contact Type</label><br />
			<?php $form->input('contact_type'); ?>
		</p>
		<p>
			<label for="<?php echo $form->notes->getName(); ?>">Notes</label><br />
			<?php $form->input('notes'); ?>
		</p>
		<p>
			<label for="<?php echo $form->created->getName(); ?>">Created</label><br />
			<?php $form->input('created'); ?>
		</p>
		<p>
			<label for="<?php echo $form->updated->getName(); ?>">Updated</label><br />
			<?php $form->input('updated'); ?>
		</p>
		<p>
			<label for="<?php echo $form->updated_by->getName(); ?>">Updated By</label><br />
			<?php $form->input('updated_by'); ?>
		</p>
		<p>
			<label for="<?php echo $form->orig_id->getName(); ?>">Orig Id</label><br />
			<?php $form->input('orig_id'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>