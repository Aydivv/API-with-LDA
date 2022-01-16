<?php

class LifeExpectancy{
    private $Ward_Code;
    private $Wards;
    private $LE;
    private $LCL;
    private $UCL;

    public function __construct($Ward_Code, $Wards, $LE, $LCL, $UCL)
    {
        $this->Ward_Code = $Ward_Code;
        $this->Wards = $Wards;
        $this->LE = $LE;
        $this->LCL = $LCL;
        $this->UCL = $UCL;
    }

    public function getWardCode()
    {
        return $this->Ward_Code;
    }

    public function getWards()
    {
        return $this->Wards;
    }

    public function getLE()
    {
        return $this->LE;
    }

    public function getLCL()
    {
        return $this->LCL;
    }

    public function getUCL()
    {
        return $this->UCL;
    }
}
