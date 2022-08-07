<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])){
    if (!isset($_POST['registerName']) || empty($_POST['registerName']) || !isset($_POST['registerPassword']) || empty($_POST['registerPassword']) || !isset($_POST['repeatPassword']) || empty($_POST['repeatPassword']) || !isset($_POST['loginName']) || empty($POST['loginName']) || !isset($_POST['loginPassword']) || empty($_POST['loginPassword'])){
        header("Location: index.php");
    }
}

// set status to online when is loged in
$status = true;

// including models -------------------------------
require_once __DIR__ . "/model/m-database.php";
require_once __DIR__ . "/model/validate_input.php";
//--------------------------------------------------

// logout
if (isset($_POST['log-out']) && $_POST['log-out'] == 'logout'){
    // update table set status = false
    \Database\TableUpdate::updateStatus(false, $_SESSION['username']);
    unset($_SESSION['username']);
    unset($_SESSION['chat_receiver_name']);
    header("Refresh:0.5");
}

// fatching all usernames from database
$usersArray = \Database\TableGetContent::fetchUsernameColumn();
// fetching all usernames and passwords from database for login purpos
$usernamePasswordArray = \Database\TableGetContent::fetchUernameAndPasswordColumns();



// validating register form
        // try if the same username already have in database 
if (!empty($_POST['registerName']) && !empty($_POST['registerPassword'])){
    $registerUsername = Validation\FormValidation::cleanInputUsername($_POST['registerName']);
    foreach ($usersArray as $value){
        if ($value["username"] == $registerUsername){
            exit("Same username already exist in our database, please choose different <br><a href='index.php'>Go back</a>");
        }
    }
    $registerPassword = Validation\FormValidation::cleanInputPassword($_POST['registerPassword']);

    $repeatPassword =  Validation\FormValidation::cleanInputPassword($_POST['repeatPassword']);

    if(!empty($registerUsername) && !empty($registerPassword) && $registerPassword === $repeatPassword){
        // insert filtered form variable into session
        $_SESSION['username'] = $registerUsername;
        // hashing password
        $registerPassword = password_hash($registerPassword, PASSWORD_DEFAULT);
        // insert into database
        \Database\TableInsert::insertRegisterForm($registerUsername, $registerPassword, $status);
    
    } else {
        die("Incorrect format of required register data, go back " . " <a href='index.php'>here</a> <br><h2>Pokusaj Hakovanja!</h2>");
    }
}



// validating login form
if (isset($_POST['loginName']) && !empty($_POST['loginName'] && isset($_POST['loginPassword']) && !empty($_POST['loginPassword']))){

    // validate loginName and login Password
    $loginUsername = Validation\FormValidation::cleanInputUsername($_POST['loginName']);
    $loginPassword = Validation\FormValidation::cleanInputPassword($_POST['loginPassword']);

    $loginMessage = true;
    // check if loginUsername and login Password exsist in database
    foreach ($usernamePasswordArray as $value){
            if($value['username'] == $loginUsername && password_verify($loginPassword, $value['password'])){
                // if exist, set the session variable
                $_SESSION['username'] = $loginUsername;
                // if exist, set the database status to true
                \Database\TableUpdate::updateStatus(true, $_SESSION['username']);
                $loginMessage = true;
                break;
            } else {
                $loginMessage = false;
            }
    }
    // iz nekog razloga ovo ispod ne radi!!!
    $_SESSION['log-message'] = $loginMessage;
    header("Refresh:0");
}

// get all content from users table
$users = \Database\TableGetContent::getAllFromUserTable();

// get chat receiver id and username for database and nav purpos
if(isset($_POST['user-id']) && !empty($_POST['user-id'])){
    $chat_receiver_id = $_POST['user-id'];
    if(!empty($users)){
        foreach ($users as $user){
            if($user['id'] == $chat_receiver_id){
                $chat_receiver_name = $user['username'];
                $_SESSION['chat_receiver_name'] = $chat_receiver_name;
            }
        }
    }
}

 // putting receiver id into session for chat_controller.php usage
 if (isset($chat_receiver_id) && !empty($chat_receiver_id)){
    $_SESSION['chat_receiver_id'] = $chat_receiver_id;
}

// unset session - exit chat receiver
if(isset($_POST['chat-exit'])){
    if($_POST['chat-exit'] == "exit"){
        unset($_SESSION['chat_receiver_name']);
        header("Refresh:0.5");
    }
}


// get chat sender id for database purpos
if(!empty($users)){
    foreach ($users as $user){
        if(isset($_SESSION['username'])){
            if($user['username'] == $_SESSION['username']){
                $chat_sender_id = $user['id'];
            }
        }
    }
}

// putting sender id into session for chat_controller.php usage
if (isset($chat_sender_id) && !empty($chat_sender_id)){
    $_SESSION['chat_sender_id'] = $chat_sender_id;
}


// including views------------------------------
include_once __DIR__ . "/view/header.php";
include_once __DIR__ . "/view/v-navigation.php";
include_once __DIR__ . "/view/v-chat.php";
include_once __DIR__ . "/view/footer.php";
//----------------------------------------------

?>