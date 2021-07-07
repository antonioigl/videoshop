<?php


namespace videoShop\Movie\Domain;


use Exception;
use Throwable;

class MovieNotFound extends Exception
{
    public function __construct()
    {
        parent::__construct('Movie not found', 404);
    }

}