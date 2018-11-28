<?php
session_start();
require_once '../../conn.php';
if(isset($_POST['pontare'])){
  $clasa = $_POST['clasa'];
  $date = date('Y-m-d');
  $user_id = $_POST['user_id'];
  $name = "select `nume` from `elevi` where `user_id` = '$user_id'";
  $resName = $conn -> query($name);
  $nume = $resName -> fetch_assoc();
  $checkLogin = "select `prezenta` from `prezenta` where `user_id` = '$user_id' and `ora` = '$clasa' and `date` = '$date'";
  $resCheckLogin = $conn -> query($checkLogin);
  $rowCheckLogin = $resCheckLogin -> fetch_assoc();
  //echo $rowCheckLogin['prezenta'];
  if($rowCheckLogin['prezenta'] == 0){
    //$sql = "insert into `prezenta` (`nume`,`user_id`,`ora`,`date`,`prezenta`) values ('".$nume['nume']."','$user_id','$clasa','$date','1')";
    $sql = "update `prezenta` set `prezenta` = '1' where `user_id` = '$user_id' and `date` = '$date' and `ora` = '$clasa'";
    //echo $sql;
    if($conn -> query($sql)){
      echo "success";
    }else{
      echo $conn -> error;
    }
  }
}
?>
