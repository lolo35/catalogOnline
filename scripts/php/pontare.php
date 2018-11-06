<?php
session_start();
require_once '../../conn.php';
if(isset($_POST['pontare'])){
  $name = $_POST['nume'];
  $clasa = $_POST['clasa'];
  $date = date('Y-m-d');
  $checkLogin = "select `prezenta` from `prezenta` where `nume` = '$name' and `ora` = '$clasa' and `date` = '$date'";
  $resCheckLogin = $conn -> query($checkLogin);
  $rowCheckLogin = $resCheckLogin -> fetch_assoc();
  if($rowCheckLogin['prezenta'] != 1){
    $sql = "insert into `prezenta` (`nume`,`ora`,`date`,`prezenta`) values ('$name','$clasa','$date','1')";
    if($conn -> query($sql)){
      echo "success";
    }else{
      echo $conn -> error;
    }
  }  
}
?>
