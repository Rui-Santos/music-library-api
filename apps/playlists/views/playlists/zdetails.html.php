<?php 
Layout::extend('layouts/playlists');
$title = 'Details of playlists #' . $playlists->id ;
?>

<?php Part::draw('playlists/details', $playlists) ?>

<?php echo Html::anchor(Url::action('playlistsController::index'), 'Back to list of playlistss') ?>
<hr />