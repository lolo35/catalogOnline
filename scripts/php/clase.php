<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['clasa'])){
  $clasa = substr($_GET['clasa'], 9);
  $getClase = "select `clasa` from `$clasa`";
  $resClase = $conn -> query($getClase);
  ?>
  <div class="container-fluid">
    <div class="row">
      <?php
      $i = 0;
      while($row = $resClase -> fetch_assoc()){
        if($i == 0 || $i == 5 || $i == 10){

        }
        ?>
        <div class="col-sm-3">
          <div class="list-group text-center" style="margin-top: 10px;">
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start" id="clasa-<?php echo $clasa;?>-<?php echo $row['clasa'];?>" onclick="selectClasa(this.id)">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Clasa <?php echo $row['clasa'];?></h5>
                <small></small>
              </div>
              <p class="mb-1">Materie: <?php echo $clasa;?></p>
              <small>Clasa: <?php echo $row['clasa'];?></small>
            </a>
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
