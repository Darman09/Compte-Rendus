<?php

class Offrir
{
    private $medDepotlegal;
    private $offrirQte;


    public function __construct($medDepotlegal, $offrirQte)
    {
        $this->medDepotlegal = $medDepotlegal;
        $this->offrirQte = $offrirQte;
    }

    public function getMedDepotlegal()
    {
        return $this->medDepotlegal;
    }

    public function getOffrirQte()
    {
        return $this->offrirQte;
    }

}