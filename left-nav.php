<?php

require_once("config.php");
require_once("header.php");

// Links for logged in user
if (isUserLoggedIn()) {

    If($loggedInUser->roles == "Admin")  { ?>
        <ul>
        <li><a href='myaccount.php'>Account Home</a></li>
        <li><a href='logout.php'>Logout</a></li>
        <li><a href='admin_users.php'>Admin Manager</a></li>

            <li><a href='userstatuspage.php'>Chat with me !</a></li>

        </ul>

    <?php  }else if($loggedInUser->roles == "P1") { ?>

        <ul>
            <li><a href='myaccount.php'>Account Home</a></li>
            <li><a href='logout.php'>Logout</a></li>
            <li><a href='Record-Manager-P1.php'>Record Manager (P1)</a></li>

            <li><a href='userstatuspage.php'>Chat with me !</a></li>

        </ul>

    <?php } else if($loggedInUser->roles == "P2") { ?>

        <ul>
            <li><a href='myaccount.php'>Account Home</a></li>
            <li><a href='logout.php'>Logout</a></li>
            <li><a href='Record-Manager-P2.php'>Record Manager (P2)</a></li>

                       <li><a href='userstatuspage.php'>Chat with me !</a></li>

        </ul>

    <?php } else if($loggedInUser->roles == "GeneralUser") { ?>

    <ul>
        <li><a href='myaccount.php'>Account Home</a></li>
        <li><a href='logout.php'>Logout</a></li>
        <li><a href='General-User.php'>General User</a></li>

        <li><a href='userstatuspage.php'>Chat with me !</a></li>

    </ul>

<?php } ?>



<?php  }else { ?>

    <ul>
        <li><a href='index.php'>Home</a></li>
        <li><a href='BeforeLoginDisplayRecords.php'>View Records</a></li>
        <li><a href='login.php'>Login</a></li>
        <li><a href='register.php'>Register</a></li>
    </ul>

<?php }  ?>
