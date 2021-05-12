<?php

namespace App\Models;

class SingletonStore extends Store
{
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }
}
