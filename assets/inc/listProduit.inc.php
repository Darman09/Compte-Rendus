<?php
$bdd = new BDD();
$bdd->query('SELECT MED_DEPOTLEGAL, MED_NOMCOMMERCIAL FROM medicament');
$row = $bdd->resultset();