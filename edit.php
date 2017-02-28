<?php
session_start();
if (isset($_POST['update']) && isset($_SESSION['login'])) {
  require 'includes/game/db.php';
  $con= new db;
  include_once 'includes/game/formvalidate.php';
  $id=$_SESSION['login']['id'];
  $username=validate_form($_POST['username']);
  $name=validate_form($_POST['name']);
  $gender=validate_form($_POST['gender']);
  if ($username==$_SESSION['login']['username']) {
    $isOldUsername=true;
  }
  else {
    $isOldUsername=false;
  }
  $update=$con->updateProfile($id,$username,$name,$gender,$isOldUsername);
  if ($update) {
    $data=$con->getData($username);
    $_SESSION['login']=$data;
    header("location:index.php");
  }
  else {
    $_SESSION['error']['update']="Username Already taken";
  }
}
?>
<?php if (isset($_SESSION['login'])): ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edit - <?php echo $_SESSION['login']['name']; ?></title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php include 'includes/template/sidenav.html.php'; ?>
    <div class="wrapper">
    <div class="form">
      <h1>Edit Profile</h1>
      <div class="errormsg" id="errormsg_reg">
        <?php
        if (isset($_SESSION['error']['update'])) {
        echo $_SESSION['error']['update'];
        unset($_SESSION['error']['update']);
        }
        ?>
      </div>
      <form method="post">
        <input type="text" name="username" value="<?php echo $_SESSION['login']['username']?>">
        <input type="text" name="name" value="<?php echo $_SESSION['login']['name']?>" class="last">
          <input type="radio" name="gender" value="m" id="genderm" <?php if ($_SESSION['login']['gender']=='m') echo 'checked'; ?>><label for="genderm"> Male</label>
          <input type="radio" name="gender" value="f" id="genderf" <?php if ($_SESSION['login']['gender']=='f') echo 'checked'; ?>><label for="genderf"> Female</label>
        <input type="submit" name="update" value="UPDATE">
      </form>
    </div>
    </div>
  </body>
</html>
<?php else: header("location:index.php")?>
<?php endif; ?>
