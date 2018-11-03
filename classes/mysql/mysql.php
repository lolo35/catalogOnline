<?php
require_once 'config.php';
class mysqlClass{

    public function dbConnect($servername,$username,$password,$dbname,$message){
        $conn = new mysqli($servername,$username,$password,$dbname);
        if($conn -> connect_error){
            die("Connection error: ". $conn -> connect_error);
        }else{
            if($message != 0) {
                echo "connection successfull<br>";
            }
        }
        return $conn;
    }
    public function insert($tableName,$cols,$values,$credentials,$message){
        $cols = implode(",",$cols);
        $values = implode("','",$values);
        $sql = "insert into `$tableName` ($cols) VALUES ('$values')";
        //echo $sql;
        $conn = $this->dbConnect($credentials['serverName'],$credentials['username'],$credentials['password'],$credentials['dbname'],$message);
        if($conn -> query($sql) === TRUE){
            if($message != 0) {
                echo "inserted";
            }
        }else{
            echo $conn -> error;
        }
        mysqli_close($conn);
    }
    public function insertIgnore($tableName,$cols,$values,$credentials,$message){
        $cols = implode(",",$cols);
        $values = implode(",",$values);
        $sql = "insert ignore into `$tableName` ($cols) VALUES ($values)";
        $conn = $this->dbConnect($credentials['serverName'],$credentials['username'],$credentials['password'],$credentials['dbname'],$message);
        if($conn -> query($sql) === TRUE){
            if($message != 0) {
                echo "inserted";
            }
        }else{
            echo $conn -> error;
        }
        mysqli_close($conn);
    }
    public function update($tableName,$data,$criteria,$credentials,$message){
        $string = "";
        $i = 1;
        foreach ($data as $key => $value){
            if($i < count($data)){
                $string .= $key ." = " . $value.",";
            }else{
                $string .= $key ." = " . $value;
            }
            $i++;
        }
        $criteriaString = "";
        $y = 1;
        foreach ($criteria as $key => $value){
            if($y < count($criteria)){
                $criteriaString .= $key . " = " . $value. " and ";
            }else{
                $criteriaString .= $key . " = " . $value;
            }
            $y++;
        }
        $conn = $this->dbConnect($credentials['serverName'],$credentials['username'],$credentials['password'],$credentials['dbname'],$message);
        mysqli_query($conn,"update `$tableName` set $string where $criteriaString");
        if($message != 0){
            echo "updated " . mysqli_affected_rows($conn);
        }
        mysqli_close($conn);
    }
    public function select($tablename,$headers,$data,$credentials,$message){
        $headers = implode(',', $headers);
        $string = "";
        $i = 1;
        foreach ($data as $key => $value){
            if($i < count($data)){
                $string .= $key ." = '" . $value ."' and ";
            }else{
                $string .= $key ." = '" . $value . "'";
            }
            $i++;
        }
        $sql = "select $headers from `$tablename` where $string";
        //echo $sql;
        $conn = $this->dbConnect($credentials['serverName'],$credentials['username'],$credentials['password'],$credentials['dbname'],$message);
        $result = $conn -> query($sql);
        $returnData = array();
        while($row = $result -> fetch_assoc()){
            $returnData[ $row['id'] ] = $row;
        }
        mysqli_close($conn);
        return $returnData;
    }
}

//$test = new mysqlClass;
/* use this for inserts... */
/*$cols = array(
    "firstCol" => "`id`",
    "secondCol" => "`eticheta`",
    "thirdCol" => "`test1`",
    "fourthCol" => "`test2`"
);
$values = array(
    "id" => "'10'",
    "eticheta" => "'123456798'",
    "test1" => "'bla'",
    "test2" => "'bla2'"
);
/* use this for updates in a db... */
/*$data = array(
    "`id`" => "'1'",
    "`eticheta`" => "'123456789012'"
);
$criteria = array(
    "`id`" => "'1'",
    "`eticheta`" => "'1234567890'"
);
*/
/*use this for selects*/
$headers = array('*');
$data = array(
    'eticheta' => '123456789012',
    'test1' => 'bl');

//print_r( $test->select("test",$headers,$data,$credentials,0));
?>