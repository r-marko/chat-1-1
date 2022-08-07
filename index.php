<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['username'] != null){
    header("Location: chat.php");
}
require_once __DIR__ . "/model/m-database.php";

$dbTable = new Database\TableCreate("users");
$dbTable->createTableChatCouples("chat_couples");
$dbTable->createTableMessages("messages");

include_once __DIR__ . "/view/header.php";
include_once __DIR__ . "/view/v-home.php"; 
include_once __DIR__ . "/view/footer.php";

?>