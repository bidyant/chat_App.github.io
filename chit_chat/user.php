<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:./index.php?info=login");
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
    <link rel="stylesheet" href="./css/user.css">
</head>

<body>
    <?php
    include "./partial/nav.php";
    ?>
    <div class="main">
        <div class="col">
            <div class="col-lg-12 note">
                <h1 style="color: black; text-align:center; margin:2px;">Message Notifications</h1>
                <div class="not_wrapper" id="notification_cont">
                    <!-- <div class="notify">
                        <h1> 5 messages from bidyant</h1>
                    </div> -->
                </div>
            </div>
            <div class="center">
                <h1
                    style="background-color: greenyellow; padding:20px; border-radius:20px; color:black">
                    Select
                    Users Form Here to
                    Chat</h1>
            </div>
            <div class="col-lg-12">
                <div class="row" id="content_wrapper">
                    <!-- <div class="col-md-4 back_of">
                <img src="./icons/user.png" class="user_img" alt="">
                <h1>
                    usr name
                </h1>
                <h3>user description</h3>
                <h4 class="online">online</h4>
                <h4 class="no_msg">
                    5 messages form bbj
                </h4>
            </div> -->
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
                        handel_result(arr);
                    } else {
                        console.log("problem occured");
                    }
                }
            };
            xhr.open("POST", "./api.php", true);
            var data = {
                "data_type": 'user_info'
            };
            var mydata = JSON.stringify(data);
            xhr.send(mydata);
        }
        load_profile();

        function handel_result(result_arr) {
            var content_wrapper = document.getElementById("content_wrapper");
            for (var i = 0; i < result_arr.length; i++) {
                if (<?php echo $_SESSION['id'] ?> == result_arr[i].id) {
                    continue;
                }
                var user_div = document.createElement("div");
                user_div.classList.add('col-md-4');
                user_div.classList.add('back_of');
                var u_img = document.createElement("img");
                u_img.classList.add('user_img');
                u_img.src = "" + result_arr[i].image + "";
                user_div.appendChild(u_img);
                var u_name = document.createElement("h1");
                u_name.innerText = result_arr[i].name;
                user_div.appendChild(u_name);
                var u_desc = document.createElement("h3");
                u_desc.innerText = result_arr[i].email;
                user_div.appendChild(u_desc);
                content_wrapper.appendChild(user_div);
                var date = new Date();
                var time = date.getTime();
                var time = Math.trunc(time / 1000)
                if (time <= result_arr[i].status) {
                    var status = document.createElement("h4");
                    status.classList.add('online');
                    status.innerText = "online";
                    user_div.appendChild(status);
                } else {
                    var status = document.createElement("h4");
                    status.classList.add('offline');
                    status.innerText = "offline";
                    user_div.appendChild(status);
                }
                var frm = document.createElement("form");
                frm.setAttribute("method", "post");
                frm.setAttribute("action", "./chat.php");
                var p_btn = document.createElement("input");
                p_btn.setAttribute("type", "submit");
                p_btn.setAttribute("value", "start a chat");
                p_btn.classList.add("p_btn");
                var hdn = document.createElement("input");
                hdn.setAttribute("type", "hidden");
                hdn.setAttribute("name", "uid");
                hdn.setAttribute("value", result_arr[i].id);
                hdn.value = result_arr[i].id;
                frm.appendChild(hdn);
                frm.appendChild(p_btn);
                user_div.appendChild(frm);
            }
        }

        function show_unseen_chats() {
            const xus = new XMLHttpRequest();
            xus.open("POST", "api.php", true);
            xus.onload = () => {
                if (xus.readyState === XMLHttpRequest.DONE) {
                    if (xus.status === 200) {
                        let res_arr = JSON.parse(xus.response);
                        handel_notification(res_arr);
                    } else {
                        console.log("problem occured");
                    }
                }
            };
            var data = {
                "r_id": <?php echo $_SESSION['id']; ?>,
                "data_type": 'show_un_seen_message'
            };
            var mydata = JSON.stringify(data);
            xus.send(mydata);
        }

        function handel_notification(result_ar) {
            if (result_ar.length > 0) {
                for (var j = 0; j < result_ar.length; j++) {
                    var notify = document.createElement("div");
                    notify.classList.add("notify");
                    var not = document.createElement("h2");
                    not.innerHTML = result_ar[j].name + " messaged you .";
                    var msg_r = document.createElement("h3");
                    msg_r.style.color = "black";
                    msg_r.innerText = result_ar[j].message + " at  :" + result_ar[j].time;
                    var not_f = document.createElement("form");
                    not_f.setAttribute("method", "post");
                    not_f.setAttribute("action", "./chat.php");
                    var hdn = document.createElement("input");
                    hdn.setAttribute("type", "hidden");
                    hdn.setAttribute("name", "uid");
                    hdn.setAttribute("value", result_ar[j].id);
                    var p_btn = document.createElement("input");
                    p_btn.setAttribute("type", "submit");
                    p_btn.setAttribute("value", "Go to chat section");
                    p_btn.classList.add("p_btn");
                    hdn.setAttribute("value", result_ar[j].id);
                    not_f.appendChild(hdn);
                    not_f.appendChild(p_btn);
                    notify.appendChild(not);
                    notify.appendChild(msg_r);
                    notify.appendChild(not_f);
                    notification_cont.appendChild(notify);
                }
            } else {
                var notify = document.createElement("div");
                notify.classList.add("notify");
                var not = document.createElement("h2");
                not.innerHTML = " no  messaged for you .";
                notify.appendChild(not);
                notification_cont.appendChild(notify);
            }
        }
        show_unseen_chats();
        </script>
        <?php
        include "./partial/status_req.php";
        ?>
</body>

</html