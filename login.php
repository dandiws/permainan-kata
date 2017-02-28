<?php session_start();
  if (!isset($_SESSION['login'])): ?>
<?php $title='Login'; include 'layout/head.ly.php'; include 'layout/navbar.ly.php';?>
<div class="container">
  <div class="form login">
    <div class="form-header">
      LOGIN FORM
    </div>
    <div class="errormsg"></div>
    <form method="post" action="includes/game/user.php" name="login">
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" name="login" value="LOGIN">
    </form>
    <a href="register.php"class="form-link">Not a member? Register Here!</a>
  </div>
</div>
<?php include 'layout/endbody.ly.php'; ?>
<?php else: header("location:index.php")?>
<?php endif; ?>
