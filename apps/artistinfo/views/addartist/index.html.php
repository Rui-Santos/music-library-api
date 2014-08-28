<?php 
Layout::extend('layouts/addartist');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('addartistController::newForm'), 'Create New addartist') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($addartistSet as $addartist): ?>
	<?php Part::draw('addartist/details', $addartist) ?>
	<hr />
<?php endforeach; ?>