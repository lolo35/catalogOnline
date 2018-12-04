<?php
session_start();
if(!isset($_SESSION['user'])){
	$URL = "login.php";
	redirect($URL);
}
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
      $noteSql = "select * from `note` where `user_id` = '".$user_id."' and `ora` = '$materia' order by `date` asc";
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
                    $semOneBreak = 0;
                    $semOneCounter = 0;
                    $semTwoBreak = 0;
                    $semTwoCounter = 0;
                    while($rowNoteSql = $resNoteSql -> fetch_assoc()){
                      if($rowNoteSql['nota'] < 4){
                        $class = "class='table-danger'";
                      }elseif($rowNoteSql['nota'] > 4 && $rowNoteSql['nota'] < 8){
                        $class = "class='table-warning'";
                      }elseif($rowNoteSql['nota'] > 8){
                        $class = "class='table-success'";
                      }
                      if($rowNoteSql)
                      $media += $rowNoteSql['nota'];
                      $counter++;
                      $date = new DateTime($rowNoteSql['date']);
                      $intDate = $date -> format('Ymd');
                      //echo $intDate;
                      $startSemestrUnu = 20181106;
                      $endSemestruUnu = 20181113;
                      $startSemestruDoi = 20181126;
                      $endSemestruDoi = 20181224;
                      if(($intDate >= $startSemestrUnu) && ($intDate <= $endSemestruUnu)){
                        if(!isset($noteSemOne)){
                          $noteSemOne = 0;
                        }
                        $noteSemOne += $rowNoteSql['nota'];
                        $semOneCounter++;
                        if ($semOneBreak < 1) {
                          ?>
                          <tr>
                            <th>Semestrul Intai</th>
                          </tr>
                          <?php
                          $semOneBreak += 1;
                        }
                      }elseif(($intDate >= $startSemestruDoi) && ($intDate <= $endSemestruDoi)){
                        if(!isset($noteSemTwo)){
                          $noteSemTwo = 0;
                        }
                        $noteSemTwo += $rowNoteSql['nota'];
                        $semTwoCounter++;
                        if($semTwoBreak < 1){
                          ?>
                          <tr>
                            <th>Semestrul Doi</th>
                          </tr>
                          <?php
                          $semTwoBreak += 1;
                        }
                      }
                      ?>
                      <tr <?php echo $class;?>>
                        <td><?php echo $rowNoteSql['nota'];?></td>
                      </tr>
                      <?php
                    }
                    ?>
                    <tr>
                      <th><u>Medii</u></th>
                    </tr>
                    <tr>
                      <td><u>Sem 1</u></td>
                    </tr>
                    <tr>
                      <td><?php
                            if($semOneCounter > 0){
                              if(isset($noteSemOne)){
                                echo $noteSemOne / $semOneCounter;
                              }
                            }
                          ?>
                      </td>
                    </tr>
                    <tr>
                      <td><u>Sem 2</u></td>
                    </tr>
                    <tr>
                      <td>
                        <?php
                          if($semTwoCounter > 0){
                            if(isset($noteSemTwo)){
                              echo $noteSemTwo / $semTwoCounter;
                            }
                          }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td><u>Anuala</u></td>
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
  <div class="row">
    <div class="col-sm-1">
      <a href="" onclick="event.preventDefault(); selectClasa('clasa-<?php echo $materia;?>-<?php echo $clasa;?>')">
        <i class="fas fa-chevron-left"></i>
        Inapoi
      </a>
    </div>
  </div>
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
