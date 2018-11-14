<?php
session_start();
require_once '../../conn.php';
if(isset($_POST['delete']) && $_POST['delete'] === "true"){
  $id = $_POST['row'];
  $sql = "delete from `ore` where `id` = '$id'";
  if($conn -> query($sql)){
    ?>
    <div class="alert alert-success" role="alert">
      Materia a fost stearsa cu success!
    </div>
    <?php
  }
}
?>
