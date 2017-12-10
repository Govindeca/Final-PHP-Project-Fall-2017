<?php

require_once("config.php");


//Prevent the user visiting the logged in page if he/she is already logged in
if (isUserLoggedIn()) {
    header("Location: myaccount.php");
    die();
}

//Forms posted
if (!empty($_POST)) {
    $errors = array();
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    //Perform some validation

    if ($username == "") {
        $errors[] = "enter username";
    }
    if ($password == "") {
        $errors[] = "enter password";
    }

    if (count($errors) == 0) {
        //retrieve the records of the user who is trying to login
        $userdetails = fetchUserDetails($username);

        //See if the user's account is activated
        if ($userdetails["Active"] == 0) {
            $errors[] = "account inactive";
        } else {
            //Hash the password and use the salt from the database to compare the password.
            $entered_pass = generateHash($password, $userdetails["Password"]);
            echo "entered password : " . $entered_pass . "<br><br>";
            echo "database password : " . $userdetails['Password'];

            if ($entered_pass != $userdetails["Password"]) {
                $errors[] = "invalid password";
            } else {
                //Passwords match! we're good to go'
                //Transfer some db data to the session object
                $loggedInUser = new loggedInUser();
                $loggedInUser->email = $userdetails["Email"];
                $loggedInUser->user_id = $userdetails["UserID"];
                $loggedInUser->hash_pw = $userdetails["Password"];
                $loggedInUser->first_name = $userdetails["FirstName"];
                $loggedInUser->last_name = $userdetails["LastName"];
                $loggedInUser->username = $userdetails["UserName"];
                $loggedInUser->member_since = $userdetails["MemberSince"];
                $loggedInUser->roles = $userdetails["Roles"];
                //pass the values of $loggedInUser into the session -
                // you can directly pass the values into the array as well.

                // to show online status of users
                setstatusasOL();


                $_SESSION["ThisUser"] = $loggedInUser;

                //now that a session for this user is created
                //Redirect to this users account page
                header("Location: myaccount.php");
                die();
            }
        }

    }
}

require_once("header.php"); ?>

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

        <div id="main">

            <div class="content">
                <h2>Login</h2>

                <div id="regbox">
                <form name="login" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <p>
                        <label for="username">Username:</label>
                        <input id="username" type="text" name="username"/>
                    </p>
                    <p>
                        <label for="password">Password:</label>
                        <input id="password" type="password" name="password"/>
                    </p>
                    <p>
                        <label>&nbsp;</label>
                        <input type="submit" value="Login" class="submit"/>
                    </p>
                </form>
            </div>
            </div>
        </div>
        <div id="bottom"></div>
    </div>
</div>
</body>
</html>