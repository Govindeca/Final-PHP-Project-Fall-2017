<?php

require_once("config.php");

    $thisuserid = $_POST['userid'];
    $deletedRecord = deleteThisRecord($thisuserid);
    echo $deletedRecord;

?>

