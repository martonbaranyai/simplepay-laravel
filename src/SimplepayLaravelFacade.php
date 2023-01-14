<?php

namespace Casterke\SimplePayLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Casterke\SimplePayLaravel\Skeleton\SkeletonClass
 */
class SimplepayLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'simplepay-laravel';
    }
}
