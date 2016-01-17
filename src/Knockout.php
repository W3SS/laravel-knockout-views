<?php
namespace Zawntech\Laravel\KnockoutViews;

/**
 * Class Knockout
 * @package Zawntech\Laravel\KnockoutViews
 */
class Knockout
{

    /**
     * @var array A list of modules registered within the Knockout object.
     */
    protected $modules = [];

    /**
     * @return array
     */
    public function getModules()
    {
        return $this->modules;
    }
}