<?php
session_start();
require_once '../../conn.php';
$elevi = "select `user_id`,`nume` from `elevi`";
$resElevi = $conn -> query($elevi);
$eleviArray = array();
$eleviNames = array();
while($rowElevi = $resElevi -> fetch_assoc()){
  if(!isset($eleviArray[$rowElevi['user_id']])){
    $eleviArray[$rowElevi['user_id']] = 0;
  }
  $countAbsente = "select count(`id`) as total from `prezenta` where `prezenta` = '0' and `user_id` = '".$rowElevi['user_id']."'";
  $resCountAbsente = $conn -> query($countAbsente);
  $rowCountAbsente = $resCountAbsente -> fetch_assoc();
  $eleviArray[$rowElevi['user_id']] = $rowCountAbsente['total'];
}
arsort($eleviArray);
//print_r($eleviArray);
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
      <canvas id="top-absente-elevi" width="400" height="300"></canvas>
      <script>
        var ctx = document.getElementById("top-absente-elevi").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                  <?php
                  $i = 0;
                  foreach ($eleviArray as $key => $value) {
                    $getName = "select `nume` from `elevi` where `user_id` = '$key'";
                    $resName = $conn -> query($getName);
                    $rowName = $resName -> fetch_assoc();
                    echo "\"" . $rowName ['nume'] . "\"" . ",";
                    if($i == 4){
                      break;
                    }else{
                      $i++;
                    }
                  }
                  ?>
                ],
                datasets: [{
                    label: 'Top 5 Absente Elevi',
                    data: [
                      <?php
                      $i = 0;
                      foreach ($eleviArray as $key => $value) {
                        echo $value . ",";
                        if($i == 4){
                          break;
                        }else{
                          $i++;
                        }
                      }
                      ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
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
    <div class="col-sm-6">
      <?php
      $getClase = "select `nume`,`user_id`,`clasa` from `elevi`";
      $resGetClase = $conn -> query($getClase);
      $date = array();
      while($row = $resGetClase -> fetch_assoc()){
        if(!isset($date[$row['clasa']])){
          $date[$row['clasa']] = 0;
        }
        $countAbsente = "select count(`id`) as total from `prezenta` where `user_id` = '".$row['user_id']."' and `prezenta` = '0'";
        $resCountAbsente = $conn -> query($countAbsente);
        $rowTotalAbsente = $resCountAbsente -> fetch_assoc();
        //echo $row['clasa'] . $rowTotalAbsente['total']."<br>";
        $date[$row['clasa']] += $rowTotalAbsente['total'];
      }
      ?>
      <canvas id="top-clase-absente" width="400" height="300"></canvas>
      <script type="text/javascript">
        var ctx = document.getElementById("top-clase-absente").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                  <?php
                  foreach ($date as $key => $value) {
                    echo "\"" . $key . "\",";
                  }
                  ?>
                ],
                datasets: [{
                    label: 'Top Absente/Clasa',
                    data: [
                      <?php
                      foreach ($date as $key => $value) {
                        echo $value . ",";
                      }
                      ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
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
