<?php
session_start();
require_once '../../conn.php';
$sql = "select * from `ore`";
$result = $conn -> query($sql);
?>
<div class="modal" tabindex="-1" role="dialog" id="materie-edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Materie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="edit-materie-modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide</button>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm text-center">
      <button type="button" id="materie-edit-modal-btn" data-toggle="modal" style="visibility: hidden;" data-target="#materie-edit-modal">bla</button>
      <div id="ore-alert">

      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm">
      <table class="table table-sm table-striped">
        <thead class="thead-light">
          <tr>
            <th>#</th>
            <th>ID</th>
            <th>Materia</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = $result -> fetch_assoc()) {
            // code...
            ?>
            <tr id="row-<?php echo $row['id'];?>">
              <td>
                <i class="fas fa-trash-alt" style="cursor: pointer;" onclick="deleteMaterie(<?php echo $row['id'];?>)" title="Delete"></i>
                <i class="fas fa-edit" title="Edit" style="cursor: pointer;" onclick="editMaterie(<?php echo $row['id'];?>)"></i>
              </td>
              <td><?php echo $row['id'];?></td>
              <td><?php echo $row['materie'];?></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
