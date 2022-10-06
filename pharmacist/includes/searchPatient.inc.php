<?php
include("autoloader.inc.php");


if(isset($_POST['btn_Search'])){
    $search = $_POST['search'];

    try {
        $n = new Usercontr();
        $n->searchPatient($search);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}

?>