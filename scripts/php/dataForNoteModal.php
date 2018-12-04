<?php
session_start();
if(!isset($_SESSION['user'])){
	$URL = "login.php";
	redirect($URL);
}
require_once '../../conn.php';
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "select * from `note` where `id` = '$id'";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  $sqlGetElev = "select `nume`,`clasa` from `elevi` where `user_id` = '".$row['user_id']."'";
  $resGetElev = $conn -> query($sqlGetElev);
  $rowGetElev = $resGetElev -> fetch_assoc();
  ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm text-center">
        <h5><?php echo $rowGetElev['nume'];?> - <?php echo $rowGetElev['clasa'];?></h5>
      </div>
    </div>
    <form id="change-grade-form" onsubmit="changeGradeForm(event,<?php echo $row['id'];?>,<?php echo $row['user_id'];?>,'<?php echo $row['ora'];?>')">
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label for="date">Data</label>
            <input type="text" class="form-control" style="text-align: center;" id="date" value="<?php echo $row['date'];?>" disabled>
            <small class="text-muted"></small>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label for="ora">Materia</label>
            <input type="text" style="text-align: center;" value="<?php echo $row['ora'];?>" id="ora" class="form-control" disabled>
            <small class="text-muted"></small>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label for="nota">Nota</label>
            <input type="text" style="text-align: center;" value="<?php echo $row['nota'];?>" id="nota" class="form-control">
            <small class="text-muted"></small>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label for="tip-nota">Tip Nota</label>
            <input type="text" style="text-align: center;" value="<?php echo $row['tip_nota'];?>" id="tip-nota" class="form-control">
            <small class="text-muted"></small>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label for="comments">Comentarii</label>
            <textarea id="comments" class="form-control" rows="8" cols="80"><?php echo $row['comentarii'];?></textarea>
          </div>
        </div>
      </div>
    </form>
    <div class="row">
      <div class="col-sm">
        <div id="modal-alert-div">

        </div>
      </div>
    </div>
  </div>
  <?php
}
?>
