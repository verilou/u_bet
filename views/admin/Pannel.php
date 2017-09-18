<h4 class="thin">Bienvenue sur votre pannel admin <?= $_SESSION["pseudo"]?></h4>
<div class="row">
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<h4 class="thin">Crée un evènement</h4>
				<?
					if (isset($erreur1)) {echo "<p class=\"red-text\">$erreur1</p>";}
					if (isset($erreur2)) {echo "<p class=\"red-text\">$erreur2</p>";}
					if (isset($erreur3)) {echo "<p class=\"red-text\">$erreur3</p>";}
					if (isset($erreur4)) {echo "<p class=\"red-text\">$erreur4</p>";}
					if (isset($erreur5)) {echo "<p class=\"red-text\">$erreur5</p>";}
					if (isset($message)) {echo "<p class=\"green-text\">$message</p>";}
				?>
				<form action="<?=WEBROOT?>admin/post_event" method="post" enctype="multipart/form-data">
					<div class="row">
				        <div class="input-field col s6">
				          	<input id="teamA" type="text" class="validate" name="teamA">
				          	<label for="teamA">Nom de l'equipe A</label>
				        </div>
				        <div class="input-field col s6">
				          	<input id="teamB" type="text" class="validate" name="teamB">
							<label for="teamB">Nom de l'équipe B</label>
				    	</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<textarea id="textarea1" class="materialize-textarea" data-length="120" name="small-desc"></textarea>
							<label for="textarea1">Petite description de l'évnènement</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<textarea id="textarea2" class="materialize-textarea" name="full-desc"></textarea>
          					<label for="textarea2">Article complet sur l'evènement</label>
						</div>
					</div>
					<div class="row">
						<div class="file-field input-field col s12">
					      	<div class="btn indigo">
					        	<span>Photo d'event</span>
					        	<input type="file" name="fichier">
					      	</div>
					      	<div class="file-path-wrapper">
						       	<input class="file-path validate" type="text">
						   	</div>
					    </div>
					</div>
					<div class="row">
						<div class="input-field col s6">
  							<input type="text" class="datepicker" id="date" name="date_debut">
							<label for="date">Date de debut de l'event</label>
				    	</div>
						<div class="input-field col s6">
  							<input type="text" class="timepicker" id="time" name="heure_debut">
							<label for="time">Heure de debut de l'event</label>
				    	</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
  							<input type="text" class="datepicker" id="date_fin" name="date_fin">
							<label for="date_fin">Date de fin de l'event</label>
				    	</div>
						<div class="input-field col s6">
  							<input type="text" class="timepicker" id="time_fin" name="heure_fin">
							<label for="time_fin">Heure de fin l'event</label>
				    	</div>
					</div>
					<div class="row">
						<div class="col s12">
							<button class="btn waves-effect waves-light indigo" type="submit" name="action">Poster l'evènement
							    <i class="material-icons right">send</i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
<?
foreach ($data as $key => $value) {
	if ($key !== "user") {
		echo "
					<div class=\"col s12 m6 l3\">
						<div class=\"card\">
							<div class=\"card-content\">
								<h5 class=\"thin\">" . $value["teamA"] . " vs " . $value["teamB"] . "</h5> 
								<p class=\"light\">" . substr($value["date_debut"], -17, 14) . " - " . substr($value["date_debut"], -17, 14) . "</p>
								<a class=\"btn indigo\" href=\"" . WEBROOT . "admin/display_modify_event/" . $value["event_id"] . "\">Administrer l'évnènement</a>
							</div>
						</div>
					</div>";
	}
}
?>
</div>
<form action="<?=WEBROOT?>admin/list_user" method="post" class="<?if($_SESSION["role"] !== "2"){echo "hide";}?>">
	<div class="row">
		<div class="input-field col s12">
		    <input id="search" type="text" class="validate" name="search">
		    <label for="search">Trouver un profil utilisateur</label>
		</div>
	</div>
</form>
<?
if (!empty($user)) {
	foreach ($user as $key => $value) {
		echo "<div class=\"col s12 m6 l3\">
						<div class=\"card\">
							<div class=\"card-content\">
								<h5 class=\"thin\">" . $value["nom"] . " " . $value["prenom"] . "</h5> 
								<p class=\"light\">" . $value["email"] . "</p>
								<a class=\"btn indigo\" href=\"" . WEBROOT . "admin/promote/" . $value["id_user"] . "\">AJouter en temps qu'admin</a>
							</div>
						</div>
					</div>";
		
	}
}
?>