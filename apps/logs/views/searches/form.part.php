<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('log_id'); ?>		
				<p>
			<label for="<?php echo $form->query_id->getName(); ?>">Query Id</label><br />
			<?php $form->input('query_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->lock->getName(); ?>">Lock</label><br />
			<?php $form->input('lock'); ?>
		</p>
		<p>
			<label for="<?php echo $form->text->getName(); ?>">Text</label><br />
			<?php $form->input('text'); ?>
		</p>
		<p>
			<label for="<?php echo $form->total->getName(); ?>">Total</label><br />
			<?php $form->input('total'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>