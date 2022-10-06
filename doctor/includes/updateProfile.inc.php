<?php
include("autoloader.inc.php");


if (isset($_POST['btn_updateProfile'])){
    $name = strtoupper($_POST['name']);
    $surname = strtoupper($_POST['surname']);
    $loginID= strtoupper($_POST['loginID']);

    $email= strtoupper($_POST['email']);
    $phone= strtoupper($_POST['phone']);
    $hospital= strtoupper($_POST['hospital']);
    $category= strtoupper($_POST['category']);
    $id = $_SESSION['id'];


    try {
        $prof = new Usercontr();
        $prof->updateDoctorProfile($name, $surname, $email, $phone, $hospital, $category, $loginID, $id);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }


}

?>