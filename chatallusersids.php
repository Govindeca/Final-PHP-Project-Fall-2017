<?php


require_once("config.php");
require_once("header.php");
require_once("Chat-User-2.php");
//require_once ("userstatuspage.php");


// to get value from userstatus page
if(isset($_GET['FirstName'])){
    $thisUserName = $_GET['FirstName'];

    $_SESSION['OnlineUserName'] = $thisUserName;
}
$thisUserName = $_SESSION['OnlineUserName'];
echo $thisUserName;
// to get value from logged in user session
$_SESSION['user'] = "$loggedInUser->first_name";
$user = $_SESSION['user'];
echo $user;
// call a function to insert values in chatroom table

$chatrommdata = Fetchchatroomfetchdata($user,$thisUserName);


if(is_array($chatrommdata)){

    ?>  <?php
    foreach ($chatrommdata as $displayRecords) { ?>
        <tr>
            <td><?php print $displayRecords['ChatID']; ?></td>
            <td><?php print $displayRecords['User1']; ?></td>
            <td><?php print $displayRecords['user2']; ?></td>
        </tr>
    <?php }} ?>

<?php

if($chatrommdata == NULL){
    $chatroominserted = indertintochatroom($user, $thisUserName);
    echo $chatroominserted;
}

// $user = $_SESSION['user'];
//$message  = $_POST['message'];
//$newuser = createNewmessage($user, $message);

if (isset($_POST['message'])) {
    $user = $_SESSION['user'];
    $message = $_POST['message'];
    $newuser = createNewmessage($user, $message);

}




?>

