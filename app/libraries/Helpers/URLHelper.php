<?php namespace Helpers;

use Illuminate\Support\Facades\URL;

class URLHelper {

    /**
     * [addURLVars description]
     * @param array $vars
     * @return  string URL with vars
     */
    public static function addFullURLVars(array $vars = array())
    {
        $url = URL::current();
        if ( ! empty($vars))
        {
            $parsedURL = parse_url(URL::full());

            if (isset($parsedURL['query']))
                parse_str($parsedURL['query'], $currentVars);
            else
                $currentVars = array();
            
            $finalVars = array_merge($currentVars, $vars);

            if ( ! str_contains($url, '?'))
                $url = str_finish($url, '?');
            else
                $url = str_finish($url, '&');

            $url .= http_build_query($finalVars);
        }
    
        return $url;
    }

    public static function orderBy($orderby, $order)
    {
        return static::addFullURLVars(array('orderby' => $orderby, 'order' => ($order == 'asc' ? 'desc' : 'asc')));
    }

}