<?php
include "../partial/config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sinfo']) && $_POST['sinfo'] == 'sign_up_info') {
    $s_name = $_POST['name'];
    $s_email = $_POST['semail'];
    $s_password = $_POST['spassword'];
    $s_u_name=$s_name.rand(111,999);
    $sql = "INSERT INTO `user` (`user_name`, `name`, `email`, `password`) VALUES (?,?,?,?)";
    $result = $conn->prepare($sql);
    if ($result) {
        $result->bind_param('ssss',$s_name,$s_email,$s_password,$s_u_name);
        $result->execute();
        if ($result->affected_rows == 1) {
            header("location:../index.php?signup=true");
            exit();
        } else 
        {
            header("location:../index.php?signup=false");
            exit();
        }
    } else {
        header("location:../index.php?signup=falsee");
        exit();
    }
    $result->close();
}