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

    /**
     * @param $moduleName string
     * @param $view
     * @param array $data
     * @throws \Exception
     */
    public function addModule($moduleName, $view, $data=[])
    {
        // Verify that the module does not already exist by id.
        if ( isset($this->modules[$moduleName]) && !empty($this->modules) ) {
            throw new \Exception('Module already exists.');
        }

        // Verify that the module view actually exists.
        if ( ! view()->exists($view) ) {
            throw new \Exception("Specified view does not exist: {$view}.");
        }

        // Create the view.
        $this->modules[$moduleName] = view($view, $data);
    }

    /**
     * Echos the knockout view models.
     */
    public function renderModules()
    {
        // Loop through the modules views, print them.
        foreach( $this->modules as $module ) {
            echo $module;
        }
    }
}