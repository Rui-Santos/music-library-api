<?php 
Layout::extend('layouts/downloadtracks');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('downloadtracksController::newForm'), 'Create New downloadtracks') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($downloadtracksSet as $downloadtracks): ?>
	<?php Part::draw('downloadtracks/details', $downloadtracks) ?>
	<hr />
<?php endforeach; ?>