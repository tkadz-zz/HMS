<?php
include("autoloader.inc.php");


if (isset($_POST['btn_updateProfile'])){
    $name = strtoupper($_POST['name']);
    $surname = strtoupper($_POST['surname']);
    $loginID= strtoupper($_POST['loginID']);

    $email= strtoupper($_POST['email']);
    $phone= strtoupper($_POST['phone']);
    $address= strtoupper($_POST['address']);
    $joint= strtoupper($_POST['joint']);
    $id = $_SESSION['id'];


    try {
        $prof = new Usercontr();
        $prof->updatePharmacistProfile($name, $surname, $email, $phone, $address, $joint, $loginID, $id);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }


}

?>