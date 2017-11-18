<?php
use Carbon\Carbon;

function print_f($arr)
{
    echo "<pre>".print_r($arr, true)."</pre>";
}

/**
 * Returns current timestamp. If $string_date is set, it will return the date in 
 * letter format (i.e. Dec 5, 2017)
 * @param boolean @string_date - Set to true to return date in letter format.
 */
function _now($string_date = false)
{
    return $string_date ? Carbon::now('America/Chicago')->toFormattedDateString() : Carbon::now('America/Chicago');
}

function _tomorrow()
{
    return Carbon::tomorrow('America/Chicago')->toFormattedDateString();  
}