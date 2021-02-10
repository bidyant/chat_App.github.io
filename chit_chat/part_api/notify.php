<?php
include "./partial/config.php";
$sql = "SELECT user.name,user.id , messages.* FROM `messages` ,`user` WHERE messages.r_id=? AND messages.status =? AND user.id=messages.s_id";
$result = $conn->prepare($sql);
if ($result) {
    $r_id = $data_boj->r_id;
    $status=0;
    //    $r_id=1;
    $result->bind_param('ii', $r_id,$status);
    $result->execute();
    $resultu = $result->get_result();
    $user = $resultu->fetch_all(MYSQLI_ASSOC);
    echo JSON_encode($user);
}
$result->close();