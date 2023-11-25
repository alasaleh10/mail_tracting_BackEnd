<?php

function Encryption($requestname)
{
    return  htmlspecialchars(strip_tags($_POST[$requestname]));
}
function GetEncryption($requestname)
{
    return  htmlspecialchars(strip_tags($_GET[$requestname]));
}

function getAllData($table, $where = null, $values = null,$jeson=true)
{
    global $con;
  
    $data = array();
    if($where==null){
        $stmt = $con->prepare("SELECT  * FROM $table ");

    }
    else{
        $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");

    }
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($jeson==true){
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
        return $count;
    }
    else{
      if($count>0){
        return $data;

      }
      else{
        return json_encode(array("status" => "failure"));

      }

    }  
}
function getData($table, $where = null, $values = null,$json=true)
{
    global $con;
  
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($json==true){
        if ($count > 0) {
            echo json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }

    }
    
    
    return $count;
}
function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}


