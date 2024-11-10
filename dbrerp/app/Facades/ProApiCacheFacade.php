<?php

namespace App\Facades;

use App\Models\Cache\ProApiCache;
use Illuminate\Support\Facades\Facade;

class ProApiCacheFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ProApiCache::class;
    }
}
