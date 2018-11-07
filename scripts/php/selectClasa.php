<?php
session_start();
require_once '../../conn.php';
if(isset($_GET['id'])){
  $classInfo = explode("-", $_GET['id']);
  //print_r($classInfo);
  //echo $classInfo[1];
  $clasa = substr($_GET['id'], -3, 3);
  //echo $clasa;
  $sql = "select * from `elevi` where `clasa` = '$clasa'";
  $result = $conn -> query($sql);
  ?>
  <div class="container-fluid">
    <div id="note-dialog" title="Adaugare Nota">

    </div>
    <div class="row">
      <?php
      while($row = $result -> fetch_assoc()){
        $prezentNotification = "select `prezenta` from `prezenta` where `user_id` = '".$row['user_id']."' and `ora` = '".$classInfo[1]."' and `date` = '".date('Y-m-d')."'";
        $sqlGetNote = "select `date`, `nota` from `note` where `user_id` = '".$row['user_id']."' and `ora` = '".$classInfo[1]."'";
        //echo $prezentNotification;
        $resPrezentNotification = $conn -> query($prezentNotification);
        $resGetNote = $conn -> query($sqlGetNote);
        $prezent = $resPrezentNotification -> fetch_assoc();

        //echo $prezent['prezenta'];
        if(strlen($prezent['prezenta']) < 1){
          $span = "<i class='fas fa-times-circle' style='color: red; font-size: 1.4em;'></i>";
        }
        if($prezent['prezenta'] == 1){
          $span = "<i class='fas fa-check-circle' style='color: green; font-size: 1.4em;'></i>";
        }
        ?>
        <div class="col-sm-3">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="images/<?php echo $row['user_id'];?>.jpg" height="220" width="286" alt="<?php echo $row['user_id'];?>-thumb-image">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['nume'];?></h5>
              <p class="card-text">Adresa: <?php echo $row['adresa'];?></p>
              <p class="card-text">Nr. tel: <?php echo $row['nr_tel'];?></p>
            </div>
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action" id="<?php echo $row['user_id'];?>-prezenta" onclick="prezenta(this.id,'<?php echo $classInfo[1];?>')">Prezenta</a>
              <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between" id="<?php echo $row['user_id'];?>-note" onclick="showNote(this.id, '<?php echo $classInfo[1];?>')">
                <div id="arrow-<?php echo $row['user_id'];?>-note">
                  <i class="fas fa-chevron-down"></i>
                </div>
                Note
                <span class="badge" onclick="editGrades(<?php echo $row['user_id'];?>, '<?php echo $classInfo[1];?>')" title="Edit">
                    <i class="fas fa-edit" style="font-size: 1.4em;"></i>
                </span>
              </a>
              <div id="current-<?php echo $row['user_id'];?>-note">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm">
                      <table class="table table-sm table-striped">
                        <thead class="thead-light">
                          <tr>
                            <th>Data</th>
                            <th>Nota</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          while($note = $resGetNote -> fetch_assoc()){
                            ?>
                            <tr>
                              <td><?php echo $note['date'];?></td>
                              <td><?php echo $note['nota'];?></td>
                            </tr>
                            <?php
                          }
                          ?>
                        </tbody>
                      </table>
                      <div class="row">
                        <div class="col-sm">
                          <button type="button" class="btn btn-primary btn-block" onclick="addGrade(<?php echo $row['user_id'];?>,'<?php echo $classInfo[1];?>')">Adauga nota</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between" id="<?php echo $row['nume'];?>" onclick="markAsPresent(this.id,'<?php echo $classInfo[1];?>',<?php echo $row['user_id'];?>)">
                Prezent?
                <span class="badge"><div id="<?php echo $row['id'];?>-span"><?php echo $span;?></div></span>
              </a>
            </div>
          </div>
        </div>
        <script type="text/javascript">
          $("#current-<?php echo $row['user_id'];?>-note").hide();

        </script>
        <?php
      }
      ?>
    </div>
  </div>
  <script type="text/javascript">
  $(function(){
    $("#note-dialog").dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
  });
  </script>
  <?php
}
?>
