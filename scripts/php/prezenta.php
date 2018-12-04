<?php
session_start();
if(!isset($_SESSION['user'])){
	$URL = "login.php";
	redirect($URL);
}
require_once '../../conn.php';
if(isset($_GET['nume']) && isset($_GET['materia'])){
  $nume = explode("-", $_GET['nume']);
  $name = "select `nume`,`clasa` from `elevi` where `user_id` = '".$nume[0]."' limit 1";
  $resName = $conn -> query($name);
  $rowName = $resName -> fetch_assoc();
  $materia = $_GET['materia'];
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
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-1">
      <a href="" onclick="event.preventDefault(); selectClasa('clasa-<?php echo $materia;?>-<?php echo $rowName['clasa'];?>')">
        <i class="fas fa-chevron-left"></i>
        Inapoi
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-sm">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#"><?php echo $rowName['nume'];?></a>
          </li>
          <li class="breadcrumb-item">
            <a href="#">Prezenta</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="#"><?php echo $materia;?></a>
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-sm">
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
                  if(strlen($day) < 2){
                    $sqlDay = 0 . $day;
                  }else{
                    $sqlDay = $day;
                  }
                  $getPrezenta = "select `prezenta` from `prezenta` where `user_id` = '$nume[0]' and `ora` = '$materia' and `date` = '" .$year."-".$month."-". $sqlDay . "'";
                  //echo $getPrezenta;
                  $resGetPrezenta = $conn -> query($getPrezenta);
                  $prezenta = $resGetPrezenta -> fetch_assoc();
                  ?>
                  <td>
                    <div class="card" style="width: 12rem;">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $day;?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                          <?php
                          if($sqlDay <= date('d')){
                            if($y != 6 && $y != 7){
                              if($prezenta['prezenta'] == 1){
                                echo "Prezent";
                              }elseif($prezenta['prezenta'] == 0){
                                echo "Absent";
                              }
                            }else{
                              echo "Weekend";
                            }
                          }else{
                            echo "&nbsp;";
                          }
                          ?>
                        </h6>
                        <p class="card-text"></p>
                        <p style="position: absolute; right: 10px; bottom: 2px;">
                          <?php
                          if($sqlDay <= date('d')){
                            if($y != 6 && $y != 7){
                              if($prezenta['prezenta'] == 1){
                                ?>
                                <i class="fas fa-check-circle" style="color: green;"></i>
                                <?php
                              }
                              if($prezenta['prezenta'] == 0){
                                ?>
                                <i class="fas fa-times-circle" style="color: red;"></i>
                                <?php
                              }
                              if($prezenta['prezenta'] === ""){
                                ?>
                                <i class="far fa-calendar-times"></i>
                                <?php
                              }
                            }else{
                              ?>
                              <i class="fas fa-home"></i>
                              <?php
                            }
                          }else{
                            ?>
                            <i class="far fa-calendar-times"></i>
                            <?php
                          }
                          ?>
                        </p>
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

    </div>
  </div>
</div>
