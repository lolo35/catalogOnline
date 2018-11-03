<?php
include 'header.php';
$sqlOre = "select `materie` from `ore`";
$resOre = $conn -> query($sqlOre);
?>
<script type="text/javascript" src="scripts/js/scripts.js"></script>
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
            <div id="left-side-div">

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm">
            <div class="list-group">
              <?php
              while($row = $resOre -> fetch_assoc()){
                ?>
                <a href="#" class="list-group-item list-group-item-action" id="left-nav-<?php echo $row['materie'];?>" onclick="makeActive(this.id)"><?php echo $row['materie'];?></a>
                <?php
              }
              ?>

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
            <div id="main-content-div">

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="container-fluid">
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

<?php
include 'footer.php';
/**
 * Created by PhpStorm.
 * User: raul.filimon
 * Date: 7/30/2018
 * Time: 7:42 AM
 */
?>
