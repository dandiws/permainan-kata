<?php
session_start();
require 'db.php';
$con=new db;

if (isset($_POST['start'])) {
  setcookie('game1','started',time()+59);
}

if (isset($_COOKIE['game1'])) {
  /*------CREATE PREFIX-------*/
  if (isset($_POST['prefix'])) {
    $alpha=array("bcdfghjklmnpqrstvwxyz","aeiou","bcdfgkprst");
    $cons=array();
    $cons[0]=$alpha[0][rand(0, 20)];//generate a consonan
    $cons[1]=$alpha[0][rand(0, 20)];//generate a consonan
    $vocal=array();
    $vocal[0]=$alpha[1][rand(0, 4)];//generate a vocal
    $vocal[1]=$alpha[1][rand(0, 4)];//generate a vocal
    $spc_r=$alpha[2][rand(0, 9)];//generate special character for *r

    $spc=array();
    $spc[0]=$spc_r."r";
    $spc[1]=$spc_r."r".$vocal[rand(0,1)];

    //====possile prefix
    $posspref=array();
    $posspref[0]=$cons[rand(0,1)].$vocal[rand(0,1)];
    $posspref[1]=$cons[0].$vocal[rand(0,1)].$cons[1];
    $posspref[2]=$vocal[rand(0,1)].$cons[rand(0,1)];
    $posspref[3]=$vocal[0].$cons[rand(0,1)].$vocal[1];
    $posspref[4]=$vocal[rand(0,1)].$cons[0].$cons[1];
    $posspref[5]=$spc[rand(0,1)];
    shuffle($posspref);//shuffle order of possible prefix
    $prefix=$posspref[rand(0,5)];
      $prefxnum=intval($con->checkNum($prefix,'katadasar'));//cheking availablity(count) in database
      if ($prefxnum>10) {
        $_SESSION['prefix']=$prefix;
        echo json_encode(array($prefix,$prefxnum));
      }
      else {
        echo (int)1010;
      }
  }

  /*-----CHECKING WORD ON DATABASE---*/
    if (isset($_POST['word'])) {
      $word=wordvalid($_POST['word']);
      if ($word==$_SESSION['prefix']) {
        exit();
      }
      $data=$con->check($word,'katadasar');//check on database
      if ($data) {//if word exist
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
      }//if word not exist
      else {
        echo 1011;
      }
    }
}
else {
  $finalscore=0;
  if (isset($_SESSION['score'])) {
    $finalscore=$_SESSION['score'];
  }
  unset($_SESSION['uwords']);
  unset($_SESSION['score']);
  unset($_SESSION['category']);
  unset($_SESSION['prefix']);
  $user_id=$_SESSION['login']['id'];
  $user_score=$con->getScore($user_id);
  if ($finalscore > $user_score['game1']) {
    $con->updateScore($user_id,$finalscore,1);
    echo json_encode(array('isbest'=> true, 'score' => $finalscore));
  }
  else {
    echo json_encode(array('isbest' => false, 'score' => $finalscore,'best'=> $user_score['game1']));
  }
}

function wordvalid($word){
  $word=strtolower($word);
  $word=trim($word);
  $word=stripslashes($word);
  $word=htmlspecialchars($word);
  return $word;
}

 ?>
