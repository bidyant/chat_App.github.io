<head>
    <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
    }

    body {
        font-family: "Lato", sans-serif;
        background-color: #232323;
        color: rgb(255, 255, 255);
    }

    .container {
        width: 100%;
        /* max-width: 90%; */
        margin: 0 auto;
        position: sticky;
        top: 0;
    }

    .nav-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 5;
        background-color: #232323;
    }

    .brand {
        display: flex;
        align-items: center;
    }

    .brand img {
        height: 30px;
        margin-right: 10px;
    }

    .brand img path {
        fill: #fff;
    }

    .nav-wrapper ul.nav-list {
        list-style-type: none;
        display: flex;
        align-items: center;
    }

    .nav-wrapper ul.nav-list li {
        margin-left: 30px;
        padding: 20px 0;
        position: relative;
    }

    .nav-wrapper ul.nav-list li a {
        color: #fff;
        text-decoration: none;
        letter-spacing: 1px;
        transition: all 0.5s ease-in-out;
    }

    .nav-wrapper ul.nav-list li a:hover,
    .nav-wrapper ul.nav-list li.active a {
        color: #933ded;
    }

    .btn {
        background: #933ded;
        color: #fff;
        outline: none;
        padding: 8px 20px;
        font-size: 14px;
        cursor: pointer;
        letter-spacing: 1px;
        border: 1px solid transparent;
        transition: all 0.5s ease-in-out;
    }

    .srh {
        padding: 8px 20px;
        font-size: 14px;
        letter-spacing: 1px;
        border: 1px solid transparent;
        border-radius: 5px;
        outline: none;
    }

    .btn:hover {
        background: transparent;
        border-color: #fff;
    }

    main section.header {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-top: 160px;
    }

    main section.header h1 {
        font-size: 36px;
        font-weight: 100;
        text-transform: capitalize;
        margin-bottom: 20px;
    }

    main section.header h4 {
        font-size: 18px;
        font-weight: 400;
        color: #232323;
        margin-bottom: 20px;
    }

    .hamburger {
        display: none;
    }

    .mobile .hamburger {
        display: flex;
        flex-direction: column;
        padding: 20px 0;
        cursor: pointer;
    }

    .mobile .hamburger span {
        background: #fff;
        width: 28px;
        height: 2px;
        margin-bottom: 8px;
    }

    .mobile ul.nav-list {
        background: -webkit-linear-gradient(45deg, #434343, #000000);
        background: linear-gradient(45deg, #434343, #000000);
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        padding-top: 80px;
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s ease-in-out;
    }

    .hamburger,
    .brand {
        z-index: 9999;
    }

    .mobile ul.nav-list.open {
        opacity: 1;
        pointer-events: auto;
        z-index: 5;
    }

    .mobile .hamburger span {
        transform-origin: left;
        transition: all 0.3s ease-in-out;
    }

    .mobile ul.nav-list li a {
        font-size: 20px;
    }
    </style>
</head>
<nav>
    <div class="container nav-wrapper">
        <div class="brand">
            <img src="./icons/logo.png" id="logo" alt="Brand" style="width: 50px; height:50px">
            <span id="br_nm"><strong style="font-size: 30px;">Chit-Chat</strong></span>
            <script>
            document.getElementById("logo").addEventListener("click", () => {
                window.location.href = "./index.php";
            });
            document.getElementById("br_nm").addEventListener("click", () => {
                window.location.href = "./index.php";
            });
            </script>
        </div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-list">
            <li><a href="./partial/contact.html">Contact</a></li>
            <li><a href="#">Profile</a></li>
            <?php
            if (isset($_SESSION['id'])) {
                echo '
                <li><a href="./user.php">Users</a></li>
                <li>
                <input type="text" style="width:150px;" class="srh" placeholder="search">
                </li>
                <li>
                <button type="submit" class="btn">search</button>
                </li>
                <li>
                <a href="./part_api/logout.php">
                <button class="btn" id="sign_btn">Log out</button>
                </a>
                </li>
                ';
            }
            //  else {
            //     echo '
            // <li>
            //     <button class="btn" id="log_btn">Log in</button>
            // </li>
            // <li>
            //     <button class="btn" id="sign_btn">Sign up</button>
            // </li>
            //     ';
            // }
            ?>
        </ul>
    </div>
    <script>
    window.addEventListener('resize', function() {
        addRequiredClass();
    })


    function addRequiredClass() {
        if (window.innerWidth < 860) {
            document.body.classList.add('mobile');
        } else {
            document.body.classList.remove('mobile');
        }
    }

    window.onload = addRequiredClass

    let hamburger = document.querySelector('.hamburger');
    let mobileNav = document.querySelector('.nav-list');

    let bars = document.querySelectorAll('.hamburger span');

    let isActive = false;

    hamburger.addEventListener('click', function() {
        mobileNav.classList.toggle('open')
        if (!isActive) {
            bars[0].style.transform = 'rotate(45deg)';
            bars[1].style.opacity = '0';
            bars[2].style.transform = 'rotate(-45deg)';
            isActive = true;
        } else {
            bars[0].style.transform = 'rotate(0deg)';
            bars[1].style.opacity = '1';
            bars[2].style.transform = 'rotate(0deg)';
            isActive = false;
        }
    });
    </script>

</nav>