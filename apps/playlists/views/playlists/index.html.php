<?php 
Layout::extend('layouts/playlists');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('playlistsController::newForm'), 'Create New playlists') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($playlistsSet as $playlists): ?>
	<?php Part::draw('playlists/details', $playlists) ?>
	<hr />
<?php endforeach; ?>