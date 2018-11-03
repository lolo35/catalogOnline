<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['id'])){
  $classInfo = explode("-", $_GET['id']);
  //print_r($classInfo);
  //echo $classInfo[1];
  $clasa = substr($_GET['id'], -3, 3);
  //echo $clasa;
  $sql = "select * from `elevi` where `clasa` = '$clasa'";
  $result = $conn -> query($sql);
  ?>
  <div class="container-fluid">
    <div class="row">
      <?php
      while($row = $result -> fetch_assoc()){
        ?>
        <div class="col-sm-3">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="images/<?php echo $row['nume'];?>.jpg" height="220" width="286" alt="<?php echo $row['nume'];?>-thumb-image">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nume'];?></h5>
              <p class="card-text">Informatii suplimentare aici</p>
            </div>
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action" id="<?php echo $row['nume'];?>-prezenta" onclick="prezenta(this.id,'<?php echo $classInfo[1];?>')">Prezenta</a>
              <a href="#" class="list-group-item list-group-item-action">Note</a>
              <a href="#" class="list-group-item list-group-item-action">Inca ceva aici</a>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
  <?php
}
?>
