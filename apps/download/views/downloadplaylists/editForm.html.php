<?php 
Layout::extend('layouts/downloadplaylists');
if(isset($downloadplaylists->id)) {
	$title = 'Edit downloadplaylists #' . $downloadplaylists->id;
} else {
	$title = 'Create New downloadplaylists';
}
$title = $title;
?>

<?php Part::draw('downloadplaylists/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('downloadplaylistsController::index'), 'downloadplaylists List') ?>