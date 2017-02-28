<?php
/**
 *
 */
class db
{
  public $db;

  function __construct(){
    $this->db=new PDO("mysql:host=localhost;dbname=tralala", "root", "");
  }
  public function checkNum($prefix,$category) {
    switch ($category) {
      case 'animal':$cate='animal';
        break;
      case 'fruit':$cate='fruit';
        break;
      case 'vegetable':$cate='vegetable';
        break;
      case 'country':$cate='country';
        break;
      case 'katadasar':$cate='katadasar';
        break;
    }
    $pref=$prefix.'%';
    $query=$this->db->prepare("SELECT COUNT(word) FROM $cate WHERE word LIKE :prefix");
    $query->bindParam(":prefix",$pref);
    $query->execute();
    $num=$query->fetchColumn();
    return $num;
  }

  public function check($word,$category){
    switch ($category) {
      case 'animal':$cate='animal';
        break;
      case 'fruit':$cate='fruit';
        break;
      case 'vegetable':$cate='vegetable';
        break;
      case 'country':$cate='country';
        break;
      case 'katadasar':$cate='katadasar';
        break;
    }
    $query=$this->db->prepare("SELECT word FROM $cate WHERE word=:word");
    $query->bindParam(":word",$word);
    $query->execute();
    if ($query->rowCount()!=0) {
      $data=$query->fetchColumn();
      return $data;
    }
    else {
      return false;
    }
  }

  public function signUp($name, $username, $password, $gender){
    $query=$this->db->prepare("SELECT COUNT(*) FROM users WHERE username=:username");
    $query->bindParam(":username", $username);
    $query->execute();
    $num=$query->fetchColumn();
    if ($num==0) {
      $q=$this->db->prepare("INSERT INTO users(`name`,`username`,`password`,`gender`) VALUES (:name,:username,:password,:gender)");
      $q->bindParam(":name", $name);
      $q->bindParam(":username", $username);
      $q->bindParam(":password", $password);
      $q->bindParam(":gender", $gender);
      $q->execute();
      $data=$this->getData($username);
      $id=$data['id'];
      $q1=$this->db->prepare("INSERT INTO scores(`user_id`,`game1`,`game2`,`game3`) VALUES (:id,:zero,:zero,:zero)");
      $q1->bindParam(":id",$id);
      $zero=0;
      $q1->bindParam(":zero", $zero);
      $q1->execute();
      return true;
    }
    else {
      return false;
    }
  }

  public function signIn($username, $password){
    $data=$this->getData($username);
    if ($data) {
      if ($data['password']==$password) {
        return true;
      }
      else return false;
    }
    else {
      return false;
    }
  }

  public function updateProfile($id, $username,$name,$gender,$isOldUsername)
  {
    if ($isOldUsername) {
      $query=$this->db->prepare("UPDATE users SET name=:name,gender=:gender WHERE id=:id");
    }
    else {
      $data=$this->getData($username);
      if ($data) {
        return false;
        exit();
      }
      else {
        $query=$this->db->prepare("UPDATE users SET username=:username,name=:name,gender=:gender WHERE id=:id");
        $query->bindParam(":username",$username);
      }
    }
    if ($query) {
      $query->bindParam(":id",$id);
      $query->bindParam(":name",$name);
      $query->bindParam(":gender",$gender);
      $query->execute();
      return true;
    }
  }
  public function uploadAvatar($id,$filename)
  {
    $query=$this->db->prepare("UPDATE users SET avatar=:filename WHERE id=:id");
    $query->bindParam(":id",$id);
    $query->bindParam(":filename",$filename);
    $query->execute();
  }
  public function getData($username){
    $query=$this->db->prepare("SELECT * FROM users WHERE username=:username");
    $query->bindParam(":username",$username);
    $query->execute();
    $data=$query->fetch();
    return $data;
  }

  public function getScore($id)
  {
    $query=$this->db->prepare("SELECT * FROM scores WHERE user_id=:id");
    $query->bindParam(":id",$id);
    $query->execute();
    $data=$query->fetch();
    return $data;
  }
  public function updateScore($id, $score, $game)
  {
    switch ($game) {
      case 1:
        $query=$this->db->prepare("UPDATE `scores` SET game1=:score WHERE user_id=:id");
        break;
      case 2:
        $query=$this->db->prepare("UPDATE `scores` SET game2=:score WHERE user_id=:id");
        break;
      case 3:
        $query=$this->db->prepare("UPDATE `scores` SET game3=:score WHERE user_id=:id");
        break;
    }
    $query->bindParam(":id",$id);
    $query->bindParam(":score",$score);
    $query->execute();
  }
  public function getWord()
  {
    $query=$this->db->prepare("SELECT word FROM katadasar WHERE LENGTH(word)<=7 ORDER BY RAND() LIMIT 1");
    $query->execute();
    $data=$query->fetchColumn();
    return $data;
  }
}

 ?>
