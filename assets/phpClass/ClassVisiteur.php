<?php
require 'ClassSecteur.php';
require 'ClassLabo.php';


class Visiteur
{
    private $nom;
    private $prenom;
    private $ville;
    private $adresse;
    private $cp;
    private $dateEmbauche;

    private $secteur = null;
    private $labo = null;

    public function __construct($nom,$prenom,$ville,$adresse,$cp,$dateEmbauche)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->ville = $ville;
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->dateEmbauche = $dateEmbauche;
    }



    static function getAllVisiteurs()
    {
        $bdd = new BDD();
        $bdd->query('SELECT * FROM visiteur 
                       LEFT OUTER JOIN secteur ON visiteur.SEC_CODE = secteur.SEC_CODE
                       JOIN labo ON visiteur.LAB_CODE = labo.LAB_CODE WHERE VIS_MATRICULE != "zzz"');
        $row = $bdd->resultset();

        $visiteurs = [];
        foreach ($row as $value) {
            $visiteur = new Visiteur(
                $value['VIS_NOM'],
                $value['VIS_PRENOM'],
                $value['VIS_VILLE'],
                $value['VIS_ADRESSE'],
                $value['VIS_CP'],
                $value['VIS_DATEEMBAUCHE']);
            $visiteur->setSecteur($value['SEC_CODE'], $value['SEC_LIBELLE']);
            $visiteur->setLabo($value['LAB_CODE'],$value['LAB_NOM'],$value['LAB_CHEFVENTE']);
            $visiteurs[] = $visiteur;
        }
        return $visiteurs;
    }


    public function setSecteur($secCode,$secLibelle)
    {
        $this->secteur = new Secteur($secCode,$secLibelle);
    }

    public function getSecteur()
    {
        return $this->secteur;
    }

    public function setLabo($labCode,$labNom,$labChef)
    {
        $this->labo = new Labo($labCode,$labNom,$labChef);
    }

    public function getLabo()
    {
        return $this->labo;
    }



    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getCp()
    {
        return $this->cp;
    }

    public function getDateEmbauche()
    {
        $this->dateEmbauche = substr($this->dateEmbauche, 0, strpos($this->dateEmbauche, " "));
        return $this->dateEmbauche;
    }





}