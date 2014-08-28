<?php 
Layout::extend('layouts/logpurchasedtracks');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('logpurchasedtracksController::newForm'), 'Create New logpurchasedtracks') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($logpurchasedtracksSet as $logpurchasedtracks): ?>
	<?php Part::draw('logpurchasedtracks/details', $logpurchasedtracks) ?>
	<hr />
<?php endforeach; ?>