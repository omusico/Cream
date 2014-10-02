<?php namespace Helpers;

class DateHelper extends \DateTime {

    /**
     * Format to retrieve the date
     * 
     * @var string
     */
    public $format = 'Y-m-d H:i:s';

    /**
     * By now just constructs a parent object
     */
    public function __construct($time = 'now', \DateTimeZone $timezone = null)
    {
        parent::__construct($time, $timezone);
    }

    /**
     * Returns the date as a string based on the format set in $this->format
     * 
     * @return string
     */
    public function toString()
    {
        return $this->format($this->format);
    }

}