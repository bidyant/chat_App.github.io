<?php
include "./partial/config.php";
$sql = "SELECT * FROM user WHERE id= ?";
$result = $conn->prepare($sql);
if ($result) {
    $id= $data_boj->id;
    // $id=1;
    $result->bind_param('i',$id);
    $result->execute();
    $resultu = $result->get_result();
    $user = $resultu->fetch_array(MYSQLI_ASSOC);
    echo JSON_encode($user);
}
$result->close();