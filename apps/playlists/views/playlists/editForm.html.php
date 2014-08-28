<?php 
Layout::extend('layouts/playlists');
if(isset($playlists->id)) {
	$title = 'Edit playlists #' . $playlists->id;
} else {
	$title = 'Create New playlists';
}
$title = $title;
?>

<?php Part::draw('playlists/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('playlistsController::index'), 'playlists List') ?>