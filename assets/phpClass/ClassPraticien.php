<?php
require 'ClassTypePraticien.php';

class Praticien
{
    private $num;
    private $nom;
    private $prenom;
    private $adresse;
    private $cp;
    private $ville;
    private $coef;

    private $typePraticien = null;

    public function __construct($num, $nom, $prenom, $adresse, $cp, $ville, $coef)
    {
        $this->num = $num;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->coef = $coef;
    }


    static function getAllPraticiens()
    {
        $bdd = new BDD();
        $bdd->query('SELECT * FROM praticien 
                    INNER JOIN type_praticien ON praticien.TYP_CODE = type_praticien.TYP_CODE');
        $row = $bdd->resultset();

        $praticiens = [];
        foreach ($row as $value)
        {
            $praticien = new Praticien(
                $value['PRA_NUM'],
                $value['PRA_NOM'],
                $value['PRA_PRENOM'],
                $value['PRA_ADRESSE'],
                $value['PRA_CP'],
                $value['PRA_VILLE'],
                $value['PRA_COEFNOTORIETE']);
            $praticien->setTypePraticien($value['TYP_CODE'], $value['TYP_LIBELLE'], $value['TYP_LIEU']);
            $praticiens[] = $praticien;
        }
        return $praticiens;
    }


    static function creerPraticien($nom, $prenom, $adresse, $cp, $ville, $coef, $typeCode)
    {
        $bdd = new BDD();
        $nouveauPraticien = $bdd->query('INSERT INTO praticien(PRA_NOM,PRA_PRENOM,PRA_ADRESSE,PRA_CP,PRA_VILLE,PRA_COEFNOTORIETE,TYP_CODE)
        VALUE (:nom,:prenom,:adresse,:cp,:ville,:coef,:typeCode)');
        $bdd->bind(':nom', $nom);
        $bdd->bind(':prenom', $prenom);
        $bdd->bind(':adresse', $adresse);
        $bdd->bind(':cp', $cp);
        $bdd->bind(':ville', $ville);
        $bdd->bind(':coef', $coef);
        $bdd->bind(':typeCode', $typeCode);
        $nouveauPraticien->execute();
        return $bdd->lastInsertId();
    }


    public function setTypePraticien($typeCode, $typeLibelle, $typeLieu)
    {
        $this->typePraticien = new TypePraticien($typeCode, $typeLibelle, $typeLieu);
    }

    public function getTypePraticien()
    {
        return $this->typePraticien;
    }


    public function getNum()
    {
        return $this->num;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getCp()
    {
        return $this->cp;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function getCoef()
    {
        return $this->coef;
    }


}