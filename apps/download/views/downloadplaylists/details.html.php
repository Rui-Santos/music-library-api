<?php 
Layout::extend('layouts/downloadplaylists');
$title = 'Details of downloadplaylists #' . $downloadplaylists->id ;
?>

<?php Part::draw('downloadplaylists/details', $downloadplaylists) ?>

<?php echo Html::anchor(Url::action('downloadplaylistsController::index'), 'Back to list of downloadplaylistss') ?>
<hr />