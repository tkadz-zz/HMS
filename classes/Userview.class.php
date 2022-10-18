<?php

class Userview extends Users
{

    public function viewPatientAppointmentsLoopByAppID($patientID, $appDate, $doctorID){
        $appRows = $this->GetAppByAppID($patientID, $appDate, $doctorID);
        if(count($appRows) > 0){
            $s = 0;
            foreach ($appRows as $appRow){
                $patientRows = $this->GetPatientByID($appRow['patientID']);
                $doctorRows = $this->GetDoctorByID($appRow['doctorID']);
                $s++;
                ?>
                <tr>
                    <td><?php echo $s ?> </td>
                    <td><?php echo $patientRows[0]['name'] .' '. $patientRows[0]['surname'] ?></td>
                    <td><?php echo $doctorRows[0]['name'] .' '. $doctorRows[0]['surname'] ?></td>
                    <td><a href="appointmentDetails.php?appID=<?php echo $appRow['appointmentUID'] ?>"><?php echo $appRow['appointmentUID'] ?></a> </td>
                    <td><?php echo $this->dateToDay($appRow['appDateWork'])?> FROM <?php echo $appRow['appFrom'] ?> TO <?php echo $appRow['appTo'] ?> </td>
                </tr>
                <?php
            }
        }
    }


    public function viewPatientAppointmentsLoop($id){
        $appRows = $this->GetAppontmentByPatientID($id);
        if(count($appRows) > 0){
            $s = 0;
            foreach ($appRows as $appRow){
                $patientRows = $this->GetPatientByID($appRow['patientID']);
                $doctorRows = $this->GetDoctorByID($appRow['doctorID']);
                $s++;
                if($appRow['appDateWork'] > date('Y-m-d')){
                    $cl = 'success';
                }
                else{
                    $cl = 'danger';
                }

                ?>
                <tr>
                    <td class="rounded badge-<?php echo $cl ?>"><?php echo $s ?> </td>
                    <td><?php echo $patientRows[0]['name'] .' '. $patientRows[0]['surname'] ?></td>
                    <td><?php echo $doctorRows[0]['name'] .' '. $doctorRows[0]['surname'] ?></td>
                    <td><a href="appointmentDetails.php?appID=<?php echo $appRow['appointmentUID'] ?>"><?php echo $appRow['appointmentUID'] ?></a> </td>
                    <td class="badge-<?php echo $cl ?>" ><?php echo $this->dateToDay($appRow['appDateWork'])?> FROM <?php echo $appRow['appFrom'] ?> TO <?php echo $appRow['appTo'] ?> </td>
                </tr>
                <?php
            }
        }
    }

    public function viewDoctorAppointmentsLoop($id){
        $appRows = $this->GetAppontmentByDoctorID($id);
        if(count($appRows) > 0){
            $s = 0;
            foreach ($appRows as $appRow){
                $patientRows = $this->GetPatientByID($appRow['patientID']);
                $doctorRows = $this->GetDoctorByID($appRow['doctorID']);
                $s++;
                if($appRow['appDateWork'] > date('Y-m-d')){
                    $cl = 'success';
                }
                else{
                    $cl = 'danger';
                }
                ?>
                <tr>
                    <td class="rounded badge-<?php echo $cl ?>"><?php echo $s ?> </td>
                    <td><?php echo $patientRows[0]['name'] .' '. $patientRows[0]['surname'] ?></td>
                    <td><?php echo $doctorRows[0]['name'] .' '. $doctorRows[0]['surname'] ?></td>
                    <td><a href="appointmentDetails.php?appID=<?php echo $appRow['appointmentUID'] ?>"><?php echo $appRow['appointmentUID'] ?></a> </td>
                    <td class="badge-<?php echo $cl ?>" ><?php echo $this->dateToDay($appRow['appDateWork'])?> FROM <?php echo $appRow['appFrom'] ?> TO <?php echo $appRow['appTo'] ?> </td>
                </tr>
                <?php
            }
        }
    }


    public function viewAppointmentDetails($appID){
        $appRows = $this->GetAppontmentByAppID($appID);
        $doctorRows = $this->GetDoctorByID($appRows[0]['doctorID']);
        $patientRows = $this->GetPatientByID($appRows[0]['patientID'])
        ?>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <span style="font-size: 13px" -class="fa">Appointment-ID: <?php echo $appRows[0]['appointmentUID'] ?></span>
                    <hr>
                    <div class="row">

                        <div class="col-md-6">
                            <h6>Doctor Details</h6>
                            <ul>
                                <li>Doctor name : <span class="text-decoration-underline"><a href="doctorDetails.php?userID=<?php echo $doctorRows[0]['userID'] ?>"><span class="fa fa-user"></span></span> Dr <?php echo $doctorRows[0]['name'] ?>  <?php echo $doctorRows[0]['surname'] ?> <span class="fa fa-chevron-right"></span> </a> </li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <h6>Patient Details</h6>
                            <ul>
                                <li>Patient name :<a><span class="text-decoration-underline"><a href="patientSetup.php?userid=<?php echo $patientRows[0]['userID'] ?>"><span class="fa fa-user"></span> </span> <?php echo $patientRows[0]['name'] ?>  <?php echo $patientRows[0]['surname'] ?> <span class="fa fa-chevron-right"></span> </a></li>
                            </ul>
                        </div>
                        <hr>
                        <div class="row mt-2 text-center">
                            <h6 class="card-header">Appointment</h6>
                                <span class="p-1">Appointment Date: <?php echo $this->dateToDay($appRows[0]['appDateWork']) ?></span>
                                <br>
                                <span class="p-1">From: <?php echo $appRows[0]['appFrom'] ?></span>
                                <br>
                                <span class="p-1">To: <?php echo $appRows[0]['appTo'] ?></span>
                            </span>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <?php
    }

    public function doctorOptionLoop(){
        $userRows = $this->GetAllDoctors();
        foreach ($userRows as $userRow){
            ?>
            <option value="<?php echo $userRow['userID'] ?>"> DR. <?php echo $userRow['name'] .' '. $userRow['surname'] ?> (<?php echo $userRow['category'] ?>)</option>
            <?php
        }
    }


    public function viewSetApointmentCheck($id){
        $userRows = $this->GetPatientByID($id);
        ?>

        <div class="row">
            <div class="col-md-12 border-right card rounded -card-body">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Set Appointment For <?php echo $userRows[0]['name'] .' '. $userRows[0]['surname'] ?></h4>
                    </div>
                    <hr>
                    <form class="form" method="post" action="includes/checkAppointment.inc.php?userID=<?php echo $id ?>" >
                        <span class="card-description">Input details to check if there are any appointments for the date you provide</span>
                        <br>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Appointment Date</label>
                                <input id="text" min="<?php echo date('Y-m-d', strtotime("+1 day")) ?>" name="AppDate" type="date" class="form-control" minlength="8" required>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Select Doctor</label>
                                <select class="form-control" name="doctorID">
                                    <?php
                                    echo $this->doctorOptionLoop();
                                    ?>
                                </select>
                            </div>

                            <div class="row mt-2 pt-3">
                                <div class="col-md-3">
                                    <label class="labels">From</label>
                                    <input id="text" name="appFrom" type="time" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="labels">To</label>
                                    <input id="text" name="appTo" type="time" class="form-control" required>
                                </div>
                            </div>

                        </div>
                        <div class="mt-5 text-center">
                            <button id="save-btn" name="btn_setApp" class="btn btn-primary" type="submit">Check</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
    }

    public function viewSetApointment($patientID){
        $userRows = $this->GetPatientByID($patientID);
        $str=rand();
        $result = md5($str);
        ?>

        <div class="row">
            <div class="col-md-12 border-right card rounded -card-body">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Approve This Appointment For <?php echo $userRows[0]['name'] .' '. $userRows[0]['surname'] ?></h4>
                        <span class="fa" style="font-size: 13px">Appointment ID: <?php echo $result ?></span>
                    </div>
                    <hr>
                    <form class="form" method="post" action="includes/setAppointment.inc.php?appID=<?php echo $result ?>&userID=<?php echo $patientID ?>&doctorID=<?php echo $_GET['doctorID'] ?>" >
                        <div class="row mt-2 text-center">
                            <span style="font-size: 14px">
                                <?php
                                $doctorRows = $this->GetDoctorByID($_GET['doctorID']);
                                ?>
                                Doctor: <a href="doctorDetails.php?userID=<?php echo $doctorRows[0]['userID'] ?>"> DR <?php echo $doctorRows[0]['name'] ?> <?php echo $doctorRows[0]['surname'] ?></a>
                                <br>
                                Date: <?php echo $this->dateToDay($_SESSION['tempAppDate']) ?>
                                <br>
                                From: <?php echo $_SESSION['tempAppFrom'] ?>
                                <br>
                                To: <?php echo $_SESSION['tempAppTo'] ?>
                            </span>
                        </div>
                        <div class="mt-5 text-center">
                            <button id="save-btn" name="btn_setApp" class="btn btn-primary" type="submit">YES <span class="fa fa-check-circle"></span></button>
                            <a href="checkAppointment.php?userID=<?php echo $patientID ?>" id="save-btn" name="btn_cancelApp" class="btn btn-danger" type="">NO <span class="fa fa-times-circle"></span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
    }


    public function viewAppointmentsLoopByAppDate($patientID, $appDate, $doctorID){
        ?>
        <div id="--printableArea" class="card-box">
            <h4 class="mt-0 header-title"></h4>
            <p class="text-muted font-14 mb-3">
                All Patient's Appointments
            </p>
            <table id="datatable" class="table table-bordered dt-responsive nowrap">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Appointment ID</th>
                    <th>Appointment Date</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $n = new Userview();
                $n->viewPatientAppointmentsLoopByAppID($patientID, $appDate, $doctorID);
                ?>
                </tbody>


            </table>
        </div>
        <?php
    }






    public function receptionistProfile(){
        $userRows = $this->GetReceptionistByID($_SESSION['id']);
        $rows = $this->GetUserByID($_SESSION['id']);
        ?>
        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">

                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updateProfile.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Login-ID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="New Login-ID..." value="<?php echo $rows[0]['loginID']  ?>" >
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRows[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRows[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>
                            <!-- Fileds here -->
                            <div class="row mt-3">
                                <div class="col-md-12 pt-3">
                                    <label class="labels">Hospital/Clinic Name</label>
                                    <input name="hospital" type="text" class="form-control" placeholder="Your Work Place Name..." value="<?php echo $userRows[0]['hospital'] ?>">
                                </div>
                            </div>

                            <div class="row mt-3">

                                <div class="mt-5 text-center">
                                    <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div -class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <?php
    }

    public function patientProfile(){
        $userRows = $this->GetPatientByID($_SESSION['id']);
        $rows = $this->GetUserByID($_SESSION['id']);
        ?>
        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">

                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updateProfile.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Login-ID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="New Login-ID..." value="<?php echo $rows[0]['loginID']  ?>" >
                                </div>
                            </div>
                            <!-- Fileds here -->
                            <br>
                            <div class="row mt-2">
                                <div class="col-md-8">
                                    <label class="labels">National ID (<span class="card-description">xx-xxxxxxXxx</span>)</label>
                                    <input name="nationalID" type="text" class="form-control" placeholder="Legal National Identification Number" minlength="12" maxlength="12" value="<?php echo $userRows[0]['nationalID'] ?>" required>
                                </div>
                            </div>
                            <br>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRows[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRows[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">DOB (<span class="card-description"><?php echo $this->dateToDay($userRows[0]['dob']) ?></span>) </label>
                                    <input name="dob" type="date" class="form-control" placeholder="Date of birth" value="<?php echo $userRows[0]['dob'] ?>" max="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label class="labels">Gender</label>
                                <select name="sex" type="text" class="form-control" required>
                                    <?php
                                    $n = new Userview();
                                    $n->validateUserGender($_SESSION['id'], 'patient');
                                    ?>
                                </select>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Mobile Number</label>
                                    <input name="phone" type="number" class="form-control" placeholder="Please enter phone number" value="<?php echo $userRows[0]['phone'] ?>" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="labels">Address</label>
                                    <input name="address" type="text" class="form-control" placeholder="enter address line 1" value="<?php echo $userRows[0]['address'] ?>" required>
                                </div>


                            </div>


                            <hr class="mt-5">
                            <br>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right card-header">Patient's Medical Aid</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Medical Aid Provider</label>
                                    <input name="medicalName" type="text" class="form-control" placeholder="Medical Aid" value="<?php echo $userRows[0]['medicalAid'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Medical Aid Plan</label>
                                    <input name="medicalPlan" type="text" class="form-control" value="<?php echo $userRows[0]['medicalAidPlan'] ?>" placeholder="Medical Aid Plan" required>
                                </div>
                            </div>



                            <hr class="mt-5">
                            <br>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right card-header">Patient's Next Of Kin</h4>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Next of kin's Name</label>
                                    <input name="nokname" type="text" class="form-control" placeholder="Next Of Kin Name" value="<?php echo $userRows[0]['nextOfKinName'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Next of kin's Surname</label>
                                    <input name="noksurname" type="text" class="form-control" value="<?php echo $userRows[0]['nextOfKinSurname'] ?>" placeholder="Next Of Kin Suname" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Next of kin's Phone</label>
                                    <input name="nokPhone" type="number" class="form-control" placeholder="Next Of Kin Phone" value="<?php echo $userRows[0]['nextOfKinPhone'] ?>" required>
                                </div>
                            </div>


                            <div class="mt-5 text-center">
                                <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div -class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    public function doctorProfile(){
        $userRows = $this->GetDoctorByID($_SESSION['id']);
        $rows = $this->GetUserByID($_SESSION['id']);
        ?>
        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">

                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updateProfile.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Login-ID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="New Login-ID..." value="<?php echo $rows[0]['loginID']  ?>" >
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRows[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRows[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>
                            <!-- Fileds here -->
                            <br>
                            <div class="row mt-3">

                                <div class="col-md-12 pb-3">
                                    <label class="labels">Email</label>
                                    <input name="email" type="email" class="form-control" placeholder="enter your/company email..." value="<?php echo $userRows[0]['email'] ?>">
                                </div>
                                <div class="col-md-12 pb-3">
                                    <label class="labels">Mobile Number</label>
                                    <input name="phone" type="text" class="form-control" placeholder="enter phone number..." value="<?php echo $userRows[0]['phone'] ?>">
                                </div>
                                <div class="col-md-12 pb-3">
                                    <label class="labels">Specialisatoin</label>
                                    <input name="category" type="text" class="form-control" placeholder="enter your specialisatoin e.g Dematologist..." value="<?php echo $userRows[0]['category'] ?>">
                                </div>
                                <div class="col-md-12 pb-3">
                                    <label class="labels">Hospital/Clinic Name</label>
                                    <input name="hospital" type="text" class="form-control" placeholder="Your Work Place Name..." value="<?php echo $userRows[0]['hospital'] ?>">
                                </div>

                            </div>

                            <div class="row mt-3">

                                <div class="mt-5 text-center">
                                    <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div -class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    public function pharmacistProfile(){
        $userRows = $this->GetPharmacistByID($_SESSION['id']);
        $rows = $this->GetUserByID($_SESSION['id']);
        ?>
        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">

                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updateProfile.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Login-ID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="New Login-ID..." value="<?php echo $rows[0]['loginID']  ?>" >
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRows[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRows[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>
                            <!-- Fileds here -->
                            <br>
                            <div class="row mt-3">

                                <div class="col-md-12 pb-3">
                                    <label class="labels">Email</label>
                                    <input name="email" type="email" class="form-control" placeholder="enter your/company email..." value="<?php echo $userRows[0]['email'] ?>">
                                </div>
                                <div class="col-md-12 pb-3">
                                    <label class="labels">Mobile Number</label>
                                    <input name="phone" type="text" class="form-control" placeholder="enter phone number..." value="<?php echo $userRows[0]['phone'] ?>">
                                </div>
                                <div class="col-md-12 pb-3">
                                    <label class="labels">Address</label>
                                    <input name="address" type="text" class="form-control" placeholder="enter your/company address..." value="<?php echo $userRows[0]['address'] ?>">
                                </div>
                                <div class="col-md-12 pb-3">
                                    <label class="labels">Company Name</label>
                                    <input name="joint" type="text" class="form-control" placeholder="Pharmacist's Work Place Name..." value="<?php echo $userRows[0]['joint'] ?>">
                                </div>

                            </div>

                            <div class="row mt-3">

                                <div class="mt-5 text-center">
                                    <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div -class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    public function adminProfile(){
        $userRows = $this->GetAdminByID($_SESSION['id']);
        $rows = $this->GetUserByID($_SESSION['id']);
        ?>
        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">

                <div class="col-md-2 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updateProfile.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Login-ID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="New Login-ID..." value="<?php echo $rows[0]['loginID']  ?>" >
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRows[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRows[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>
                            <!-- Fileds here -->
                            <div class="row mt-3">

                                <div class="mt-5 text-center">
                                    <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div -class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    public function viewChangeUserPassword($id){
        ?>
        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row">
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updatePassword.inc.php" >

                            <div class="mt-5 text-center">
                                <button id="save-btn" name="btn_updatePassword" class="btn btn-primary" type="submit">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="profile.php" class="btn btn-dark align-items-center"> <span class="fa fa-user-edit"></span> Update Profile <span class="fa fa-arrow-right"></span></a>

                    </div>
                </div>

            </div>
        </div>
        <?php
    }


    public function userProfile($id){
        $rows = $this->GetUserByID($id);
        $userRows = $this->isUser($id, $rows[0]['role']);
        ?>
        <br>
        <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-size="large"><a href="dashboard.php" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
        <br>

        <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row">

                <div class="col-md-12 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <span class="font-weight-bold">Name:<br> <?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                        <br>
                        <span>User Account: <?php echo $rows[0]['role'] ?> </span>
                        <br>
                        <span>Joined: <?php echo $this->dateTimeToDay($rows[0]['joined']) ?> </span>
                        <br>
                    </div>

                    <a onclick="return confirm('Are you sure you want to reset user password?')" href="includes/resetUserPassword.inc.php?userID=<?php echo $id ?>" class="btn btn-outline-primary"> Reset User Password</a>

                </div>
                </div>
        </div>
        <?php
    }



    public function viewChangePassword(){
        ?>
        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row">
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>

                        </div>
                        <form method="post" action="includes/updatePassword.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Current Password</label>
                                    <input name="op" type="password" class="form-control" placeholder="Current Password" required>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">New Password</label>
                                    <input id="password" name="np" type="password" class="form-control" placeholder="New Password" onkeyup='check();' minlength="8" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Confirm New Password</label>
                                    <input id="confirmPassword" name="cp" type="password" class="form-control" placeholder="Confirm New Password" onkeyup='check();' minlength="8" required>
                                </div>
                            </div>

                            <script>
                                var check = function() {
                                    if (document.getElementById('password').value ==
                                        document.getElementById('confirmPassword').value) {
                                        document.getElementById('message').style.color = 'green';
                                        document.getElementById("save-btn").disabled = false;
                                        document.getElementById('message').innerHTML = '<div id="divDis" class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-success"><span class="fa fa-check-circle"></span>Password matched</div>';
                                    }
                                    else {
                                        document.getElementById('message').style.color = 'red';
                                        document.getElementById("save-btn").disabled = true;
                                        document.getElementById('message').innerHTML = '<div class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-danger"><span class="fa fa-exclamation-circle"></span>New Password not matching Confirm Password</div>';
                                    }


                                }
                            </script>

                            <div>

                                <span id='message'></span>

                            </div>


                            <div class="mt-5 text-center">
                                <button id="save-btn" name="btn_updatePassword" class="btn btn-primary" type="submit">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="profile.php" class="btn btn-dark align-items-center"> <span class="fa fa-user-edit"></span> Update Profile <span class="fa fa-arrow-right"></span></a>

                    </div>
                </div>

            </div>
        </div>
        <?php
    }

    public function viewSearchResults($serach){
        $userRows = $this->searchPatientQuery($serach);
        $s = 0;
        ?>
        <div id="--printableArea" class="card-box">
            <h4 class="mt-0 header-title"></h4>
            <p class="text-muted font-14 mb-3">
                All Patient Accounts
            </p>
            <table id="datatable" class="table table-bordered dt-responsive nowrap">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>National-ID</th>
                    <th>Prescriptions</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($userRows as $row){
                    $s++;
                    ?>
                    <tr>
                        <td><?php echo $s ?> </td>
                        <td><?php echo $userRows[0]['name'] ?></td>
                        <td><?php echo $userRows[0]['surname'] ?> </td>
                        <td><?php echo $userRows[0]['nationalID'] ?> </td>
                        <td><a href="medicalHistory.php?userid=<?php echo $row['userID'] ?>"> More <span class="fa fa-arrow-right"></span> </a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>


            </table>
        </div>
        <?php
    }

    public function viewPharmacistDetails($id){
        $pharmacistRows = $this->GetPharmacistByID($id);
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title card-header">Pharmacist Details</h4>
                    <hr>
                    <div class="row">

                        <div class="col-md-12">
                            <ul>
                                <li><span class="text-decoration-underline">Pharmacist name : </span> <?php echo $pharmacistRows[0]['name'] ?>  <?php echo $pharmacistRows[0]['surname'] ?> </li>
                                <li><span class="text-decoration-underline">Hospital/Clinic : </span> <?php echo $pharmacistRows[0]['joint'] ?> </li>
                                <li><span class="text-decoration-underline">Work Address : </span> <?php echo $pharmacistRows[0]['address'] ?> </li>
                                <li><span class="text-decoration-underline">Phone : </span> <a href="tell:<?php echo $pharmacistRows[0]['phone'] ?>"><?php echo $pharmacistRows[0]['phone'] ?></a></li>
                                <li><span class="text-decoration-underline">Email : </span> <a href="mailto:<?php echo $pharmacistRows[0]['email'] ?>"><?php echo $pharmacistRows[0]['email'] ?></a></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <?php
    }

    public function viewDoctorDetails($id){
        $doctorRows = $this->GetDoctorByID($id);
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title card-header">Doctor Details</h4>
                    <hr>
                    <div class="row">

                        <div class="col-md-12">
                            <ul>
                                <li><span class="text-decoration-underline">Doctor name : </span> Dr <?php echo $doctorRows[0]['name'] ?>  <?php echo $doctorRows[0]['surname'] ?> </li>
                                <li><span class="text-decoration-underline">Hospital/Clinic : </span> <?php echo $doctorRows[0]['hospital'] ?> </li>
                                <li><span class="text-decoration-underline">Specialisation : </span> <?php echo $doctorRows[0]['category'] ?> </li>
                                <li><span class="text-decoration-underline">Phone : </span> <a href="tell:<?php echo $doctorRows[0]['phone'] ?>"><?php echo $doctorRows[0]['phone'] ?></a></li>
                                <li><span class="text-decoration-underline">Email : </span> <a href="mailto:<?php echo $doctorRows[0]['email'] ?>"><?php echo $doctorRows[0]['email'] ?></a></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <?php
    }

    public function viewUserDiagnosisSummeryToPharmacist($id, $duID){
        $diagonisRow = $this->GetDiagnosisByUID($duID);
        $patientRows = $this->GetPatientByID($id);
        $doctorRows = $this->GetDoctorByID($diagonisRow[0]['doctorID']);
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-size: 15px" class="card-title card-header">Diagnosis FOR <?php echo $patientRows[0]['name'] .' '. $patientRows[0]['surname'] ?> ON  <?php echo $this->dateToDay($diagonisRow[0]['dateAdded']) ?></h6>
                    <p class="card-description">
                        The following are the all the diagnosis details recorded by <a style="font-size: 15px" href="doctorDetails.php?userID=<?php echo $diagonisRow[0]['doctorID'] ?>" class="fa fa-user" > DR <?php echo $doctorRows[0]['name']  ?></a>
                    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-href="medicalHistory.php?userID=<?php echo $id ?>" data-layout="button" data-size="large"><a href="medicalHistory.php?userid=<?php echo $id ?>" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
                    </p>
                    <hr>
                    <div class="row">

                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Blood Pressure :</span> <?php echo $diagonisRow[0]['bloodPressure'] ?> mmHG </li>
                                <li><span class="text-decoration-underline">Pulse :</span> <?php echo $diagonisRow[0]['pulse']  ?> Bpm </li>
                                <li><span class="text-decoration-underline">Glucose :</span> <?php echo $diagonisRow[0]['glucose']  ?> Mmol </li>
                                <li><span class="text-decoration-underline">GCS :</span> <?php echo $diagonisRow[0]['gcs']  ?> </li>
                            </ul>
                        </div>


                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Temperature :</span> <?php echo $diagonisRow[0]['temp'] ?> &#176C </li>
                                <li><span class="text-decoration-underline">Weight :</span> <?php echo $diagonisRow[0]['weight']  ?> Kgs </li>
                                <li><span class="text-decoration-underline">Height :</span> <?php echo $diagonisRow[0]['height']  ?> Inchs </li>
                            </ul>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Diagnosis :</span><br><?php echo $diagonisRow[0]['diagnosis'] ?>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Additional Details :</span><br><?php echo $diagonisRow[0]['additional']  ?>
                        </div>

                    </div>

                    <br>
                    <hr>

                    <h5 class="card-header">Prescriptions Prescribed</h5>
                    <br>
                    <?php
                    $this->viewUserAddedPrescription($_GET['duID']);
                    ?>

                </div>
            </div>
        </div>
        <?php
    }

    public function viewUserDiagnosisSummery($id, $duID){
        $diagonisRow = $this->GetDiagnosisByUID($duID);
        $patientRows = $this->GetPatientByID($id);
        $doctorRows = $this->GetDoctorByID($diagonisRow[0]['doctorID']);
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-size: 15px" class="card-title card-header">Diagnosis FOR <?php echo $patientRows[0]['name'] .' '. $patientRows[0]['surname'] ?> ON  <?php echo $this->dateToDay($diagonisRow[0]['dateAdded']) ?></h6>
                    <p class="card-description">
                        The following are the all the diagnosis details recorded by <a style="font-size: 15px" href="doctorDetails.php?userID=<?php echo $diagonisRow[0]['doctorID'] ?>" class="fa fa-user" > DR <?php echo $doctorRows[0]['name']  ?></a>
                    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-href="medicalHistory.php?userID=<?php echo $id ?>" data-layout="button" data-size="large"><a href="medicalHistory.php?userid=<?php echo $id ?>" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Back</a></div>
                    </p>
                    <hr>
                    <div class="row">

                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Blood Pressure :</span> <?php echo $diagonisRow[0]['bloodPressure'] ?> mmHG </li>
                                <li><span class="text-decoration-underline">Pulse :</span> <?php echo $diagonisRow[0]['pulse']  ?> Bpm </li>
                                <li><span class="text-decoration-underline">Glucose :</span> <?php echo $diagonisRow[0]['glucose']  ?> Mmol </li>
                                <li><span class="text-decoration-underline">GCS :</span> <?php echo $diagonisRow[0]['gcs']  ?> </li>
                            </ul>
                        </div>


                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Temperature :</span> <?php echo $diagonisRow[0]['temp'] ?> &#176C </li>
                                <li><span class="text-decoration-underline">Weight :</span> <?php echo $diagonisRow[0]['weight']  ?> Kgs </li>
                                <li><span class="text-decoration-underline">Height :</span> <?php echo $diagonisRow[0]['height']  ?> Inchs </li>
                            </ul>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Diagnosis :</span><br><?php echo $diagonisRow[0]['diagnosis'] ?>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Additional Details :</span><br><?php echo $diagonisRow[0]['additional']  ?>
                        </div>

                    </div>

                    <hr>
                    <h5 class="card-header">Documents Added</h5>
                    <br>
                    <?php
                    $this->viewUserDocLoop($_GET['duID']);
                    ?>
                    <br>
                    <br>
                    <hr>

                    <h5 class="card-header">Prescriptions Prescribed</h5>
                    <br>
                    <?php
                    $this->viewUserAddedPrescription($_GET['duID']);
                    ?>

                </div>
            </div>
        </div>
        <?php
    }

    public function ViewPatientMedicalHistory($id){
        $userRows = $this->GetPatientByID($id);
        $diagnosisRows = $this->GetDiagnosisByUserID($id);
        $s = 0;
        foreach ($diagnosisRows as $diagnosisRow){
            $s++;
            ?>
            <tr>
                <td><?php echo $s ?> </td>
                <td><?php echo $userRows[0]['name'] ?> <?php echo $userRows[0]['surname'] ?> </td>
                <td><a href="medicalHistoryDetails.php?duID=<?php echo $diagnosisRow["duID"] ?>&userID=<?php echo $id ?>"><?php echo $diagnosisRow["duID"] ?> <span class="fa fa-arrow-right"></span> </a></td>
                <td><?php echo $this->dateToDay($diagnosisRow['dateAdded']) ?> </td>
            </tr>
            <?php
        }
    }

    public function viewDiagnosisSummery($duID){
        $diagonisRow = $this->GetDiagnosisByUID($duID);
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title card-header">Diagnosis Detailed Summery</h4>
                    <p class="card-description">
                        The following are the all the diagnosis details you have provieded
                    <div class="btn btn-outline-secondary btn-sm rounded text-decoration-none" data-href="addPrescription.php?duID=<?php echo $duID ?>" data-layout="button" data-size="large"><a href="addPrescription.php?duID=<?php echo $duID ?>" class="fb-xfbml-parse-ignore"><span class="fa fa-chevron-circle-left"></span> Edit <span class="fa fa-pencil"></span> </a></div>
                    </p>
                    <hr>
                    <div class="row">

                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Blood Pressure :</span> <?php echo $diagonisRow[0]['bloodPressure'] ?> mmHG </li>
                                <li><span class="text-decoration-underline">Pulse :</span> <?php echo $diagonisRow[0]['pulse']  ?> Bpm </li>
                                <li><span class="text-decoration-underline">Glucose :</span> <?php echo $diagonisRow[0]['glucose']  ?> Mmol </li>
                                <li><span class="text-decoration-underline">GCS :</span> <?php echo $diagonisRow[0]['gcs']  ?> </li>
                            </ul>
                        </div>


                        <div class="col-md-3">
                            <ul>
                                <li><span class="text-decoration-underline">Temperature :</span> <?php echo $diagonisRow[0]['temp'] ?> &#176C </li>
                                <li><span class="text-decoration-underline">Weight :</span> <?php echo $diagonisRow[0]['weight']  ?> Kgs </li>
                                <li><span class="text-decoration-underline">Height :</span> <?php echo $diagonisRow[0]['height']  ?> Inchs </li>
                            </ul>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Diagnosis :</span><br><?php echo $diagonisRow[0]['diagnosis'] ?>
                        </div>

                        <div class="col-md-3" style="font-size: 13px">
                            <span class="text-decoration-underline">Additional Details :</span><br><?php echo $diagonisRow[0]['additional']  ?>
                        </div>

                    </div>

                    <hr>
                    <h5 class="card-header">Documents Added</h5>
                    <br>
                    <?php
                    $this->viewDocLoop($_GET['duID']);
                    ?>
                    <br>
                    <br>
                    <hr>

                    <h5 class="card-header">Prescriptions Prescribed</h5>
                    <br>
                    <?php
                    $this->viewAddedPrescription($_GET['duID']);
                    ?>

                </div>
            </div>
        </div>
        <?php
    }

    public function viewUserAddedPrescription($duID){
        $rows = $this->GetPrescriptionByduID($duID);
        if(count($rows) > 0){
            foreach ($rows as $row){
                ?>
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-info">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>

                    <span class="text-dark">
                    <span class="animated--grow-in fadeout text-dark"></span><b><u>Prescription:</u></b> <?php echo $row['prescription'] ?>
                        <br>
                        <br>
                    <span class="animated--grow-in fadeout text-dark"></span><b><u>Collected: </u></b>
                         <?php
                         if($row['isOffered'] == 1){
                             ?>
                             <span class="badge badge-success rounded fa">Yes <span class="fa fa-check"></span> </span>
                             ON <span style="font-size: 15px" class="fa text-decoration-underline"><?php echo $this->dateTimeToDay($row['dateCollected']) ?></span>

                            <?php
                             if($row['pharmacistID'] != 0){
                                 $pharmacistRows = $this->GetPharmacistByID($row['pharmacistID']);
                                 ?>
                                 By <span style="font-size: 15px" class="fa text-decoration-underline"><a href="pharmacistDetails.php?userID=<?php echo $row['pharmacistID']?>"><span class="fa fa-user"> <?php echo $pharmacistRows[0]['name'] ?> <?php echo $pharmacistRows[0]['surname'] ?></span> </a> </span>
                                 <?php
                             }
                             ?>

                             <?php
                         }
                         else{
                             ?>
                             <span class="badge badge-danger rounded fa">No <span class="fa fa-times"></span></span>
                             <?php
                             if($_SESSION['role'] == 'pharmacist'){
                                 ?>
                                 <div>
                                     <hr>
                                     <label class="fa card-description">Click the button if the patient has collected this prescription</label>
                                     <a class="btn btn-outline-primary" href="includes/collectPrescription.inc.php?duID=<?php echo $duID ?>&userID=<?php echo $_GET['userID'] ?>&pid=<?php echo $row['id'] ?>"onclick="return confirm('By clicking OKAY, you acknowledge that the patient has collected this prescription')">Mark As Offered</a>
                                 </div>
                                 <?php
                             }

                         }
                         ?>
                </span>
                    <br>
                    <br>
                </div>
                <?php
            }
        }
        else{
            ?>
            <div class="col-md-6 rounded">
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-warning">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <span class="text-dark">
                        <span class="animated--grow-in fadeout text-dark"></span>No Prescriptions Where Provided
                    </span>

                </div>
            </div>
            <?php
        }
    }

    public function viewUserDocLoop($duid){
        $this->GetDiagnosisByUID($duid);
        $rows = $this->GetDocs($duid);
        if(count($rows) > 0){

            foreach ($rows as $row){
                ?>
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-info">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <div class="">
                        <?php
                        if($row['ext'] == 'jpeg' OR $row['ext'] == 'jpg' OR $row['ext'] == 'png'){
                            ?>
                            <img class="img-fluid rounded border border-secondary" style="height: 60px" src="<?php echo $row['source']  ?>" >
                            <br>
                            <a download="<?php echo $row['ext'] ?>"  href="<?php echo $row['source'] ?>">Download <?php echo $row['ext'] ?> Image File <span class="mdi mdi-download"></span></a>

                            <?php
                        }
                        else{
                            ?>
                            <img class="img-fluid rounded border border-secondary" style="height: 60px" src="../img/docR.png" >
                            <br>
                            <a download="<?php echo $row['ext'] ?>"  href="<?php echo $row['source'] ?>">Download <?php echo $row['ext'] ?> Document File <span class="mdi mdi-download"></span></a>
                            <?php
                        }
                        ?>
                    </div>
                    <span class="text-dark">
                    <span class="animated--grow-in fadeout text-dark"></span>Title: <?php echo $row['title'] ?>
                </span>
                    <br>
                    <span class="text-dark">
                    <span class="animated--grow-in fadeout text-dark"></span>Description: <?php echo $row['description'] ?>
                </span>
                </div>
                <?php
            }
        }
        else{
            ?>
            <div class="col-md-6 rounded">
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-warning">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <span class="text-dark">
                        <span class="animated--grow-in fadeout text-dark"></span>No Documents Or Images Where Added
                    </span>

                </div>
            </div>
            <?php
        }

    }

    public function viewAddedPrescription($duID){
        $rows = $this->GetPrescriptionByduID($duID);
        if(count($rows) > 0){
            foreach ($rows as $row){
                ?>
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-info">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>

                    <span class="text-dark">
                    <span class="animated--grow-in fadeout text-dark"></span><b><u>Prescription:</u></b> <?php echo $row['prescription'] ?>
                </span>
                    <br>
                    <a style="float: right; color: firebrick; font-size:15px" onclick="return confirm('Are you sure you want to proceed removing this qualification?')" href="includes/deletePrescription.inc.php?pID=<?php echo $row['id'] ?>&duID=<?php echo $_GET['duID'] ?>" class="closebtn" data-bs-dismiss="toast" aria-label="Close">
                        <span class="fa fa-trash"></span>
                    </a>
                    <br>
                </div>
                <?php
            }
        }
        else{
            ?>
            <div class="col-md-6 rounded">
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-warning">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <span class="text-dark">
                        <span class="animated--grow-in fadeout text-dark"></span>Added Prescriptions will appear here
                    </span>

                </div>
            </div>
            <?php
        }
    }

    public function viewDocLoop($duid){
        $this->GetDiagnosisByUID($duid);
        $rows = $this->GetDocs($duid);
        if(count($rows) > 0){

            foreach ($rows as $row){
                ?>
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-info">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <div class="">
                        <?php
                        if($row['ext'] == 'jpeg' OR $row['ext'] == 'jpg' OR $row['ext'] == 'png'){
                            ?>
                            <img class="img-fluid rounded border border-secondary" style="height: 60px" src="<?php echo $row['source']  ?>" >
                            <br>
                            <label>Image(<?php echo $row['ext'] ?>)</label>
                            <?php
                        }
                        else{
                            ?>
                            <img class="img-fluid rounded border border-secondary" style="height: 60px" src="../img/docR.png" >
                            <br>
                            <label>Document(<?php echo $row['ext'] ?>)</label>
                            <?php
                        }
                        ?>
                    </div>
                    <span class="text-dark">
                    <span class="animated--grow-in fadeout text-dark"></span>Title: <?php echo $row['title'] ?>
                </span>
                    <br>
                    <span class="text-dark">
                    <span class="animated--grow-in fadeout text-dark"></span>Description: <?php echo $row['description'] ?>
                </span>
                    <a style="float: right; color: firebrick; font-size:15px" onclick="return confirm('Are you sure you want to proceed removing this qualification?')" href="includes/deleteDoc.inc.php?docID=<?php echo $row['id'] ?>&duID=<?php echo $_GET['duID'] ?>" class="closebtn" data-bs-dismiss="toast" aria-label="Close">
                        <span class="fa fa-trash"></span>
                    </a>
                </div>
                <?php
            }
        }
        else{
            ?>
            <div class="col-md-6 rounded">
                <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-warning">
                    <div class="closebtn">
                        <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
                    </div>
                    <span class="text-dark">
                        <span class="animated--grow-in fadeout text-dark"></span>Uploaded Documents will appear here
                    </span>

                </div>
            </div>
            <?php
        }

    }

    public function viewAddDiagnosis($id){
        $rows = $this->GetUserByID($id);
        $userRow = $this->GetPatientByID($id);

        $str=rand();
        $result = md5($str);
        ?>
        <h4 class="mt-0 text-muted header-title pt-4">
            Diagnosis for <?php echo $userRow[0]['name'] .' '. $userRow[0]['surname'] ?>
        </h4>
        <hr>
        <br>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 -class="card-title">Diagnosis date: <?php echo $this->dateToDay(date('Y-m-d')) ?></h6>
                    <p class="card-description">
                        <br>
                    </p>
                    <form class="form-inline" method="POST" action="includes/addDiagnosis.inc.php?userid=<?php echo $_GET['userid'] ?>">
                        <div class="col-md-6 row pb-3">
                            <input name="duid" type="text" value="<?php echo $result ?>" hidden>
                            <div class="col-md-6">
                                <label class="font-10" for="inlineFormInputName2">Name</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="" value="<?php echo $userRow[0]['name'] ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="font-10" for="inlineFormInputName2">Surname</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="" value="<?php echo $userRow[0]['surname'] ?>" disabled>
                            </div>
                        </div>

                        <hr>
                        <h4>Vital Signs</h4>
                        <br>

                        <div class="row">
                            <div class="col-md-6 row pb-3">

                                <div class="col-md-6">
                                    <label style="font-size: 13px" class="card-description" for="inlineFormInputName2">Blood Pressure </label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">mmHG</div>
                                        </div>
                                        <input name="bloodPressure" type="number" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter Blood Pressure" required>
                                    </div>

                                    <label style="font-size: 13px" class="card-description pt-3" for="inlineFormInputName2">Pulse</label>
                                    <div class="input-group -mb-2 -mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">Bpm</div>
                                        </div>
                                        <input name="pulse" type="number" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter Heart Pulse" required>
                                    </div>


                                    <label style="font-size: 13px" class="card-description pt-3" for="inlineFormInputName2">Glucose</label>
                                    <div class="input-group -mb-2 -mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">mmol</div>
                                        </div>
                                        <input name="glucose" type="number" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter Glucose/ Suger Levels" required>
                                    </div>

                                    <label style="font-size: 13px" class="card-description pt-3" for="inlineFormInputName2">GCS</label>
                                    <div class="input-group -mb-2 -mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">#</div>
                                        </div>
                                        <input name="gcs" type="number" class="form-control" -id="inlineFormInputGroupUsername2" placeholder="Enter GCS 1-15" max="15" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label style="font-size: 13px" class="card-description" for="inlineFormInputName2">Temperature</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">&#176C</div>
                                        </div>
                                        <input name="temp" type="number" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Temperature in &#176C" required>
                                    </div>

                                    <label style="font-size: 13px" class="card-description pt-3" for="inlineFormInputName2">Weight</label>
                                    <div class="input-group -mb-2 -mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">Kg</div>
                                        </div>
                                        <input name="weight" type="number" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter Weight in Kilograms" required>
                                    </div>


                                    <label style="font-size: 13px" class="card-description pt-3" for="inlineFormInputName2">Height</label>
                                    <div class="input-group -mb-2 -mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text text-primary">Inch</div>
                                        </div>
                                        <input name="height" type="number" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter Height in Inches" required>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">

                                <label style="font-size: 13px" class="card-description" for="inlineFormInputName2">Diagnosis in detail</label>
                                <div class="input-group -mb-2 -mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary"><span class="fa fa-pencil"></span></div>
                                    </div>
                                    <textarea name="diagnosis" type="text" class="form-control" style="height: 111px" id="inlineFormInputGroupUsername2" placeholder="Provide Detailed disgnosis" required></textarea>
                                </div>

                                <br>

                                <label style="font-size: 13px" class="card-description" for="inlineFormInputName2">Additional Details (optional)</label>
                                <div class="input-group -mb-2 -mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text text-primary"><span class="fa fa-pencil"></span></div>
                                    </div>
                                    <textarea name="additional" type="text" class="form-control" style="height: 111px" id="inlineFormInputGroupUsername2" placeholder="Provide Additional Details e.g Alleges"></textarea>
                                </div>


                            </div>

                        </div>
                        <br>
                        <button name="btn_addDiagnosis" type="submit" class="btn btn-primary mb-2">Next <span class="fa fa-chevron-circle-right"></span> </button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    public function validateUserGender($id, $role){
        $rows = $this->isUser($id, $role);
        if($rows[0]['sex'] == 'm'){
            ?>
            <option value="m">Male</option>
            <option value="f">Female</option>
            <?php
        }
        elseif($rows[0]['sex'] == 'f'){
            ?>
            <option value="f">Female</option>
            <option value="m">Male</option>
            <?php
        }
        else{
            ?>
            <option value="">-- Select Gender --</option>
            <option value="m">Male</option>
            <option value="f">Female</option>
            <?php
        }
    }

    public function patientSetup($id){
        $rows = $this->GetUserByID($id);
        $userRow = $this->GetPatientByID($id);
        ?>
        <?php
        if($_SESSION['role'] == 'receptionist'){
            ?>
            <a href="checkAppointment.php?userID=<?php echo $id ?>" class="btn btn-outline-primary"> <span class="fa fa-meetup"></span> Appointment <span class="fa fa-chevron-right"></span> </a>
            <?php
        }
        ?>

        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row ">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../avatar/undraw_profile_1.svg">
                        <span class="font-weight-bold"><?php echo $userRow[0]['name'] .' '. $userRow[0]['surname']   ?></span>
                        <span class="text-black-50"><?php echo $userRow[0]['phone'] ?></span>
                        <span> </span>
                    </div>
                </div>


                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right card-header">Patient's Personal Details</h4>

                        </div>
                        <form method="post" action="includes/updatePatientDetails.inc.php?userid=<?php echo $_GET['userid'] ?>" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">LoginID</label>
                                    <input name="loginID" type="text" class="form-control" placeholder="first name" value="<?php echo $rows[0]['loginID']  ?>" disabled>
                                </div>
                            </div>
                            <br>
                            <div class="row mt-2">
                                <div class="col-md-8">
                                    <label class="labels">National ID (<span class="card-description">xx-xxxxxxXxx</span>)</label>
                                    <input name="nationalID" type="text" class="form-control" placeholder="Legal National Identification Number" minlength="12" maxlength="12" value="<?php echo $userRow[0]['nationalID'] ?>" required>
                                </div>
                            </div>
                            <br>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRow[0]['name'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Surname</label>
                                    <input name="surname" type="text" class="form-control" value="<?php echo $userRow[0]['surname'] ?>" placeholder="surname" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">DOB</label>
                                    <input name="dob" type="date" class="form-control" placeholder="Date of birth" value="<?php echo $userRow[0]['dob'] ?>" max="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label class="labels">Gender</label>
                                <select name="sex" type="text" class="form-control" required>
                                    <?php
                                    $n = new Userview();
                                    $n->validateUserGender($_GET['userid'], 'patient');
                                    ?>
                                </select>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Mobile Number</label>
                                    <input name="phone" type="number" class="form-control" placeholder="Please enter phone number" value="<?php echo $userRow[0]['phone'] ?>" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="labels">Address</label>
                                    <input name="address" type="text" class="form-control" placeholder="enter address line 1" value="<?php echo $userRow[0]['address'] ?>" required>
                                </div>


                            </div>


                            <hr class="mt-5">
                            <br>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right card-header">Patient's Medical Aid</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Medical Aid Provider</label>
                                    <input name="medicalName" type="text" class="form-control" placeholder="Medical Aid" value="<?php echo $userRow[0]['medicalAid'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Medical Aid Plan</label>
                                    <input name="medicalPlan" type="text" class="form-control" value="<?php echo $userRow[0]['medicalAidPlan'] ?>" placeholder="Medical Aid Plan" required>
                                </div>
                            </div>



                            <hr class="mt-5">
                            <br>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right card-header">Patient's Next Of Kin</h4>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Next of kin's Name</label>
                                    <input name="nokname" type="text" class="form-control" placeholder="Next Of Kin Name" value="<?php echo $userRow[0]['nextOfKinName'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Next of kin's Surname</label>
                                    <input name="noksurname" type="text" class="form-control" value="<?php echo $userRow[0]['nextOfKinSurname'] ?>" placeholder="Next Of Kin Suname" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Next of kin's Phone</label>
                                    <input name="nokPhone" type="number" class="form-control" placeholder="Next Of Kin Phone" value="<?php echo $userRow[0]['nextOfKinPhone'] ?>" required>
                                </div>
                            </div>


                            <div class="mt-5 text-center">
                                <button name="btn_updatePatient" class="btn btn-primary" type="submit">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }

    public function CountView($query){
        $rows = $this->GetCountView($query);
        echo count($rows);
    }

    public function ViewAllPatienceAccounts(){
        $rows = $this->GetAllUser();
        $s = 0;
        foreach ($rows as $row)
        {
            if($row['role'] == 'patient'){
                $newID = $row['id'];
                $rowsUser = $this->GetPatientByID($newID);
                $color = '#d9534f';
                $s++;
                ?>

                <tr>
                    <td><?php echo $s ?> </td>
                    <td><?php echo $rowsUser[0]["name"] ?> </td>
                    <td><?php echo $rowsUser[0]["surname"] ?></td>
                    <td><?php echo $rowsUser[0]['nationalID'] ?></td>
                    <td><span style="color: <?php echo $color ?>" class="badge bg-white rounded"><?php echo $row["role"] ?></span> </td>
                    <td><a href="patientSetup.php?userid=<?php echo $newID ?>"><span class="fa fa-pencil badge badge-primary"> More <span class="fa fa-chevron-circle-right"></span> </span></a></td>
                </tr>

                <?php
            }
        }
    }

    public function ViewAllUsers(){
        $rows = $this->GetAllUser();
        $s = 0;
        foreach ($rows as $row)
        {
            $newID = $row['id'];
            if($row['role'] == 'admin'){
                $rowsUser = $this->GetAdminByID($newID);
                $color = '#00a65a';
            }
            elseif ($row['role'] == 'doctor'){
                $rowsUser = $this->GetDoctorByID($newID);
                $color = '#f39c12';
            }
            elseif ($row['role'] == 'receptionist'){
                $rowsUser = $this->GetReceptionistByID($newID);
                $color = '#323837F9';
            }
            elseif ($row['role'] == 'pharmacist'){
                $rowsUser = $this->GetPharmacistByID($newID);
                $color = '#aa35b2';
            }
            elseif ($row['role'] == 'patient'){
                $rowsUser = $this->GetPatientByID($newID);
                $color = '#d9534f';
            }
            else{
                return NULL;
            }


            $s++;
            ?>

            <tr>
                <td><?php echo $s ?> </td>
                <td><?php echo $rowsUser[0]["name"] ?> </td>
                <td><?php echo $rowsUser[0]["surname"] ?></td>
                <td><span style="color: <?php echo $color ?>" class="badge bg-white rounded"><?php echo $row["role"] ?></span> </td>
                <td><?php
                    if($row['status'] == 1) {
                        ?>
                        <span class="badge badge-success rounded">active</span>
                        <?php
                    }
                    else{
                        ?>
                        <span class="badge badge-danger rounded">Inactive</span>
                        <?php
                    }
                    ?>

                </td>
                <td>
                    <?php
                    if($row['role'] == 'patient'){
                        ?>
                        <a href="../admin/patientSetup.php?userid=<?php echo $newID ?>"><span class="fa fa-pencil badge badge-primary"> More <span class="fa fa-chevron-circle-right"></span> </span></a>
                        <?php
                    }
                    else{
                        ?>
                        <a href="userProfile.php?userID=<?php echo $row['id'] ?>"><span class="fa fa-pencil badge badge-primary"> More <span class="fa fa-chevron-circle-right"></span> </span></a>
                        <?php
                    }
                    ?>
                </td>
            </tr>

            <?php
        }
    }

}
