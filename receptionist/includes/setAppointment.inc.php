<?php
include("autoloader.inc.php");


if (isset($_POST['btn_setApp'])){

    $appID = $_GET['appID'];
    $patientID = $_GET['userID'];
    $doctorID = $_GET['doctorID'];

    $appDate = $_SESSION['tempAppDate'];
    $appFrom = $_SESSION['tempAppFrom'];
    $appTo = $_SESSION['tempAppTo'];

    try {
        $prof = new Usercontr();
        $prof->setAppointment($patientID, $doctorID, $appDate, $appFrom, $appTo, $appID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }


}

?>