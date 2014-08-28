<?php 
Layout::extend('layouts/downloadassets');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('downloadassetsController::newForm'), 'Create New downloadassets') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($downloadassetsSet as $downloadassets): ?>
	<?php Part::draw('downloadassets/details', $downloadassets) ?>
	<hr />
<?php endforeach; ?>