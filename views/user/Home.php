      <div class="row">
        <div class="col s1 m1 l1"></div>
          <div class="col l10">
            <h2 class="thin">Les matchs à la une</h2>
          </div>
      </div>
      <div class="row">
        <div class="col s12 m7 l12">
          <div class="card">
            <div class="card-image">
              <img src="<?= WEBROOT?>public/event/<?= $data[0]["img_event"]?>" alt="">
            </div>
            <div class="card-content">
              <p><?echo $data[0]["small_desc"]?></p>
            </div>
            <div class="card-action">
              <a href="<? echo WEBROOT . "user/fiche_event/" . $data[0]['event_id']; ?>" class="black-text">Voir la fiche de match &rarr;</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m7 l6">
          <div class="card">
            <div class="card-image">
              <img src="<?= WEBROOT?>public/event/<?= $data[1]["img_event"]?>" alt="">
            </div>
            <div class="card-content">
              <p><?echo $data[1]["small_desc"]?></p>
            </div>
            <div class="card-action ">
              <a href="<? echo WEBROOT . "user/fiche_event/" . $data[1]['event_id']; ?>" class="black-text">Voir la fiche de match &rarr;</a>
            </div>
          </div>
        </div>
        <div class="col s12 m7 l6">
          <div class="card">
            <div class="card-image">
              <img src="<?= WEBROOT?>public/event/<?= $data[2]["img_event"]?>" alt="">
            </div>
            <div class="card-content">
              <p><?echo $data[2]["small_desc"]?></p>
            </div>
            <div class="card-action">
              <a href="<? echo WEBROOT . "user/fiche_event/" . $data[2]['event_id']; ?>" class="black-text">Voir la fiche de match &rarr;</a>
            </div>
          </div>
        </div>
      </div>