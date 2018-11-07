<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "select * from `note` where `id` = '$id'";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  $sqlGetElev = "select `nume`,`clasa` from `elevi` where `user_id` = '".$row['user_id']."'";
  $resGetElev = $conn -> query($sqlGetElev);
  $rowGetElev = $resGetElev -> fetch_assoc();
  ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm">
        <h5><?php echo $rowGetElev['nume'];?></h5>
      </div>
    </div>
  </div>
  <?php
}
?>
