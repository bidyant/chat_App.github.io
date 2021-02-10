<?php
if (isset($_GET['login']) && $_GET['login'] == 'true') {
    echo '<h3 style="background-color:green; padding:5px; text-align:center;">Logged in successfully!';
} else {
    if (isset($_GET['login']) && $_GET['login'] == 'false') {
        if ($_GET['cause'] == 'email') {
            echo "<h3 style='background-color:red; padding:5px; text-align:center;'>Please enter a valid E-mail !</h3>";
        }
        if ($_GET['cause'] == 'password') {
            echo "<h3 style='background-color:red; padding:5px; text-align:center;'>Please enter a valid Password !</h3>";
        }
        if ($_GET['cause'] == 'notsamepass') {
            echo "<h3 style='background-color:red; padding:5px; text-align:center;'>Please enter same passwords !</h3>";
        }
    }
}
if (isset($_GET['logout']) && $_GET['logout'] == "true") {
    echo "<h3 style='background-color:green; padding:5px; text-align:center;'> Log out sucessful !</h3>";
}
if (isset($_GET['logout']) && $_GET['logout'] == "false") {
    echo "<h3 style='background-color:red; padding:5px; text-align:center;'> Log out unsucessful !</h3>";
}
if (isset($_GET['info']) && $_GET['info'] == "login") {
    echo "<h3 style='background-color:red; padding:5px; text-align:center;'> Please Log in first to get started !</h3>";
}
if (isset($_GET['info']) && $_GET['info'] == "fool") {
    echo "<h3 style='background-color:red; padding:5px; text-align:center;'> बूरी नजर वले तारे मुह काला !</h3>";
}
if (isset($_GET['signup']) && $_GET['signup'] == "true") {
    echo "<h3 style='background-color:green; padding:5px; text-align:center;'> Signup sucessful !</h3>";
}
if (isset($_GET['signup']) && $_GET['signup'] == "false") {
    echo "<h3 style='background-color:green; padding:5px; text-align:center;'> Signup unsucessful !</h3>";
}
if (isset($_GET['signup']) && $_GET['signup'] == "falsee") {
    echo "<h3 style='background-color:green; padding:5px; text-align:center;'> Signup unsucessful , server busy , plese try later.!</h3>";
}