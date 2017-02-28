<?php
session_start();
 ?>
 <?php
 $title=$_SESSION['login']['name'];
 include 'layout/head.ly.php';
 include 'layout/navbar.ly.php';
 ?>

<div class="container">
  <div class="jumbotron">
    <h1>Hello, <?=$_SESSION['login']['name']?></h1>
    <p>Here is your profile page :)</p>
    <p>Username : <?=$_SESSION['login']['username']?></p>
    <p>Gender : <?=$_SESSION['login']['gender']?></p>
  </div>
</div>
 <?php include 'layout/endbody.ly.php'; ?>
