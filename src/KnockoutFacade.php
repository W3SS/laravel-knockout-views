<?php
namespace Zawntech\Laravel\KnockoutViews;

use Illuminate\Support\Facades\Facade;

class KnockoutFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return Knockout::class; }
}