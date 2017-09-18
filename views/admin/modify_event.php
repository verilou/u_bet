<div class="row">
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<h4 class="thin">Modifier l'évent <?echo $data[1][0]["teamA"] . " vs " . $data[1][0]["teamB"];?></h4>
				<p><? if(!empty($info[0])) { echo $info[0];}?></p>
				<p><? if(!empty($info["erreur3"])) { echo $info["erreur3"];}?></p>
				<p><? if(!empty($info["erreur4"])) { echo $info["erreur4"];}?></p>
				<p></p>
				<p></p>
				<form action="<?=WEBROOT?>admin/modify_event/<?echo $data[1][0]["event_id"];?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="input-field col s12">
							<textarea id="textarea1" class="materialize-textarea" data-length="120" name="small-desc"></textarea>
							<label for="textarea1">Modifier la petite description de l'évnènement</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<textarea id="textarea2" class="materialize-textarea" name="full-desc"></textarea>
          					<label for="textarea2">Modifier l'article complet sur l'evènement</label>
						</div>
					</div>
					<div class="row">
						<div class="file-field input-field col s12">
					      	<div class="btn indigo">
					        	<span>Changer la photo d'event</span>
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
							<label for="date">Changer la date de debut de l'event</label>
				    	</div>
						<div class="input-field col s6">
  							<input type="text" class="timepicker" id="time" name="heure_debut">
							<label for="time">Changer l'heure de debut de l'event</label>
				    	</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
  							<input type="text" class="datepicker" id="date_fin" name="date_fin">
							<label for="date_fin">Changer la date de fin de l'event</label>
				    	</div>
						<div class="input-field col s6">
  							<input type="text" class="timepicker" id="time_fin" name="heure_fin">
							<label for="time_fin">Changer l'heure de fin l'event</label>
				    	</div>
					</div>
					<div class="row">
						<div class="col s12">
							<button class="btn waves-effect waves-light indigo" type="submit" name="action">Modifier l'event
							</button>
						</div>
					</div>
				</form>
				<form action="<?=WEBROOT?>admin/update_event_status/<?echo $data[0];?>" method="post" class="<?if($status){echo "hide";}?>">
				    <p>
				      <input name="victoire" type="radio" id="test1" value="4"/>
				      <label for="test1"><?= $data[1][0]["teamA"]?></label>
				    </p>
				    <p>
				      <input name="victoire" type="radio" id="test2" value="5"/>
				      <label for="test2"><?= $data[1][0]["teamB"]?></label>
				    </p>
				    <div class="row">
						<div class="col s12">
							<button class="btn waves-effect waves-light indigo" type="submit" name="action">Définir le vainqueur
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>