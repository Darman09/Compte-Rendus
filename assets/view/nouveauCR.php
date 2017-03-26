<!DOCTYPE HTML>
<?php
require '../phpScript/ScriptBDD.php';
require '../phpClass/ClassMedicaments.php';
?>
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
					<a class="waves-effect waves-light btn btn-large" href="#listPraticien"><i
								class="material-icons left fa fa-user-md"></i>Praticien</a>
					<input type="checkbox" id="remplace"/>
					<label for="remplace">Remplacé</label>


					<!-- #################################################################################   -->

					<!-- Praticien INFO  -->
					<div class="row">
						<div class="col l9">
							<ul class="collection with-header" id="praInfo">

							</ul>
						</div>
					</div>
					<!-- Praticien REMPLAÇANT  -->
					<div class="row">
						<div class="col l9">
							<ul class="collection with-header" id="remplacant" style="display: none;">
								<li class="collection-header"><h4>Remplaçant :</h4></li>
								<li class="collection-item"><input placeholder="Nom" type="text"></li>
								<li class="collection-item"><input placeholder="Prénom" type="text"></li>
								<li class="collection-item"><input placeholder="Adresse" type="text"></li>
								<li class="collection-item"><input placeholder="Ville" type="text"></li>
								<li class="collection-item"><input placeholder="Code postal" type="text"></li>
								<li class="collection-item"><input placeholder="Coéficien de notoriété" type="text">
								</li>
								<li class="collection-item" style="padding-bottom: 18em;">
									<select size="5">
										<option value="MH">Médecin hospitalier</option>
										<option value="MV">Médecin de ville</option>
										<option value="PH">Pharmacien hospitalier</option>
										<option value="PO">Pharmacien officine</option>
										<option value="PS">Personnel de santé</option>
									</select>
								</li>
							</ul>
						</div>
					</div>


					<!-- #################################################################################   -->


					<div class="row">
						<div class="input-field col s7 l4">
							<select>
								<option value="1">Périodicité</option>
								<option value="2">Actualisation</option>
								<option value="3">Relance</option>
								<option value="4">Solicitation Praticien</option>
								<option value="5">Autres</option>
							</select>
							<label>Motif de la visite</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s10">
							<textarea id="textarea1" class="materialize-textarea"></textarea>
							<label for="textarea1">Bilan</label>
						</div>
					</div>
					<div class="row">
						<div class="col s10">
							<h5 class="col s10 cyan-text darken-1">Eléments présentés</h5>

						</div>
					</div>
					<!-- #################################################################################   -->
					<div id="listElement">
						<div class="row element" id="preElement1">
							<div class="input-field col m4">
								<select>
									<option value="" disabled selected>Produits</option>
                                    <?php
                                    foreach (Medicaments::getAllDepotAndName() as $value):
                                        ?>
										<option value="<?php echo $value['MED_DEPOTLEGAL']; ?>">
                                            <?php echo $value['MED_DEPOTLEGAL'] . ' : ' . $value['MED_NOMCOMMERCIAL']; ?>
										</option>
                                        <?php
                                    endforeach;
                                    ?>
								</select>
								<label>Sélectionner un produit</label>
							</div>
							<div class="col m4">
								<input type="checkbox" id="Documentation"/>
								<label for="Documentation">Documentation offerte</label>
							</div>
							<div class="col m4">
								<a id="addPresente"
								   class="btn-floating btn-large waves-effect waves-light btn tooltipped blue accent-1"
								   data-position="left" data-delay="50" data-tooltip="Ajoute un nouvel élément">
									<i class="material-icons">add</i>
								</a>
							</div>
						</div>
					</div>
					<!-- #################################################################################   -->
					<div class="s12">
						<hr>
					</div>

					<div class="row">
						<div class="input-field col l2 m4 s4">
							<a class="waves-effect waves-light btn cyan darken-1"><i
										class="material-icons left">done</i>Valide</a>
						</div>
						<div class="input-field col l2 m4 s4">
							<a class="waves-effect waves-light btn cyan darken-1"><i
										class="material-icons left">loop</i>Annule</a>
						</div>
					</div>
				</div>
			</div>
	</form>
	<div id="listPraticien" class="modal bottom-sheet">
		<div class="modal-content">
			<input id="recherche" placeholder="Rechercher un practiciens"/>
            <?php
            require '../inc/getAllPraticien.inc.php';
            ?>
		</div>
	</div>
</main>

<script src="../js/jquery.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/recherche.js"></script>
<script>
    // copier l'html du modal avec la liste des praticiens dans la page
    $('.praSelectable').on('click', function ()
    {
        let praInfo = $(this).html();
        $('#praInfo').html(praInfo);
    });
    // afficher le formulaire pour ajouter un praticien si le visité est remplacé
    $('#remplace').on('click', function ()
    {
        if ($(this).is(':checked'))
        {
            $('#remplacant').fadeIn();
        } else
        {
            $('#remplacant').fadeOut();
        }
    });
    let listProduit = $('#preElement1').html();
    $('#addPresente').on('click', function ()
    {
        console.log(listProduit);
        $('#listElement').append(listProduit);
    });
</script>
</body>
</html>