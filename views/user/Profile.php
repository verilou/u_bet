<div class="row">
	<div class="col s12">
		<div class="card">
			<div class="card-image">
				<img src="<?=WEBROOT ?>public/media/banniere2.jpg" alt="">
			</div>
			<div class="card-content">
				<p>Bienvenue <?echo $_SESSION["pseudo"];?></p>
			</div>
			<div class="card-tabs">
				<ul class="tabs tabs-fixed-width">
					<li class="indicator indigo" style="z-index:1"></li> 
					<li class="tab"><a href="#test4" class="indigo-text text-lighten-3">Mes paris</a></li>
					<li class="tab"><a class="active indigo-text text-lighten-3" href="#test5">Mes infos</a></li>
					<li class="tab"><a href="#test6" class="indigo-text text-lighten-3">Mon argent</a></li>
				</ul>
			</div>
			<div class="card-content grey lighten-4">
				<div id="test4">    
					<table>
						<thead>
							<tr>
								<th>Event</th>
								<th>Equipe</th>
								<th>Nombre de token</th>
								<th>Etat</th>
							</tr>
						</thead>

						<tbody>
							<?
							foreach ($data as $k => $v) {
								echo "<tr>
								<td>" . $v["teamA"] . " vs " . $v["teamB"] . "</td>
								<td>" . $v[$data[$k]["team"]] . "</td>
								<td>"  . $v["token"] . "</td>
								<td>" . $v["status"] . "</td>
								</tr>"; 
							}
							?>
						</tbody>
					</table>
				</div>
				<div id="test5">
					<div class="row">
						<div class="col s12 m12 l6">
							<h5><?echo $_SESSION["nom"] . " " . $_SESSION["prenom"]; ?></h5>
							<p><?echo $_SESSION["email"];?></p>
							<p>Pseudo: <?echo $_SESSION["pseudo"];?></p>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<a href="<?=WEBROOT?>user/disconnect" class="waves-effect waves-light btn  purple darken-3">Se déconnecter</a>
						</div>
					</div>
				</div>
				<div id="test6">
					<div class="row">
						<div class="col s12">
							<div class="card-panel <?if(intval($_SESSION["token"]) <= 0){echo "red";} else {echo "green";} ?>">
								<p><?echo "Vous avez : " . $_SESSION["token"] . " token";?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
