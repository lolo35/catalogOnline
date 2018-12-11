<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['clasa'])){
  $clasa = mysqli_real_escape_string($conn, $_GET['clasa']);
}else{
  exit();
}
$sql = "select `user_id`,`nume` from `elevi` where `clasa` = '$clasa'";
$result = $conn -> query($sql);
$dataArray = array();
while($row = $result -> fetch_assoc()){
  $dataArray[] = $row['user_id'];
}
?>
<div class="container-fluid">
  <div class="row" style="margin-top: 20px;">
    <div class="col-sm">
      <?php
      $prezentaArray = array();
      foreach ($dataArray as $key => $value) {
        $sql = "select count(`id`) as total,`nume` from `prezenta` where `user_id` = '$value' and `prezenta` = '0' order by `total` desc;";
        $res = $conn -> query($sql);
        $row = $res -> fetch_assoc();
        //echo $sql
        //echo $row['nume'] . " " . $row['total'];
        if($row['total'] > 0){
          if(!isset($prezentaArray[$row['nume']])){
            $prezentaArray[$row['nume'] . "-" .$value] = $row['nume'];
          }
          $prezentaArray[$row['nume'] . "-" . $value] = $row['total'];
        }
      }
      arsort($prezentaArray);
      ?>
      <canvas style="background-color: white;" id="absente-clasa-selected" width="400" height="300"></canvas>
      <script>
        var ctx = document.getElementById("absente-clasa-selected").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                  <?php
                  $i = 0;
                  foreach ($prezentaArray as $key => $value) {
                    $nume = explode("-", $key);
                    echo "\"" . $nume[0] . "\",";
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
                      foreach ($prezentaArray as $key => $value) {
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
                        '#3e95cd',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        '#3e95cd',
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
