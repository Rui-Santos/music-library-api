<?php 
Layout::extend('layouts/mplyrics');
if(isset($mplyrics->RecID)) {
	$title = 'Edit lyrics ' . $mplyrics->Filename;
} else {
	$title = 'Create New mplyrics';
}
$title = $title;
?>

<?php Part::draw('mplyrics/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('mplyricsController::index'), 'mplyrics List') ?>