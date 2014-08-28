<?php 
Layout::extend('layouts/wformsall');
if(isset($wformsall->RecID)) {
	$title = 'Edit wformsall #' . $wformsall->RecID;
} else {
	$title = 'Create New wformsall';
}
$title = $title;
?>

<?php Part::draw('wformsall/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('wformsallController::index'), 'wformsall List') ?>