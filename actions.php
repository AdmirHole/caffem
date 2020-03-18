<?php

include "db.php";
session_start();

class DataOperation extends Database
{
public function insert_record($table,$fileds){
//"INSERT INTO table_name (, , ) VALUES ('username','password')";
$sql = "";
$sql .= "INSERT INTO ".$table;
$sql .= " (`".implode("`,`", array_keys($fileds))."`) VALUES ";
$sql .= "('".implode("','", array_values($fileds))."')";
//var_dump($sql);

try{
$query = $this->conn->prepare($sql);
$query->execute();
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}

return true;


}
public function fetch_record($table){
    $sql = "SELECT * FROM ".$table;
    $array = array();
    $query = $this->conn->prepare($sql);
    $query->execute();
    while($row = $query->fetchAll(PDO::FETCH_ASSOC)){
    $array[] = $row;
}

return $array;
}
public function select($table, $where){

    $sql = "";
    $condition = "";
    foreach ($where as $key => $value) {
    // password = 'hash' AND username = 'something'
    $condition .= $key . "='" . $value . "' AND ";
    }
    $condition = substr($condition, 0, -5);
    $sql .= "SELECT * FROM ".$table." WHERE ".$condition;
    $query = $this->conn->prepare($sql);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    
    return $row;
}

public function select_record(){
$sql = "SELECT item.name, utroseno, cijena_utro, total_smjene, date_format(time, '%e.%c.%Y %H:%i') time FROM monthlyreport 
JOIN item ON monthlyreport.id_item = item.id ORDER BY time ASC";

$array = array();
    $query = $this->conn->prepare($sql);
    $query->execute();
    while($row = $query->fetchAll(PDO::FETCH_ASSOC)){
    $array[] = $row;
    };
    return $array;
}
public function update_record($table,$where,$fields){
$sql = "";
$condition = "";
foreach ($where as $key => $value) {
// id = '5' AND username = 'something'
$condition .= $key . "='" . $value . "' AND ";
}
$condition = substr($condition, 0, -5);
foreach ($fields as $key => $value) {
//UPDATE table SET username = '' , password = '' WHERE id = '';
$sql .= $key . "='".$value."', ";
}
$sql = substr($sql, 0,-2);
$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
$query = $this->conn->prepare($sql);
if($query->execute()){
return true;
}
}

public function delete_record($table,$where){
$sql = "";
$condition = "";
foreach ($where as $key => $value) {
$condition .= $key . "='" . $value . "' AND ";
}
$condition = substr($condition, 0, -5);
$sql = "DELETE FROM ".$table." WHERE ".$condition;
$query = $this->conn->prepare($sql);
if($query->execute()){
return true;
}
}
}


$obj = new DataOperation;
//Insert Artikla
if (isset($_POST['insertart'])) {
    $myArray = array(
        "name" => $_POST["naziv"],
        "group" => $_POST["grupa"],
        "amount" => 0,
        "price" => (int)$_POST['cijena']
        );
        //var_dump($myArray);
        if($obj->insert_record("item",$myArray)){
        header("location:index.php?msg=Record Inserted");
      
        }
}

//Ulaz robe
if (isset($_POST['addkol'])) {
    $id = $_POST["addid"];
    $where = array("id"=>$id);
    $myArray = array(
    "amount" => $_POST["kolicina"]
    );
    if($obj->update_record("item",$where,$myArray)){
    header("location:index.php?msg=Record Updated Successfully");
    }
}

//Brisi artikal
if (isset($_GET["delart"])) {
    $id = $_GET["delart"];
    $where = array("id" => $id);
    if ($obj->delete_record("item",$where)) {
        header("location:index.php?msg=Record delete Successfully");
    }
}
//Updajte kolicine artikla sa stanja smjene 
if (isset($_POST["kol"])) {
    $id = $_POST["id"];
    $kolicina = $_POST["kol"];
    $where = array("id" => $id);
    $myArray = array("amount" => $kolicina);
    if ($obj->update_record("item", $where, $myArray)) {
        header("location:stanjeSmjene.php?msg=Record Updated Successfully");
    }
}
//Insert za report 
if (isset($_POST['id_item'])) {
    $myArray = array(
        "id_item" => (int)$_POST["id_item"],
        "utroseno" => (int)$_POST["utroseno"],
        "cijena_utro" => (int)$_POST["cijena_utro"],
        "total_smjene" => (int)$_POST['total_smjene']
        );
        //var_dump($myArray);
        if($obj->insert_record("monthlyReport",$myArray)){
        header("location:stanjeSmjene.php?msg=Record Inserted");
      
        }
}

//Update artikla
if (isset($_POST["updateart"])) {
    $id = (int)$_POST["id"];
    $where = array("id"=>$id);
    $myArray = array(
        "name" => $_POST["naziv"],
        "group" => $_POST["grupa"], 
        "price" => (int)$_POST["cijena"] 
    );
if($obj->update_record("item",$where,$myArray)){
header("location:index.php?msg=Record Updated Successfully");
}
}