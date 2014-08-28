<?php 
Layout::extend('layouts/shares');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('sharesController::newForm'), 'Create New shares') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($sharesSet as $shares): ?>
	<?php Part::draw('shares/details', $shares) ?>
	<hr />
<?php endforeach; ?>