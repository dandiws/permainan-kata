<?php session_start(); ?>
 <?php if (!isset($_SESSION['login'])): header("location:welcome.php");?>
 <?php else: ?>
   <!--Dashboard-->
  <?php
  $title='Dashboard';
  include 'layout/head.ly.php';
  include 'layout/navbar.ly.php';
   ?>
   <div class="container"> <?php include 'includes/template/game-list.html.php'; ?> </div>
   <?php include 'layout/endbody.ly.php'; ?>
   <!--end Dashboard-->
 <?php endif; ?>
