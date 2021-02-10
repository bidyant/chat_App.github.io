<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chat App</title>
    <link rel="icon" href="./icons/logo.png">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/grid.css">
</head>

<body>
    <?php
    include "./partial/nav.php";
    ?>
    <hr>
    <?php
    include "./partial/error.php";
    ?>
    <div class="main">
        <div class="bg-image"></div>

        <div class="bg-text">
            <h2></h2>
            <h1 style="font-size:40px">Chit-Chat , Build Relationship not links</h1>
            <h3>Stay connected with your Family , Friends and Relatives.</h3>
            <br>
            <a href="./user.php">
                <button class="btn" style="font-size: 20px;" id="btn-center">get started</button>
            </a>
        </div>
    </div>

    <?php
    if (!isset($_SESSION['id'])) {
        echo '    <div class="lb">
        <h1>Get started with Chit-Chat</h1>
    </div>';
        include "./partial/log.php";
    }
    ?>
    <div class="lb">
        <h1>About the Author...</h1>
    </div>
    <div class="row" style="background-color: #dfe4ea;">
        <div class="col-lg-4" style='background-color:#dfe4ea; text-align:center;'>
            <img src=" ./icons/my_image.png"
                style=" width:250px; height:250px; background-color:#45aaf2; margin:20px; border-radius: 50%; border:2px solid black;"
                alt="">
        </div>
        <div class="col-lg-8" style="color:#2c3e50; text-align:center;">
            <h1>Hi there ! I am bidya Bedant jsohi</h1>
            <br>
            <h3 style="color:#2c3e50; font-family:cursive; width:100%; text-align:center;">
                I am a self taught Programer . I makes different projects just for fun.
                I am not from computer science background but I like to code . I am doing may
                graduation on physics at Gangadhar Meher University, Sambalpur.
                I am havig 1 year of experience in skills like HTML , CSS , JAVASCRIPT ,TENSERFLOW
                JS, BOOTSTRAP
                ,NODE JS , EXPRESS JS
                ,REACT JS , REACT NATIVE , PHP , PYTHON , JAVA , C
                , C++ ,some data bases like MYSQL , MONGODB ,SQLITE , REALM ,FIRE BASE and I know
                how to edit videos with ADOBE PREMIERE PRO . If you want to build a website or any
                software for your businness or personal blog then go to the contact page and contact
                me.
            </h3>
        </div>
    </div>
    <div class="lb">
        <h1>Our Sercivices...</h1>
    </div>
    <?php
    include "./partial/fact.php";
    ?>
    <?php
    include "./partial/footer.php";
    ?>
    <?php
    include "./partial/status_req.php";
    ?>
</body>

</html>