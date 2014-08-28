<?php 
Layout::extend('layouts/messages');
if(isset($messages->id)) {
	$title = 'Edit messages #' . $messages->id;
} else {
	$title = 'Create New messages';
}
$title = $title;
?>

<?php Part::draw('messages/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('messagesController::index'), 'messages List') ?>