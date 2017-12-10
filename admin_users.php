<?php
/* This is the admin file. this file will always  be loaded only upon login
I have included the config.php in here that contains the call to functions.php
 */
    require_once("config.php");
    require_once("header.php");
?>

<!-- this is simple HTML code -- it has calls to the respective files that we are calling at each click -->
<html>

<head>
    <link rel="stylesheet" href="style-2.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>


<div class="sidenav">
    <div id='wrapper'>
        <div id='content'>

            <?php include("left-nav.php"); ?>

        </div>
    </div>
</div>


<div class="content">
        <table>
            <tr>
                <th>Perform Operations for Admins:</th>
            </tr>
            <tr>
                <td><a href="display-Admin.php">(R)ead Display All Users </a></td>
            </tr>
            <?php if (isUserLoggedIn()) { ?>
                <tr>
                    <td><a href="AfterloginRegister.php"> (C)REATE new User</a></td>
                </tr>
                <tr>
                    <td><a href="display-Admin.php"> (U)pdate User Record</a></td>
                </tr>
                <tr>
                    <td><a href="display-Admin.php"> (D)Delete User Record</a></td>
                </tr>
            <?php } ?>
        </table>
</div>
</body>
</html>