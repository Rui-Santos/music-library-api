<?php 
Layout::extend('layouts/shares');
if(isset($shares->id)) {
	$title = 'Edit shares #' . $shares->id;
} else {
	$title = 'Create New shares';
}
$title = $title;
?>

<?php Part::draw('shares/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('sharesController::index'), 'shares List') ?>