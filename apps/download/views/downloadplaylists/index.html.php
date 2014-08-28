<?php 
Layout::extend('layouts/downloadplaylists');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('downloadplaylistsController::newForm'), 'Create New downloadplaylists') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($downloadplaylistsSet as $downloadplaylists): ?>
	<?php Part::draw('downloadplaylists/details', $downloadplaylists) ?>
	<hr />
<?php endforeach; ?>