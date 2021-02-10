<?php
include "./partial/config.php";
$sql = "UPDATE `messages` SET `status` = '1' WHERE ( s_id= ? AND r_id=?) AND status = 0";
$result = $conn->prepare($sql);
if ($result) {
    $s_id = $data_boj->s_id;
    $r_id = $data_boj->r_id;
    $result->bind_param('ii', $r_id, $s_id);
    $result->execute();
}
$result->close();