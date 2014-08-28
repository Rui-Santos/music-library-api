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
			<label for="<?php echo $form->asset_id->getName(); ?>">Asset Id</label><br />
			<?php $form->input('asset_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->order_position->getName(); ?>">Order Position</label><br />
			<?php $form->input('order_position'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>