<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['id'])){
  $classInfo = explode("-", $_GET['id']);
  //print_r($classInfo);
  echo $classInfo[1];
  $clasa = substr($_GET['id'], -3, 3);
  //echo $clasa;
  $sql = "select * from `elevi` where `clasa` = '$clasa'";
  $result = $conn -> query($sql);
  ?>
  <div class="container-fluid">
    <div class="row">
      <?php
      while($row = $result -> fetch_assoc()){
        $prezentNotification = "select `prezenta` from `prezenta` where `nume` = '".$row['nume']."' and `ora` = '".$classInfo[1]."' and `date` = '".date('Y-m-d')."'";
        //echo $prezentNotification;
        $resPrezentNotification = $conn -> query($prezentNotification);
        $prezent = $resPrezentNotification -> fetch_assoc();
        //echo $prezent['prezenta'];
        if(strlen($prezent['prezenta']) < 1){
          $span = "<i class='fas fa-times-circle' style='color: red; font-size: 1.4em;'></i>";
        }
        if($prezent['prezenta'] == 1){
          $span = "<i class='fas fa-check-circle' style='color: green; font-size: 1.4em;'></i>";
        }
        ?>
        <div class="col-sm-3">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="images/<?php echo $row['nume'];?>.jpg" height="220" width="286" alt="<?php echo $row['nume'];?>-thumb-image">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nume'];?></h5>
              <p class="card-text">Adresa: str. bla bla</p>
              <p class="card-text">Nr. tel: 555-kick ass</p>
            </div>
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action" id="<?php echo $row['nume'];?>-prezenta" onclick="prezenta(this.id,'<?php echo $classInfo[1];?>')">Prezenta</a>
              <a href="#" class="list-group-item list-group-item-action">Note</a>
              <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between" id="<?php echo $row['nume'];?>" onclick="markAsPresent(this.id,'<?php echo $classInfo[1];?>',<?php echo $row['id'];?>)">
                Prezent?
                <span class="badge"><div id="<?php echo $row['id'];?>-span"><?php echo $span;?></div></span>
              </a>
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
