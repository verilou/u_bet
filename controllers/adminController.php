<?php
/**
* Page d'acceuil / home page loader
*/
class adminController extends Controller
{
	public function identity_control($lvl = 1) {
		if ($lvl == 2) {
			if ($_SESSION['role'] == "2") {
				return true;
			} else if($_SESSION['role'] ==! "1"){
				$this->display_pannel();
				return;
			} else {
				die();
			}
		} else {
			if ($_SESSION['role'] ==! "1") {
				die();
			}
		}
	}
	public function display_pannel($arg = "") {
		$this->identity_control();
		$model = $this->newObjectModel("admin");
		$list = $model->list_event();
		$list["user"] = $arg;
		$this->render("Pannel", $list);
	}
	public function update_event_status($arg = ""){
		if (empty($arg)) {
			include "404.php";
			die();
		}
		if (empty($_POST)) {
			$this->render("Pannel");
		}
		$this->identity_control();
		$model = $this->newObjectModel("admin");
		$model->update_event($arg);
		if ($_POST["victoire"] === "5") {
			$result = $model->update_bet("2", $arg, "teamB");
		} else {
			$result = $model->update_bet("3", $arg, "teamB");
		}

		if($_POST["victoire"] === "4") {
			$result = $model->update_bet("2", $arg, "teamA");
		} else {
			$result = $model->update_bet("3", $arg, "teamA");
		}
		$this->display_pannel();
	}
	public function post_event() {
		$this->identity_control();
		if (empty($_POST)) {
			$this->render("Pannel");
			return;
		}
		$erreur = [];
		$needed = ["teamA", "teamB", "small-desc", "full-desc", "date_fin", "heure_fin", "date_debut", "heure_debut"];
		$input = $_POST;
		foreach ($needed as $value) {
			if (empty($input[$value])) {
				$erreur = ["erreur1" => "Veuillez remplir tout le formulaire " . $value];
				$this->render("Pannel", $erreur);
				return;
			}
		}
		if (empty($_FILES['fichier'])) {
			$erreur = ["erreur1" => "Veuillez donner une image d'évènement"];
		}
		if (strlen($input["small-desc"]) > 120) {
			$erreur["erreur2"] = "La petite description est trop longue.";
		}
		$model = $this->newObjectModel("admin");
		$date = $this->convert_date($input);
		$date3 = new DateTime(date("Y/m/d H:i"));

		if ($date[0] > $date[1]) {
		 	$erreur["erreur3"] = "La date et heure de debut doit etre avant celle de fin.";
		}
		if ($date3 > $date[1]) {
		 	$erreur["erreur4"] = "La date et heure de debut doit etre apres celle d'aujourd'hui.";
		}
		if (empty($erreur)) {
			$last_event = $model->select_last_event();
			$upload_status = $this->upload_img("public/event" , intval($last_event[0]["event_id"]) + 1);
			if (file_exists($upload_status)) {
				$success["message"] = "L'upload de l'event est un succes";
				$model->new_event($date[0]->format("Y-m-d H:i:s"), $date[1]->format("Y-m-d H:i:s"), basename($upload_status));
				$this->render("Pannel", $success);
			} else {
				$erreur["erreur5"] = $upload_status;
				$this->render("Pannel", $erreur);
			}
		} else {
			$this->render("Pannel", $erreur);
		}
	}
	public function convert_date($input) {
		$this->identity_control();
		$model = $this->newObjectModel("admin");
		$last_event = $model->select_last_event();
		$date = date('Y/m/d', strtotime($input["date_debut"]));
		$full_date_debut = $date . " " . $input["heure_debut"];
		$date = date('Y/m/d', strtotime($input["date_fin"]));
		$full_date_fin = $date . " " . $input["heure_fin"];
		$date1 = new DateTime($full_date_debut);
		$date2 = new DateTime($full_date_fin);
		return array($date1, $date2);
	}
	public function display_modify_event($event, $info = ""){
		$this->identity_control();
		$arg = [$event];
		$model = $this->newObjectModel("admin");
		$result = $model->event($event);
		$date = new DateTime($result[0]["date_fin"]);
		$current = new DateTime("now");
		$status = true;
		if ($date < $current && $result[0]["status"] === "3") {
			$status = false;		
		}
		$arg = [$event, $result];
		$arg["info"] = $info;
		$arg["status"] = $status;
		$this->render("modify_event", $arg);
	}
	public function modify_event($event){
		$erreur = [];
		$this->identity_control();
		$count = 0;
		$model = $this->newObjectModel("admin");
		if (!empty($_POST["date_debut"]) && !empty($_POST["heure_debut"]) && !empty($_POST["date_fin"]) && !empty($_POST["heure_fin"])) {
			$date = $this->convert_date($_POST);
			if ($date[0] > $date[1]) {
		 		$erreur["erreur3"] = "La date et heure de debut doit etre avant celle de fin.";
			}
			$current = new DateTime("now");
			if ($current > $date[1]) {
			 	$erreur["erreur4"] = "La date et heure de debut doit etre apres celle d'aujourd'hui.";
			}
			if (empty($erreur)) {
				$model->update_dates($date[0]->format("Y-m-d H:i:s"), $date[1]->format("Y-m-d H:i:s"), $event);
			} else {
				$this->display_modify_event($event, $erreur);
				return;
			}
		} else {
			$count++;
		}
		if (!empty($_POST["small-desc"])) {
			if (strlen($_POST["small-desc"]) <= 120) {
				$model->update_small_desc($event);
			}else {
				$erreur[0] = "La petite desc est trop longue";
				$this->display_modify_event($event, $erreur);
				return;
			}
		} else {
			$count++;
		}
		if (!empty($_POST["full-desc"])) {
			$model->update_full_desc($event);
		} else  {
			$count++;
		}
		$result = $model->event($event);
		if (!empty($_FILES['fichier']["name"])) {
			$this->upload_img("public/event" , $result[0]["event_id"]);
		} else {
			$count++;
		}
		if ($count < 4) {
			$this->display_modify_event($event, ["La modification a été faite"]);
		} else {
			$this->display_modify_event($event);
		}
	}
	public function list_user(){
		$this->identity_control(2);
		$model = $this->newObjectModel("admin");
		$result = $model->select_users();
		$this->display_pannel($result);
	}
	public function promote($user){
		$this->identity_control(2);
		$model = $this->newObjectModel("admin");
		$model->promote($user);
	}
}