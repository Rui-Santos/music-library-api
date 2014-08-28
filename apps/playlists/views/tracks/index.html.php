<?php 
Layout::extend('layouts/tracks');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('tracksController::newForm'), 'Create New tracks') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($tracksSet as $tracks): ?>
	<?php Part::draw('tracks/details', $tracks) ?>
	<hr />
<?php endforeach; ?>