<?php session_start();
$title='PLAY';
include 'layout/head.ly.php';
include 'layout/navbar.ly.php';
?>
  <div class="game-wrapper">
    <div class="wadah">
      <?php
      if (isset($_GET['game1'])) {
        include 'includes/template/game-one.html.php';
      }
      elseif (isset($_GET['game2'])) {
        include 'includes/template/game-two.html.php';
      }
      elseif (isset($_GET['game3'])) {
        include 'includes/template/game-three.html.php';
      }
      else {
        header("location:index.php");
      }
       ?>
    </div>
  </div>
 </div>
<?php include 'layout/endbody.ly.php'; ?>
