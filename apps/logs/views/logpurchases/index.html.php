<?php 
Layout::extend('layouts/logpurchases');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('logpurchasesController::newForm'), 'Create New logpurchases') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($logpurchasesSet as $logpurchases): ?>
	<?php Part::draw('logpurchases/details', $logpurchases) ?>
	<hr />
<?php endforeach; ?>