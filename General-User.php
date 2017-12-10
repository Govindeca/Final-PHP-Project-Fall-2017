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
        <th>Perform Operations for General Users:</th>
    </tr>


    <?php if (isUserLoggedIn()) { ?>
        <tr>
            <td><a href="display-General-User.php">(R)ead Display All Users </a></td>
        </tr>

    <?php } ?>
</table>
</body>
</html>