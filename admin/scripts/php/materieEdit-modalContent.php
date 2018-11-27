<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "select * from `ore` where `id` = '$id'";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  ?>
  <div class="container-fluid">
    <form onsubmit="submitMaterieEdit(event)">
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label for="materie">Materia</label>
            <input type="text" id="materie" class="form-control" value="<?php echo $row['materie'];?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label for="materie-comments">Comentarii</label>
            <textarea id="materie-comments" class="form-control" rows="8" cols="40">
              <?php echo $row['comments'];?>
            </textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <button type="submit" class="btn btn-primary btn-block">Salveaza modificarile</button>
        </div>
      </div>
    </form>
  </div>
  <script type="text/javascript">
    function submitMaterieEdit(e){
      e.preventDefault();
      var materie = $("#materie").val();
      var materieComments = $("#materie-comments").val();
      console.log(materie);
      console.log(materieComments);
      $.ajax({
        method:"POST",
        url: "scripts/php/submitMaterieEdit.php",
        data: {
          submit: "true",
          materie: materie,
          materieComments: materieComments
        },
        cache: false,
        success: function(materieEditData){
          
        }
      });
    }
  </script>
  <?php
}
?>
