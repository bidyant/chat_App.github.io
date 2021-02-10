<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:./index.php?info=login");
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['uid'])) {
    $id = $_POST['uid'];
} else {
    header("location:./index.php?info=fool");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Simple Chat App</title>
    <link rel="icon" href="./icons/logo.png">
    <link rel="stylesheet" href="./css/grid.css">
    <link rel="stylesheet" href="./css/chat.css">
</head>

<body>
    <?php
    include "./partial/nav.php";
    ?>
    <div class="main">
        <div class="row">
            <div class="col-lg-4">
                <h1 class="center">User Profile</h1>
                <br><br>
                <div class="user_prof">
                    <br><br>
                    <img src="./icons/user.png" class="user_image center" id="user_image" alt="">
                    <br>
                    <h4 class="" id="u-sts">online/offline</h4>
                    <br>
                    <form id="user_form">
                        <h2>user name</h2>
                        <h3>user id</h3>
                        <h3>user email</h3>
                        <h3>user description</h3>
                        <h3>user joined</h3>
                    </form>
                    <br><br>
                </div>
            </div>
            <div class="col-lg-8">
                <h1 class="center">chat area</h1><br><br>
                <p id="cmt" style="color:red; text-align:center"></p>
                <div class="chat_area">
                    <br>
                    <br>
                    <ul id="chat_box">
                        <!-- <li class="left">
                            <h3 class="left_text">kjflsdf ak</h3>
                        </li>
                        <li class="right">
                            <h3 class="right_text">kjflsdf ak</h3>
                        </li> -->
                    </ul>
                </div>
                <br>
                <div class="chat_inp">
                    <form id="send_msg" onsubmit="send_chats(e)">
                        <div class="row">
                            <div class="col-sm-9">
                                <input type="text" name="message" class="c_inp">
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="c_btn" name="send_btn">send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    function load_profile() {
        const xhr = new XMLHttpRequest();
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var arr = JSON.parse(xhr.response);
                    update_user_profile(arr);
                } else {

                    console.log("problem occured");
                }
            }
        };
        xhr.open("POST", "./api.php", true);
        var id = <?php echo $id; ?>;
        var data = {
            "data_type": 'chat_user_info',
            "id": id
        };
        var mydata = JSON.stringify(data);
        xhr.send(mydata);
    }
    load_profile();

    function update_user_profile(arr) {
        var frm = document.getElementById("user_form");
        frm.children[0].innerHTML = arr.name;
        frm.children[1].innerHTML = arr.user_name;
        frm.children[2].innerHTML = arr.email;
        frm.children[3].innerHTML = arr.user_desc;
        frm.children[4].innerHTML = arr.time;
        // document.getElementById("user_image").src = "./icons/giphy.gif";
        document.getElementById("user_image").src = arr.image;
        var date = new Date();
        var time = date.getTime();
        var time = Math.trunc(time / 1000)
        if (arr.status >= time) {
            let sts = document.getElementById("u-sts");
            sts.innerText = "online";
            sts.className = "online";
        } else {
            let sts = document.getElementById("u-sts");
            sts.innerText = "offline";
            sts.className = "offline";
        }
    }
    //load chat
    function show_chats() {
        const xml = new XMLHttpRequest();
        xml.open("POST", "api.php", true);
        // xml.responseType = "json";
        xml.onload = () => {
            if (xml.readyState === XMLHttpRequest.DONE) {
                if (xml.status === 200) {
                    let res_arr = JSON.parse(xml.response);
                    load_chats(res_arr);
                } else {
                    console.log("problem occured");
                }
            }
        };
        var data = {
            "r_id": <?php echo $id; ?>,
            "s_id": <?php echo $_SESSION['id']; ?>,
            "data_type": 'show_message'
        };
        var mydata = JSON.stringify(data);
        xml.send(mydata);
    }
    show_chats();

    function show_unseen_chats() {
        const xus = new XMLHttpRequest();
        xus.open("POST", "api.php", true);
        xus.onload = () => {
            if (xus.readyState === XMLHttpRequest.DONE) {
                if (xus.status === 200) {
                    let res_arr = JSON.parse(xus.response);
                    load_chats(res_arr);
                    update_chat_status();
                } else {
                    console.log("problem occured");
                }
            }
        };
        var data = {
            "r_id": <?php echo $id; ?>,
            "s_id": <?php echo $_SESSION['id']; ?>,
            "data_type": 'show_un_seen_chats'
        };
        var mydata = JSON.stringify(data);
        xus.send(mydata);
    }

    setInterval(() => {
        location.reload();
    }, 10000);
    show_unseen_chats();

    function update_chat_status() {
        const upd = new XMLHttpRequest();
        upd.open("POST", "api.php", true);
        upd.onload = () => {
            if (upd.readyState === XMLHttpRequest.DONE) {
                if (upd.status === 200) {
                    // let res_arr = JSON.parse(upd.response);
                    // console.log("updated");
                } else {
                    console.log("problem occured");
                }
            }
        };
        var data = {
            "r_id": <?php echo $id; ?>,
            "s_id": <?php echo $_SESSION['id']; ?>,
            "data_type": 'update_un_seen_chats'
        };
        var mydata = JSON.stringify(data);
        upd.send(mydata);
    }


    function load_chats(obj_arr) {
        let main_ul = document.getElementById("chat_box");
        for (let i = 0; i < obj_arr.length; i++) {
            let main_li = document.createElement("li");
            if (obj_arr[i].s_id == <?php echo $_SESSION["id"]; ?>) {
                main_li.classList.add('right');
                let in_txt = document.createElement("h3");
                in_txt.classList.add('right_text');
                in_txt.innerText = obj_arr[i].message;
                main_li.appendChild(in_txt);
                main_ul.appendChild(main_li);
            }
            if (obj_arr[i].s_id == <?php echo $id; ?>) {
                main_li.classList.add('left');
                let in_txt = document.createElement("h3");
                in_txt.classList.add('left_text');
                in_txt.innerText = obj_arr[i].message;
                main_li.appendChild(in_txt);
                main_ul.appendChild(main_li);
            }
        }
    }
    //send chats
    function send_chats(e) {
        e.preventDefault();
        var send_msg = document.getElementById("send_msg");
        var msg = send_msg['message'].value;
        if (msg == '') {
            var cmt = document.getElementById('cmt');
            cmt.innerHTML = 'please enter something in the message box !';
        } else {
            console.log(msg);
            const xss = new XMLHttpRequest();
            xss.open("POST", "./api.php", true);
            // xss.responseType = "json";
            xss.onload = () => {
                if (xss.readyState === XMLHttpRequest.DONE) {
                    if (xss.status === 200) {
                        // console.log(xss.response);
                        let res_out = JSON.parse(xss.response);
                        console.log(res_out);
                        if (res_out) {
                            setTimeout(() => {
                                location.reload();
                            }, 100);
                        }
                    } else {
                        console.log("problem occured");
                    }
                }
            };
            var data = {
                "r_id": <?php echo $id; ?>,
                "s_id": <?php echo $_SESSION['id']; ?>,
                "message": msg,
                "data_type": 'send_message'
            };
            var mydata = JSON.stringify(data);
            xss.send(mydata);
            send_msg['message'].value = '';
        }
    }
    send_msg['send_btn'].addEventListener("click", send_chats);
    </script>
    <?php
    include "./partial/status_req.php";
    ?>
</body>

</html>