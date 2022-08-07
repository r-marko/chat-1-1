<?php
session_start();
// including models
require_once __DIR__ . "/model/m-database.php";

// get data from tables
$users = \Database\TableGetContent::getAllFromUserTable();


// setting err_message
// $err_message = "";

// post from textarea
if(isset($_POST['chat-post']) && !empty($_POST['chat-post'])){
    $chatPost = $_POST['chat-post'];
    $chatPost = stripslashes($chatPost);
    $chatPost = htmlentities($chatPost);
    $chatPost = trim($chatPost);
} 

    // sender and receiver id
    if(!empty($_SESSION['chat_sender_id']) && !empty($_SESSION['chat_receiver_id'])){
        $chat_sender_id = $_SESSION['chat_sender_id'];
        $chat_receiver_id = $_SESSION['chat_receiver_id'];
        // insert into table messages
        if(!empty($chatPost)){
            \Database\TableInsert::insertMessagesTable($chat_receiver_id, $chat_sender_id, $chatPost, date("Y-m-d H:i:s"));
        }
    }


// fetching from table
$table_one_to_one = \Database\TableGetContent::getAllFromTableMessages();

// view
include __DIR__ . "/view/v-chat_box.php";

?>