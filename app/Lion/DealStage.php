<?php namespace Lion;

class DealStage extends BaseModel {

    public $table = 'deal_stage';

    public $timestamps = false;

    protected $fillable = [
        'name', 'probability'
    ];

    /**
     * Relationship with Deal's table
     */
    public function deals()
    {
        return $this->hasMany('Lion\Deal', 'stage_id');
    }

    public function setProbabilityAttribute($value)
    {
        if (($this->isWonOrLost()) || ( ! is_numeric($value)))
            return;

        if ($value > 99)
            $value = 99;
        elseif ($value < 1)
            $value = 1;

        $this->attributes['probability'] = $value;
    }

    /**
     * Returns if it's won or lost
     * 
     * @return boolean
     */
    public function isWonOrLost()
    {
        if (array_key_exists('probability', $this->attributes))
            return ($this->attributes['probability'] == 0 || $this->attributes['probability'] == 100) ? true : false;

        return false;
    }

    public function isWon()
    {
        return $this->attributes['probability'] == 100;
    }

    public function isLost()
    {
        return $this->attributes['probability'] == 0;
    }

}