<?php

function requirevalidsession(){
    $user = $_SESSION['user'];
    if(!isset($user)){
        header('Location: login.php');
        exit();
    }
}