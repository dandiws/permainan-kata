<?php
session_start();
function getChar($str){
  return $str[rand(0,strlen($str)-1)];
}

if (isset($_POST['start'])) {
  if (!isset($_COOKIE['start'])) {
    setcookie('start','started',time()+59);
    echo json_encode("cookie is set");
  }
}

if (isset($_COOKIE['start'])) {
  if (isset($_POST['chars'])) {
    $cons="BCDFGHJKLMNPQRSTUVWXYZ";
    $vocal="AEIOU";
    $chars=getChar($cons).getChar($vocal).getChar($cons).getChar($vocal).getChar($cons).getChar($vocal).getChar($cons).getChar($cons).getChar($vocal);
    $chars=str_shuffle($chars);
    echo json_encode($chars);
  }

  if (isset($_POST['word'])) {
    require 'db.php';
    $word=$_POST['word'];
    $con=new db;
    $data=$con->check($word, 'katadasar');
    if ($data) {
      if (isset($_SESSION['uwords'])) {//if used words's session is set
        if (in_array($word,$_SESSION['uwords'])) {//if word already used
          echo 1012;
        }
        else {//if word is not used yet
          array_push($_SESSION['uwords'], $word);//insert word to array
          $_SESSION['score']=count($_SESSION['uwords']);//score : element count in used words's session
          echo json_encode($_SESSION['score']);//send data
        }
      }
      else {//if user's words's session is not set
        $_SESSION['uwords']=array($word);//make an used words's session
        $_SESSION['score']=count($_SESSION['uwords']);//score: 1
        echo json_encode($_SESSION['score']);//send data
      }
    }
    else {
      echo 1096;
    }
  }
}
else {
  if (isset($_SESSION['score'])) {
    $finalscore=$_SESSION['score'];
  }
  else {
    $finalscore=0;
  }
  unset($_SESSION['uwords']);
  unset($_SESSION['score']);
  echo json_encode($finalscore);
}
 ?>
