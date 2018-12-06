<?php
session_start();
require_once '../../conn.php';
if(isset($_POST['post']) && $_POST['post'] === "true"){
  $nota = mysqli_real_escape_string($conn, $_POST['nota']);
  $materia = mysqli_real_escape_string($conn, $_POST['materia']);
  $elev = mysqli_real_escape_string($conn, $_POST['elev']);
  $date = date('Y-m-d');
  $sql = "insert into `note` (`user_id`,`date`,`ora`,`nota`,`tip_nota`) values ('$elev','$date','$materia','$nota', '1')";
  if($conn -> query($sql)){
    echo "success";
  }
}
?>
