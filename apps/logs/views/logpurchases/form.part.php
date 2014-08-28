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
			<label for="<?php echo $form->user_id->getName(); ?>">User Id</label><br />
			<?php $form->input('user_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->hash->getName(); ?>">Hash</label><br />
			<?php $form->input('hash'); ?>
		</p>
		<p>
			<label for="<?php echo $form->stripe_id->getName(); ?>">Stripe Id</label><br />
			<?php $form->input('stripe_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->amount->getName(); ?>">Amount</label><br />
			<?php $form->input('amount'); ?>
		</p>
		<p>
			<label for="<?php echo $form->date->getName(); ?>">Date</label><br />
			<?php $form->input('date'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>