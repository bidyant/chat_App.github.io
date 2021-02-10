<?php
include "./partial/config.php";
$sql = "UPDATE `user` SET `status` = ? WHERE `user`.`id` = ?";
$result = $conn->prepare($sql);
if ($result) {
    $status = time() + 20;
    $id=$data_boj->id;
    $result->bind_param('ii', $status,$id);
    $result->execute();
    echo 'reloded';
}
$result->close();