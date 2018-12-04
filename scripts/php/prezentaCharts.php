<?php
session_start();
if(!isset($_SESSION['user'])){
	$URL = "login.php";
	redirect($URL);
}
require_once '../../conn.php';
$sql = "select `nume`,`user_id`,`clasa` from `elevi`";
$result = $conn -> query($sql);
$date = array();
while($row = $result -> fetch_assoc()){
  if(!isset($date[$row['clasa']])){
    $date[$row['clasa']] = 0;
  }
  $countAbsente = "select count(`id`) as total from `prezenta` where `user_id` = '".$row['user_id']."' and `prezenta` = '0'";
  $resCountAbsente = $conn -> query($countAbsente);
  $rowTotalAbsente = $resCountAbsente -> fetch_assoc();
  //echo $row['clasa'] . $rowTotalAbsente['total']."<br>";
  $date[$row['clasa']] += $rowTotalAbsente['total'];
}
//print_r($date);
?>
<canvas id="myChart" width="400" height="200"></canvas>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
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
            label: '# absente/clasa',
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
