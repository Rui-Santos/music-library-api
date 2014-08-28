<?php 
Layout::extend('layouts/messages');
$title = 'Details of messages #' . $messages->id ;
?>

<?php Part::draw('messages/details', $messages) ?>

<?php echo Html::anchor(Url::action('messagesController::index'), 'Back to list of messagess') ?>
<hr />