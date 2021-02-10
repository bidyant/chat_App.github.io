<?php
include "../partial/config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['linfo']) && $_POST['linfo'] == 'log_in_info') {
    $l_email = $_POST['lemail'];
    $l_pass = $_POST['lpassword'];
    $c_pass = $_POST['cpassword'];
    if ($c_pass == $l_pass) {
        $sql = "SELECT * FROM user WHERE email= ?";
        $result = $conn->prepare($sql);
        // $l_email= $data_boj->email;
        // $l_pass= $data_boj->password;
        $result->bind_param('s', $l_email);
        $result->execute();
        $resultu = $result->get_result();
        $user = $resultu->fetch_all(MYSQLI_ASSOC);
        if (count($user) == 1) {
            $obj = $user[0];
            $email = $obj['email'];
            $password = $obj['password'];
            if ($l_email == $email && $l_pass == $password) {
                session_start();
                $_SESSION['id'] = $obj['id'];
                $_SESSION['user_name'] = $obj['user_name'];
                $_SESSION['name'] = $obj['name'];
                $_SESSION['email'] = $obj['email'];
                $_SESSION['image'] = $obj['image'];
                $_SESSION['time'] = $obj['time'];
                $_SESSION['desc'] = $obj['desc'];
                header("location:../index.php?login=true");
                exit();
            } else {
                header("location:../index.php?login=false&cause=password");
                exit();
            }
        } else {
            header("location:../index.php?login=false&cause=email");
            exit();
        }
    }
    else
    {
        header("location:../index.php?login=false&cause=notsamepass");
        exit();
    }
    $result->close();
}