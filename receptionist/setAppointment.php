<?php
include 'includes/emptyLayoutTop.inc.php';
include 'includes/miniTab.inc.php';
?>
    <div class="container mt-4 mb-4">
        <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="javascript:history.back()" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
        <br>
        <br>



<?php
    if(isset($_GET['num']) && $_GET['num'] > 0){
        $v = new Userview();
        $v->viewAppointmentsLoopByAppDate($_GET['userID'], $_SESSION['tempAppDate'], $_GET['doctorID']);
    }
    ?>

<br>

    <?php

    $n = new Userview();
    $n->viewSetApointment($_GET['userID'] );

    ?>


</div>


<?php
include 'includes/emptyLayoutBottom.inc.php';
?>