<?php
include 'includes/emptyLayoutTop.inc.php';
?>
<?php
include 'includes/miniTab.inc.php';
?>





<?php

$studentProfile = new Userview();
$studentProfile->doctorProfile($_SESSION['id']);

?>







<?php
include 'includes/emptyLayoutBottom.inc.php';
?>