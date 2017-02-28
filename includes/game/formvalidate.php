<?php
function validate_form($data){
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
}
 ?>
