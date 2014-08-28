<?php 
Layout::extend('layouts/messages');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('messagesController::newForm'), 'Create New messages') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($messagesSet as $messages): ?>
	<?php Part::draw('messages/details', $messages) ?>
	<hr />
<?php endforeach; ?>