<?php namespace Helpers;

use Illuminate\Filesystem\Filesystem;
use Basset\Facade as Basset;

class LoadAssets {

    public static $collections = array();

    /**
     * [addApplicationCollection description]
     * @param [type] $collection [description]
     */
    public static function addApplicationCollection($collection)
    {
        static::$collections = array_add(static::$collections, $collection, $collection);
    }

    /**
     * [addToControllerCollection description]
     * @param [type] $asset      [description]
     * @param string $collection [description]
     */
    public static function addToControllerCollection($asset, $collection = 'controller')
    {
        Basset::collection($collection, function($col) use ($asset)
        {
            $col->add('assets/' . $asset);
        });

        static::addApplicationCollection($collection);
    }

}