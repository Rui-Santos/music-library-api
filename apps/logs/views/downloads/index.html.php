<?php 
Layout::extend('layouts/downloads');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('downloadsController::newForm'), 'Create New downloads') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($downloadsSet as $downloads): ?>
	<?php Part::draw('downloads/details', $downloads) ?>
	<hr />
<?php endforeach; ?>