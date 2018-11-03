<?php
include 'conn.php';
function redirect($URL){
	echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
	echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
function error($errMSG){
	echo "<div class='form-group'>
        	<div class='alert alert-danger'>
    			<span class='glyphicon glyphicon-info-sign'></span>".$errMSG."
            </div>
          </div>";
}
function sessionTimeOut(){
	$logLength = 900;
	$ctime = strtotime("now");
	if(!isset($_SESSION['sessionX'])){
		$_SESSION['sessionX'] = $ctime;
		}else{
			if((strtotime("now") - $_SESSION['sessionX']) > $logLength){
				session_destroy();
				header("Location: login");
				exit;
			}else{
				$_SESSION['sessionX'] = $ctime;
			}
		}
}

function sendSMSLipsa($number1,$number2,$number3,$number4,$number5,$number6,$partNumber,$linie,$conn){
	$sqlSendSMS = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('Atentie! Lipsa material: ".$partNumber." Linia: ".$linie."','".$number1.";".$number2.";".$number3.";".$number4.";".$number5.";".$number6."');";
	/*$sqlSendSMS_1 = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('Atentie! Lipsa material: ".$partNumber." Linia: ".$linie."','".$number2."');";
	$sqlSendSMS_2 = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('Atentie! Lipsa material: ".$partNumber." Linia: ".$linie."','".$number3."');";
	$sqlSendSMS_3 = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('Atentie! Lipsa material: ".$partNumber." Linia: ".$linie."','".$number4."');";
	$sqlSendSMS_4 = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('Atentie! Lipsa material: ".$partNumber." Linia: ".$linie."','".$number5."');";
	$sqlSendSMS_5 = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('Atentie! Lipsa material: ".$partNumber." Linia: ".$linie."','".$number6."');";*/
				//echo $sqlSendSMS;
				if(mysqli_query($conn, $sqlSendSMS)){}else{echo "<br>".$sqlSendSMS; echo "error" . mysqli_error($conn); die; }
}
function sendSMSLipsaLater($number1,$number2,$number3,$number4,$partNumber,$linie,$conn,$abort){
	$sqlSendSMS = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('In linia ".$linie." a fost anulata comanda: ".$partNumber.".Motiv ".$abort."','".$number1.";".$number2.";".$number3.";".$number4."');";
	/*$sqlSendSMS_1 = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('Atentie! Lipsa material: ".$partNumber." Linia: ".$linie."','".$number2."');";
	$sqlSendSMS_2 = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('Atentie! Lipsa material: ".$partNumber." Linia: ".$linie."','".$number3."');";
	$sqlSendSMS_3 = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('Atentie! Lipsa material: ".$partNumber." Linia: ".$linie."','".$number4."');";
	$sqlSendSMS_4 = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('Atentie! Lipsa material: ".$partNumber." Linia: ".$linie."','".$number5."');";
	$sqlSendSMS_5 = "INSERT INTO `send_sms`(`msg`, `number`) VALUES ('Atentie! Lipsa material: ".$partNumber." Linia: ".$linie."','".$number6."');";*/
				//echo $sqlSendSMS;
				if(mysqli_query($conn, $sqlSendSMS)){}else{echo "<br>".$sqlSendSMS; echo "error" . mysqli_error($conn); die; }
}
function SqlTablet($result){
	while($row = $result -> fetch_assoc()){
	?>
		<form method="post">
		<tr>
			<th scope="row"><?php echo $row['tableta']; ?></th>
			<td><input type="text" class="form-control-sm" name="numberOne" value="<?php echo $row['number1'];?>" /></td>
			<td><input type="text" class="form-control-sm" name="numberTwo" value="<?php echo $row['number2'];?>" /></td>
			<td><input type="text" class="form-control-sm" name="numberThree" value="<?php echo $row['number3'];?>" /></td>
			<td><input type="text" class="form-control-sm" name="numberFour" value="<?php echo $row['number4'];?>" /></td>
			<td><input type="text" class="form-control-sm" name="numberFive" value="<?php echo $row['number5'];?>" /></td>
			<td><input type="text" class="form-control-sm" name="numberSix" value="<?php echo $row['number6'];?>" />
			<input type="hidden" name="schimbul" value="<?php echo $row['schimb'];?>" />
			<input type="hidden" name="ID" value="<?php echo $row['ID'];?>" /></td>
			<td><input class="btn btn-primary" type="submit" name="submit" /></td>
		</tr>
		</form>
	<?php
	}
}
function addRowToTablete($conn,$tabel){
	$sqlSelectTablet = "select `tableta` from `$tabel` order by `ID` desc limit 1";
	$resultSelectTablet = $conn -> query($sqlSelectTablet);
	$rowSelectTablet = $resultSelectTablet -> fetch_assoc();
	$tabletNumber = substr($rowSelectTablet['tableta'], -1);
	$tabletNumber = $tabletNumber + 1;
	$sqlAddRow = "INSERT INTO `$tabel`(`schimb`, `tableta`, `number1`, `number2`, `number3`, `number4`, `number5`, `number6`) 
	VALUES ('numere_schimbul_a','tableta ".$tabletNumber."','','','','','','')";
	if($conn -> query($sqlAddRow) === TRUE){$URL = $_SERVER['PHP_SELF']; redirect($URL);}else{echo $conn -> error;}
}
function GetLinii($tableta,$conn){
	$sql = "select * from `$tableta`";
	$result = $conn -> query($sql);
	while($row = $result -> fetch_assoc()){
		$linii = substr($row['linii'], 1,4);
	?>
		<tr>
			<form method="post">
			<td><?php echo $row['id'];?></td>
			<td>
				<input type="submit" name="delete-linie" class="btn btn-danger" value="Sterge" />
			</td>
				<td>
					
					<input type="text" name="linii" value="<?php echo $linii;?>" />
					<input type="hidden" name="id" value="<?php echo $row['id'];?>" />
					<input type="hidden" name="tableta" value="<?php echo $tableta;?>" />
				</td>
				<td><input type="submit" name="submit-linii" class="btn btn-primary"></td>
			</form>
		</tr>
	<?php
	}
}
function timeRound($minutes){
	if($minutes <= 15 && $minutes >= 00){
		$minutes = 00;
	}
	if($minutes > 15 && $minutes <= 30){
		$minutes = 30;
	}
	if($minutes > 30 && $minutes <= 45){
		$minutes = 30;
	}
	if($minutes > 45 && $minutes <= 59){
		$minutes = 45;
	}
	return $minutes;
}
function getTime($time){
	if($time >= "06:00" && $time <= "14:30"){
		$logoutTime = "14:30";	
	}
	if($time >= "14:30" && $time <= "23:00"){
		$logoutTime = "23:00";	
	}
	if($time >= "23:00" && $time <= "24:00"){
		$logoutTime = "06:00";	
	}
	if($time >= "00:00" && $time <= "06:00"){
		$logoutTime = "06:00";
	}
	return $logoutTime;
}
function prodErrors($msg,$errorTitle){
    ?>
    <!-- Modal -->
    <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        <h4><?php echo $msg;?></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#ModalCenter').modal('show');
    </script>
    <?php
}
?>