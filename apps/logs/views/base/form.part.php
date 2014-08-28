<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('id'); ?>		
				<p>
			<label for="<?php echo $form->time->getName(); ?>">Time</label><br />
			<?php $form->input('time'); ?>
		</p>
		<p>
			<label for="<?php echo $form->event->getName(); ?>">Event</label><br />
			<?php $form->input('event'); ?>
		</p>
		<p>
			<label for="<?php echo $form->user_id->getName(); ?>">User Id</label><br />
			<?php $form->input('user_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->group_id->getName(); ?>">Group Id</label><br />
			<?php $form->input('group_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->role_id->getName(); ?>">Role Id</label><br />
			<?php $form->input('role_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->host_id->getName(); ?>">Host Id</label><br />
			<?php $form->input('host_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->browser_id->getName(); ?>">Browser Id</label><br />
			<?php $form->input('browser_id'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>