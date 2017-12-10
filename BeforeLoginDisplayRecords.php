<?php
/* This is the admin file. this file will always  be loaded only upon login
I have included the config.php in here that contains the call to functions.php
 */
require_once("config.php");
require_once("header.php");
?>
<html>
<head>
    <link rel="stylesheet" href="style-2.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>


<!-- this is simple HTML code -- it has calls to the respective files that we are calling at each click -->
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
        <th>Perform Operations for General Users:</th>
    </tr>

    <tr>
        <td><a href="display-General-User.php">(R)ead Display All Users </a></td>
    </tr>

</table>
</div>
</body>
</html>