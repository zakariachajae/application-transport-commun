<?php include "header.php"; 

$tarifss = false;
$message_erreur = false;




$stmt_lignes = $pdo->prepare('SELECT id_ligne, ligne_index FROM ligne');
$stmt_lignes->execute();
$lignes = $stmt_lignes->fetchAll();


if ($_SESSION["name"] == "admin") {
	if (isset($_POST['ajouer_tarifs'])) {
		if (($_POST['ligne'] == 0 ) OR is_null($_POST['description']) OR is_null($_POST['prix_ticket']) OR is_null($_POST['tarif_abonnememnt']) OR is_null($_POST['tarif_abonnememnt_etudiant']) ) {
			$message_erreur = '<div class="alert alert-danger" role="alert">	Tous Les Champs Sont Recommander </div>';
		}else {
			$stmt_insert = $pdo->prepare('INSERT INTO tarif ( ligne_id, description, prix_ticket, prix_abonnement, prix_abonnement_etudiant ) VALUES ( ?, ?, ?, ?, ? )');
			$results_insert = $stmt_insert->execute([ $_POST['ligne'], $_POST['description'], $_POST['prix_ticket'], $_POST['tarif_abonnememnt'], $_POST['tarif_abonnememnt_etudiant']] );
			//var_dump($results_insert);
			if ($results_insert) {
				$message_erreur = '<div class="alert alert-success" role="alert">	Insert Success  </div>';
			}
		}
	}if (isset($_GET['edit_tarif'])) {
		$stmt_check = $pdo->prepare('SELECT t.tarif_id, t.ligne_id, t.description, t.prix_ticket, t.prix_abonnement, t.prix_abonnement_etudiant, l.id_ligne, l.ligne_index 
		FROM tarif t 
		LEFT JOIN ligne l 
		ON t.ligne_id = l.id_ligne
		WHERE t.tarif_id = '.$_GET['tarif_id']);
		$stmt_check->execute();
		$tarifss = $stmt_check->fetch();
		if (isset($_POST['modifier_tarifs'])) {
			$stmt_update_lignes = $pdo->prepare('UPDATE tarif SET description=?, prix_ticket=?, prix_abonnement=?, prix_abonnement_etudiant=? WHERE tarif_id = '.$_GET['tarif_id']);
			$tarif_edit_results = $stmt_update_lignes->execute([ $_POST['description'], $_POST['prix_ticket'], $_POST['tarif_abonnememnt'], $_POST['tarif_abonnememnt_etudiant'] ]);
			if ($tarif_edit_results) {
				$message_erreur = '<div class="alert alert-success" role="alert">	Edit Success  </div>';
			}
		}


	}

}


$stmt = $pdo->prepare('SELECT t.tarif_id, t.ligne_id, t.description, t.prix_ticket, t.prix_abonnement, t.prix_abonnement_etudiant, l.id_ligne, l.ligne_index 
	FROM tarif t 
	LEFT JOIN ligne l 
	ON t.ligne_id = l.id_ligne');

$stmt->execute();
$tarifs = $stmt->fetchAll();
?>




						<!-- Post -->
							<section class="post">
								<header class="major">
									<h1>les tarifs
									</h1>
								</header>
								<!-- Text stuff -->
								<h3>tickets</h3>
									<div class="table-wrapper">
										<table>
											<thead>
												<tr>
													<th>ligne</th>
													<th>Description</th>
													<th>Prix</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($tarifs as $tarif_ticket){ ?>
												<tr>
													<td>ligne <?= $tarif_ticket["ligne_index"] ?></td>
													<td><?= $tarif_ticket["description"] ?></td>
													<td><?= $tarif_ticket["prix_ticket"] ?> DH</td>
													<td> <a href="?edit_tarif&tarif_id=<?= $tarif_ticket["tarif_id"] ?>" ></a> </td>
												</tr>
											<?php } ?>	
											</tbody>
											
										</table>
									</div>

									<h3>abonnement</h3>
									<div class="table-wrapper">
										<table class="alt">
											<thead>
												<tr>
													<th>ligne</th>
													<th>abonnement etudiant</th>
													<th>abonnement normale</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($tarifs as $tarif_abonnement){ ?>
												<tr>
													<td>ligne <?= $tarif_abonnement["ligne_index"] ?></td>
													<td><?= $tarif_abonnement["prix_abonnement_etudiant"] ?></td>
													<td><?= $tarif_abonnement["prix_abonnement"] ?> DH</td>
												</tr>
											<?php } ?>	
											</tbody>
											
										</table>
									</div>
									<br><br>
									<hr />


									<?php if (($_SESSION["name"] == "admin") && (!isset($_GET['edit_tarif']) or $tarifss == false)) { ?>
										<header class="major">
											<h1> Ajouter Des Tarifs</h1>
											<?= $message_erreur ?>
										</header>
									<form method="POST" action="">
										<div class="form-group">
											<label for="exampleInputEmail1">Ligne</label>
											<select name="ligne" class="form-control" required="">
											<option value="0" > Select a Line </option>
											<?php foreach($lignes as $ligne){ ?>
												<option value="<?= $ligne['id_ligne'] ?>"><?= $ligne['ligne_index'] ?> </option>
											<?php } ?>
											</select>
											<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
										</div>
										<div class="form-group">
											<label for="tarif_description">Description</label>
											<input name="description" type="text" class="form-control" id="tarif_description" placeholder="Your Discription" required="">
										</div>
										<div class="form-group">
											<label for="prix_ticket">Prix De Ticket</label>
											<input name="prix_ticket" type="numbre" class="form-control" id="prix_ticket" placeholder="0" required="">
										</div>
										<div class="form-group">
											<label for="tarif_abonnememnt">Prix D'abonnement normal</label>
											<input name="tarif_abonnememnt" type="numbre" class="form-control" id="tarif_abonnememnt" placeholder="Prix" required="">
										</div>
										<div class="form-group">
											<label for="tarif_abonnememnt_etudiant">Prix D'abonnement pour les etudiants</label>
											<input name="tarif_abonnememnt_etudiant" type="numbre" class="form-control" id="tarif_abonnememnt_etudiant" placeholder="Prix" required="">
										</div>
										<button name="ajouer_tarifs" type="submit" class="btn btn-primary">Envoyer</button>
									</form>
								<?php } ?>


								<?php if (($_SESSION['rank'] == "admin") && isset($_GET['edit_tarif']) && ($tarifss) ) { ?>
										<header class="major">
											<h1> Modifier Les Tarifs</h1>
											<?= $message_erreur ?>
										</header>
									<form method="POST" action="">
										<div class="form-group">
											<label for="exampleInputEmail1">Ligne</label>
											<select name="ligne" class="form-control" disabled="">
											<option value="0" > Select a Line </option>
											<?php foreach($lignes as $ligne){ ?>
												<option <?php if($tarifss['ligne_id'] == $ligne['id_ligne']){ echo 'selected'; }  ?> value="<?= $ligne['id_ligne'] ?>"><?= $ligne['ligne_index'] ?> </option>
											<?php } ?>
											</select>
											<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
										</div>
										<div class="form-group">
											<label for="tarif_description">Description</label>
											<input name="description" type="text" value="<?= $tarifss['description'] ?>" class="form-control" id="tarif_description" placeholder="Your Discription" required="">
										</div>
										<div class="form-group">
											<label for="prix_ticket">Prix De Ticket</label>
											<input name="prix_ticket" type="numbre" value="<?= $tarifss['prix_ticket'] ?>" class="form-control" id="prix_ticket" placeholder="0" required="">
										</div>
										<div class="form-group">
											<label for="tarif_abonnememnt">Prix D'abonnement normal</label>
											<input name="tarif_abonnememnt" type="numbre" value="<?= $tarifss['prix_abonnement'] ?>" class="form-control" id="tarif_abonnememnt" placeholder="Prix" required="">
										</div>
										<div class="form-group">
											<label for="tarif_abonnememnt_etudiant">Prix D'abonnement pour les etudiants</label>
											<input name="tarif_abonnememnt_etudiant" value="<?= $tarifss['prix_abonnement_etudiant'] ?>" type="numbre" class="form-control" id="tarif_abonnememnt_etudiant" placeholder="Prix" required="">
										</div>
										<button name="modifier_tarifs" type="submit" class="btn btn-primary">Envoyer</button>
									</form>
								<?php } ?>

								<hr>
								<!-- Buttons -->
									
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>