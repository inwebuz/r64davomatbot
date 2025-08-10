<?php

namespace App\Helpers;

class Helper
{
    public static function formatPhone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        return $phone;
    }

    public static function removeHttp($url)
    {
        $url = preg_replace('/^https?:\/\//', '', $url);
        return $url;
    }

    public static function formatDatetime($datetime)
    {
        return $datetime->format('d.m.Y H:i');
    }

    public static function convertHoursToHoursMinutes($hours): array
    {
        $res = [];
        $res[0] = floor($hours);
        $res[1] = round(($hours - $res[0]) * 60);
        return $res;
    }

    public static function formatHoursMinutes($hours): string
    {
        $hoursMinutes = self::convertHoursToHoursMinutes($hours);
        return $hoursMinutes[0] . ' ' . __('hours') . ' ' . $hoursMinutes[1] . ' ' . __('minutes');
    }
}
