<?php

namespace Staskjs\LaravelFaye\Facades;

use Illuminate\Support\Facades\Facade;

class Faye extends Facade {
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'faye'; // the IoC binding.
    }
}

