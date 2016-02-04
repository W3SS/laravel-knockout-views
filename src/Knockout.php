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
     * Add a module via a view.
     * @param $view
     * @param array $data
     * @throws \Exception
     */
    public function addModuleView($view, $data=[])
    {
        // Verify that the module view actually exists.
        if ( ! view()->exists($view) ) {
            throw new \Exception("Specified view does not exist: {$view}.");
        }

        // Create the view.
        $this->modules[] = view($view, $data);
    }

    /**
     * Begins buffering output.
     */
    public function startModule()
    {
        ob_start();
    }

    /**
     * Dumps the output buffer to a module item.
     */
    public function endModule()
    {
        $this->modules[] = ob_get_clean();
    }

    /**
     * Renders the knockout javascript.
     */
    public function render()
    {
        // Print the knockout application.
        echo view('knockout::knockout-app', ['modules' => $this->modules]);
    }

    /**
     * A convenience wrapper for setting an arbitrary value.
     * @param $key
     * @param $value
     */
    public function setValue($key, $value)
    {
        $this->startModule();
        echo "<script>";
        echo "App.{$key}($value)";
        echo "</script>";
        $this->endModule();
    }
}