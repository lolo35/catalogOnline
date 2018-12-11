<?php
session_start();
require_once '../../conn.php';
$sql = "select `user_id`,`nume` from `elevi`";
$result = $conn -> query($sql);
$materii = "select `materie` from `ore`";
$resMaterii = $conn -> query($materii);
$materiiArray = array();
while($row = $resMaterii -> fetch_assoc()){
  $materiiArray[] = $row['materie'];
}
//print_r($materiiArray);
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm">
      <?php
      while($row = $result -> fetch_assoc()){
        foreach ($materiiArray as $key => $value) {
          $note = "select count(`nota`) as nr_note,sum(`nota`) as total, `nota`,`tip_nota` from `note` where `user_id` = '".$row['user_id']."' and `ora` = '$value' and `tip_nota` = '1'";
          $resNote = $conn -> query($note);
          $rowNote = $resNote -> fetch_assoc();
          if($rowNote['total'] > 0){
            if($rowNote['total'] / $rowNote['nr_note'] <= 5){
              $getTeza = "select `nota` from `note` where `user_id` = '".$row['user_id']."' and `tip_nota` = '2' and `ora` = '$value'";
              $resGetTeza = $conn -> query($getTeza);
              $rowGetTeza = $resGetTeza -> fetch_assoc();
              echo $row['nume']." - ". $value . "<br>";
              echo "Media fara teza: " . $rowNote['total'] / $rowNote['nr_note']."<br>";
              if($rowGetTeza['nota'] > 0){
                $mTeza = ($rowNote['total'] / $rowNote['nr_note']) * 3 / 4;
                echo "Media cu teza: " . $mTeza . "<br>";
              }
            }
          }
        }
      }
      ?>
    </div>
  </div>
</div>
