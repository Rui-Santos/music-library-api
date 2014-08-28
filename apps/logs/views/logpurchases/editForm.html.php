<?php 
Layout::extend('layouts/logpurchases');
if(isset($logpurchases->id)) {
	$title = 'Edit logpurchases #' . $logpurchases->id;
} else {
	$title = 'Create New logpurchases';
}
$title = $title;
?>

<?php Part::draw('logpurchases/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('logpurchasesController::index'), 'logpurchases List') ?>