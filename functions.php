<?php

//$password = md5("Smith");
//echo $password."<br><br>";
//$code = md5(uniqid(rand(), TRUE));

//echo $code;


//Generate a unique code
/**
 * @param string $length
 * @return string
 */
function getUniqueCode($length = "")
{
    $code = md5(uniqid(rand(), TRUE));
    if ($length != "") {
        return substr($code, 0, $length);
    } else {
        return $code;
    }
}


//$plainText = getUniqueCode(15);
//echo $plainText;


/**
 * @param $plainText
 * @param null $salt
 * @return string
 */
function generateHash($plainText, $salt = NULL)
{
    echo "plain text =" . $plainText . "<br><br>";
    if ($salt === NULL) {
        $salt = substr(md5(uniqid(rand(), TRUE)), 0, 25);
        echo "salt when salt is null : " . $salt . "<br><br>";
    } else {
        echo "salt before substr : " . $salt . "<br><bR>";
        $salt = substr($salt, 0, 25);
        echo "just salt : " . $salt . "<br><bR>";
    }
    echo "return salt : " . $salt . "<br><br>";
    echo "return sha ( salt ) : " . sha1($salt) . "<br><br>";
    echo "return sha ( plaintext ) : " . sha1($plainText) . "<br><br>";
    echo "return sha ( satl + plaintext ) : " . sha1($salt . $plainText) . "<br><br>";
    echo "return salt . sha1 ( salt + plaintext ) : " . $salt . sha1($salt . $plainText) . "<br><br>";

    return $salt . sha1($salt . $plainText);
}


//echo $newpassword;
//$compare = generateHash($_POST['password'], $newpassword);

//echo $compare;

/**
 * @param $username
 * @param $firstname
 * @param $lastname
 * @param $email
 * @param $roles
 * @param $password
 * @return bool
 */
function createNewUser($username, $firstname, $lastname, $email, $password ,$membersince , $active, $privilege, $roles)
{
    global $mysqli, $db_table_prefix;
    //Generate A random userid

    $character_array = array_merge(range(a, z), range(0, 9));
    $rand_string = "";
    for ($i = 0; $i < 6; $i++) {
        $rand_string .= $character_array[rand(
            0, (count($character_array) - 1)
        )];
    }


    $newpassword = generateHash($password);

    echo $newpassword;



    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "UserDetails (
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
		Password,
		membersince,
		active,
		privilege
		)
		VALUES (
		'" . $rand_string . "',
		?,
		?,
		?,
		?,
		?,
		?,
		?,
		?
		)"
        );

    $stmt->bind_param("ssssssss", $username, $firstname, $lastname, $email, $newpassword , $membersince , $active, $privilege);
    //print_r($stmt);
    $result = $stmt->execute();
    //print_r($result);
    $stmt->close();

    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "roles (
	
		UserID,
		UserName,		
		roles  
		)
		VALUES (
  
        '" . $rand_string . "',
        ?,
        ?
		)"
    );

    $stmt->bind_param("ss", $username,  $roles);
    //print_r($stmt);
    $result = $stmt->execute();
    //print_r($result);
    $stmt->close();
    return $result;

}


// New user with privilege

/**
 * @param $username
 * @param $firstname
 * @param $lastname
 * @param $email
 * @param $password
 * @return bool
 * @param $privilege
 * @param roles
 */
function createNewUserpriv($username, $firstname, $lastname, $email, $password ,$roles,$privilege  )
{
    global $mysqli, $db_table_prefix;
    //Generate A random userid

    $character_array = array_merge(range(a, z), range(0, 9));
    $rand_string = "";
    for ($i = 0; $i < 6; $i++) {
        $rand_string .= $character_array[rand(
            0, (count($character_array) - 1)
        )];
    }

    //$rand_string = getUniqueCode(14);
    //echo $rand_string;
    //echo $username;
    //echo $firstname;
    //echo $lastname;
    //echo $email;
    //echo $password;

    $newpassword = generateHash($password);

    echo $newpassword;


    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "UserDetails (
		UserDetails.UserID,
		UserDetails.UserName,
		UserDetails.FirstName,
		UserDetails.LastName,
		UserDetails.Email,
		UserDetails.Password,
		UserDetails.MemberSince,
		UserDetails.Active
		)
		VALUES (
		'" . $rand_string . "',
		?,
		?,
		?,
		?,
		?,
        '" . time() . "',
        1
		)"
    );
    $stmt->bind_param("sssss", $username, $firstname, $lastname, $email, $newpassword);
    //print_r($stmt);
    $result = $stmt->execute();
    //print_r($result);
    $stmt->close();
    return $result;

}








//Retrieve complete user information by username
/**
 * @param $username
 * @return array
 */
function fetchUserDetails($username)
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		userdetails.UserID,
		userdetails.UserName,
		userdetails.FirstName,
		userdetails.LastName,
		userdetails.Email,
		userdetails.Password,
		userdetails.MemberSince,
		userdetails.Active,
		roles.roles
		
		FROM " . $db_table_prefix . "UserDetails
		JOIN roles on UserDetails.UserID = roles.UserID	
		WHERE
		userdetails.UserName = ?"
    );
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->bind_result(
        $UserID,
        $UserName,
        $FirstName,
        $LastName,
        $Email,
        $Password,
        $MemberSince,
        $Active ,
        $roles
    );
    while ($stmt->fetch()) {
        $row = array('UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active,
            'Roles' => $roles
        );
    }
    $stmt->close();
    return ($row);
}


//Check if a user is logged in
/**
 * @return bool
 */
function isUserLoggedIn()
{
    global $loggedInUser, $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		UserID,
		Password
		FROM " . $db_table_prefix . "UserDetails
		WHERE
		UserID = ?
		AND
		Password = ?
		AND
		active = 1
		LIMIT 1");
    $stmt->bind_param("ss", $loggedInUser->user_id, $loggedInUser->hash_pw);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($loggedInUser == NULL) {
        return false;
    } else {
        if ($num_returns > 0) {
            return true;
        } else {
            destroySession("ThisUser");
            return false;
        }
    }
}


//Destroys a session as part of logout
/**
 * @param $name
 */
function destroySession($name)
{
    if (isset($_SESSION[$name])) {
        $_SESSION[$name] = NULL;
        unset($_SESSION[$name]);
    }
}




//Retrieve complete user information of all users
/**
 * @return array
 */
function fetchAllUsers()
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		userdetails.UserID,
		userdetails.UserName,
		userdetails.FirstName,
		userdetails.LastName,
		userdetails.Email,
		userdetails.Password,
		userdetails.MemberSince,
		userdetails.Active,
		userdetails.privilege,
		roles.roles
		
		
		
		
		FROM " . $db_table_prefix . "UserDetails
		JOIN roles on UserDetails.UserID = roles.UserID
		
		");

    $stmt->execute();
    $stmt->bind_result(
        $UserID,
        $UserName,
        $FirstName,
        $LastName,
        $Email,
        $Password,
        $MemberSince,
        $Active,
        $privilege,
        $roles
    );
    while ($stmt->fetch()) {
        $row[] = array(
            'UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active,
            'privilege' =>$privilege,
            'roles' => $roles
        );
    }
    $stmt->close();
    return ($row);
}



/**
 * @return array
 */
function fetchAllUsersforP1()
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		userdetails.UserID,
		userdetails.UserName,
		userdetails.FirstName,
		userdetails.LastName,
		userdetails.Email,
		userdetails.Password,
		userdetails.MemberSince,
		userdetails.Active,
		userdetails.privilege,
		roles.roles
		
		
		
		
		FROM " . $db_table_prefix . "UserDetails
		JOIN roles on UserDetails.UserID = roles.UserID
        Where userdetails.privilege = 'P1'
		");

    $stmt->execute();
    $stmt->bind_result(
        $UserID,
        $UserName,
        $FirstName,
        $LastName,
        $Email,
        $Password,
        $MemberSince,
        $Active,
        $privilege,
        $roles
    );
    while ($stmt->fetch()) {
        $row[] = array(
            'UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active,
            'privilege' => $privilege,
            'roles' => $roles
        );
    }
    $stmt->close();
    return ($row);
}




/**
 * @return array
 */
function fetchAllUsersforP2()
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		userdetails.UserID,
		userdetails.UserName,
		userdetails.FirstName,
		userdetails.LastName,
		userdetails.Email,
		userdetails.Password,
		userdetails.MemberSince,
		userdetails.Active,
		userdetails.privilege,
		roles.roles
		
		
		
		
		FROM " . $db_table_prefix . "UserDetails
		JOIN roles on UserDetails.UserID = roles.UserID
        Where 
        userdetails.privilege = 'P1' "."or"." 
        userdetails.privilege = 'P2' order by userdetails.privilege 
		");

    $stmt->execute();
    $stmt->bind_result(
        $UserID,
        $UserName,
        $FirstName,
        $LastName,
        $Email,
        $Password,
        $MemberSince,
        $Active,
        $privilege,
        $roles
    );
    while ($stmt->fetch()) {
        $row[] = array(
            'UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active,
            'privilege' => $privilege,
            'roles' => $roles
        );
    }
    $stmt->close();
    return ($row);
}



// To update details


/**
 * @param $thisUserID
 * @return array
 */
function fetchThisUser($thisUserID)
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		userdetails.UserID,
		userdetails.UserName,
		userdetails.FirstName,
		userdetails.LastName,
		userdetails.Email,
		userdetails.Password,
		userdetails.MemberSince,
		userdetails.Active,
		userdetails.privilege,
		roles.roles
		
		
		
		
		FROM " . $db_table_prefix . "UserDetails
		JOIN roles on UserDetails.UserID = roles.UserID
        Where 
        userdetails.UserID = ?
		");

    $stmt->bind_param("s", $thisUserID);
    $stmt->execute();
    $stmt->bind_result(
        $UserID,
        $UserName,
        $FirstName,
        $LastName,
        $Email,
        $Password,
        $MemberSince,
        $Active,
        $privilege,
        $roles
    );
    while ($stmt->fetch()) {
        $row[] = array(
            'UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active,
            'privilege' => $privilege,
            'roles' => $roles
        );
    }
    $stmt->close();
    return ($row);
}

/**
 * @param $fname
 * @param $lname
 * @param $email
 * @param $membersince
 * @param $active
 * @param $role
 * @param $privilege
 * @param $thisuserid
 * @return bool
 */

function updateThisRecord($fname, $lname, $email,$membersince,$active , $role , $privilege , $thisuserid)
{
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "UPDATE " . $db_table_prefix . "UserDetails
		SET
	
		userdetails.FirstName = ?,
		userdetails.LastName = ?,
		userdetails.Email = ?,
		userdetails.MemberSince = ?,
		userdetails.Active = ?,
		userdetails.privilege = ?
		
		WHERE
		userid = ?
		LIMIT 1"
    );
    $stmt->bind_param("sssssss", $fname, $lname, $email,$membersince,$active , $privilege , $thisuserid);
    $result = $stmt->execute();
    $stmt->close();

    $stmt = $mysqli->prepare(
        "UPDATE " . $db_table_prefix . "roles
		SET
			
		roles.roles = ? 	
	
			WHERE
		roles.UserID = ?
		LIMIT 1"
    );
    $stmt->bind_param("ss", $role, $thisuserid);
    $result = $stmt->execute();
    $stmt->close();


    return $result;
}

/**
 * @param $userid
 * @return bool
 */

function deleteThisRecord($userid)
{
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "Delete from " . $db_table_prefix . "userdetails
		where
		userdetails.UserID = ?"
    );


    $stmt->bind_param("s", $userid);
    $result = $stmt->execute();
    $stmt->close();


    $stmt = $mysqli->prepare(
        "Delete from " . $db_table_prefix . "roles
		where
		roles.UserID = ?"
    );

    $stmt->bind_param("s", $userid);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}



/*
--chat box functions--

1. createNewmessage() -- for fill massage table
2. messagefetchedtofillparent() -- called in createNewmessage() To fill Parent table
3. messagefetched() - function to fetch s_chat_message table data based on ChatID-user1-user2 and ChatID-user2-user1
4. setstatusasOL() - update online and offline status of a user on logged in page
5. setstatusasOFFL() - Call function after session logged out to chage status to Offline
6. fetchAllUsersStatusONandOff() -  to show all Online users on Page
7. Fetchchatroomfetchdata() -
        select data from chat room
        this function works similarly as function messagefetchedtofillparent()
8. indertintochatroom() - data insert into chatroom table with random chatid generated
9. FetchchatroomUser1toUser2() -
        A function to fetch ChatID For User 1 and User 2
        function works similar to function messagefetchedtofillparent()
10. FetchchatroomUser2toUser1() -
        User 2 and user 1
        function works similar to messagefetchedtofillparent()

All 4 functions work similar but created 4 times to understand the logic
1. messagefetchedtofillparent()
2. Fetchchatroomfetchdata()
3. FetchchatroomUser1toUser2()
4. FetchchatroomUser2toUser1()

*/


// function to fill messages of chat box in table
/**
 * @param $user
 * @param $message
 * @return bool
 */

function createNewmessage($user , $message)
{

// Here User-1 and User-2 combination ChatID will be populate
    $thisUserName = $_SESSION['OnlineUserName'];
    $user = $_SESSION['user'];
    $chatvariable = messagefetchedtofillparent($user, $thisUserName);
    foreach ($chatvariable as $userdetails) {
        echo $userdetails['ChatID'];

    }


        global $mysqli, $db_table_prefix;
        $stmt = $mysqli->prepare(
            "INSERT INTO " . $db_table_prefix . "s_chat_messages (
	    ChatID,
	    user,
		message
		)
		VALUES (
		'" . $userdetails['ChatID'] . "',
		?,
		?
		)"
        );
        $stmt->bind_param("ss", $user, $message);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }


// fetch data for push Chatroom's ChatID to parent table based on User-1 and User-2

/**
 * @param $user
 * @param $thisUserName
 * @return array
 */

function messagefetchedtofillparent($user , $thisUserName)
{
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		ChatID

		FROM " . $db_table_prefix . "Chatroom
		WHERE 
		user1 = ? 
		AND
		user2 = ?
		"
    );
    $stmt->bind_param("ss", $user , $thisUserName);
    $stmt->execute();
    $stmt->bind_result(
        $ChatID
    );

    while ($stmt->fetch()) {
        $row[] = array(
            'ChatID' => $ChatID


        );
    }
    $stmt->close();
    return ($row);
}


// function to fetch s_chat_message table data based on ChatID-user1-user2 and ChatID-user2-user1

/**
 * @param $u1u2ChatID
 * @param $u2u1ChatID
 * @return array
 */
function messagefetched($u1u2ChatID , $u2u1ChatID)
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		user,
		message,
		Time

		FROM " . $db_table_prefix . "s_chat_messages
		WHERE 
		ChatID = ? 
		OR
		ChatID = ?
		order by time asc"
    );
    $stmt->bind_param("ss", $u1u2ChatID , $u2u1ChatID);
    $stmt->execute();
    $stmt->bind_result(
        $user,
        $message,
        $time
    );
    $row = "";
    while ($stmt->fetch()) {
        $row[] = array(
            'user' => $user,
            'message' => $message,
            'time' => $time

        );
    }
    $stmt->close();

    return ($row);

}



// update online and offline status of a user on logged in page


require_once("config.php");

function setstatusasOL()
{
    global $loggedInUser, $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "UPDATE " . $db_table_prefix . "UserDetails
		SET
	
		userdetails.Statusofuser = 'Online'
		
		WHERE
		userdetails.UserID = ?
		LIMIT 1"
    );
    $stmt->bind_param("s", $loggedInUser->user_id);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

// Call function after session logged out to chage status to Offline
function setstatusasOFFL()
{
    global $loggedInUser, $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "UPDATE " . $db_table_prefix . "UserDetails
		SET
	
		userdetails.Statusofuser = 'Offline'
		
		WHERE
		userdetails.UserID = ?
		LIMIT 1"
    );
    $stmt->bind_param("s", $loggedInUser->user_id);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}


// to show all Online users on Page


/**
 * @return array
 */
function fetchAllUsersStatusONandOff()
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		userdetails.UserID,
		userdetails.FirstName,
		userdetails.Statusofuser
	  
		FROM " . $db_table_prefix . "UserDetails
        Where userdetails.Statusofuser = 'Online'
		");

    $stmt->execute();
    $stmt->bind_result(
        $UserID,
        $FirstName,
        $Statusofuser
    );
    while ($stmt->fetch()) {
        $row[] = array(
            'UserID' => $UserID,
            'FirstName' => $FirstName,
            'userstatus' => $Statusofuser
        );
    }
    $stmt->close();
    return ($row);
}
// select data from chat room
// this function works similarly as function messagefetchedtofillparent()
/**
 * @param $user1
 * @param $user2
 * @return array
 */

function Fetchchatroomfetchdata($user1 , $user2)
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		ChatID,
			user1,
				user2

		FROM " . $db_table_prefix . "Chatroom
        Where 
         user1 = ?
         AND
         user2 = ?
		");
    $stmt->bind_param("ss", $user1,  $user2);
    $stmt->execute();
    $stmt->bind_result(
        $ChatID,
        $user1,
        $user2
    );
    $row ="";
    while ($stmt->fetch()) {
        $row[] = array(
            'ChatID' => $ChatID,
            'User1' => $user1,
            'user2' => $user2
        );
    }
    $stmt->close();
    return ($row);
}







// create chatroom table

/**
 * @param $user1
 * @param $user2
 * @return bool
 */
function indertintochatroom($user1, $user2)
{
    global $mysqli, $db_table_prefix;
    //Generate A random chatid

    $character_array = array_merge(range('a', 'z'), range(0, 9));
    $rand_string = "";
    for ($i = 0; $i < 8; $i++) {
        $rand_string .= $character_array[rand(
            0, (count($character_array) - 1)
        )];
    }

    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "Chatroom (
		ChatID,
			user1,
				user2
		)
		VALUES (
		'" . $rand_string . "',
		?,
		?
		)"
    );

    $stmt->bind_param("ss", $user1,$user2);
    $result = $stmt->execute();
    $stmt->close();
    return $result;

}

// A function to fetch ChatID For User 1 and User 2
// function works similar to function messagefetchedtofillparent()
/**
 * @param $user1
 * @param $thisUserName
 * @return array
 */
function FetchchatroomUser1toUser2($user1 , $thisUserName)
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		ChatID

		FROM " . $db_table_prefix . "Chatroom
        Where 
         user1 = ?
         AND
         user2 = ?
		");
    $stmt->bind_param("ss", $user1,  $thisUserName);
    $stmt->execute();
    $stmt->bind_result(
        $ChatID
    );
    while ($stmt->fetch()) {
        $row[] = array(
            'ChatID' => $ChatID
        );
    }
    $stmt->close();
    return ($row);
}



// User 2 and user 1
// function works similar to messagefetchedtofillparent()

/**
 * @param $thisUserName
 * @param $user2
 * @return array
 */
function FetchchatroomUser2toUser1($thisUserName , $user2)
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		ChatID

		FROM " . $db_table_prefix . "Chatroom
        Where 
         user1 = ?
         AND
         user2 = ?
		");
    $stmt->bind_param("ss", $thisUserName,  $user2);
    $stmt->execute();
    $stmt->bind_result(
        $ChatID
    );
    $row = "";
    while ($stmt->fetch()) {
        $row[] = array(
            'ChatID' => $ChatID
        );
    }
    $stmt->close();
    return ($row);
}





