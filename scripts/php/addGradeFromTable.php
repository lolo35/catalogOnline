<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['elev']) && isset($_GET['materia'])){
  $elev = mysqli_real_escape_string($conn, $_GET['elev']);
  $materia = mysqli_real_escape_string($conn, $_GET['materia']);
  $sql = "select `nume`,`clasa` from `elevi` where `user_id` = '$elev'";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  ?>
  <div class="modal-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm">
          <h5 class="display-5 text-center"><?php echo $row['nume'];?></h5>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <h6 class="display-6 text-center"><?php echo $materia;?></h6>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label for="addGrade-nota">Nota</label>
            <select class="form-control text-center" id="addGrade-nota">
              <?php
              for ($i=1; $i <= 10; $i++) {
                // code...
                ?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php
              }
              ?>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" id="close-add-gradeModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="addGradeTabelModal('<?php echo $row['clasa'];?>')">Save</button>
  </div>
  <script type="text/javascript">
    function addGradeTabelModal(clasa){
      var nota = $("#addGrade-nota").val();
      var materia = "<?php echo $materia;?>";
      $.ajax({
        method: "POST",
        url: "scripts/php/addGradeTabelModal.php",
        data: {
          post: "true",
          nota: nota,
          materia: materia,
          elev: '<?php echo $elev;?>'
        },
        cache: false,
        success: function(addGradeData){
          console.log(addGradeData);
          if(addGradeData === "success"){
            $("#tabelNoteModal").on('hidden.bs.modal', function(e){
              $.ajax({
                method: "GET",
                url: "scripts/php/tabelnote.php?clasa=clasa-" + materia + "-" + clasa ,
                cache: false,
                success: function(renewNoteTableData){
                  $("#main-content-div").html(renewNoteTableData);
                },
                error: function(renewNoteTableError){
                  console.log(renewNoteTableError);
                }
              });
            });
          }
        },
        error: function(){
          console.log("ups");
        }
      });
    }
  </script>
  <?php
}
?>
