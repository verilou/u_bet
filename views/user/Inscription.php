<div class="card">
  <div class="card-image">
    <img src="<?=WEBROOT?>public/media/banniere.png" alt="">
  </div>
  <div class="card-content"> 
    <div class="row">
      <div class="cool s12">
        <h5>Inscription</h5>
        <span class="red-text">
          <?
            if (isset($erreur)) { echo $erreur . "<br>"; } 
            if (isset($erreur1)) { echo $erreur1 . "<br>"; }
            if (isset($erreur2)) { echo $erreur2 . "<br>"; }
            if (isset($erreur3)) { echo $erreur3 . "<br>"; }
            if (isset($erreur4)) { echo $erreur4 . "<br>"; }
          ?>
        </span>
      </div>
      <form class="col s12" action="<?echo WEBROOT?>user/inscription" method="post">
        <div class="row">
          <div class="input-field col s6">
            <input placeholder="Ex: Jean-exemple" id="pseudo" type="text" class="validate" name="pseudo">
            <label for="pseudo">Pseudo</label>
          </div>
          <div class="input-field col s12 l6">
            <input placeholder="Ex: jean.dupont@test.fr" id="email" type="email" class="validate" name="email">
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input placeholder="Ex: jean" id="last_name" type="text" class="validate" name="prenom">
            <label for="last_name">Prénom</label>
          </div>
          <div class="input-field col s6">
            <input placeholder="Ex: Dupont" id="first_name" type="text" class="validate" name="nom">
            <label for="first_name">Nom</label>
          </div>
          <div class="input-field col s12 l6">
            <input placeholder="8 caractère min" id="password" type="password" class="validate" name="password">
            <label for="password">Password</label>
          </div>
          <div class="col s12 m6 l6">
              <p class="range-field">
                <label for="test5">Age</label>
                <input type="range" id="test5" min="0" max="100" name="age"/>
              </p>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m6 l6">
              <p>
                <input name="genre" type="radio" id="test1" value="1"/>
                <label for="test1">Homme</label>
              </p>
              <p>
                <input name="genre" type="radio" id="test2" value="2"/>
                <label for="test2">Femme</label>
              </p>
          </div>
        </div>
      <button class="btn waves-effect waves-light indigo accent-2" type="submit"  >Crée un compte
        <i class="material-icons right">send</i>
      </button>
</form>
    </div>
  </div>
</div>