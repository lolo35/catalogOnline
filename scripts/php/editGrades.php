<?php
session_start();
if(!isset($_SESSION['user'])){
	$URL = "login.php";
	redirect($URL);
}
require_once '../../conn.php';
if(isset($_GET['user'])){
  $user = mysqli_real_escape_string($conn, $_GET['user']);
  $ora = mysqli_real_escape_string($conn, $_GET['ora']);
	$selectClasa = "select `clasa` from `elevi` where `user_id` = '$user'";
	$resSelectClasa = $conn -> query($selectClasa);
	$clasa = $resSelectClasa -> fetch_assoc();
  $sql = "select * from `note` where `user_id` = '$user' and `ora` = '$ora'";
  //echo $sql;
  $result = $conn -> query($sql);
  ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="noteModal" aria-labelledby="noteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editare Nota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="note-modal-content">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="refreshGradeTable(<?php echo $user;?>,'<?php echo $ora;?>')">Inchide</button>
          <button type="button" class="btn btn-primary" onclick="submitChangeGradeForm()">Salveaza</button>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<a href="" onclick="event.preventDefault(); selectClasa('clasa-<?php echo $ora;?>-<?php echo $clasa['clasa'];?>')">
	        <i class="fas fa-chevron-left"></i>
	        Inapoi
	      </a>
			</div>
		</div>
    <div class="row">
      <button type="button" id="modal-trigger-hidden-btn" style="visibility: hidden;" data-toggle="modal" data-target="#noteModal"></button>
      <div class="col-sm">
        <table class="table table-sm table-striped">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Data</th>
              <th>Nota</th>
              <th>Tip Nota</th>
              <th>Comentarii</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while($row = $result -> fetch_assoc()){
              ?>
              <tr id="<?php echo $row['id'];?>">
                <td>
                  <a href="#" onclick="deleteGrade(<?php echo $row['id'];?>)" data-toggle="tooltip" data-placement="top" title="Sterge">
                    <i class="fas fa-eraser" style="font-size: 1.4em;"></i>
                  </a>
                  <a href="#" onclick="showNoteModal(<?php echo $row['id'];?>)">
                    <i class="fas fa-edit" style="font-size: 1.4em;" title="Edit"></i>
                  </a>
                </td>
                <td title="Data"><?php echo $row['date'];?></td>
                <td><?php echo $row['nota'];?></td>
								<?php
								if($row['tip_nota'] == 1){
									$tipNota = "";
								}elseif($row['tip_nota'] == 2){
									$tipNota = "Teza";
								}
								?>
                <td><strong><?php echo $tipNota;?></strong></td>
                <td><?php echo $row['comentarii'];?></td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php
}
?>
