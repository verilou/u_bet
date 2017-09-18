<?php
/**
* 
*/
class userController extends Controller
{
	public function display_inscription(){

		$this->render("Inscription");
	}

	public function display(){
		$model = $this->newObjectModel("user");
		$event = $model->getEvent(array(0, 3));
		$this->render("Home", $event);
	}

	public function inscription(){
		if (empty($_POST)) {
			$this->render("Inscription");
			return;
		}
		$model = $this->newObjectModel("user");
		$error = [];
		$input = $_POST;
		$needed = ["pseudo", "prenom", "nom", "email", "password", "genre", "age"];
		foreach ($needed as $value) {
			if (empty($input[$value])) {
				$error = ["erreur" => "Veuillez remplir toutes les informations"];
				$this->render("Inscription", $error);
				return;
			}
		}
		if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
  			$error["erreur1"] = "Cet email n'est pas valide";
		} else {
			if(!empty($model->select_user($input['email']))) {
				$error["erreur2"] = "Cet E-mail est déjà utilisé";
			}
		}
		if (intval($input["age"]) < 18) {
		 	$error["erreur3"] = "Vous etes trop jeune pour vous inscrire";
		}
		if (strlen($input["password"]) < 8) {
			$error["erreur4"] = "Votre mots de passe est trop cour";
		} else {
			$password = password_hash($input['password'], PASSWORD_DEFAULT);
		}
		if (!count($error)) {
			$model->dataInsert($password);
			$this->display_connexion();
		} else {
			$this->render("Inscription", $error);
		}
	}
	private function verify_session() {
		if (empty($_SESSION)) {
			$this->display();
			die();
		}
	}
	public function display_connexion(){
		$this->render("Connexion");
	}

	public function connexion(){
		if (!empty($_SESSION)) {
			$this->display();
			return;
		}
		if (!empty($_POST['email']) && !empty($_POST['password'])) {
			$input = $_POST;
			$erreur['erreur1'] = "les informations de connexions ne sont pas bonnes.";
			$user_info = $this->newObjectModel("user")->select_user($input["email"]);
			if (!empty($user_info)) {
				if (password_verify($input['password'], $user_info[0]['password'])) {
					foreach ($user_info[0] as $key => $value) {
						$_SESSION[$key] = $value;
					}
					$this->display();
				} else {
					$this->render("Connexion", $erreur);
				}
			}else {
				$this->render("Connexion", $erreur);
			}

		} else {
			$this->display_connexion();
		}
	}

	public function disconnect(){
		session_destroy();
		$this->layout = "no_session";
		$this->display();
	}

	public function profile() {
		$this->verify_session();
		$model = $this->newObjectModel("user");
		$result = $model->get_user_bet($_SESSION["id_user"]);
		$result = array_reverse($result);
		foreach ($result as $key => $value) {
			$result[$key]["status"] = $this->switch_status($model , $key, $value, $result);
 		}
		$user_info = $this->newObjectModel("user")->select_user($_SESSION["email"]);
		foreach ($user_info[0] as $key => $value) {
			$_SESSION[$key] = $value;
		}
		$this->render("Profile", $result);
	}
	private function switch_status($model , $key, $value, $result) {
			$bet = $model->get_bet_status($result[$key]["bet_id"]);
			if ($value["status"] == "1") {
				return "A venir";
			} else if ($value["status"] == "2") {
				return "En cour";
			} else if ($value["status"] == "3") {
				return "Match Fini";
			} else if ($value["status"] == "4") {
				if ($value["team"] == "teamA" && $bet[0] == "2") {
					return $result[$key]["teamA"] . " a gagné ! <a class=\" right waves-effect waves-light btn indigo\" href=\"" . WEBROOT . "user/recover/" . $result[$key]["bet_id"] . "/" . $result[$key]["event_id"] . "\">Ramasser le butin</a>";
					
				} else {
					return $result[$key]["teamA"] . " a gagné !";
				}
			} else if ($value["status"] == "5") {
				if ($value["team"] == "teamB" && $bet[0] == "2") {
					return $result[$key]["teamB"] . " a gagné ! <a class=\" right waves-effect waves-light btn indigo\" href=\"" . WEBROOT . "user/recover/" . $result[$key]["bet_id"] . "/" . $result[$key]["event_id"] . "\">Ramasser le butin</a>";
				} else {
					return $result[$key]["teamB"] . " a gagné !";
				}
			}
	}
	public function display_event($arg1 = ""){
		if (empty($arg)) {
			$page[0] = 0;
			$page[1] = 20;
		}
		$page[0] = intval($arg1) * 10;
		$page[1] = $page[0] + 20;
		$model = $this->newObjectModel("user");
		$last_event = $model->getEvent($page);
		foreach ($last_event as $key => $value) {
			$mod_key = "event" . $key;
			$last_event[$mod_key] = $value;
			unset($last_event[$key]); 
		}
		$this->render("Match_listed", $last_event);
	}

	public function fiche_event($arg, $warn = ""){
		$this->verify_session();
		$arg = intval($arg);
		if (empty($arg) || !is_int($arg)) {
			include '404.php';
			return;
		}
		$model = $this->newObjectModel("user");
		$event = $model->event($arg);
		$date_debut = new DateTime($event[0]["date_debut"]);
		$date_fin = new DateTime($event[0]["date_fin"]);
		$current_date = new DateTime();
		if ($date_fin < $current_date){
			$event[0]["hide"] = true;
			$result = $model->update_event_status(3, $event[0]["event_id"]);
		} else if ($date_debut <= $current_date) {
			$event[0]["hide"] = true;
			$result = $model->update_event_status(2, $event[0]["event_id"]);
		} else {
			$event[0]["hide"] = false;
		}
		if (empty($event)) {
			include '404.php';
			return;
		}
		foreach ($event as $key => $value) {
			$mod_key = "event" . $key;
			$last_event[$mod_key] = $value;
			unset($last_event[$key]); 
		}
		if (!empty($warn)) {
			$event[0]["warn"] = $warn;		
		}
		$betA = $model->get_cote("betA", $arg);
		$betB = $model->get_cote("betB", $arg);
		$coteA = $betA[0] * 100 / ($betA[0] + $betB[0]);
		$coteB = 100 - $coteA;
		$event[0]["coteA"] = $coteA;
		$event[0]["coteB"] = $coteB;
		$this->render("Event", $event[0]);
	}

	public function display_market(){
		$this->verify_session();
		$this->render("Market");
	}

	public function send_bet($arg){
		$this->verify_session();
		if (empty($_POST["team"])) {
			$this->fiche_event($arg);
		}
		if (intval($_SESSION['token'] - $_POST['bet'] ) >= 0) {
			$_SESSION["token"] -= $_POST['bet'];
			$model = $this->newObjectModel("user");
			$result = $model->remove_token($_POST["bet"]);
			if ($result) {
				$result2 = $model->add_bet($arg, $_POST["bet"], $_POST["team"]);
				$this->fiche_event($arg, "Votre paris est en ligne");
			}
		}else{
			$this->fiche_event($arg, "Vous n'avez pas assez de jeton");
		}
	}

	public function recover($arg1 = "", $arg2 = "") {
		$this->verify_session();
		if (empty($arg2) || empty($arg1)) {
			include "404.php";
			die();
		}
		$model = $this->newObjectModel("user");
		$status = $model->get_bet_status($arg1);
		if ($status[0] == "2") {
			$result = $model->update_bet_status(3, $arg1, $_SESSION["id_user"]);
			$betA = $model->get_cote("betA", $arg2);
			$betB = $model->get_cote("betB", $arg2);
			$winner = $model->event($arg2);
			$result = $model->get_bet_value($arg1);
			$bet = $result[0];
			$betA = intval($betA[0]);
			$betB = intval($betB[0]);
			if ($winner[0]["status"] === "5") {
				$cote = $betA / $betB;
			} else {
				$cote = $betB / $betA;
			}
			$token = $bet * ($cote + 1);
			$result = $model->add_token(intval($token), $_SESSION["id_user"]);
			if ($result) {
				$this->profile();
			} else {
				include "404.php";
				return;
			}
		} else {
			$this->profile();
		}
	}
}