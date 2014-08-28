<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('id'); ?>		
				<p>
			<label for="<?php echo $form->log_id->getName(); ?>">Log Id</label><br />
			<?php $form->input('log_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->type->getName(); ?>">Type</label><br />
			<?php $form->input('type'); ?>
		</p>
		<p>
			<label for="<?php echo $form->value->getName(); ?>">Value</label><br />
			<?php $form->input('value'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>