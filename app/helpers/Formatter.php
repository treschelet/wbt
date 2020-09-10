<?php


namespace app\helpers;


class Formatter
{
    /**
     * Format as duration closure
     *
     * @return string
     */
    public static function asDuration()
    {
        return static function($value, $formatter) {
            if ($value === null) {
                return $formatter->nullDisplay;
            }

            $hours = intdiv($value, 3600);
            $minutes = intdiv($value % 3600, 60);
            $seconds = $value % 60;

            if ($hours > 0) {
                return sprintf("%d:%02d:%02d", $hours, $minutes, $seconds);
            }

            return sprintf("%02d:%02d", $minutes, $seconds);
        };
    }
}