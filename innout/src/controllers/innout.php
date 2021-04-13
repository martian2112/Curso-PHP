<?php
session_start();
requirevalidsession();

loadmodel('WorkingHours');

$user = $_SESSION['user'];
$records = WorkingHours::loadfromuseranddate($user->id, date('Y-m-d'));

$currenttime = strftime('%hH:%M:%S', time());
$records->innout($currenttime);
header('Location: day_records.php');