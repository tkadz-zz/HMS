<?php
include("autoloader.inc.php");


if (isset($_POST['btn_updateProfile'])){


    $loginID= strtoupper($_POST['loginID']);
    $id = $_SESSION['id'];
    //personal
    $name = strtoupper($_POST['name']);
    $surname = strtoupper($_POST['surname']);
    $nationalID = $_POST['nationalID'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];


    //medical
    $medicalName = $_POST['medicalName'];
    $medicalPlan = $_POST['medicalPlan'];

    //NextOfKin(nok)
    $nokname = strtoupper($_POST['nokname']);
    $noksurname = strtoupper($_POST['noksurname']);
    $nokPhone = $_POST['nokPhone'];


    try {
        $prof = new Usercontr();
        $prof->updatePatientProfile($loginID, $name, $surname, $nationalID, $dob, $sex, $phone, $address, $medicalName, $medicalPlan, $nokname, $noksurname,$nokPhone, $id);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }


}

?>