<?php 
Layout::extend('layouts/prosfxassets');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('prosfxassetsController::newForm'), 'Create New prosfxassets') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($prosfxassetsSet as $prosfxassets): ?>
	<?php Part::draw('prosfxassets/details', $prosfxassets) ?>
	<hr />
<?php endforeach; ?>