<?php 
Layout::extend('layouts/mplyrics');
$title = 'Index';
?>


<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($mplyricsSet as $mplyrics): ?>
	<?php Part::draw('mplyrics/details', $mplyrics) ?>
	<hr />
<?php endforeach; ?>