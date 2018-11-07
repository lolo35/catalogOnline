<?php
session_start();
require_once '../../conn.php';
if(isset($_POST['ins'])){
  $date = date('Y-m-d');
  $user = $_POST['user'];
  $grade = $_POST['grade'];
  $clasa = $_POST['clasa'];
  $sql = "insert into `note` (`user_id`,`date`,`ora`,`nota`) values ('$user','$date','$clasa','$grade')";
  if($conn -> query($sql)){
    $sqlGetNote = "select `date`,`nota` from `note` where `user_id` = '$user' and `ora` = '$clasa'";
    $resGetNote = $conn -> query($sqlGetNote);
    ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm">
          <table class="table table-sm table-striped">
            <thead class="thead-light">
              <tr>
                <th>Data</th>
                <th>Nota</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while($note = $resGetNote -> fetch_assoc()){
                ?>
                <tr>
                  <td><?php echo $note['date'];?></td>
                  <td><?php echo $note['nota'];?></td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
          <div class="row">
            <div class="col-sm">
              <button type="button" class="btn btn-primary btn-block" onclick="addGrade(<?php echo $user;?>,'<?php echo $clasa;?>')">Adauga nota</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }else{
    echo $conn -> error;
  }
}
?>
