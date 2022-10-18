<?php
include 'includes/emptyLayoutTop.inc.php';
?>
<?php
include 'includes/miniTab.inc.php';
?>





<?php

$studentProfile = new Userview();
$studentProfile->userProfile($_GET['userID']);

?>







<?php
include 'includes/emptyLayoutBottom.inc.php';
?>