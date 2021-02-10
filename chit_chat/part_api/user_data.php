<?php
include "./partial/config.php";

$sql = "SELECT * FROM user";
$result = $conn->prepare($sql);
if ($result) {
    $result->execute();
    $resultu = $result->get_result();
    $user = $resultu->fetch_all(MYSQLI_ASSOC);
    echo JSON_encode($user);
}
$result->close();