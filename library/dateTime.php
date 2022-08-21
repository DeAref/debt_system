<?php

function nextMonth($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' + 1 months'));
    return $newDate;
}

function preMonth($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' - 1 months'));
    return $newDate;
}

function nextDay($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' + 1 day'));
    return $newDate;
}

function preDay($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' - 1 day'));
    return $newDate;
}

function nextYear($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' + 1 year'));
    return $newDate;
}

function preYear($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' - 1 year'));
    return $newDate;
}

function next40Day($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' + 40 day'));
    return $newDate;
}

function pre40Day($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' - 40 day'));
    return $newDate;
}

function next6Month($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' + 6 month'));
    return $newDate;
}

function pre6Month($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' - 6 month'));
    return $newDate;
}

function customNextMonth($date,$count){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. " + $count month"));
    return $newDate;
}

function customPreMonth($date,$count){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. " - $count month"));
    return $newDate;
}

//Finding the number of days between two dates
/********************************************/
function differenceDate($now,$yourDate){
    $earlier = new DateTime("$now");
    $later = new DateTime("$yourDate");

    $pos_diff = $earlier->diff($later)->format("%r%a"); //3
    return $pos_diff;
}

//week day 
/********************************/
function pre2Day($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' - 2 day'));
    return $newDate;
}
function pre3Day($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' - 3 day'));
    return $newDate;
}
function pre4Day($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' - 4 day'));
    return $newDate;
}
function pre5Day($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' - 5 day'));
    return $newDate;
}
function pre6Day($date){
    $date = date('y-m-d', strtotime($date));
    $newDate = date('Y-m-d', strtotime($date. ' - 6 day'));
    return $newDate;
}
