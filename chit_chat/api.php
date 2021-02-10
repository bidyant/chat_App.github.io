<?php
session_start();
$raw_dat = file_get_contents("php://input");
$data_boj = json_decode($raw_dat);
if (isset($data_boj->data_type) && $data_boj->data_type == "user_info") {
    include "./part_api/user_data.php";
} else
if (isset($data_boj->data_type) && $data_boj->data_type == "chat_user_info") {
    include "./part_api/chat_user_data.php";
}  else
if (isset($data_boj->data_type) && $data_boj->data_type == "send_message") {
    include "./part_api/send_chat.php";
} else
if (isset($data_boj->data_type) && $data_boj->data_type == "show_message") {
    include "./part_api/receive_chat.php";
} else
if (isset($data_boj->data_type) && $data_boj->data_type == "show_un_seen_message") {
    include "./part_api/notify.php";
} else
if (isset($data_boj->data_type) && $data_boj->data_type == "show_un_seen_chats") {
    include "./part_api/receive_u_seen_chat.php";
} else
if (isset($data_boj->data_type) && $data_boj->data_type == "update_un_seen_chats") {
    include "./part_api/update_u_chat.php";
} else
if (isset($data_boj->data_type) && $data_boj->data_type == "log_out") {
    include "./part_api/log_out.php";
} else
if (isset($data_boj->data_type) && $data_boj->data_type == "sign_up") {
    include "./handel_chat.php";
} else
if (isset($data_boj->data_type) && $data_boj->data_type == "log_in") {
    include "./part_api/log_in.php";
} else
if (isset($data_boj->data_type) && $data_boj->data_type == "set_status") {
    include "./part_api/set_status.php";
} else
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['linfo']) && $_POST['linfo'] == 'log_in_info') {
    header("location:./part_api/login.php");
} else
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sinfo']) && $_POST['info'] == 'sign_up_info') {
    header("location:./part_api/signup.php");
} else
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    header("location:./index.php");
}
if(!isset($_SESSION['id']))
{
    header("location:./index.php?info=login");
}
// header("location:./index.php?info=fool");