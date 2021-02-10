<?php
include "./partial/config.php";
$sql = "SELECT * FROM messages WHERE (r_id=? && s_id= ? || s_id =? && r_id=?) && status = ?";
$result = $conn->prepare($sql);
if ($result) {
    $s_id = $data_boj->s_id;
    $r_id = $data_boj->r_id;
    $status = 0;
    $result->bind_param('iiiii', $r_id, $s_id, $r_id, $s_id, $status);
    $result->execute();
    $resultu = $result->get_result();
    $user = $resultu->fetch_all(MYSQLI_ASSOC);
    echo JSON_encode($user);
}
$result->close();