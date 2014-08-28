<?php 
Layout::extend('layouts/downloadpurchase');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('downloadpurchaseController::newForm'), 'Create New downloadpurchase') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($downloadpurchaseSet as $downloadpurchase): ?>
	<?php Part::draw('downloadpurchase/details', $downloadpurchase) ?>
	<hr />
<?php endforeach; ?>