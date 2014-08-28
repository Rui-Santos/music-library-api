<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('log_id'); ?>		
				<p>
			<label for="<?php echo $form->asset_id->getName(); ?>">Asset Id</label><br />
			<?php $form->input('asset_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->db_id->getName(); ?>">Db Id</label><br />
			<?php $form->input('db_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->track_id->getName(); ?>">Track Id</label><br />
			<?php $form->input('track_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->file_path->getName(); ?>">File Path</label><br />
			<?php $form->input('file_path'); ?>
		</p>
		<p>
			<label for="<?php echo $form->file_size->getName(); ?>">File Size</label><br />
			<?php $form->input('file_size'); ?>
		</p>
		<p>
			<label for="<?php echo $form->file_type->getName(); ?>">File Type</label><br />
			<?php $form->input('file_type'); ?>
		</p>
		<p>
			<label for="<?php echo $form->completed->getName(); ?>">Completed</label><br />
			<?php $form->input('completed'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>