<?php
include 'header.php';
$sqlOre = "select `materie`,`comments` from `ore`";
$resOre = $conn -> query($sqlOre);
$sqlLeftMenu = "select `menuItem`,`favicon` from `left_menu`";
$resLeftMenu = $conn -> query($sqlLeftMenu);
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm">
      <div id="jumbo-container">

      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm">
            <div class="list-group" style="background-color: #2153af;">
              <h5 class="text-center" style="color: white;">
                <i class="fas fa-bars"></i>
                Meniu Principal
              </h5>
              <?php
              while($row = $resLeftMenu -> fetch_assoc()){
                ?>
                <a href="#" class="list-group-item list-group-item-action left-menu" onclick="leftMenu(this.id)" id="left-nav-<?php echo $row['menuItem'];?>">
                  <?php echo $row['favicon'];?>
                  <span style="color: white;"><?php echo $row['menuItem'];?></span>
                </a>
                <?php
              }
              ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm">
            <div id="tabel-note-container">

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="container-fluid">
				<div class="row">
					<div class="col-sm">

					</div>
				</div>
        <div class="row">
          <div class="col-sm">
            <div class="row">

            </div>
            <div id="main-content-div">
                <?php
                $i = 0;
                ?>
                <div class="container-fluid">
                  <div class="row">
                    <?php
                    while($row = $resOre -> fetch_assoc()){
                      $jpg = "images/" . $row['materie'] . ".jpg";
                      $png = "images/" . $row['materie'] . ".png";
                      if($i == 0 || $i == 2 || $i == 5){
                        ?>

                        <?php
                      }
                      ?>
                      <div class="col-lg-3 col-md-4 col-sm-6">
                        <div href="test" class="card zoom" id="main-nav-<?php echo $row['materie'];?>" style="width: 11rem; cursor:pointer; margin-top: 20px; background-color: #EDEDED; border: 0;" onclick="makeActive(this.id)">
                          <img style="border-radius: 50%; box-shadow: 2px 2px 2px 2px grey;" src="<?php if(file_exists($jpg)){echo $jpg;}else{echo $png;} ?>" alt="<?php echo $row['materie'];?>" width="100%" height="120">
                          <div class="card-body text-center main-page-card-custom">
                            <h5 style="color: white; margin-top: -10%;"><?php echo $row['materie'];?></h5>
                          </div>
                        </div>
                      </div>
                      <?php
                      if($i == 0 || $i == 2 || $i == 5){
                        ?>

                        <?php
                      }
                      $i++;
                    }
                    ?>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm">
            <div class="card" style="width: 14rem;">
              <?php
              //echo $_SESSION['user'].".jpg";
              if(file_exists("images/" . $_SESSION['user'].".jpg")){
                ?>
                <img style="border-radius: 50%;" class="card-img-top" width="222" height="222" src="images/<?php echo $_SESSION['user'];?>.jpg" alt="<?php echo $_SESSION['user'];?>">
                <?php
              }else{
                ?>
                <form method="post" onsubmit="uploadProfilePic(event)" enctype="multipart/form-data">
                  <input style="display: none;" onchange="submitProfilePic()" type="file" id="profile-pic-input">
                  <button style="display: none;" type="submit" id="submit-profile-pic">submit</button>
                </form>
                <a style="cursor: pointer;" onclick="openFileBrowser()">
                  <img style="border-radius: 50%;" class="card-img-top" src="images/no_user.png" alt="No User" title="Click pentru a incarca imagine de profil">
                </a>
                <?php
              }
              ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo $_SESSION['user'];?></h5>
                <p class="card-text">some more info here</p>
                <form method="post">
                  <button type="submit" name="logout-btn" class="btn btn-danger">Logout</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm">

          </div>
        </div>
        <div class="row">
          <div class="col-sm">
            <div id="right-side-div">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="scripts/js/scripts.js"></script>
<script type="text/javascript">
function openFileBrowser(){
  $("#profile-pic-input").click();
}
function submitProfilePic(){
  $("#submit-profile-pic").submit();
}
function uploadProfilePic(e){
  e.preventDefault();
  var profilePic = new FormData();
  profilePic.append('file', $("#profile-pic-input")[0].files[0]);
  $.ajax({
    method: "POST",
    url: "scripts/php/uploadProfilePic.php",
    data: profilePic,
    processData: false,
    contentType: false,
    success: function(uploadProfilePicData, textStatus,jqXHR){
      if(uploadProfilePicData === "success"){
        window.location.reload();
      }else{
        console.log(uploadProfilePicData);
      }
    },
    error: function (errorData){
      console.log(errorData);
    }
  });
}
</script>
<?php
if(isset($_POST['logout-btn'])){
  session_destroy();
  $URL = "login.php";
  redirect($URL);
}
include 'footer.php';
/**
 * Created by PhpStorm.
 * User: raul.filimon
 * Date: 7/30/2018
 * Time: 7:42 AM
 */
?>
