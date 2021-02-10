<div class="log">
    <br><br>
    <div class="row">
        <div class="col-lg-6 field">
            <h1 style="color: black; text-align:center">Log in</h1>
            <form id="log_form" action="./part_api/login.php" method="POST">
                <br>
                <br>
                <div class="centi">
                    <input type="email" name="lemail" id="email" placeholder="  User Email"
                        required>
                    <br><br>
                    <input type="password" name="lpassword" id="password" placeholder="  Passwrod"
                        required>
                    <br><br>
                    <input type="password" name="cpassword" id="cpassword"
                        placeholder="  Confirm Passwrod" required>
                    <br><br><br>
                    <input type="hidden" value="log_in_info" name="linfo">
                    <button type="submit" class="btn log-btn" name="log_btn">Log
                        in</button>
                    <br><br><br><br>
                </div>
            </form>
        </div>
        <div class="col-lg-6 field">
            <h1 style="color: black; text-align:center">Sign up</h1>
            <form id="sign_form" action="./part_api/signup.php" method="POST">
                <br>
                <br>
                <div class="centi">
                    <input type="text" name="name" id="name" placeholder="  Name" required>
                    <br><br>
                    <input type="email" name="semail" id="semail" placeholder="  E-mail" require>
                    <br><br>
                    <input type="password" name="spassword" id="spassword" placeholder="  Passwrod"
                        required>
                    <br><br><br>
                    <input type="hidden" value="sign_up_info" name="sinfo">
                    <button type="submit" class="btn log-btn" name="sign_btn">Sign Up</button>
                    <br><br><br><br>
                </div>
            </form>
        </div>
    </div>
    <br><br><br>
</div>