<?php
include("autoloader.inc.php");


if (isset($_POST['btn_setApp'])){

    $appID = $_GET['appID'];
    $patientID = $_GET['userID'];
    $doctorID = $_POST['doctorID'];
    $appDate = $_POST['AppDate'];

    try {
        $prof = new Usercontr();
        $prof->setAppointment($patientID, $doctorID, $appDate, $appID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }


}

?>