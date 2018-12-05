<?php
session_start();
require_once '../../conn.php';
if(!isset($_SESSION['user'])){
  $URL = "login.php";
  redirect($URL);
}
if(isset($_GET['nota'])){
  $notaID = mysqli_real_escape_string($conn, $_GET['nota']);
  $sql = "select * from `note` where `id` = '$notaID'";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
}else{
  die("Nu ati selectat nici o nota!");
}
?>
<div class="modal-body">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm">
        <?php
        $sqlName = "select `nume`,`user_id` from `elevi` where `user_id` = '".$row['user_id']."'";
        $resName = $conn -> query($sqlName);
        $rowName = $resName -> fetch_assoc();
        ?>
        <h5 class="display-5 text-center"><?php echo $rowName['nume'];?></h5>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <h6 class="display-6 text-center"><?php echo $row['ora'];?></h6>
      </div>
    </div>
    <form method="post" id="form-modal-tabel-note" enctype="multipart/form-data" onsubmit="submitModalFormData(event,<?php echo $notaID;?>)">
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label for="tabel-note-modal-select">Nota</label>
            <select class="form-control" style="text-align: center;" id="tabel-note-modal-select">
              <?php
                for ($i=1; $i <= 10; $i++){
                  ?>
                  <option value="<?php echo $i;?>" <?php if($i == $row['nota']){echo "selected";}?>><?php echo $i;?></option>
                  <?php
                }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <div class="form-group" id="motiv-group-div">
            <label for="motiv">Motiv editare</label>
            <textarea id="motiv" class="form-control" rows="4" cols="80" required></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="form-group">
            <i class="fas fa-paperclip" onclick="triggerFileBrowse('optional-file')" style="font-size: 2rem;"></i>
            <label for="optional-file">Atasati fisier...</label>
            <input type="file" onchange="showName()" class="form-control-file" id="optional-file" style="display: none;" name="">
          </div>
        </div>
        <div class="col-sm-4">
          <p id="file-name"></p>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="button" onclick="submitModalTabelForm()" id="submit-form-modal-note-tabel-btn" class="btn btn-primary">Save</button>
</div>
<script type="text/javascript">
  function triggerFileBrowse(id){
    $("#" + id).click();
  }
  function submitModalTabelForm(){
    $("#form-modal-tabel-note").submit();
  }
  function submitModalFormData(e,gradeID){
    e.preventDefault();
    var textarea = $("#motiv").val();
    if(textarea.length < 20){
      $("#valid-feedback-tabel-note-modal").remove();
      $("#invalid-feedback-tabel-note-modal").remove();
      $("#motiv").removeClass("is-valid");
      $("#motiv").addClass("is-invalid");
      $("#motiv-group-div").append("<div id='invalid-feedback-tabel-note-modal' class='invalid-feedback'>Introduceti minim 20 de caractere</div>");
      return 0;
    }else{
      $("#valid-feedback-tabel-note-modal").remove();
      $("#motiv").removeClass("is-invalid");
      $("#motiv").addClass("is-valid");
      $("#invalid-feedback-tabel-note-modal").remove();
      $("#motiv-group-div").append("<div id='valid-feedback-tabel-note-modal' class='valid-feedback'><i class='fas fa-thumbs-up'></i></div>")
    }
    var nota = $("#tabel-note-modal-select").val();
    $.ajax({
      method: "POST",
      url: "scripts/php/updateGrade.php",
      data: {
        post: "true",
        nota: nota,
        motiv: textarea,
        gradeId: gradeID
      },
      cache: false,
      success: function(notaFormData){
        if(notaFormData === "success"){
          $("#th-" + gradeID).text(nota);
          var formData = new FormData();
          formData.append('file', $("#optional-file")[0].files[0]);
          $.ajax({
            method: "POST",
            url: "scripts/php/fileUpload.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(fileData,textStatus,jqXHR){
              if(fileData === "success"){
                //do something
              }
            }
          });
        }
      }
    });
    //console.log(formData);
  }
  function showName(){
    var name = document.getElementById('optional-file');
    $("#file-name").text("Fisierul atasat: " + name.files.item(0).name);
  }
</script>
