<?php
include("autoloader.inc.php");

if(isset($_GET['docID'])) {
    $docID = $_GET['docID'];
    $duID = $_GET['duID'];


    try {
        $s = new Usercontr();
        $s->deleteDoc($docID, $duID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}

