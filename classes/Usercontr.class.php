<?php
class Usercontr extends Users{

    public function updatePatientProfile($loginID, $name, $surname, $nationalID, $dob, $sex, $phone, $address, $medicalName, $medicalPlan, $nokname, $noksurname, $nokPhone, $id)
    {
        parent::updatePatientProfile($loginID, $name, $surname, $nationalID, $dob, $sex, $phone, $address, $medicalName, $medicalPlan, $nokname, $noksurname, $nokPhone, $id);
    }

    public function setAppointment($patientID, $doctorID, $appDate, $appID)
    {
        parent::setAppointment($patientID, $doctorID, $appDate, $appID);
    }

    public function updateReceptionistProfile($name, $surname, $hospital, $loginID, $id)
    {
        parent::updateReceptionistProfile($name, $surname, $hospital, $loginID, $id);
    }

    public function updateDoctorProfile($name, $surname, $email, $phone, $hospital, $category, $loginID, $id)
    {
        parent::updateDoctorProfile($name, $surname, $email, $phone, $hospital, $category, $loginID, $id);
    }

    public function updatePharmacistProfile($name, $surname, $email, $phone, $address, $joint, $loginID, $id)
    {
        parent::updatePharmacistProfile($name, $surname, $email, $phone, $address, $joint, $loginID, $id);
    }

    public function updateAdminProfile($name, $surname, $loginID, $id)
    {
        parent::updateAdminProfile($name, $surname, $loginID, $id);
    }

    public function updatePassword($op, $cp, $id)
    {
        parent::updatePassword($op, $cp, $id);
    }

    public function collectPrescription($duID, $prescriptionID, $userID, $pharmacistID)
    {
        parent::collectPrescription($duID, $prescriptionID, $userID, $pharmacistID);
    }

    public function searchPatient($search){
        parent::searchPatient($search);
    }

    public function addDPrescription($prescription, $duID)
    {
        parent::addDPrescription($prescription, $duID);
    }

    public function deletePrescription($pID, $duID)
    {
        parent::deletePrescription($pID, $duID);
    }

    public function deleteDoc($docID, $duID)
    {
        parent::deleteDoc($docID, $duID);
    }

    public function addDoc($title, $description, $duID, $file_tmp, $file_destination, $file_name_new, $file_ext)
    {
        parent::addDoc($title, $description, $duID, $file_tmp, $file_destination, $file_name_new, $file_ext);
    }

    public function addDiagnosis($bloodPressure, $pulse, $glucose, $gcs, $temp, $weight, $height, $diagnosis, $additional, $duID, $doctorID, $dateAdded, $userID)
    {
        parent::addDiagnosis($bloodPressure, $pulse, $glucose, $gcs, $temp, $weight, $height, $diagnosis, $additional, $duID, $doctorID, $dateAdded, $userID);
    }

    public function updatePatientDetails($name, $surname, $nationalID, $dob, $sex, $phone, $address, $medicalName, $medicalPlan, $nokname, $noksurname, $nokPhone, $userid)
    {
        parent::updatePatientDetails($name, $surname, $nationalID, $dob, $sex, $phone, $address, $medicalName, $medicalPlan, $nokname, $noksurname, $nokPhone, $userid);
    }

    public function ViewAllUsers(){
        parent::GetAllUser();
    }

    public function dateToDay($mydate)
    {
        return parent::dateToDay($mydate);
    }

    public function passwordreserttoken($email)
    {
        parent::passwordreserttoken($email);
    }

    public function forgotpassword($email){
        parent::forgotpassword($email);
    }

    public function addUser($name, $surname, $loginID, $userRole, $activeStatus, $joined)
    {
        parent::addUser($name, $surname, $loginID, $userRole, $activeStatus, $joined);
    }

    public function autoLoginUsers($loginID, $par){
        parent::autoLoginUsers($loginID, $par);
    }

    public function SigninUser($loginID, $password){
        parent::SigninUser($loginID, $password);
    }

    public function log_out(){
        // Destroy and unset active session
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['surname']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        unset($_SESSION['status']);
        echo "<script type='text/javascript'>
      window.location='index.php';
      </script>";
        return true;
    }

}
