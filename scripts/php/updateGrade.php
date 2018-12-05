<?php
session_start();
require_once '../../conn.php';
if(isset($_POST['post']) && $_POST['post'] === "true"){
  $id = mysqli_real_escape_string($conn, $_POST['gradeId']);
  $nota = mysqli_real_escape_string($conn, $_POST['nota']);
  $motiv = mysqli_real_escape_string($conn, $_POST['motiv']);
  $sql = "update `note` set `nota` = '$nota' , `comentarii` = '$motiv' where `id` = '$id'";
  if($conn -> query($sql)){
    echo "success";
  }
}
?>
