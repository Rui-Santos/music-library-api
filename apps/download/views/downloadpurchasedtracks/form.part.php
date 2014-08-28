<?php
Part::input($form, 'ModelForm');
Part::input($title, 'string');
?>
<?php $form->begin(); ?>
	<fieldset>
		<legend><?php echo $title ?></legend>
		<?php $form->input('id'); ?>		
				<p>
			<label for="<?php echo $form->purchase_id->getName(); ?>">Purchase Id</label><br />
			<?php $form->input('purchase_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->asset_id->getName(); ?>">Asset Id</label><br />
			<?php $form->input('asset_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->user_id->getName(); ?>">User Id</label><br />
			<?php $form->input('user_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->db_id->getName(); ?>">Db Id</label><br />
			<?php $form->input('db_id'); ?>
		</p>
		<p>
			<label for="<?php echo $form->created->getName(); ?>">Created</label><br />
			<?php $form->input('created'); ?>
		</p>

		<input type="submit" value="Save" />
	</fieldset>
<?php $form->end(); ?>