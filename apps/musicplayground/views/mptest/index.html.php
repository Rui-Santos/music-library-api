<?php 
Layout::extend('layouts/mptest');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('mptestController::newForm'), 'Create New mptest') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($mptestSet as $mptest): ?>
	<?php Part::draw('mptest/details', $mptest) ?>
	<hr />
<?php endforeach; ?>