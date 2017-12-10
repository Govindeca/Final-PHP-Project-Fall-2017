<?php
/* This is the admin file. this file will always  be loaded only upon login
I have included the config.php in here that contains the call to functions.php
 */
require_once("config.php");
require_once("header.php");
?>

<!-- this is simple HTML code -- it has calls to the respective files that we are calling at each click -->
<body>
<table>
    <tr>
        <th>Perform Operations for Record-Manager-P2:</th>
    </tr>
    <tr>
        <td><a href="display-P2.php">(R)ead Display All Users </a></td>
    </tr>
    <?php if (isUserLoggedIn()) { ?>
        <tr>
            <td><a href="AfterloginRegister.php"> (C)REATE new User</a></td>
        </tr>
        <tr>
            <td><a href="display-P2.php"> (U)pdate User Record</a></td>
        </tr>
        <tr>
            <td><a href="display-P2.php"> (D)Delete User Record</a></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>