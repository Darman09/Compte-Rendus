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
<?php include '../inc/sideMenu.inc.php';?>

<main>
<form name="formRAPPORT_VISITE" method="post" action="#">
<div class="row">
    <div class="col l10  offset-l1">
        <div class="col m11">
          <h3 class="cyan-text darken-1">Rapport de visite</h3>
        </div>
          <div class="input-field col s12 m5 l4">
            <input id="icon_prefix" type="text" disabled value="<?php echo uniqid(); ?>">
            <label for="icon_prefix">Numéro</label>
          </div>
          <div class="col s12 m5 l4">
            <label>Sélectionner la date de la visite</label>
            <input type="date" class="datepicker">
          </div>
          <div class="input-field col s11">
              <a class="waves-effect waves-light btn btn-large"><i class="material-icons left fa fa-user-md"></i>Praticien</a>
          </div>
          <div class="input-field col s12">
            <input id="icon_prefix" type="text" class="validate">
            <label for="icon_prefix">Coefficient</label>
          </div>
            <div class="col s1">
            <input type="checkbox" id="remplacant" onClick="selectionne(true,this.checked,'PRA_REMPLACANT');"/>
            <label for="remplacant"></label>
          </div>
          <div class="input-field col s7">
            <select>
              <option value="" disabled selected>Remplacant</option>
              <option value="1">Praticien 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
            <label>Sélectionner un remplacant</label>
          </div>
          <div class="col s8">
            <label>Sélectionner la date</label>
            <input type="date" class="datepicker">
          </div>

          <div class="input-field col s7">
            <select>
              <option value="" disabled selected>Motif</option>
              <option value="1">Périodicité</option>
              <option value="2">Actualisation</option>
              <option value="3">Relance</option>
              <option value="4">Solicitation Praticien</option>
              <option value="5">Autres</option>
            </select>
            <label>Sélectionner un motif</label>
          </div>
          <div class="input-field col s10">
            <textarea id="textarea1" class="materialize-textarea"></textarea>
            <label for="textarea1">Bilan</label>
          </div>
          <div class="col s10">
            <h5 class="col s10 cyan-text darken-1">Eléments présentés</h5>
            <div class="col s2">
              <a class="btn-floating btn-large waves-effect waves-light btn tooltipped cyan darken-1" data-position="left" data-delay="50" data-tooltip="Ajoute un nouvel élément"  ><i class="material-icons">add</i></a>
            </div>
          </div>
          <div class="input-field col s7">
            <select>
              <option value="" disabled selected>Produit</option>
              <option value="1">Praticien 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
            <label>Sélectionner un produit</label>
          </div>
          <div class="input-field col s7">
            <select>
              <option value="" disabled selected>Produit</option>
              <option value="1">Praticien 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
            <label>Sélectionner un produit</label>
          </div>
          <div class="col s7">
            <input type="checkbox" id="Documentation" />
            <label for="Documentation">Documentation Offerte</label>
          </div>
          <div class="col s10">
           <h5 class="col s10 cyan-text darken-1">Echantillons</h5>
            <div class="col s2">
                <a class="btn-floating btn-large waves-effect waves-light btn tooltipped cyan darken-1" data-position="left" data-delay="50" data-tooltip="Ajoute un nouvel échantillon"  ><i class="material-icons">add</i></a>
            </div>
          </div>
          <div class="col s12 input-field">
            <div class="input-field col s6">
              <select>
                <option value="" disabled selected>Produit</option>
                <option value="1">Produit 2</option>
                <option value="2">Produit</option>
                <option value="3">Produit</option>
              </select>
              <label>Sélectionner un produit</label>
            </div>
            <div class="input-field col s4">
              <input id="icon_prefix" type="text" class="validate">
              <label for="icon_prefix">Nom</label>
            </div>
          </div>
          <div class="col l12 s12">
            <div class="col l2 m4 s4">
              <input type="checkbox" id="def"/>
              <label for="def">Saisie Définitive</label>
            </div>
            <div class="input-field col l2 m4 s4">
              <a class="waves-effect waves-light btn cyan darken-1"><i class="material-icons left">done</i>Valide</a>
            </div>
            <div class="input-field col l2 m4 s4">
              <a class="waves-effect waves-light btn cyan darken-1"><i class="material-icons left">loop</i>Annule</a>
            </div>
          </div>
    </div>
</div>
</form>
</main>

<script src="../js/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/main.js"></script>
</body>
</html>