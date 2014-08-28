<?php 
Layout::extend('layouts/dinerttlicenses');
$title = 'Details of dinerttlicenses #' . $dinerttlicenses->id ;
?>

<?php Part::draw('dinerttlicenses/details', $dinerttlicenses) ?>

<?php echo Html::anchor(Url::action('dinerttlicensesController::index'), 'Back to list of dinerttlicensess') ?>
<hr />