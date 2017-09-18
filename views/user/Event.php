<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-image">
        <img src="<? echo WEBROOT . "public/event/" . $img_event;?>" alt="">
        <span class="card-title card indigo-text"><? echo $teamA . " Versus " . $teamB; ?></span>
      </div>
      <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l5">
              <div class="card-panel">
               <p>La cote est de 
                  <?
                    if ($coteA > $coteB) {
                      $coteA = floor($coteA);
                      $coteB = ceil($coteB);
                    } else {
                      $coteA = ceil($coteA);
                      $coteB = floor($coteB);
                    }
                    echo $coteA . "% pour " . $teamA . " et de " . $coteB . "% pour " . $teamB;
                  ?>    
                </p>
              </div>
            </div>
        </div>
        <div class="row">
          <?if(!empty($warn)){echo "<div class=\"card-panel indigo\"><p class=\"white-text\">" . $warn . "</p></div>";}?>
        </div>
        <form action="<?=WEBROOT?>user/send_bet/<?=$event_id?>" method="post" id="formid" class="<?if ($hide) {echo "hide";}?>">
          <div class="row">
            <p class="col s12 l6">
              <input name="team" type="radio" id="test1" value="teamA" />
              <label for="test1"><?echo $teamA?></label>
            </p>
            <p class="col s12 l6">
              <input name="team" type="radio" id="test2" value="teamB" />
              <label for="test2"><?echo $teamB?></label>
            </p>
          </div>
          <div class="row">
            <p class="range-field col s12">
              <input type="range" id="test5" min="1" max="<?=$_SESSION["token"]?>" name="bet" />
              <label>Nombre de token en mise</label>
            </p>
          </div>
          <div class="row">
            <div class="center">
              <button class="btn waves-effect waves-light btn-large indigo" type="submit" name="action">Jouer la mise
                <i class="material-icons right">attach_money</i>
              </button>
            </div>
          </div>
        </form>
          <p><? echo "[" . substr($date_debut, 0, 16) . " - " . substr($date_fin, 0, 16) . "]";?></p>
          <p><? echo $small_desc;?></p>
          <p><? echo $full_desc;?></p>
      </div>
      <div class="card-action">
        <a href="<?=WEBROOT . "user/display_event"?>" class="indigo-text">retour</a>
      </div>
    </div>
  </div>
</div>