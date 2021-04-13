<?php

function getdateasdatetime($date){
    return is_string($date) ? new DateTime($date) : $date;
}

function isweekend($date){
    $inputdate = getdateasdatetime($date);
    return $inputdate->format('N') >= 6;
}

function isbefore($date1, $date2){
    $inputdate1 = getdateasdatetime($date1);
    $inputdate2 = getdateasdatetime($date2);
    return $inputdate1 <= $inputdate2;
}

function getnextday($date){
    $inputdate = getdateasdatetime($date);
    $inputdate->modify('+1 day');
    return $inputdate;
}