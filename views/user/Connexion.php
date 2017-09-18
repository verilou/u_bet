<div class="row">
	<div class="col l1">
</div>
<h4 class="light">Connexion</h4>
<form action="<?echo WEBROOT?>user/connexion" method="post">		
	<div class="row">
		<div class="col l4"></div>
		<div class="col s12 m5 l4">
			<div class="card-panel">
				<span class="card-title red-text"><?if(!empty($erreur1)) {echo $erreur1;}?></span>
				<div class="row">
					<div class="input-field col s12">
						<input id="email" type="email" class="validate" name="email">
						<label for="email">Email</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="password" type="password" class="validate" name="password">
						<label for="password">Password</label>
					</div>
				</div>
		    	<button class="btn waves-effect waves-light indigo accent-2" type="submit"  >Connexion
		        	<i class="material-icons right">send</i>
		    	</button>
			</div>
		</div>
	</div>
</form>