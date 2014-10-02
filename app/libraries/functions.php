<?php

    if ( ! function_exists('preg_grep_keys'))
    {
        /**
        * This function gets does the same as preg_grep but applies the regex
        * to the array keys instead to the array values as this last does.
        * Returns an array containing only the keys that match the exp.
        * 
        * @author Daniel Klein
        * 
        * @param  string  $pattern
        * @param  array  $input
        * @param  integer $flags
        * @return array
        */
        function preg_grep_keys($pattern, array $input, $flags = 0) {
            return array_intersect_key($input, array_flip(preg_grep($pattern, array_keys($input), $flags)));
        }
    }