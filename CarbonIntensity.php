<?php
class CarbonIntensity
{
    public $CountryID;
    public $CarbonIntensity;

    public function __construct($id)
    {
        $this->CountryID = $id;
        $this->CarbonIntensity = array();
    }

    public function getId()
    {
        return $this->CountryID;
    }

    public function setIntensity($year, $intensity)
    {
        $this->CarbonIntensity[$year] = $intensity;
    }

    public function getYears()
    {
        $years = array();
        foreach ($this->CarbonIntensity as $year) {
            $years[] = $year;
        }
        return $years;
    }

    public function getIntensity($year)
    {
        return $this->CarbonIntensity[$year];
    }
}
