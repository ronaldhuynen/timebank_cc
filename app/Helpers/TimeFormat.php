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
    $wholeHours = intdiv($minutes, 60);
    $restMinutes = sprintf("%02d", abs($minutes % 60));
    return __('H') . ' ' . $wholeHours . ':' . $restMinutes;
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
  $hours = ($wholeHours == null) ? 0 : $wholeHours;
  $minutes = ($hours * 60) + $restMinutes;
  return $minutes;
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