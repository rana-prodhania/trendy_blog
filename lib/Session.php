<?php

class Session
{
    public static function init()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value)
    {
        self::init();
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        self::init();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function loginCheck()
    {
        self::init();
        if (self::get('login') == true) {
            header('Location: index.php');
            exit;
        }
    }

    public static function check()
    {
        self::init();
        if (self::get('login') == false) {
            self::destroy();
            header('Location: login.php');
            exit;
        }
    }

    public static function destroy()
    {
        self::init();
        session_destroy();
        header('Location: login.php');
        exit;
    }
}
