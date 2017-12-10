<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
        'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <title>
        FIRST CRUD - Create New Record
    </title>
    <link rel="stylesheet" href="style-2.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>

    <!-- Style -- Can also be included as a file usually style.css -->
    <style type="text/css">
        table.table-style-three {
            font-family: verdana, arial, sans-serif;
            font-size: 11px;
            color: #333333;
            border-width: 1px;
            border-color: #3A3A3A;
            border-collapse: collapse;
        }

        table.table-style-three th {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #FFA6A6;
            background-color: #D56A6A;
            color: #ffffff;
        }

        table.table-style-three a {
            color: #ffffff;
            text-decoration: none;
        }

        table.table-style-three tr:hover td {
            cursor: pointer;
        }

        table.table-style-three tr:nth-child(even) td {
            background-color: #F7CFCF;
        }

        table.table-style-three td {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #FFA6A6;
            background-color: #ffffff;
        }
    </style>

</head>

<body>

<?php

require_once("config.php");
//Prevent the user visiting the logged in page if he/she is already logged in
if (isUserLoggedIn()) {
    header("Location: myaccount.php");
    die();
}

print_r($_POST);

//Forms posted
if (!empty($_POST)) {
    $errors = array();
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $password = trim($_POST["password"]);
    $confirm_pass = trim($_POST["passwordc"]);
   $membersince = trim($_POST["membersince"]);
   $active = trim($_POST["active"]);
    $privilege = trim($_POST["privilege"]);
    $role = trim($_POST["role"]);


    if ($username == "") {
        $errors[] = "enter valid username";
    }

    if ($firstname == "") {
        $errors[] = "enter valid first name";
    }

    if ($lastname == "") {
        $errors[] = "enter valid last name";
    }

    if ($password == "") {
        $errors[] = "enter valid password";
    }

    if ($confirm_pass == "") {
        $errors[] = "enter valid password";
    }

    if ($email == "") {
        $errors[] = "enter valid email address";
    }


    if ($membersince == "") {
        $errors[] = "enter valid membersince value";
    }


    if ($active == "") {
        $errors[] = "enter valid active status";
    }


    if ($privilege == "") {
        $errors[] = "enter valid privilege status";
    }


    if ($role == "") {
        $errors[] = "enter valid role";
    }


    if ($password == "" && $confirm_pass == "") {
        $errors[] = "enter password";
    } else if ($password != $confirm_pass) {
        $errors[] = "password do not match";
    }

    //End data validation
    if (count($errors) == 0) {
        $user = createNewUser($username, $firstname, $lastname, $email, $password ,$membersince, $active , $privilege, $role);
        print_r($user);
        if ($user <> 1) {
            $errors[] = "registration error";
        }
    }
    if (count($errors) == 0) {
        $successes[] = "registration successful";
    }
}

require_once("header.php");
?>
<div class="sidenav">
    <div id='wrapper'>
        <div id='content'>

            <?php include("left-nav.php"); ?>

        </div>
    </div>
</div>

<div class="content">


        <div id="wrapper">
            <div id="content">
                <h2>Register</h2>

                <div id="main">

                        <pre>
                            <?php print_r($errors); ?>
                            <?php print_r($successes); ?>
                        </pre>

                    <div id="regbox">

                        <form name="newUser" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                            <table class="table-style-three">
                                <thead>
                            <tr>
                                <th><label>User Name:</label></th>
                                <td><input type="text" name="username"/></td>
                            </tr>
                            <tr>
                               <th> <label>First Name:</label></th>
                                <td><input type="text" name="firstname"/></td>
                            </tr>
                            <tr>
                                <th>  <label>Last Name:</label></th>
                                <td><input type="text" name="lastname"/></td>
                            </tr>
                            <tr>
                                <th> <label>Password:</label></th>
                                <td><input type="password" name="password"/></td>
                            </tr>
                            <tr>
                                <th> <label>Confirm:</label></th>
                                <td><input type="password" name="passwordc"/></td>
                            </tr>
                            <tr>
                                <th> <label>Email:</label></th>
                                <td><input type="text" name="email"/></td>
                            </tr>

                            <tr>
                                <th> <label>Active:</label></th>
                                <td><input type="text" name="active"/></td>
                            </tr>

                            <tr>
                                <th> <label>Role:</label></th>
                                <td><input type="text" name="role"/></td>
                            </tr>

                            <tr>
                                <th> <label>Privilege:</label></th>
                                <td><input type="text" name="privilege"/></td>
                            </tr>
                            <tr>
                                <th> <label>Member Since:</label></th>
                                <td><input type="text" name="membersince"/></td>
                            </tr>


                            <label></label>&nbsp;

                            <tr>
                                <td><input type="submit" value="Register"/></td>
                            </tr>
                            </thead>
                            </table>
                        </form>

                    </div>
                </div>
                <div id='bottom'></div>
            </div>
        </div>


</div>
    </body>
</html>

