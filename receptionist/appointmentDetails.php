<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
?>

    <h4 class="mt-0 text-muted header-title pt-4">Appointment Details</h4>
<br>






<?php
$n = new Userview();
$n->viewAppointmentDetails($_GET['appID']);
?>





<?php
include 'includes/emptyLayoutBottom.inc.php';
?>