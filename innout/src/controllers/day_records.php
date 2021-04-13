<?php
session_start();
requirevalidsession();

loadmodel('WorkingHours');

$date = (new DateTime())->getTimestamp();
$today = strftime('%d de %B de %Y', $date);

$user = $_SESSION['user'];
$userworkinghours = WorkingHours::loadfromuseranddate($user->id, date('Y-m-d'));

loadtemplateview('day_records', [
    'today' => $today,
    'records' => $records
    ]);
