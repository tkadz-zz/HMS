<?php
include("autoloader.inc.php");


if (isset($_POST['btn_updateProfile'])){
    $name = strtoupper($_POST['name']);
    $surname = strtoupper($_POST['surname']);
    $loginID= strtoupper($_POST['loginID']);
    $hospital= strtoupper($_POST['hospital']);
    $id = $_SESSION['id'];


    try {
        $prof = new Usercontr();
        $prof->updateReceptionistProfile($name, $surname, $hospital, $loginID, $id);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }


}

?>