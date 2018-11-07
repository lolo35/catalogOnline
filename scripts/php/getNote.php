<?php
session_start();
if(isset($_GET['user_id'])){
  $user_id = $_GET['user_id'];
  $clasa = $_GET['clasa'];
  //echo $user_id."<br>";
  //echo $clasa;
  ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm">
        <input type="text" id="insert-grade-input" class="form-control">
      </div>
    </div>
    <div class="row" style="margin-top: 10px;">
      <div class="col-sm">
        <button type="button" class="btn btn-success btn-block" id="insert-grade-btn" onclick="insertGrade(<?php echo $user_id;?>,'<?php echo $clasa;?>')">Adauga</button>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    
  </script>
  <?php
}
?>
