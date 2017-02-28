<?php
session_start();
if (isset($_POST['getletter'])) {
  require 'db.php';
  $con=new db;
  $randWord=$con->getWord();
  $randWord=strtoupper($randWord);
  $_SESSION['word']=$randWord;
  $shuffle_word=str_shuffle($randWord);
  for ($i=0; $i < 16-strlen($randWord) ; $i++) {
    $shuffle_word.=$randWord[rand(0, strlen($randWord)-1)];
  }
  $shuffle_word=str_shuffle($shuffle_word);
  $_SESSION['shuffle_word']=$shuffle_word;
  echo json_encode($shuffle_word);
}
if (isset($_POST['thatlettersagain'])) {
  echo json_encode($_SESSION['shuffle_word']);
}
if (isset($_POST['printword'])) {
  echo json_encode($_SESSION['word']);
}
if (isset($_POST['answer'])) {
  $answer=$_POST['answer'];
  $incorrect=false;
  $i=0;
  $correct_ltr=array();
  $incorrect_ltr=array();
  foreach ($answer as $index) {
    $index=$index-1;
    if ($index>=0 && $index <16) {
      if ($_SESSION['word'][$i]!=$_SESSION['shuffle_word'][$index]) {
        $incorrect=true;
        array_push($incorrect_ltr, $index+1);
      }
      else {
        array_push($correct_ltr, $index+1);
      }
    }
    else {
      $incorrect=true;
      array_push($incorrect_ltr, $index+1);
    }
    $i++;
  }
  $_SESSION['score']=count($correct_ltr);
  if ($incorrect) {
    $echo=array('result' => 1111,'score' => $_SESSION['score'],'correct' => $correct_ltr,'incorrect' => $incorrect_ltr);
  }
  else {
    $_SESSION['score']+=3;
    $echo=array('result' => 9999, 'score' => $_SESSION['score'], 'correct' => $correct_ltr,'incorrect' => $incorrect_ltr);
  }
  echo json_encode($echo);
}
 ?>
