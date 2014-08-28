<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('RecID'); ?>		
				<p>
			<label for="<?php echo $form->WaveformRep->getName(); ?>">Waveform Rep</label><br />
			<?php $form->input('WaveformRep'); ?>
		</p>
		<p>
			<label for="<?php echo $form->SpectroRep->getName(); ?>">Spectro Rep</label><br />
			<?php $form->input('SpectroRep'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>