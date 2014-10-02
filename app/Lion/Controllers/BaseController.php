<?php namespace Lion\Controllers;

use Helpers\LoadAssets;

class BaseController extends \Controller {

    /**
     * Contains an array of the collections to be loaded in every method.
     * 'method' => array('collections', ...)
     * 
     * @var array
     */
    protected $collections = array();

    /**
     * Contains an array of the assets to be loaded in every method.
     * 'method' => array('assets', ...)
     * 
     * @var array
     */
    protected $assets = array();

    /**
     * If the request's not an AJAX one, It'll load the assets set in the
     * $assets property and also the collections in the $collections property.
     */
    public function __construct()
    {
        if ( ! \Request::ajax())
            $this->loadControllerAssets();
    }

    /**
     * Load the controller assets dependences. It calls to load the collections
     * for the method and also the custom files.
     * 
     * @return void
     */
    protected function loadControllerAssets()
    {
        $action = $this->getAction();

        $this->loadCollections($action);
        $this->loadAssets($action);
    }

    /**
     * Returns the controller method to be executed
     * 
     * @return string
     */
    protected function getAction()
    {
        $action = \Route::currentRouteAction();
        $split  = explode('@', $action);
        return $split[1];
    }

    /**
     * Load the basic collections to be used to the current action.
     * 
     * @param  string $action Action name
     * @return void
     */
    protected function loadCollections($action)
    {
        $toLoad = isset($this->collections[$action]) ? $this->collections[$action] : array();

        foreach ($toLoad as $collection)
            LoadAssets::addApplicationCollection($collection);
    }

    /**
     * This method load the assets
     * @param  string $action Action name
     * @return void
     */
    protected function loadAssets($action)
    {
        $toLoad = isset($this->assets[$action]) ? $this->assets[$action] : array();

        foreach ($toLoad as $asset)
            LoadAssets::addToControllerCollection($asset);
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    // protected function setupLayout()
    // {
    //  if ( ! is_null($this->layout))
    //  {
    //      $this->layout = View::make($this->layout);
    //  }
    // }

}