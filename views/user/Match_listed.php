<h2 class="indigo-text thin">Les matchs</h2>
<?php
foreach ($data as $key => $value) {

  echo "
    <div class=\"col s12 m7\">
	    <h4 class=\"light\">" . $value["teamA"] . " - " . $value["teamB"] . "</h4>
	    <div class=\"card small\">
	      <div class=\"card-image\">
	        <img src=\"" . WEBROOT . "public/event/sn_logo.jpg\" alt=\"\">
	        <span class=\"card-title card-panel indigo-text\">" . substr($value["date_debut"], 0, 16) . "</span>
	      </div>
	      <div class=\"card-content\">
	          	<p class=\"truncate\">" . $value["small_desc"] . "</p>
	          	
	      </div>
	      <div class=\"card-action\">
	        <a href=\"" . WEBROOT . "user/fiche_event/" . $value["event_id"] . "\" class=\"indigo-text right-align\">Parier sur le match</a>
	      </div>
	    </div>
	  </div>";
}										