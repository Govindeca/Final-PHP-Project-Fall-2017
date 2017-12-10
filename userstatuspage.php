<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
    'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
        FIRST CRUD
    </title>

    <head>
        <link rel="stylesheet" href="style-2.css" />

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
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
            color: blue;
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


<?php
require_once("config.php");
require_once("header.php");
// call to function fetchAllUsers() from functions.php
$allusers = fetchAllUsersStatusONandOff();

?>
<body>


<div class="sidenav">
    <div id='wrapper'>
        <div id='content'>

            <?php include("left-nav.php"); ?>

        </div>
    </div>
</div>


<div class="content">

<table class="table-style-three">
    <thead>

    <th>UserID</th>
    <th>FirstName</th>
    <th>Status</th>

    </thead>
    <tbody>
    <?php //NOTICE THE USE OF PHP IN BETWEEN HTML
    foreach ($allusers as $userdetails) {
        ?>
        <tr>
            <td>
                <?php print $userdetails['UserID']; ?>
            </td>
            <td>
                <a href="chatallusersids.php?FirstName=<?php print $userdetails['FirstName']; ?>"><?php print $userdetails['FirstName']; ?></a>
            </td>
            <td><?php print $userdetails['userstatus']; ?></td>
        </tr>

    <?php } ?>
    </tbody>
</table>
</div>
</body>
</html>