<?php
include 'header.php';
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
      </div>
    </div>
    <div class="col-sm-8">
      <div class="container-fluid">
				<div class="row">
					<div class="col-sm">
						<?php
						date_default_timezone_set('EET');
						$date = date('Y F');
						//echo $date;
						?>
						<h3 class="text-center">Pontaj AMG 3 <?php echo $date;?></h3>
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
