<?php
    require_once("config.php");
    require_once("header.php");
?>


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


<div id="wrapper">
    <div id="content">
        <div class="content">

        <div id="main">
            <br><br><br>
            Hey, <?php echo "$loggedInUser->first_name" . "$loggedInUser->last_name" . "\t"."!"."\t"."$loggedInUser->roles"; ?>.
            This is an example page designed to demonstrate user authentication examples.
            Just so you know, you registered this account on <?php print  $loggedInUser->member_since; ?>

            <?php print $loggedInUser->email; ?>
        </div>
        <div id='bottom'></div>
    </div>
    </div>
</div>
</body>
</html>