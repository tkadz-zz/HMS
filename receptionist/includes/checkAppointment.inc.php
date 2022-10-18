<?php
include("autoloader.inc.php");


if (isset($_POST['btn_setApp'])){

    $patientID = $_GET['userID'];
    $appDate = $_POST['AppDate'];
    $appFrom = $_POST['appFrom'];
    $appTo = $_POST['appTo'];
    $doctorID = $_POST['doctorID'];

    try {
        $prof = new Usercontr();
        $prof->checkAppointment($patientID, $appDate,$appFrom, $appTo, $doctorID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }


}

?>