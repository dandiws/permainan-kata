<?php
session_start();
require 'db.php';
if (isset($_POST['register'])) {
  $con=new db;
  $name=htmlspecialchars($_POST['name']);
  $username=htmlspecialchars($_POST['username']);
  $password=md5($_POST['password']);
  $confirmpassword=md5($_POST['confirmpassword']);
  $gender=$_POST['gender'];
  if (empty($name) || empty($username) || empty($_POST['password']) || empty($_POST['confirmpassword']) || empty($gender)) {
    $_SESSION['error']['register']='All field must be filled';
    $_SESSION['value']= array('name' => $name,'username'=>$username,'gender'=>$gender );
    header("location:../../index.php");
    exit();
  }
  else if($password!=$confirmpassword){
    $_SESSION['error']['register']='Confirm password must be same';
    $_SESSION['value']= array('name' => $name,'username'=>$username,'gender'=>$gender );
    header("location:../../index.php");
    exit();
  }
  $signup=$con->signUp($name, $username, $password, $gender);
  if ($signup) {
    $login=$con->signIn($username,$password);
    if ($login) {
      $user=$con->getData($username);
      $_SESSION['login']=$user;      
      header("location:../../index.php");
    }
  }
  else {
    $_SESSION['error']['register']='Username already used';
    header("location:../../index.php");
    exit();
  }
}
if (isset($_POST['login'])) {
  $con=new db;
  $username=$_POST['username'];
  $password=md5($_POST['password']);
  if (empty($username) || empty($_POST['password'])) {
    $_SESSION['error']['login']='All field must be filled';
    header("location:../../index.php");
    exit();
  }
  $login=$con->signIn($username,$password);
  if ($login) {
    $user=$con->getData($username);
    $_SESSION['login']=$user;
    header("location:../../index.php");
  }
  else {
    $_SESSION['error']['login']='Invalid username or password';
    header("location:../../index.php");
    exit();
  }
}

 ?>
