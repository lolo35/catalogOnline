<?php
session_start();
if(isset($_GET['nume']) && isset($_GET['materia'])){
  //print_r($_GET);
}
$month = date('m');
$year = date('Y');
$first = date('l', mktime(0,0,0, date('m'), 1, date('Y')));
//echo $first;
$numberOfDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
//echo $numberOfDays;
if($first === "Monday"){
  $skip = 0;
}
if($first === "Tuesday"){
  $skip = 1;
}
if($first === "Wednesday"){
  $skip = 2;
}
if($first === "Thursday"){
  $skip = 3;
}
if($first === "Friday"){
  $skip = 4;
}
if($first === "Saturday"){
  $skip = 5;
}
if($first === "Sunday"){
  $skip = 6;
}
?>
<table class="table table-sm">
  <thead>
    <tr>
      <th>Luni</th>
      <th>Marti</th>
      <th>Miercuri</th>
      <th>Joi</th>
      <th>Vineri</th>
      <th>Sambata</th>
      <th>Duminica</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    while ($i <= $numberOfDays){
      ?>
      <tr>
        <?php
        for ($y=1; $y<=7;$y++){
          $day = $i - $skip;
          if($day > 0){
            ?>
            <td>
              <div class="card" style="width: 12rem;">
                <div class="card-body">
                  <h5 class="card-title"><?php if($day > 0){ echo $day;}?></h5>
                  <h6 class="card-subtitle mb-2 text-muted">Absent</h6>
                  <p class="card-text"></p>
                  <p style="position: absolute; right: 10px; bottom: 2px;"><i class="fas fa-check-circle"></i></p>
                </div>
              </div>
            </td>
            <?php
          }else{
            ?>
            <td></td>
            <?php
          }
          if($day == $numberOfDays){
            break;
          }
          $i++;
        }
        ?>
      </tr>
      <?php
      if($day == $numberOfDays){
        break;
      }
    }
    ?>
  </tbody>
</table>
