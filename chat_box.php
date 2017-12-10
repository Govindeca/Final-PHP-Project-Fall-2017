<?php
require_once("config.php");
require_once("header.php");


$thisUserName = $_SESSION['OnlineUserName'];

$_SESSION['user'] = "$loggedInUser->first_name";
$user = $_SESSION['user'];

// ChatId fetch of user 1 - user 2
$user1user2 = FetchchatroomUser1toUser2($user,$thisUserName);
    foreach ($user1user2 as $displayRecordsu1u2) {
        echo $displayRecordsu1u2['ChatID'];
    }

// ChatId fetch of user 2 - user 1
$user2user1 = FetchchatroomUser2toUser1($thisUserName,$user);
    if(empty($user2user1)){
        Echo "Other user not joined yet";
    }
    else {
        foreach ($user2user1 as $displayRecordsu2u1) {
            echo $displayRecordsu2u1['ChatID'];
        }
    }

if(empty($displayRecordsu2u1['ChatID']))
{
    echo "Please ask to join other user";
    $displayRecordsu2u1['ChatID'] = "uiji";
}


$allmsg = messagefetched($displayRecordsu1u2['ChatID'], $displayRecordsu2u1['ChatID']);

if(is_array($allmsg)) {

?>

<?php
foreach ($allmsg as $displayRecords) { ?>
    <div class="single-message">
        <h3> <?php print $displayRecords['user']; ?></h3>
        <?php print $displayRecords['message']; ?>
        <span> <?php print $displayRecords['time']; ?></span>
    </div>
<?php   }} ?>




