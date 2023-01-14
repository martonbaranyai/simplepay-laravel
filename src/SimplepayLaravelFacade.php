<?php

declare(strict_types=1);

namespace Casterke\SimplepayLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Casterke\SimplepayLaravel\Skeleton\SkeletonClass
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
