<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['clasa'])){
  $get = mysqli_real_escape_string($conn, $_GET['clasa']);
  $infoArray = explode("-", $get);
  //print_r($infoArray);
  $clasa = $infoArray[2] . "-" . $infoArray[3];
  $materia = $infoArray[1];
  //echo $materia;
  $numberOfElevi = "select count(`id`) as total from `elevi` where `clasa` = '$clasa'";
  $resNumberOfElevi = $conn -> query($numberOfElevi);
  $actualNumberOfElevi = $resNumberOfElevi -> fetch_assoc();
  //echo $actualNumberOfElevi['total'];
  $userID = array();
  function drawNoteTable($conn,$clasa,$materia,$limit,$offset){
    $sql = "select `user_id`,`nume` from `elevi` where `clasa` = '$clasa' limit $limit offset $offset";
    //echo $sql;
    $result = $conn -> query($sql);
    ?>
    <table class="table table-bordered table-sm">
      <thead class="colors">
        <tr>
    <?php
    while($thead = $result -> fetch_assoc()){
      $userID[] = $thead['user_id'];
      ?>
            <th><?php echo $thead['nume'];?></th>
      <?php
    }
    ?>
      </tr>
    </thead>
    <tbody>
      <tr>
    <?php
    foreach($userID as $key => $user_id){
      $noteSql = "select * from `note` where `user_id` = '".$user_id."' and `ora` = '$materia'";
      $resNoteSql = $conn -> query($noteSql);
      ?>

            <td>
              <table class="table table-sm text-center table-borderless">
                <thead>
                  <tr>
                    <td>Note</td>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $media = 0;
                    $counter = 0;
                    while($rowNoteSql = $resNoteSql -> fetch_assoc()){
                      if($rowNoteSql['nota'] < 4){
                        $class = "class='table-danger'";
                      }elseif($rowNoteSql['nota'] > 4 && $rowNoteSql['nota'] < 8){
                        $class = "class='table-warning'";
                      }elseif($rowNoteSql['nota'] > 8){
                        $class = "class='table-success'";
                      }
                      $media += $rowNoteSql['nota'];
                      $counter++;
                      ?>
                      <tr <?php echo $class;?>>
                        <td><?php echo $rowNoteSql['nota'];?></td>
                      </tr>
                      <?php
                    }
                    ?>
                    <tr>
                      <th><u>Media</u></th>
                    </tr>
                    <tr>
                      <td><?php if($media > 0){echo $media / $counter;}else{echo 0;}?></td>
                    </tr>
                </tbody>
              </table>
            </td>

      <?php
    }
    ?>
    </tr>
    </tbody>
  </table>
    <?php
  }
?>
<div class="container-fluid">
      <?php
      $limit = 12;
      $offset = 0;
      $i = 0;
      while($i < $actualNumberOfElevi['total']){
        //echo $i;
        if($i > 11 && $i < 23){
          $uneven = $actualNumberOfElevi['total'] - 12;
        }
        if($i %12 != 0){

        }else{
          ?>
          <div class="row">
            <div class="col-sm-<?php if(isset($uneven) && $uneven < 12){echo $uneven;}else{echo 12;}?>" style="padding: 0;">
              <?php
              drawNoteTable($conn,$clasa,$materia,$limit,$offset);
              $limit += 12;
              $offset += 12;
              ?>
            </div>
          </div>
          <?php
            }
        $i++;
      }
      ?>
</div>
<?php
}
?>
