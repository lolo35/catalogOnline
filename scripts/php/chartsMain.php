<?php
session_start();
require_once '../../conn.php';
$month = date('m');
if($month >= 9){
  $monthsArray = array('Septembrie' => '09', 'Octombrie' => '10', 'Noiembrie' => '11', 'Decembrie' => '12');
}elseif($month <= 6){
  $monthsArray = array('Septembrie' => '09', 'Octombrie' => '10', 'Noiembrie' => '11', 'Decembrie' => '12','Ianuarie' => '01',
                      'Februarie' => '02', 'Martie' => '03', 'Aprilie' => '04', 'Mai' => '05', 'Iunie' => '06');
}
$dateArray = array();
foreach ($monthsArray as $key => $value) {
  if(!isset($dateArray[$key])){
    $dateArray[$key] = 0;
  }
  if($month >= 9){
    $year = date('Y');
  }elseif($month <= 6){
    if($key === "Septembrie" || $key === "Octombrie" || $key === "Noiembrie" || $key === "Decembrie"){
      $year = date('Y') - 1;
    }else{
      $year = date('Y');
    }
  }
  //echo $year. "<br>";
  $sql = "select count(`id`) as total from `prezenta` where `prezenta` = '0' and `date` like '$year-$value%'";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  //echo $key . "-" . $row['total']."<br>";
  $dateArray[$key] = $row['total'];

}
//print_r($dateArray);
$year = date('Y');
//echo $year - 1;
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm">
      <canvas style="background-color: white;" id="evolutieAbsente" width="300" height="150"></canvas>
      <script type="text/javascript">
        var ctx = document.getElementById("evolutieAbsente");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                  <?php
                  foreach ($dateArray as $key => $value) {
                    echo "\"" . $key . "\",";
                  }
                  ?>
                ],
                datasets: [{
                    label: 'Evolutie absente <?php if($month >= 9){echo $year . " - " . ($year + 1);}elseif($month <= 6){ echo ($year - 1) . " - " . $year;} ?>',
                    fill: 0,
                    data: [
                      <?php
                      foreach ($dateArray as $key => $value) {
                        echo $value . ",";
                      }
                      ?>
                    ],
                    backgroundColor: [
                        'blue'
                    ],
                    borderColor: [
                        'blue'
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
