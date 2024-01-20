<?php

namespace App;


class Error
{
    private static $error;
    private static $errorArr;

    private function __construct()
    {
        if (isset($_SESSION['error'])) {
            self::$errorArr = $_SESSION['error'];
            unset($_SESSION['error']);
        }
    }

    public static function get()
    {
        return self::$error ?? self::$error = new self;
    }

    public static function set($arr)
    {
       return $_SESSION['error'] = $arr;
    }

    public static function show()
    {
        return self::$errorArr ?? false;
    }
}
