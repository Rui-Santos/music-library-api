<?php 
Layout::extend('layouts/downloadpurchasedtracks');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('downloadpurchasedtracksController::newForm'), 'Create New downloadpurchasedtracks') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($downloadpurchasedtracksSet as $downloadpurchasedtracks): ?>
	<?php Part::draw('downloadpurchasedtracks/details', $downloadpurchasedtracks) ?>
	<hr />
<?php endforeach; ?>