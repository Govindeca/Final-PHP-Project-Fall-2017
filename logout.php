<?php

require_once("config.php");
//Log the user out
if (isUserLoggedIn()) {
    destroySession("ThisUser");;
}
// To change status offline of a user
setstatusasOFFL();

header("Location:index.php");
die();