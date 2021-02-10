<?php
session_start();
if (isset($_SESSION['id'])) {
    session_destroy();
    header("Location:../index.php?logout=true");
}
else
{
    header("Location:../index.php?logout=true");
}
?>