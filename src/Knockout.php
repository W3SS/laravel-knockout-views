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
     * @var array Modules which should be loaded after the first set.
     */
    protected $secondaryModules = [];

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
     * @param $secondary bool Load to first or second channel.
     */
    public function endModule($secondary=false)
    {
        if ( ! $secondary ) {
            $this->modules[] = ob_get_clean();
        }
        else{
            $this->secondaryModules[] = ob_get_clean();
        }
    }

    /**
     * Renders the knockout javascript.
     */
    public function render()
    {
        // Print the knockout application.
        echo view('knockout::knockout-app', [
            'modules' => $this->modules,
            'secondary' => $this->secondaryModules
        ]);
    }

    /**
     * A convenience wrapper for setting an arbitrary value.
     * @param $key
     * @param $value
     */
    public function setValue($key, $value)
    {
        if ( is_string($value) ) {
            $value = '"' . $value . '"';
        }
        $this->startModule();
        echo "<script>";
        echo "App.{$key}($value)";
        echo "</script>";
        $this->endModule(true);
    }
}