<?php
Part::input($messages, 'messages');
?>
<form method="POST" action="<?php echo Url::action('messagesController::delete', $messages->id) ?>">
	<fieldset>
	<h3><?php echo Html::anchor(Url::action('messagesController::details', $messages->id), 'messages #' . $messages->id) ?></h3>
	<p>
		<strong>Type</strong>: <?php echo $messages->type; ?><br />
		<strong>Email</strong>: <?php echo $messages->email; ?><br />
		<strong>Name</strong>: <?php echo $messages->name; ?><br />
		<strong>Company</strong>: <?php echo $messages->company; ?><br />
		<strong>Phone</strong>: <?php echo $messages->phone; ?><br />
		<strong>Client</strong>: <?php echo $messages->client; ?><br />
		<strong>Product</strong>: <?php echo $messages->product; ?><br />
		<strong>Num Spots</strong>: <?php echo $messages->num_spots; ?><br />
		<strong>Titles</strong>: <?php echo $messages->titles; ?><br />
		<strong>Description</strong>: <?php echo $messages->description; ?><br />
		<strong>Lengths</strong>: <?php echo $messages->lengths; ?><br />
		<strong>Isci</strong>: <?php echo $messages->isci; ?><br />
		<strong>Num Tracks</strong>: <?php echo $messages->num_tracks; ?><br />
		<strong>Tags</strong>: <?php echo $messages->tags; ?><br />
		<strong>Territories</strong>: <?php echo $messages->territories; ?><br />
		<strong>Media</strong>: <?php echo $messages->media; ?><br />
		<strong>Date Start</strong>: <?php echo $messages->date_start; ?><br />
		<strong>Duration</strong>: <?php echo $messages->duration; ?><br />
		<strong>Budget</strong>: <?php echo $messages->budget; ?><br />
		<strong>Post</strong>: <?php echo $messages->post; ?><br />
		<strong>Tracks Direction</strong>: <?php echo $messages->tracks_direction; ?><br />
		<strong>Message</strong>: <?php echo $messages->message; ?><br />

	</p>
	<?php echo Html::anchor(Url::action('messagesController::editForm', $messages->id), 'Edit') ?> - 
	<input type="hidden" name="_METHOD" value="DELETE" />
	<input type="submit" name="delete" value="Delete" />
	</fieldset>
</form>