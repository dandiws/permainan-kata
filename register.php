<?php session_start();
  if (!isset($_SESSION['login'])): ?>
<?php $title='Register'; include 'layout/head.ly.php'; include 'layout/navbar.ly.php';?>
<div class="container">
  <div class="form register">
    <div class="form-header">
      REGISTER  FORM
    </div>
    <div class="errormsg"></div>
      <form method="post" action="includes/game/user.php" name="register">
        <input type="text" class="error" name="name" placeholder="Full Name" value="<?php if (isset($_SESSION['value'])) {echo $_SESSION['value']['name'];} ?>">
        <input type="text" name="username" placeholder="Username" value="<?php if (isset($_SESSION['value'])) {echo $_SESSION['value']['username'];} ?>">
        <input type="password" name="password" placeholder="Password" >
        <input type="password" name="confirmpassword" placeholder="Confirm Password">
        <input type="radio" name="gender" value="m" id="genderm" checked><label for="genderm"> Male</label>
        <input type="radio" name="gender" value="f" id="genderf"><label for="genderf"> Female</label>
        <input type="submit" name="register" value="REGISTER">
      </form>
      <a href="login.php"class="form-link">Already register? Sign In here!</a>
</div>

<?php include 'layout/endbody.ly.php'; ?>
<?php else: header("location:index.php")?>
<?php endif; ?>
