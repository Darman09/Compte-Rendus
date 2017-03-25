<!DOCTYPE HTML>
<html>
<head>
    <title>GSB - Comptes-Rendus</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/main.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css" media="screen,projection"/>
</head>

<body>
<?php include '../inc/sideMenu.inc.php'; ?>
<main>
    <div class="row">
        <div class="col l10  offset-l1">
            <h5>Comptes rendus</h5>
            <div class="col l4 m12 s11 offset-s1">
                <input id="recherche" placeholder="Rechercher un comptes rendus"/>
            </div>
        </div>
        <div class="col l7 offset-l1 offset-m0 s12">
            <?php
            require '../phpScript/ScriptBDD.php';
            require '../phpClass/ClassRapportVisite.php';
            require '../phpClass/ClassDateManager.php';
            ?>
            <?php foreach(RapportVisite::getAllRapports() as $value):
                echo "<pre>";
                print_r(RapportVisite::getAllRapports());
                echo "</pre>";
                ?>

            <ul class="collection with-header">
                <li class="collection-header">
                    <h5 class="nom"> Rapport n°
                        <?php echo $value->getNumeroRapport(); ?>
                    </h5>
                </li>
                <li class="collection-item">
                    <h6>
                        <span class="boldPoppins">Date :</span>
                        <?php
                        $dateRapport = $value->getDateRapport();
                        $dateRapport=substr($dateRapport, 0, strrpos($dateRapport, ' '));
                        echo DateManager::dateAnglaisVersFrancais($dateRapport);
                        ?>
                    </h6>
                </li>
                <li class="collection-item">
                    <h6>
                        <span class="boldPoppins">Praticien :</span>
                        <?php echo strtoupper($value->getPraticien()->getNom())." ".$value->getPraticien()->getPrenom(); ?>
                    </h6>
                </li>
                <li class="collection-item">
                    <h6>
                        <span class="boldPoppins">Visiteur :</span>
                        <?php echo strtoupper($value->getVisiteur()->getNom())." ".$value->getVisiteur()->getPrenom(); ?>
                    </h6>
                </li>
                <li class="collection-item">
                    <h6>
                        <span class="boldPoppins">Motif :</span>
                        <?php echo $value->getMotifRapport(); ?>
                    </h6>
                </li>
                <li class="collection-item">
                    <h6>
                        <span class="boldPoppins">Offre :</span>
                        <?php echo $value->getMotifRapport(); ?>
                    </h6>
                </li>
                <li class="collection-item">
                    <h5>
                        <span class="boldPoppins">Bilan :</span>
                    </h5>
                    <h6>
                        <?php echo $value->getBilanRapport(); ?>
                    </h6>
                </li>
            </ul>
            <?php
            endforeach;
            ?>
        </div>

    </div>
</main>


<script src="../js/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/recherche.js"></script>
</body>
</html>