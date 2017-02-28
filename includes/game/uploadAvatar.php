<?php
session_start();
if (isset($_FILES['avatar']) && isset($_SESSION['login'])) {
  require 'db.php';
  $con= new db;
  $errors=array();
  $file_size=$_FILES['avatar']['size'];
  $file_type=$_FILES['avatar']['type'];
  $tmp=explode('.',$_FILES['avatar']['name']);
  $file_ext=strtolower(end($tmp));
  $file_name=md5($_SESSION['login']['username']).".".$file_ext;
  $sourcepath=$_FILES['avatar']['tmp_name'];
  $targetpath="../../img/avatars/".$file_name;
  $ext=array("jpeg","jpg","png");

  if (in_array($file_ext,$ext)===false) {
    $errors[]="extension not allowed, must be JPEG or PNG";
  }
  if ($file_size>2097152) {
    $errors[]="file size can not higher than 2MB";
  }

  if (empty($errors)) {
    $id=$_SESSION['login']['id'];
    $con->uploadAvatar($id,$file_name);
    move_uploaded_file($sourcepath,$targetpath);
    $data=$con->getData($_SESSION['login']['username']);
    $_SESSION['login']=$data;
    echo $file_name;
  }
  else {
    echo $errors;
  }
}
else {
  echo "failed";
}
 ?>
