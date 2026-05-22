<?php

namespace Core;

class Bootstrap
{
    public static function init()
    {
        self::startSession();
        self::setTimezone();
        self::loadEnv();
    }

    private static function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private static function setTimezone()
    {
        date_default_timezone_set("America/Panama");
    }

    private static function loadEnv()
    {
        // aquí luego puedes cargar variables .env
    }
}
