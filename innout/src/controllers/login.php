<?php
loadmodel('login');
session_start();
$exception = null;

if(count($_POST) > 0){
    $login = new Login($_POST);
    try{
        $user = $login->checklogin();
        $_SESSION['user'] = $user;
        header("Location: day_records.php");
    }catch(AppException $e){
        $exception = $e;
    }
}

loadview('login', $_POST + ['exception' => $exception]);