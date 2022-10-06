<?php
include("autoloader.inc.php");


if(isset($_GET['pid'])){
    $duID = $_GET['duID'];
    $prescriptionID = $_GET['pid'];
    $userID = $_GET['userID'];
    $pharmacistID = $_SESSION['id'];

    try {
        $n = new Usercontr();
        $n->collectPrescription($duID, $prescriptionID, $userID, $pharmacistID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}

?>