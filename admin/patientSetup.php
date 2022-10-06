<?php
include 'includes/emptyLayoutTop.inc.php';
?>

<?php
include 'includes/miniTab.inc.php';
?>



<h4 class="mt-0 text-muted header-title pt-4">Patient Account Setup</h4>

<?php
$new = new Userview();
$new->patientSetup($_GET['userid']);
?>


<?php
include 'includes/emptyLayoutBottom.inc.php';
?>

