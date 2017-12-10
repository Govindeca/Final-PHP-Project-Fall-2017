<?php

require_once("config.php");

$thisUserID = $_GET['userid'];
echo $thisUserID;


$foundUser = fetchThisUser($thisUserID);

echo "<pre>";
print_r($foundUser);
echo "</pre>";
?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
    'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
        FIRST CRUD - Ipdate This Record
    </title>
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

<form name="getUserDetails" method="post" action="processUpdateUser.php">
    <table class="table-style-three">
        <?php foreach ($foundUser as $userdetails) { ?>

            <tr>
                <td>FirstName :</td>
                <td><input type="text" name="firstname" value="<?php print $userdetails['FirstName']; ?>"></td>
            </tr>
            <tr>
                <td>LastName :</td>
                <td><input type="text" name="lastname" value="<?php print $userdetails['LastName']; ?>"></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="text" name="email" value="<?php print $userdetails['Email']; ?>"></td>
            </tr>
            <tr>
                <td>Member SInce:</td>
                <td><input type="text" name="membersince" value="<?php print $userdetails['MemberSince']; ?>"></td>
            </tr>
            <tr>
                <td>Active :</td>
                <td><input type="text" name="active" value="<?php print $userdetails['Active']; ?>"></td>
            </tr>
            <tr>
                <td>Role :</td>
                <td><input type="text" name="role" value="<?php print $userdetails['roles']; ?>"></td>
            </tr>
            <tr>
                <td>Privilege :</td>
                <td><input type="text" name="privilege" value="<?php print $userdetails['privilege']; ?>"></td>
            </tr>

            <tr>
                <td>Userid :</td>
                <td><input type="text" name="userid" value="<?php print $userdetails['UserID']; ?>"></td>
            </tr>
        <?php } ?>
    </table>

    <input type="submit" name="submit" value="Update Me">

</form>


</body>
</html>