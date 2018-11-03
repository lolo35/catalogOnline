<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['id'])){
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
            <img class="card-img-top" src="images/<?php echo $row['nume'];?>.jpg" height="220" width="286" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nume'];?></h5>
              <p class="card-text">Informatii suplimentare aici</p>
            </div>
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action">Prezenta</a>
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
