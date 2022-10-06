<?php


class Users extends Dbh
{


    protected function setAppointment($patientID, $doctorID, $appDate, $appID){

        $dateAdded = date("Y-m-d h:m:i");
        $att = 0;
        $sql = "INSERT INTO appointments(appointmentUID, patientID, doctorID, appDate, attendance, dateAdded) VALUES (?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$appID, $patientID, $doctorID, $appDate, $att, $dateAdded])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Appointment Set Successfully';
            echo "<script type='text/javascript'>;
                      window.location='../appointmentDetails.php?appID=$appID';
                    </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong. Contact Admin';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }
    }

    protected function updateReceptionistProfile($name, $surname, $hospital, $loginID, $id){
        $sql = "UPDATE receptionist SET name=?, surname=?, hospital=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $hospital, $id])){
            $this->updateLoginID($loginID, $name, $surname, $id);
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Profile failed to update';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }

    }

    protected function updatePatientProfile($loginID, $name, $surname, $nationalID, $dob, $sex, $phone, $address, $medicalName, $medicalPlan, $nokname, $noksurname,$nokPhone, $id){
        $sql = "UPDATE patient SET name=?, surname=?, nationalID=?, dob=?, sex=?, phone=?, address=?, medicalAid=?, medicalAidPlan=?, nextOfKinName=?, nextOfKinSurname=?, nextOfKinPhone=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $nationalID, $dob, $sex, $phone, $address, $medicalName, $medicalPlan, $nokname, $noksurname,$nokPhone, $id])){
            $this->updateLoginID($loginID, $name, $surname, $id);
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Profile failed to update';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }

    }

    protected function updateDoctorProfile($name, $surname, $email, $phone, $hospital, $category, $loginID, $id){
        $sql = "UPDATE doctor SET name=?, surname=?, email=?, phone=?, hospital=?, category=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $email, $phone, $hospital, $category, $id])){
            $this->updateLoginID($loginID, $name, $surname, $id);
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Profile failed to update';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }
    }

    protected function updatePharmacistProfile($name, $surname, $email, $phone, $address, $joint, $loginID, $id){
        $sql = "UPDATE pharmacist SET name=?, surname=?, email=?, phone=?, address=?, joint=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $email, $phone, $address, $joint, $id])){
            $this->updateLoginID($loginID, $name, $surname, $id);
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Profile failed to update';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }
    }

    protected function updateAdminProfile($name, $surname, $loginID, $id){
        $sql = "UPDATE admin SET name=?, surname=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $id])){
            $this->updateLoginID($loginID, $name, $surname, $id);
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Profile failed to update';
            echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
        }

    }

    protected function updateLoginID($newID, $name, $surname, $id){
        $sql = "SELECT * FROM users WHERE loginID=? AND id != ?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$newID, $id]);
        $rows = $stmt->fetchAll();
        //Check to see if there is any loginID in database matching the provided one
        if (count($rows) > 0) {
            //if loginID already exist in database, do not create account, redirect user to previous page
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'LoginID <span class="text-decoration-underline text-dark">'.$newID.'</span> already taken. Please Choose another';
            echo "<script type='text/javascript'>
                window.location='../profile.php';
              </script>";
        } else {
            $sql = "UPDATE users SET loginID=? WHERE id=?";
            $stmt = $this->con()->prepare($sql);
            if($stmt->execute([$newID, $id])){
                $_SESSION['loginID'] = $newID;
                $_SESSION['name'] = $name;
                $_SESSION['surname'] = $surname;

                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Profile updated successfully';
                echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
            }
            else{
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Profile LoginID failed to update';
                echo "<script type='text/javascript'>;
                      window.location='../profile.php';
                    </script>";
            }
        }

    }

    public function updatePassword($op, $cp, $id){
        $rows = $this->GetUserByID($id);
        if(password_verify($op, $rows[0]['password'])){
            //Match
            $sql2 = "UPDATE users SET password=? WHERE id=?";
            $stmt2 = $this->con()->prepare($sql2);
            $pass_safe = password_hash($cp, PASSWORD_DEFAULT);

            if($stmt2->execute([$pass_safe, $id])){

                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Password Updated Successfully';
                echo "<script type='text/javascript'>;
                      window.location='../password.php';
                    </script>";
            }
            else{

                $_SESSION['type'] = 'd';
                $_SESSION['err'] = 'Password Update Failed';
                echo "<script type='text/javascript'>;
                      window.location='../password.php';
                    </script>";
            }
        }
        else{
            //Not Matched

            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Old password did not match';

            echo "<script type='text/javascript'>;
                      window.location='../password.php';
                    </script>";
        }


    }

    protected function collectPrescription($duID, $prescriptionID, $userID, $pharmacistID){
        $this->GetPrescriptionByID($prescriptionID);
        $dateAdded = date("Y-m-d h:m:i");
        $isofferTrue = 1;
        $sql = "UPDATE prescription SET isOffered=?, pharmacistID=?, dateCollected=? WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$isofferTrue, $pharmacistID, $dateAdded, $prescriptionID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Prescription Collection Done';
            echo "<script type='text/javascript'>
                    window.location='../medicalHistoryDetails.php?duID=$duID&userID=$userID';
                </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong. Contact admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function searchPatientQuery($search)
    {
        $sql = "SELECT * FROM patient WHERE name LIKE :search OR surname LIKE :search OR nationalID LIKE :search;";
        $stmt = $this->con()->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function searchPatient($search){
        $sql="SELECT * FROM patient WHERE name LIKE :search OR surname LIKE :search OR nationalID LIKE :search;";
        $stmt=$this->con()->prepare($sql);
        $stmt->bindValue(':search' ,'%'.$search.'%');
        $stmt->execute();
        $rows = $stmt->fetchAll();

       if(count($rows) > 0){
           //results found
           $_SESSION['type'] = 's';
           $_SESSION['err'] = 'We Found '.count($rows).' Results. Here is what we found';
           echo "<script type='text/javascript'>
                   window.location='../dashboard.php?search=$search';
               </script>";
           return $rows;
       }
       else{
           //no results found
           $_SESSION['type'] = 'w';
           $_SESSION['err'] = 'No Data Found';
           echo "<script type='text/javascript'>
                   window.location='../dashboard.php';
               </script>";
       }

    }

    protected function addDPrescription($prescription, $duID){
        $dateAdded = date("Y-m-d h:m:i");
        $sql = "INSERT INTO prescription(duID, pharmacistID, prescription, isOffered, dateAdded, dateCollected)
                VALUES(?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        $zeroID = 0;
        $blank = '';
        if($stmt->execute([$duID, $zeroID, $prescription, $zeroID, $dateAdded, $blank])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Prescription has been added to the database';
            echo "<script type='text/javascript'>
                    window.location='../addPrescription.php?duID=$duID';
                </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! SOmething went wrong. Contact admin';
            echo "<script type='text/javascript'>
                    history.back(-1);
                </script>";
        }
    }

    protected function deletePrescription($pID, $duID){
        $sql = "DELETE FROM prescription WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$pID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Document has been Deleted from the database';
            echo "<script type='text/javascript'>
                    window.location='../addPrescription.php?duID=$duID';
                </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong. Please try again';
            echo "<script type='text/javascript'>
                    window.location='../addPrescription.php?duID=$duID';
                </script>";
        }
    }

    protected function deleteDoc($docID, $duID){
        $rows = $this->GetDocByID($docID);
        $source_raw = $rows[0]['source'];
        $source = "../".$source_raw;
        if(unlink($source)){
            $sql = "DELETE FROM docs WHERE id=?";
            $stmt = $this->con()->prepare($sql);

            if($stmt->execute([$docID])){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Document has been Deleted from the database';
                echo "<script type='text/javascript'>
                    window.location='../uploadDocs.php?duID=$duID';
                </script>";
            }
            else{
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Opps! Something went wrong. Please try again';
                echo "<script type='text/javascript'>
                    window.location='../uploadDocs.php?duID=$duID';
                </script>";
            }
        }else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to unlink Document File from Source';
            echo "<script type='text/javascript'>
                    window.location='../uploadDocs.php?duID=$duID';
                </script>";
        }
    }

    protected function addDoc($title, $description, $duID, $file_tmp, $file_destination, $file_name_new, $file_ext){
        if(move_uploaded_file($file_tmp, $file_destination)){
            $filed = '../documents/'.$file_name_new.'';
            $sql = "INSERT INTO docs(title, description, duID, source, ext)
                    VALUES(?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$title, $description, $duID, $filed, $file_ext]);
            if($stmt){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Document Added Successfully';
                echo "<script>
                    window.location='../uploadDocs.php?duID=$duID';
                </script>";
            }
            else{
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Opps! Something went wrong while uploading the Document- level2';
                echo "<script>
                    history.back(-1);
                </script>";
            }
        }
        else{
            //Failed to move. Probably file destination permissions
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong while uploading the Document- level1';
            echo "<script>
                    history.back(-1);
                </script>";
        }

    }

    protected function addDiagnosis($bloodPressure, $pulse, $glucose, $gcs, $temp, $weight, $height, $diagnosis, $additional, $duID, $doctorID, $dateAdded, $userID){
        $sql = "INSERT INTO diagnosis (userID, doctorID, duID, bloodPressure, pulse, glucose, gcs, temp, weight, height, diagnosis, additional, dateAdded)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$userID, $doctorID, $duID, $bloodPressure, $pulse, $glucose, $gcs, $temp, $weight, $height, $diagnosis, $additional, $dateAdded])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Diagnosis Added to database Successfully';
            echo "<script type='text/javascript'>
                        window.location='../uploadDocs.php?duID=$duID';
                      </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong. Contact admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function updatePatientDetails($name, $surname, $nationalID, $dob, $sex, $phone, $address, $medicalName, $medicalPlan, $nokname, $noksurname, $nokPhone, $userid){
        //check if patient exist. The following function will redirect to previous page if userID is not found in the databae avoiding future errors
        $this->GetPatientByID($userid);
        $sql = "UPDATE patient SET name=?, surname=?, nationalID=?, sex=?, dob=?, address=?, phone=?, nextOfKinName=?, nextOfKinSurname=?, nextOfKinPhone=?, medicalAid=?, medicalAidPlan=? WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $surname, $nationalID, $sex, $dob, $address, $phone, $nokname, $noksurname, $nokPhone, $medicalName, $medicalPlan, $userid])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Patient Account ('.$name.' '.$surname.') Updated Successfully';
            echo "<script type='text/javascript'>
                        window.location='../patientSetup.php?userid=$userid';
                      </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Opps! Something went wrong. Contact admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }

    }

    protected function isUser($id, $role){
        if($role == 'admin'){
            return $this->GetAdminByID($id);
        }
        elseif($role == 'doctor'){
            return $this->GetDoctorByID($id);
        }
        elseif ($role == 'patient'){
            return $this->GetPatientByID($id);
        }
        elseif ($role == 'pharmacist'){
            return $this->GetPharmacistByID($id);
        }
        elseif ($role == 'receptionist'){
            return $this->GetReceptionistByID($id);
        }
    }

    protected function autoLoginUsers($loginID, $par)
    {
        //LOGIN FROM NORMAL LOGIN PAGE
        //THis functino is used to login from 2 endpoint(signin and set password)
        //for setpassword.php, login should be done without need to veryfy login password
        //for normal signin, password has already been verified on User.class::signInUser

        //get user using provided loginID
        $rowsUser = $this->GetUserByLoginID($loginID);
        $id = $rowsUser[0]['id'];

        //since we do not know whre the user has come from(setpassword or normal signin), we check if the password has been set
        //if not set, then the user is coming from setpassword.php hence update password with provided on by variable par
        //else, then its definetly a normal login soo pproceed without updating password
        if($rowsUser[0]['password'] == ''){
            $sql = "UPDATE users SET password=? WHERE loginID=?";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$par,  $loginID]);
        }


        $role = $rowsUser[0]['role'];
        //the following code is to automate the get user type with referance to class throiugh the use of session-role[]
        //it should return an array containing data from the right user table in our database and store is in variable $s
        $s = $this->isUser($id, $role);

        //set user sessions using the $s returned array variable object
        $_SESSION['name'] = $s[0]['name'];
        $_SESSION['surname'] = $s[0]['surname'];
        $_SESSION['role'] = $rowsUser[0]['role'];
        $_SESSION['id'] = $rowsUser[0]['id'];

        //check if user status is active, else, account is deactivated and cannot login
        if ($rowsUser[0]['status'] != 1) {
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'Your account (' . $s[0]['name'] . ' ' . $s[0]['surname'] . ') is temporarily deactivated. Contact the administrator to get this issue fixed';
            //if acc is deactive, destroy sessions
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            unset($_SESSION['surname']);

            echo "<script type='text/javascript'>
                    window.location='../signin.php?loginID=$loginID';
                  </script>";
        } else {
            //everything is okay, the user can log-in
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Welcome '.$loginID.'!';

            //redirect user to teh correct directory
            //Note: all directory names are based on available user roles hence automating the process of redirecting
            echo "<script type='text/javascript'>
                    window.location='../$role/';
                  </script>";

        }


    }

    protected function SigninUser($loginID, $password)
    {
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $res = $stmt->execute([$loginID]);

        if ($res) {
            $record = $stmt->fetchAll();
            /* Check the number of rows that match the SELECT statement */
            if (count($record) > 0) {

                //checkif passwrod is empty else proceed to login
                if($record[0]['password'] == ''){
                    //password not set
                    //set temporary session variables and redirect to set password
                    $_SESSION['loginIDTemp'] = $record[0]['loginID'];
                    $_SESSION['idTemp'] = $record[0]['id'];
                    $_SESSION['ids'] = $record[0]['id'];
                    $_SESSION['type'] = 's';
                    $_SESSION['err'] = 'Looks like this is your first time login-in! Please Choose a password of your choice to proceed';

                    echo "<script type='text/javascript'>;
                          window.location='../setPassword.php';
                        </script>";                }
                else {
                    //password is already set hence proceed logging in
                    foreach ($record as $row) {
                        $passwords = $row["password"];
                        $userID = $row["id"];
                        //verify password encryption
                        if (password_verify($password, $passwords)) {
                            $_SESSION['id'] = $userID;
                            $blank = '';
                            //redirect to main login class whre sessions will be set and redirection
                            //since password is already verified, pass only loginID and a blank variable as a replacement of password
                            Usercontr::autologinUsers($loginID, $blank);
                        } else {
                            //Password Did Not match
                            $_SESSION['type'] = 'w';
                            $_SESSION['err'] = 'Wrong LoginID or Password';

                            echo "<script type='text/javascript'>;
                          window.location='../signin.php?loginID=" . $loginID . "';
                        </script>";
                        }
                    }
                }
            }
            /* No rows matched -- do something else */
            else {
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Wrong LoginID or Password';

                echo "<script type='text/javascript'>;
                          window.location='../signin.php?loginID=".$loginID."';
                        </script>";
            }
        }
    }

    protected function dateToDay($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('l j F Y',$history_bus_date_tostring);
    }

    protected function dateToDayMDY($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('F j Y',$history_bus_date_tostring);
    }

    protected function dateTimeToDay($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('l j F Y H:m:s A',$history_bus_date_tostring);
    }

    protected function GetCountView($query){
        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetDocs($duID){
        $sql = "SELECT * FROM docs WHERE duID=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$duID]);
        return $stmt->fetchAll();
    }

    protected function GetDocByID($id){
        $sql = "SELECT * FROM docs WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Document Data Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }

    protected function GetDiagnosisByUID($id){
        $sql = "SELECT * FROM diagnosis WHERE duID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Diagnostic Data Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }

    protected function GetDiagnosisByUserID($id){
        $sql = "SELECT * FROM diagnosis WHERE userID=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetPrescriptionByID($id){
        $sql = "SELECT * FROM prescription WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Prescription Data Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }

    protected function GetPrescriptionByduID($id){
        $sql = "SELECT * FROM prescription WHERE duID=? ORDER BY ID DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetAdminByID($id){
        $sql = "SELECT * FROM admin WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Admin Data Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }

    protected function GetDoctorByID($id){
        $sql = "SELECT * FROM doctor WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Doctor Data Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }

    protected function GetAllDoctors(){
        $sql = "SELECT * FROM doctor";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetPatientByID($id){
        $sql = "SELECT * FROM patient WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Patient Data Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }

    protected function GetPharmacistByID($id){
        $sql = "SELECT * FROM pharmacist WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Pharmacist Data Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }

    protected function GetReceptionistByID($id){
        $sql = "SELECT * FROM receptionist WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Receptionist Data Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }

    protected function GetAppontmentByAppID($id){
        $sql = "SELECT * FROM appointments WHERE appointmentUID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        $r = $stmt->fetchAll();
        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Appointments Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();
    }

    protected function GetAppontmentByPatientID($id){
        $sql = "SELECT * FROM appointments WHERE patientID=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetAppontmentByDoctorID($id){
        $sql = "SELECT * FROM appointments WHERE doctorID=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }


    protected function GetAllUser(){
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetUserByID($id){
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetUserByLoginID($loginID){
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$loginID]);
        $r = $stmt->fetchAll();

        if(count($r) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'No Data Found';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }
        else{
            return $r;
        }
        return $stmt->fetchAll();

    }

    protected function addAdmin($name, $surname, $id){
        $sql = "INSERT INTO admin(userID, name, surname) VALUES(?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$id, $name, $surname])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Created Admin Successfully';
            echo "<script type='text/javascript'>
                        window.location='../dashboard.php';
                      </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to create user account(2nd level). Contact Admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function addDoctor($name, $surname, $id){
        $sql = "INSERT INTO doctor(UserID, name, surname, hospital, email, phone, category) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        $blank = '';
        if($stmt->execute([$id, $name, $surname, $blank, $blank, $blank, $blank])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Created Doctor Successfully';
            echo "<script type='text/javascript'>
                        window.location='../dashboard.php';
                      </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to create user account(2nd level). Contact Admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function addPatient($name, $surname, $id){
        $sql = "INSERT INTO patient(userID, name, surname, nationalID, sex, dob, address, phone, nextOfKinName, nextOfKinSurname, nextOfKinPhone, medicalAid, medicalAidPlan) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        $blank = '';
        if($stmt->execute([$id, $name, $surname, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank, $blank])){

            if($_SESSION['role'] == 'receptionist' OR $_SESSION['role'] == 'doctor'){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Created Patient Successfully. Finishing up patient account below';
                echo "<script type='text/javascript'>
                        window.location='../patientSetup.php?userid=$id';
                      </script>";
            }
            else {
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Created Patient Successfully';
                echo "<script type='text/javascript'>
                        window.location='../dashboard.php';
                      </script>";
            }

        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to create user account(2nd level). Contact Admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function addPharmacist($name, $surname, $id){
        $sql = 'INSERT INTO pharmacist(userID, name, surname, joint, address, phone, email) VALUES(?,?,?,?,?,?,?)';
        $stmt = $this->con()->prepare($sql);
        $blank = '';
        if($stmt->execute([$id, $name, $surname, $blank, $blank, $blank, $blank])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Created Pharmacist Successfully';
            echo "<script type='text/javascript'>
                        window.location='../dashboard.php';
                      </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to create user account(2nd level). Contact Admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function addReceptionist($name, $surname, $id){
        $sql = 'INSERt INTO receptionist(userID, name, surname, hospital) VALUES(?,?,?,?)';
        $stmt = $this->con()->prepare($sql);
        $blank='';
        if($stmt->execute([$id, $name,$surname, $blank])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Created Receptionist Successfully';
            echo "<script type='text/javascript'>
                        window.location='../dashboard.php';
                      </script>";
        }
        else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Failed to create user account(2nd level). Contact Admin';
            echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
        }
    }

    protected function addUser($name, $surname, $loginID, $userRole, $activeStatus, $joined){
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$loginID]);
        $rows = $stmt->fetchAll();
        if($stmt){
            //Check to see if there is any loginID in database matching the provided one
            if(count($rows) > 0){
                //if loginID already exist in database, do not create account, redirect user to previous page
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'LoginID is not available. Please Choose another';
                echo "<script type='text/javascript'>
                    history.back(-1);
                  </script>";
            }
            else{
                //ACCOUNT NOT FOUND HENCE WITH SAME LOGINID HENCE PROCEED
                $password = '';
                //insert data into users table
                $setSql = "INSERT INTO users(loginID, password, role, joined, status)
                        VALUES (?,?,?,?,?)";
                $setStmt = $this->con()->prepare($setSql);
                if($setStmt->execute([$loginID, $password, $userRole, $joined, $activeStatus])){
                    //Get user id of created user accounts from users table
                    //this will help creating cascading table rows depending on the user role
                    $userFetchRows = $this->GetUserByLoginID($loginID);
                    $id = $userFetchRows[0]['id'];

                    if($userRole == 'admin'){
                        //create admin acc
                        $this->addAdmin($name, $surname, $id);
                    }
                    elseif($userRole == 'doctor'){
                        //create doctor acc
                        $this->addDoctor($name, $surname, $id);
                    }
                    elseif ($userRole == 'patient'){
                        //create patient acc
                        $this->addPatient($name, $surname, $id);
                    }
                    elseif ($userRole == 'pharmacist'){
                        //create pharmacist acc
                        $this->addPharmacist($name, $surname, $id);
                    }
                    elseif ($userRole == 'receptionist'){
                        //create receptionist acc
                        $this->addReceptionist($name, $surname, $id);
                    }
                    else{
                        //failed to execute
                        $_SESSION['type'] = 'w';
                        $_SESSION['err'] = 'Opps! SOmething went wrong';
                        echo "<script type='text/javascript'>
                            history.back(-1);
                          </script>";
                    }

                }
                else{
                    //FAILED TO CREATE USER
                    //echo 'Failed to create user';
                    $_SESSION['type'] = 'w';
                    $_SESSION['err'] = 'Failed to create user';
                    echo "<script type='text/javascript'>
                        window.location='../signup.php';
                      </script>";
                }
            }
        }
        else{
            //FAILED EXECUTING THE QUERY;
            //echo 'Failed executing query';
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'Failed executing query';
            echo "<script type='text/javascript'>
                        window.location='../signup.php';
                      </script>";
        }
    }


}