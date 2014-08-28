<?php 
Layout::extend('layouts/downloads');
if(isset($downloads->log_id)) {
	$title = 'Edit downloads #' . $downloads->log_id;
} else {
	$title = 'Create New downloads';
}
$title = $title;
?>

<?php Part::draw('downloads/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('downloadsController::index'), 'downloads List') ?>