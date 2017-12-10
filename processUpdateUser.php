<?php
/**
 * PraviinM
 */


require_once("config.php");

// print_r is to display the contents of an array() in PHP.
//print_r($_POST);

// Assigning $_POST values to individual variables for reuse.
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$membersince = $_POST['membersince'];
$active = $_POST['active'];
$role = $_POST['role'];
$privilege = $_POST['privilege'];
$thisuserid = $_POST['userid'];

//Creating a variable to hold the "@return boolean value returned by function updateThisRecord - is boolean 1 with
//successfull and 0 when there is an error with executing the query .
$updatedRecord = updateThisRecord($fname, $lname, $email,$membersince,$active , $role , $privilege , $thisuserid);


//display the result that was returned by the createNewUser function - in this case we usually get a 1 when the
//update is completed successfully.
echo $updatedRecord;
