<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('id'); ?>		
				<p>
			<label for="<?php echo $form->databases->getName(); ?>">Databases</label><br />
			<?php $form->input('databases'); ?>
		</p>
		<p>
			<label for="<?php echo $form->query->getName(); ?>">Query</label><br />
			<?php $form->input('query'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>