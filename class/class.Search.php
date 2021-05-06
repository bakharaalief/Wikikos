<?php
class Search
{
    private $keywords;
    
    public function __construct($keywords)
    {
        $this->keywords = $keywords;
    }

    //automatic create get
    public function __get($atribute)
    {
        if (property_exists($this, $atribute)) {
            return $this->$atribute;
        }
    }
}
