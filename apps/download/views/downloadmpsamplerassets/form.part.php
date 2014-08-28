<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('id'); ?>		
				<p>
			<label for="<?php echo $form->sampler_id->getName(); ?>">Sampler Id</label><br />
			<?php $form->input('sampler_id'); ?>
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
			<label for="<?php echo $form->order_position->getName(); ?>">Order Position</label><br />
			<?php $form->input('order_position'); ?>
		</p>
		<p>
			<label for="<?php echo $form->filename->getName(); ?>">Filename</label><br />
			<?php $form->input('filename'); ?>
		</p>
		<p>
			<label for="<?php echo $form->filepath->getName(); ?>">Filepath</label><br />
			<?php $form->input('filepath'); ?>
		</p>
		<p>
			<label for="<?php echo $form->title->getName(); ?>">Title</label><br />
			<?php $form->input('title'); ?>
		</p>
		<p>
			<label for="<?php echo $form->artist->getName(); ?>">Artist</label><br />
			<?php $form->input('artist'); ?>
		</p>
		<p>
			<label for="<?php echo $form->artist_id->getName(); ?>">Artist Id</label><br />
			<?php $form->input('artist_id'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>