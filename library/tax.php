<?php

function tax($Percent,$Value){
    $tax = number_format((($Percent*$Value)/100));
    return $tax;
}