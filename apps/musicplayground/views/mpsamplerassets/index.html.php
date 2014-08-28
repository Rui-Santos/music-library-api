<?php 
Layout::extend('layouts/mpsamplerassets');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('mpsamplerassetsController::newForm'), 'Create New mpsamplerassets') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($mpsamplerassetsSet as $mpsamplerassets): ?>
	<?php Part::draw('mpsamplerassets/details', $mpsamplerassets) ?>
	<hr />
<?php endforeach; ?>