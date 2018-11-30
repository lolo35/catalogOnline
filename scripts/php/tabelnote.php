<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['clasa'])){
  $get = mysqli_real_escape_string($conn, $_GET['clasa']);
  $infoArray = explode("-", $get);
  //print_r($infoArray);
  $clasa = $infoArray[2] . "-" . $infoArray[3];
  $materia = $infoArray[1];
  //echo $materia;
  $sql = "select `user_id`,`nume` from `elevi` where `clasa` = '$clasa'";
  $result = $conn -> query($sql);
  $userID = array();
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm">
      <button type="button" style="visibility: hidden;" data-toggle="modal" data-target="#tabel-note-modal" id="tabel-note-trigger">trigger</button>
      <div class="modal fade text-center" id="tabel-note-modal" tabindex="-1" role="dialog" aria-labelledby="note-tabel-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="note-tabel-title">Tabel Note <?php echo $materia;?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
              <?php
              while($thead = $result -> fetch_assoc()){
                $userID[] = $thead['user_id'];
                ?>
                      <th><?php echo $thead['nume'];?></th>
                <?php
              }
              ?>
                </tr>
              </thead>
              <tbody>
                <tr>
              <?php
              foreach($userID as $key => $user_id){
                $noteSql = "select * from `note` where `user_id` = '".$user_id."' and `ora` = '$materia'";
                $resNoteSql = $conn -> query($noteSql);
                ?>

                      <td>
                        <table class="table table-sm text-center table-borderless">
                          <thead>
                            <tr>
                              <td></td>
                            </tr>
                          </thead>
                          <tbody>
                              <?php
                              $media = 0;
                              $counter = 0;
                              while($rowNoteSql = $resNoteSql -> fetch_assoc()){
                                if($rowNoteSql['nota'] < 4){
                                  $class = "class='table-danger'";
                                }elseif($rowNoteSql['nota'] > 4 && $rowNoteSql['nota'] < 8){
                                  $class = "class='table-warning'";
                                }elseif($rowNoteSql['nota'] > 8){
                                  $class = "class='table-success'";
                                }
                                $media += $rowNoteSql['nota'];
                                $counter++;
                                ?>
                                <tr <?php echo $class;?>>
                                  <td><?php echo $rowNoteSql['nota'];?></td>
                                </tr>
                                <?php
                              }
                              ?>
                              <tr>
                                <th><u>Media</u></th>
                              </tr>
                              <tr>
                                <td><?php echo $media / $counter;?></td>
                              </tr>
                          </tbody>
                        </table>
                      </td>

                <?php
              }
              ?>
              </tr>
              </tbody>
            </table>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#tabel-note-trigger").click();
  });
</script>
<?php
}
?>
