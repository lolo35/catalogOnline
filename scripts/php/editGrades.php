<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['user'])){
  $user = $_GET['user'];
  $ora = $_GET['ora'];

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
                <td><strong><?php echo $row['tip_nota'];?></strong></td>
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
