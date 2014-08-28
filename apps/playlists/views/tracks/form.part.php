<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('id'); ?>		
				<p>
			<label for="<?php echo $form->playlist_id->getName(); ?>">Playlist Id</label><br />
			<?php $form->input('playlist_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->path->getName(); ?>">Path</label><br />
			<?php $form->input('path'); ?>
		</p>
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
			<label for="<?php echo $form->ndx->getName(); ?>">Ndx</label><br />
			<?php $form->input('ndx'); ?>
		</p>
		<p>
			<label for="<?php echo $form->usage->getName(); ?>">Usage</label><br />
			<?php $form->input('usage'); ?>
		</p>
		<p>
			<label for="<?php echo $form->time->getName(); ?>">Time</label><br />
			<?php $form->input('time'); ?>
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