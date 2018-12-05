<?php
if(isset($_FILES)){
  //print_r($_FILES);
  $targetDir = '../../uploads/';
  $targetFile = $targetDir . basename($_FILES['file']['name']);
  //echo $targetFile;
  $uploadOk = 1;
  $filetype = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
  if(file_exists($targetFile)){
    die("Fisierul exista deja");
  }
  if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)){
    echo "Fisierul a fost incarcat";
  }
}else{

}
?>
