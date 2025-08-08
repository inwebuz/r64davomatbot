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
}
