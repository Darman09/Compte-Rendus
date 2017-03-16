<?php
require 'ClassPraticien.php';
require 'ClassVisiteur.php';


class RapportVisite
{
    private $numeroRapport;
    private $dateRapport;
    private $bilanRapport;
    private $motifRapport;

    private $praticien = null;
    private $visiteur = null;


    public function __construct($numeroRapport, $dateRapport, $bilanRapport, $motifRapport)
    {
        $this->numeroRapport = $numeroRapport;
        $this->dateRapport = $dateRapport;
        $this->bilanRapport = $bilanRapport;
        $this->motifRapport = $motifRapport;
    }


    static function getAllRapports()
    {
        $bdd = new BDD();
        $bdd->query('SELECT * FROM rapport_visite
                       JOIN visiteur ON rapport_visite.VIS_MATRICULE = visiteur.VIS_MATRICULE
                       JOIN praticien ON rapport_visite.PRA_NUM = praticien.PRA_NUM
                       ORDER BY RAP_NUM');
        $row = $bdd->resultset();

        $rapports = [];
        foreach ($row as $value)
        {
            $rapport = new RapportVisite(
                $value['RAP_NUM'],
                $value['RAP_DATE'],
                $value['RAP_BILAN'],
                $value['RAP_MOTIF']);
            $rapport->setVisiteur(
                $value['VIS_NOM'],
                $value['VIS_PRENOM'],
                $value['VIS_VILLE'],
                $value['VIS_ADRESSE'],
                $value['VIS_CP'],
                $value['VIS_DATEEMBAUCHE']);
            $rapport->setPraticien(
                $value['PRA_NUM'],
                $value['PRA_NOM'],
                $value['PRA_PRENOM'],
                $value['PRA_ADRESSE'],
                $value['PRA_CP'],
                $value['PRA_VILLE'],
                $value['PRA_COEFNOTORIETE']);
            $rapports[] = $rapport;
        }
        return $rapports;
    }


    public function setPraticien($num, $nom, $prenom, $adresse, $cp, $ville, $coef)
    {
        $this->praticien = new Praticien($num, $nom, $prenom, $adresse, $cp, $ville, $coef);
    }

    public function getPraticien()
    {
        return $this->praticien;
    }

    public function setVisiteur($nom, $prenom, $ville, $adresse, $cp, $dateEmbauche)
    {
        $this->visiteur = new Visiteur($nom, $prenom, $ville, $adresse, $cp, $dateEmbauche);
    }

    public function getVisiteur()
    {
        return $this->visiteur;
    }






    public function getNumeroRapport()
    {
        return $this->numeroRapport;
    }

    public function setNumeroRapport($numeroRapport)
    {
        $this->numeroRapport = $numeroRapport;
    }

    public function getDateRapport()
    {
        return $this->dateRapport;
    }

    public function setDateRapport($dateRapport)
    {
        $this->dateRapport = $dateRapport;
    }


    public function getBilanRapport()
    {
        return $this->bilanRapport;
    }


    public function setBilanRapport($bilanRapport)
    {
        $this->bilanRapport = $bilanRapport;
    }

    public function getMotifRapport()
    {
        return $this->motifRapport;
    }

    public function setMotifRapport($motifRapport)
    {
        $this->motifRapport = $motifRapport;
    }


}