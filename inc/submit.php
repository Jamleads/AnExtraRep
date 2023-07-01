<?php
require_once('mysql.php');
session_start();

try {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // accept request 
        $r = $_POST;

        $path           = "/assets/uploads/";
        $target_dir     = $_SERVER['DOCUMENT_ROOT'].$path;
        $fileName       = basename($_FILES["heath_report"]["name"]);
        $target_file    = $target_dir . $fileName;

        // upload file
        move_uploaded_file($_FILES["heath_report"]["tmp_name"], $target_file);
        // store record into an array
        $data = [
            'name'          =>  $r['name'],
            'age'           =>  $r['age'],
            'weight'        =>  $r['weight'],
            'email_id'      =>  $r['email_id'],
            'health_report' =>  $path.$fileName ,
        ];

        if($msg  = create('users', $data)){
           //return $msg;
            $_SESSION['msg'] = "Record Submited sucessfully!";
            header("Location: ../index.php");
            exit();
        }
        header("Location: ../index.php");
        exit();
    }
    $_SESSION['msg'] = "Invalid request!";
    header("Location: ../index.php");
    exit();
} catch (\Throwable $th) {
    die($th->getMessage());
    $_SESSION['msg'] = $th->getMessage();
    header("Location: ../index.php");
    exit();
}