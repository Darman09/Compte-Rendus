<?php
require 'ClassPraticien.php';
require 'ClassVisiteur.php';
require 'ClassOffrir.php';
require 'ClassPresenter.php';


class RapportVisite
{
    private $numeroRapport;
    private $dateRapport;
    private $bilanRapport;
    private $motifRapport;

    private $praticien = null;
    private $visiteur = null;
    private $offrir = [];
    private $presenter = [];

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
        $bdd->query('SELECT DISTINCT RAP.*, OFF.MED_DEPOTLEGAL, OFF.OFF_QTE, PRE.MED_DEPOTLEGAL, PRE.DOCUMENTATION, VIS.*, PRA.*
                      FROM rapport_visite RAP
                      JOIN visiteur VIS ON (RAP.VIS_MATRICULE = VIS.VIS_MATRICULE)
                      JOIN praticien PRA ON (RAP.PRA_NUM = PRA.PRA_NUM)
                      LEFT JOIN offrir OFF ON (RAP.RAP_NUM = OFF.RAP_NUM)
                      LEFT JOIN presenter PRE ON (RAP.RAP_NUM = PRE.RAP_NUM)
                       ');
        $row = $bdd->resultset();

        $rapports = [];
        foreach ($row as $value)
        {
            $RapportExiste = false;

            foreach ($rapports as $listeRapport)
            {
                if ($listeRapport->getNumeroRapport() === $value['RAP_NUM'])
                {
                    $RapportExiste = true;
                    if ($value['MED_DEPOTLEGAL'] !== null && $value['OFF_QTE'] !== null)
                    {
                        $listeRapport->setOffrir(
                            $value['MED_DEPOTLEGAL'],
                            $value['OFF_QTE']
                        );
                    }

                    if ($value['MED_DEPOTLEGAL'] !== null && $value['DOCUMENTATION'] !== null)
                    {
                        $listeRapport->setPresenter(
                            $value['MED_DEPOTLEGAL'],
                            $value['DOCUMENTATION']
                        );
                    }

                    break;
                }
            }

            if (!$RapportExiste)
            {
                $rapport = new RapportVisite(
                    $value['RAP_NUM'],
                    $value['RAP_DATE'],
                    $value['RAP_BILAN'],
                    $value['RAP_MOTIF']
                );

                $rapport->setVisiteur(
                    $value['VIS_MATRICULE'],
                    $value['VIS_NOM'],
                    $value['VIS_PRENOM'],
                    $value['VIS_VILLE'],
                    $value['VIS_ADRESSE'],
                    $value['VIS_CP'],
                    $value['VIS_DATEEMBAUCHE']
                );

                $rapport->setPraticien(
                    $value['PRA_NUM'],
                    $value['PRA_NOM'],
                    $value['PRA_PRENOM'],
                    $value['PRA_ADRESSE'],
                    $value['PRA_CP'],
                    $value['PRA_VILLE'],
                    $value['PRA_COEFNOTORIETE']
                );

                if ($value['MED_DEPOTLEGAL'] !== null && $value['OFF_QTE'] !== null)
                {
                    $rapport->setOffrir(
                        $value['MED_DEPOTLEGAL'],
                        $value['OFF_QTE']
                    );
                }

                if ($value['MED_DEPOTLEGAL'] !== null && $value['DOCUMENTATION'] !== null)
                {
                    $rapport->setPresenter(
                        $value['MED_DEPOTLEGAL'],
                        $value['DOCUMENTATION']
                    );
                }
                $rapports[] = $rapport;
            }
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

    public function setVisiteur($matricule, $nom, $prenom, $ville, $adresse, $cp, $dateEmbauche)
    {
        $this->visiteur = new Visiteur($matricule, $nom, $prenom, $ville, $adresse, $cp, $dateEmbauche);
    }

    public function getVisiteur()
    {
        return $this->visiteur;
    }

    public function setOffrir($medDepotlegal, $offrirQte)
    {
        $this->offrir[] = new Offrir($medDepotlegal, $offrirQte);
    }

    public function getOffrir()
    {
        return $this->offrir;
    }

    public function setPresenter($medDepotlegal, $documentation)
    {
        $this->presenter[] = new Presenter($medDepotlegal, $documentation);
    }

    public function getPresenter()
    {
        return $this->presenter;
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