<?php
include "./partial/config.php";
$sql = "INSERT INTO messages (`message`, `s_id`,`r_id`) VALUES (?,?,?)";
$result = $conn->prepare($sql);
if ($result) {
    $message = $data_boj->message;
    $s_id = $data_boj->s_id;
    $r_id = $data_boj->r_id;
    $result->bind_param('sii', $message, $s_id, $r_id);
    $result->execute(); 
    if($result->affected_rows == 1)
    {
        echo "true";
    }
    else
    {
        echo 'false';
    }
} else {
    echo " query is not correct";
}
$result->close();