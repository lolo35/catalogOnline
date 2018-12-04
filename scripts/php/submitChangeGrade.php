<?php
session_start();
if(!isset($_SESSION['user'])){
	$URL = "login.php";
	redirect($URL);
}
require_once '../../conn.php';
if(isset($_POST['changeGrade']) && $_POST['changeGrade'] === "true"){
  $id = $_POST['id'];
  $grade = $_POST['grade'];
  $type = $_POST['type'];
  $comments = $_POST['comments'];

  $sql = "update `note` set `nota` = '$grade', `tip_nota` = '$type', `comentarii` = '$comments' where `id` = '$id'";
  if($conn -> query($sql)){
    ?>
    <div class="alert alert-success text-center" role="alert">
      Nota a fost modificata cu success.
    </div>
    <?php
  }else{
    echo $conn -> error;
  }
}
?>
