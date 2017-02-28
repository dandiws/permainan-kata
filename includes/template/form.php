    <div class="container form">
      <div class="form">
        <h1>Register</h1>
          <div class="errormsg" id="errormsg_reg"><?php if (isset($_SESSION['error']['register'])) {
            echo $_SESSION['error']['register'];
            session_destroy();
          } ?></div>
        <form method="post" action="includes/game/user.php" name="register">
          <input type="text" class="error" name="name" placeholder="Full Name" value="<?php if (isset($_SESSION['value'])) {echo $_SESSION['value']['name'];} ?>">
          <input type="text" name="username" placeholder="Username" value="<?php if (isset($_SESSION['value'])) {echo $_SESSION['value']['username'];} ?>">
          <input type="password" name="password" placeholder="Password" >
          <input type="password" name="confirmpassword" placeholder="Confirm Password">
          <input type="radio" name="gender" value="m" id="genderm" checked><label for="genderm"> Male</label>
          <input type="radio" name="gender" value="f" id="genderf"><label for="genderf"> Female</label>
          <input type="submit" name="register" value="REGISTER">
        </form>
      </div>
      <div class="form" action="user.php">
        <h1>Sign In</h1>
        <div class="errormsg" id="errormsg_login"><?php if (isset($_SESSION['error']['login'])) {
          echo $_SESSION['error']['login'];
          session_destroy();
        } ?></div>
        <form method="post" action="includes/game/user.php" name="login">
          <input type="text" name="username" placeholder="Username">
          <input type="password" name="password" placeholder="Password">
          <input type="submit" name="login" value="LOGIN">
        </form>
      </div>
    </div>
    <script src="js/formvalidate.js" charset="utf-8"></script>
