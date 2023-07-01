<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "anex_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//$conn = mysqli_connect($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("DB Connection failed: " . $conn->connect_error);
}


function create(string $table, array $data)
{
    global $conn;
    //Make sure the array isn't empty
    if (empty($data)) {
        return false;
    }
    $variables = $data;
    $sql = "INSERT INTO {$table}";
    $fields = array();
    $values = array();
    foreach ($variables as $field => $value) {
        $fields[] = $field;
        if ($value === null) {
            $values[] = "NULL";
        } else {
            $values[] = "'{$value}'";
        }
    }
    $fields = " (`" . implode("`, `", $fields) . "`)";
    $values = "(" . implode(", ", $values) . ")";
    $sql .= $fields . " VALUES {$values};";
    $query = $conn->query($sql);
    if($query){
        return $query;
    }
    return  $conn->error; 
}

function search(string $table, array $where, $limit = null)
{
    global $conn;
    if (empty($where)) {
        return false;
    }
    $sql = "SELECT * FROM `{$table}`";
    //Add the $where clauses as needed
    if (!empty($where)) {
        foreach ($where as $field => $value) {
            $clause[] = "`{$field}` = '{$value}'";
        }
        $sql .= ' WHERE ' . implode(' AND ', $clause);
    }
    if ($limit !== null) {
        $sql .= " LIMIT {$limit}";
    }
    if ($result  = $conn->query($sql)) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            var_dump($row);
            return $row;
        } else {
            return false;
        }
    } else {
        return  $conn->error;
    }
    return $sql;
}

