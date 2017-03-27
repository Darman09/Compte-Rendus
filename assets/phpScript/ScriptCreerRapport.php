<?php
require 'ScriptBDD.php';
require '../phpClass/ClassPraticien.php';

echo "<pre>";
print_r($_POST);
echo "</pre>";

$rapportDate      = $_POST['rapportDate'];
$rapportPraticien = $_POST['rapportPraticien'];
$rapportBilan     = $_POST['rapportBilan'];
$compteElem       = $_POST['compteElem'];
$compteEchant     = $_POST['compteEchant'];
if(array_key_exists('rapportIsRemplace',$_POST) && $_POST['rapportIsRemplace'] === 'on')
{
    $remplacantNom     = $_POST['remplacantNom'];
    $remplacantPrenom  = $_POST['remplacantPrenom'];
    $remplacantAdresse = $_POST['remplacantAdresse'];
    $remplacantVille   = $_POST['remplacantVille'];
    $remplacantCP      = $_POST['remplacantCP'];
    $remplacantCoef    = $_POST['remplacantCoef'];
    $remplacantTypePra = $_POST['remplacantTypePra'];
# /!\
    $praticienEstRemplace = true;
# /!\
}
$rapportMotif = $_POST['rapportMotif'];
switch ($rapportMotif)
{
    case '1':$rapportMotif = 'Périodicité';
    break;
    case '2':$rapportMotif = 'Actualisation';
    break;
    case '3':$rapportMotif = 'Relance';
    break;
    case '4':$rapportMotif = 'Solicitation Praticien';
    break;
    case '5':$rapportMotif = 'Autre';
}
if($rapportMotif === 'Autre')
{
    $rapportMotif = $_POST['autreMotif'];
}

#récupération des lignes des éléments présentés :
$ElementsPresentes = [];
for($i=$compteElem; $i>=0;$i--)
{
    $ElementsPresentes['Elem'.$i] =
        [
            'MED_DEPOTLEGAL'          =>$_POST['selectElem'.$i],
            'DOCUMENTATION'       =>$_POST['documentation'.$i]
        ];
}
#récupération des lignes des échantillons offerts :
$EchantillonsOfferts = [];
for($i=$compteEchant;$i>=0;$i--)
{
    $EchantillonsOfferts['Echant'.$i] =
        [
            'MED_DEPOTLEGAL'          =>$_POST['selectEchant'.$i],
            'saisieDef'           =>$_POST['saisieDef'.$i]
        ];
}

#transaction du tout :

$bdd = new BDD();
#debut
$bdd->beginTransaction();

if($praticienEstRemplace)
{
    $remplacantId = Praticien::creerPraticien(
            $remplacantNom,
            $remplacantPrenom,
            $remplacantAdresse,
            $remplacantCP,
            $remplacantVille,
            $remplacantCoef,
            $remplacantTypePra);
}

#table rapport_visite
$rapport = $bdd->query('INSERT INTO rapport_visite (VIS_MATRICULE, PRA_NUM,RAP_REMPLACANT, RAP_DATE, RAP_BILAN, RAP_MOTIF)
                VALUE (:visiteur,:praticien,:remplacant,:rapportDate,:bilan,:motif)');
$rapport->bindValue(':visiteur','b13');
$rapport->bindValue(':praticien',$rapportPraticien);
$rapport->bindValue(':remplacant',$remplacantId);
$rapport->bindValue(':rapportDate',$rapportDate);
$rapport->bindValue(':bilan',$rapportBilan);
$rapport->bindValue(':motif',$rapportMotif);
$rapport->execute();
$numeroRapport = $bdd->lastInsertId();

#insérer les éléments présentés :
$presentes = $bdd->query('INSERT INTO presenter (RAP_NUM, MED_DEPOTLEGAL, DOCUMENTATION) 
              VALUE (:numeroRapport,:MED_DEPOTLEGAL,:DOCUMENTATION)');
$presentes->bindValue(':numeroRapport',$numeroRapport);
foreach ($ElementsPresentes as $row)
{
    $presentes->execute($row);
}

#insérer les échantillons offerts :
$offerts = $bdd->query('INSERT INTO offrir (RAP_NUM, MED_DEPOTLEGAL, OFF_QTE)
            VALUE (:numeroRapport,:MED_DEPOTLEGAL,:DOCUMENTATION)');
$offerts->bindValue(':numeroRapport',$numeroRapport);
foreach($EchantillonsOfferts as $row)
{
    $offerts->execute($row);
}

#fin
$bdd->endTransaction();





































