<?php session_start();
  if (!isset($_SESSION['login'])): ?>
<?php
$title='Welcome';
include 'layout/head.ly.php';
include 'layout/navbar.ly.php';
?>
    <div class="container">
      <div class="jumbotron">
        <h1>Hello, world!</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>
<?php include 'layout/endbody.ly.php'; ?>
<?php else: header("location:index.php")?>
<?php endif; ?>
