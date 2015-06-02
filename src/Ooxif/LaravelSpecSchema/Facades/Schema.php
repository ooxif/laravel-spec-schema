<?php

namespace Ooxif\LaravelSpecSchema\Facades;

use Illuminate\Support\Facades\Schema as BaseFacade;
use Ooxif\LaravelSpecSchema\Builder;

class Schema extends BaseFacade
{
    /**
     * Get a schema builder instance for a connection.
     *
     * @param string $name
     * @return Builder
     */
    public static function connection($name)
    {
        return static::$app['schema']->createBuilder($name);
    }

    /**
     * Get the registered name of the component.
     *
     * @return Builder
     */
    protected static function getFacadeAccessor()
    {
        return static::$app['schema']->createBuilder();
    }
}