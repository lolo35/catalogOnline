<?php
session_start();
if(!isset($_SESSION['user'])){
	$URL = "login.php";
	redirect($URL);
}
require_once '../../conn.php';
if(isset($_POST['absent']) && $_POST['absent'] === "true"){
  $name = $_POST['nume'];
  $clasa = $_POST['clasa'];
  $date = date('Y-m-d');
  $user_id = $_POST['user_id'];
  $checkLogin = "select `prezenta` from `prezenta` where `user_id` = '$user_id' and `ora` = '$clasa' and `date` = '$date'";
  $resCheckLogin = $conn -> query($checkLogin);
  $rowCheckLogin = $resCheckLogin -> fetch_assoc();
  if($rowCheckLogin['prezenta'] == 1){
    //$sql = "insert into `prezenta` (`nume`,`user_id`,`ora`,`date`,`prezenta`) values ('$name','$user_id','$clasa','$date','0')";
    $sql = "update `prezenta` set `prezenta` = '0' where `user_id` = '$user_id' and `date` = '$date' and `ora` = '$clasa'";
    if($conn -> query($sql)){
      echo "success";
    }else{
      echo $conn -> error;
    }
  }
}
?>
