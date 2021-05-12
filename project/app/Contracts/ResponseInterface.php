<?php

namespace App\Contracts;

interface ResponseInterface {

    /**
     * @return mixed
     */
    public function make($type, $message);
    public function setType($type);
    public function setMessage($message);
}