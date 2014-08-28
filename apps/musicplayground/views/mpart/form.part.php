<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('RecID'); ?>		
				<p>
			<label for="<?php echo $form->hash->getName(); ?>">Hash</label><br />
			<?php $form->input('hash'); ?>
		</p>
		<p>
			<label for="<?php echo $form->Picture->getName(); ?>">Picture</label><br />
			<?php $form->input('Picture'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>