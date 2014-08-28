<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('RecID'); ?>		
		<p>
			<label for="<?php echo $form->Lyrics->getName(); ?>">Lyrics</label><br />
			<?php $form->input('Lyrics'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>