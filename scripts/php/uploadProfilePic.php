<?php
session_start();
if(isset($_FILES)){
  //print_r($_FILES);
  $targetDir = '../../images/';
  $targetFile = $targetDir . $_SESSION['user'] . ".jpg";
  $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  $checkType = getimagesize($_FILES['file']['tmp_name']);
  if($checkType !== false){

  }else{
    echo "Fisierul atasat nu este o imagine";
    exit();
  }
  if($_FILES['file']['size'] > 500000){
    echo "Imaginea este prea mare";
    exit();
  }
  if($fileType !== "jpg"){
    echo "Imaginea nu este de tip jpg";
    exit();
  }
  if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)){
    echo "success";
  }
}
?>
