<?php
session_start();
require_once '../../conn.php';
if(isset($_POST['delete']) && $_POST['delete'] === "yes"){
  $id = $_POST['id'];
  $sql = "delete from `note` where `id` = '$id'";
  if($conn -> query($sql)){
    echo "success";
  }
}
?>
