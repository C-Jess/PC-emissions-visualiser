<?php
class Country
{
    public $CountryID;
    public $Country;

    public function __construct($id, $name)
    {
        $this->CountryID = $id;
        $this->Country = $name;
    }

    public function getId()
    {
        return $this->CountryID;
    }

    public function getCountry()
    {
        return $this->Country;
    }

    public function getYears()
    {
        $years = [];
        foreach ($this->CarbonIntensityByYear as $year) {
            $years[] = $year;
        }
        return $years;
    }

    public function getIntensity($year)
    {
        return $this->CarbonIntensityByYear[$year];
    }
}
