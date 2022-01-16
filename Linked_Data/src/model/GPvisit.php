<?php

class GPvisit
{
    private $Age_group;
    private $Female;
    private $Male;
    private $Total;

    public function __construct($Age_group, $Female, $Male, $Total)
    {
        $this->Age_group = $Age_group;
        $this->Female = $Female;
        $this->Male = $Male;
        $this->Total = $Total;
    }

    public function getAgeGroup()
    {
        return $this->Age_group;
    }

    public function getFemale()
    {
        return $this->Female;
    }

    public function getMale()
    {
        return $this->Male;
    }

    public function getTotal()
    {
        return $this->Total;
    }

}