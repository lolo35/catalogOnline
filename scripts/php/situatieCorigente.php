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
              /*echo $row['nume']." - ". $value . "<br>";
              echo "Media fara teza: " . $rowNote['total'] / $rowNote['nr_note']."<br>";*/
              ?>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-3">
                    <div class="card border-danger mb-3" style="max-width: 18rem;">
                      <div class="card-header">
                        Materia: <?php echo $value;?>
                      </div>
                      <div class="card-body text-danger">
                        <h5 class="card-title"><?php echo $row['nume'];?></h5>
                        <p class="card-text">Elevul este in risk de corigenta...</p>
                        <p class="card-text">
                          Media:
                          <?php
                          if($rowGetTeza['nota'] > 0){
                            $mTeza = ($rowNote['total'] / $rowNote['nr_note']) * 3 / 4;
                            echo $mTeza;
                          }else{
                            echo $rowNote['total'] / $rowNote['nr_note'];
                          }
                          ?>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="card border-danger mb-3">
                      <div class="card-header">
                        Note
                      </div>
                      <div class="card-body text-danger text-center">
                        <?php
                        $getNote = "select `nota`,`tip_nota`,`date` from `note` where `user_id` = '".$row['user_id']."' and `ora` = '$value'";
                        $resGetNote = $conn -> query($getNote);
                        while($rowGetNote = $resGetNote -> fetch_assoc()){
                          ?>
                          <p class="card-text"><?php if($rowGetNote['tip_nota'] == 2){echo "Teza: " . $rowGetNote['nota'];}else{echo $rowGetNote['nota'];}?></p>
                          <?php
                        }
                        mysqli_data_seek($resGetNote, 0);
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <canvas style="background-color: white;" id="evoChart-<?php echo $row['user_id'];?>" width="300" height="150"></canvas>
                    <script>
                    var ctx = document.getElementById("evoChart-<?php echo $row['user_id'];?>");
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [
                              <?php
                              while($rowGetNote = $resGetNote -> fetch_assoc()){
                                echo "\"" . $rowGetNote['date'] . "\",";
                              }
                              mysqli_data_seek($resGetNote, 0);
                              ?>
                            ],
                            datasets: [{
                                label: '<?php echo $row['nume'] ?>',
                                fill: 0,
                                data: [
                                  <?php
                                  while($rowGetNote = $resGetNote -> fetch_assoc()){
                                    echo $rowGetNote['nota'] . ",";
                                  }
                                  ?>
                                ],
                                backgroundColor: [
                                    'red'
                                ],
                                borderColor: [
                                    'red'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                    </script>
                  </div>
                </div>
              </div>
              <?php
            }
          }
        }
      }
      ?>
    </div>
  </div>
</div>
