<?php
session_start();
require_once '../../conn.php';
function drawTable($conn,$clasa,$materia){
  $sql = "select `user_id`,`nume` from `elevi` where `clasa` = '$clasa'";
  //echo $sql;
  $result = $conn -> query($sql);
  ?>
  <button type="button" id="note-table-modal-btn" class="hidden-modal-button" data-toggle="modal" data-target="#tabelNoteModal">Trigger</button>
  <div class="modal fade" id="tabelNoteModal" tabindex="-1" role="dialog" aria-labelledby="tabelNoteModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tabelNoteModalLongTitle">Editare nota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="tabel-note-modal-content">

        </div>
      </div>
    </div>
  </div>
  <table class="table table-bordered table-sm" style="border: 1px solid black; background-color: white;">
    <thead class="colors" style="border: 1px solid black;">
      <tr style="border: 1px solid black;">
        <th style="border: 1px solid black;">Nume Prenume Elev</th>
        <th style="border: 1px solid black;">Nota</th>
        <th style="border: 1px solid black;">Nota</th>
        <th style="border: 1px solid black;">Nota</th>
        <th style="border: 1px solid black;">Nota</th>
        <th style="border: 1px solid black;">Nota</th>
        <th style="border: 1px solid black;">Nota</th>
        <th style="border: 1px solid black;" class="bg-warning">Teza</th>
        <th style="border: 1px solid black;" class="bg-danger">Media<br>Semestriala</th>
        <th style="border: 1px solid black;" class="bg-success">Media Anuala</th>
      </tr>
    </thead>
    <tbody style="border: 1px solid black;">

        <?php
        while($thead = $result -> fetch_assoc()){
          ?>
        <tr style="padding: 0;">
          <td style="border: 1px solid black;"><?php echo $thead['nume'];?></td>
          <?php
          //$note = array();
          $noteSql = "select * from `note` where `user_id` = '".$thead['user_id']."' and `ora` = '$materia' and `tip_nota` = '1'";
          $count = "select count(`nota`) as total from `note` where `user_id` = '".$thead['user_id']."' and `ora` = '$materia' and `tip_nota` = '1'";
          $resCount = $conn -> query($count);
          $total = $resCount -> fetch_assoc();
          //echo $noteSql;
          $resNoteSql = $conn -> query($noteSql);
          while ($row = $resNoteSql -> fetch_assoc()) {
            if($row['nota'] < 4){
              $class = "color: red;";
            }/*elseif($row['nota'] > 4 && $row['nota'] <= 7){
              $class = "bg-warning";
            }elseif($row['nota'] > 7 && $row['nota'] <= 10){
              $class = "bg-success";
            }*/else{
              $class = "";
            }
            ?>
            <td style="cursor: pointer;<?php echo $class;?>; border: 1px solid black; padding: 0;" id="td-<?php echo $row['id'];?>"
               title="Detalii" data-container="body" data-toggle="popover" data-placement="top" data-content="Data: <?php echo $row['date'];?>">
               <table class="table table-sm table-borderless" style="padding: 0; margin: 0 !important;">
                 <thead>
                   <tr>
                     <th><b id="th-<?php echo $row['id'];?>"><?php echo $row['nota'];?></b></th>
                     <th style="text-align: right; vertical-align: top;"><i class="fas fa-info" style="font-size: 0.7rem;" title="Apasati pentru mai multe informatii"></i></th>
                   </tr>
                 </thead>
                 <tbody>
                   <tr style="padding: 0 !important; margin: 0 !important;">
                     <td style="text-align: left; position: relative; bottom: -5px;">
                       <i id="<?php echo $row['id'];?>" onclick="editGradeInTabel(this.id)" class="fas fa-pencil-alt" style="font-size: 0.7rem;" title="Apasati pentru mai multe informatii"></i>
                     </td>
                     <td></td>
                   </tr>
                 </tbody>
               </table>
            </td>
            <?php
            // code...
          }
          $i = $total['total'];
          if($i < 6){
            //echo $i;
            while($i < 6){
              ?>
              <td style="border: 1px solid black;"></td>
              <?php
              $i++;
            }
          }
          if($i == 6){
            $teza = "select `nota` from `note` where `user_id` = '".$thead['user_id']."' and `ora` = '$materia' and `tip_nota` = '2'";
            $resTeza = $conn -> query($teza);
            $rowTeza = $resTeza -> fetch_assoc();
            ?>
            <td style="border: 1px solid black;"><?php echo $rowTeza['nota'];?></td>
            <?php
            $i++;
          }
          if($i == 7){
            $mediaSem1 = "select sum(`nota`) as total, count(`nota`) as number from `note` where `user_id` = '".$thead['user_id']."' and `ora` = '$materia' and `tip_nota` = '1'";
            $resMediaSem1 = $conn -> query($mediaSem1);
            $rowMediaSem1 = $resMediaSem1 -> fetch_assoc();
            ?>
            <td style="border: 1px solid black;"><?php if($rowMediaSem1['total'] > 0){echo $rowMediaSem1['total'] / $rowMediaSem1['number'];}?></td>
            <?php
          }
          ?>
        </tr>
      <?php
  }
  ?>
    </tbody>
  </table>
  <?php
}
if(isset($_GET['clasa'])){
  $get = mysqli_real_escape_string($conn, $_GET['clasa']);
  $infoArray = explode("-", $get);
  //print_r($infoArray);
  $clasa = $infoArray[2] . "-" . $infoArray[3];
  $materia = $infoArray[1];
  //echo $materia;
  /*$numberOfElevi = "select count(`id`) as total from `elevi` where `clasa` = '$clasa'";
  $resNumberOfElevi = $conn -> query($numberOfElevi);
  $actualNumberOfElevi = $resNumberOfElevi -> fetch_assoc();
  //echo $actualNumberOfElevi['total'];
  $userID = array();*/
  ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2">
        <div class="alert alert-success">
          <strong>Semestrul 1</strong>
        </div>
      </div>
    </div>
      <div class="row">
        <div class="col-sm">
          <?php
          drawTable($conn,$clasa,$materia);
          ?>
        </div>
      </div>
  </div>
  <script type="text/javascript">
  $(function () {
    $('[data-toggle="popover"]').popover()
  });
  function triggerPopover(id){
    $("#" + id).click();
  }
  function editGradeInTabel(id){
    //console.log(id);
    $.ajax({
      method: "GET",
      url: "scripts/php/tabelnotemodalData.php?nota=" + id,
      cache: false,
      success: function(tabelNoteModalData){
        $("#tabel-note-modal-content").html(tabelNoteModalData);
        $("#note-table-modal-btn").click();
      }
    });
  }
  </script>
  <?php
}
?>
