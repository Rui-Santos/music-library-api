<?php 
Layout::extend('layouts/downloadpurchase');
if(isset($downloadpurchase->id)) {
	$title = 'Edit downloadpurchase #' . $downloadpurchase->id;
} else {
	$title = 'Create New downloadpurchase';
}
$title = $title;
?>

<?php Part::draw('downloadpurchase/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('downloadpurchaseController::index'), 'downloadpurchase List') ?>