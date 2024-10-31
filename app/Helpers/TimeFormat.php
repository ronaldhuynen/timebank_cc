<?php


/**
 * Format the given number of minutes into a time format string.
 * Minutes are used in the database to record currency.
 *
 * @param int $minutes The number of minutes to format.
 * @return string The formatted time string.
 */

function tbFormat($minutes)
{
    $isNegative = $minutes < 0;
    $minutes = abs($minutes);

    $wholeHours = intdiv($minutes, 60);
    $restMinutes = sprintf("%02d", $minutes % 60);

    $formattedTime = __('H') . ' ' . ($isNegative ? '-' : '') . $wholeHours . ':' . $restMinutes;

    return $formattedTime;
}




/**
 * Converts a time string in the format "HHH:MM" to minutes.
 *
 * @param string $hhh_mm The time string to convert.
 * @return int The time in minutes.
 */

function dbFormat($hhh_mm)
{
    list($wholeHours, $restMinutes) = explode(':', $hhh_mm);

    // Check if the wholeHours part is negative
    $isNegative = $wholeHours < 0;
    // Convert the values to absolute for calculation
    $wholeHours = abs($wholeHours);
    $restMinutes = abs($restMinutes);
    // Calculate the total minutes
    $minutes = ($wholeHours * 60) + $restMinutes;
    // Adjust the sign if the original value was negative
    return $isNegative ? -$minutes : $minutes;
}


function hoursAndMinutes($time, $format = '%02d:%02d')
// Usage: echo hoursAndMinutes('188', '%02d Hours, %02d Minutes');
// this will output 3 Hours, 8 Minutes
// hoursAndMinutes('188', '%02dH,%02dM');
// will output 3H,8M
{
  if ($time < 1) {
    return;
  }
  $hours = floor($time / 60);
  $minutes = ($time % 60);
  return sprintf($format, $hours, $minutes);
}