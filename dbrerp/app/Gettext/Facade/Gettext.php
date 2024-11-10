<?php


namespace App\Gettext\Facade;


use Illuminate\Support\Facades\Facade;

class Gettext extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'gettext';
    }
}
