<?php
/**
* 
*/
class adminModel extends Model
{
	public function select_last_event() {
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("SELECT * FROM event ORDER BY event_id DESC LIMIT 1");
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	public function new_event($date_debut, $date_fin, $img) {
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("INSERT INTO event (date_debut, date_fin, teamA, teamB, small_desc, full_desc, img_event) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$query->bindValue(1, $date_debut, PDO::PARAM_STR);
		$query->bindValue(2, $date_fin, PDO::PARAM_STR);
		$query->bindValue(3, $_POST["teamA"], PDO::PARAM_STR);
		$query->bindValue(4, $_POST["teamB"], PDO::PARAM_STR);
		$query->bindValue(5, $_POST["small-desc"], PDO::PARAM_STR);
		$query->bindValue(6, $_POST["full-desc"], PDO::PARAM_STR);
		$query->bindValue(7, $img, PDO::PARAM_STR);
		return $query->execute();
	}
	public function list_event() {
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("SELECT * FROM event WHERE status = 3 OR date_fin < CURRENT_DATE + 1");
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result; 
	}
	public function update_event($arg) {
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("UPDATE event SET status = ? WHERE event_id = ?");
		$query->bindValue(1, $_POST["victoire"], PDO::PARAM_INT);
		$query->bindValue(2, $arg, PDO::PARAM_INT);
		$result = $query->execute();
		return $result;
	}
	public function update_bet($arg1, $arg2, $arg3){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("UPDATE bet SET status = ? WHERE event_id = ? AND team = ?");
		$query->bindValue(1, $arg1, PDO::PARAM_INT);
		$query->bindValue(2, $arg2, PDO::PARAM_INT);
		$query->bindValue(3, $arg3, PDO::PARAM_STR);
		$result = $query->execute();
		return $result;
	}
	public function event($arg){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("SELECT * FROM event WHERE event_id = ?");
		$query->bindValue(1, $arg, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	public function update_dates($arg1 , $arg2, $arg3){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("UPDATE event SET date_debut = ?, date_fin = ? WHERE event_id = ?");
		$query->bindValue(1, $arg1, PDO::PARAM_STR);
		$query->bindValue(2, $arg2, PDO::PARAM_STR);
		$query->bindValue(3, $arg3, PDO::PARAM_INT);
		$result = $query->execute();
		return $result;
	}
	public function update_small_desc($event) {
	 	$pdo = self::pdoConnexion();
		$query = $pdo->prepare("UPDATE event SET small_desc = ? WHERE event_id = ?");
		$query->bindValue(1, $_POST["small-desc"], PDO::PARAM_STR);
		$query->bindValue(2, $event, PDO::PARAM_INT);
		$result = $query->execute();
		return $result;
	}
	public function update_full_desc($event) {
	 	$pdo = self::pdoConnexion();
		$query = $pdo->prepare("UPDATE event SET full_desc = ? WHERE event_id = ?");
		$query->bindValue(1, $_POST["full-desc"], PDO::PARAM_STR);
		$query->bindValue(2, $event, PDO::PARAM_INT);
		$result = $query->execute();
		return $result;
	}
	public function select_users() {
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("SELECT * FROM user WHERE nom LIKE ?");
		$query->bindValue(1, "%" . $_POST["search"] . "%", PDO::PARAM_STR);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result; 
	}
	public function promote($user){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("UPDATE user SET role = 1 WHERE id_user = ?");
		$query->bindValue(1, $user, PDO::PARAM_INT);
		$result = $query->execute();
		return $result;
	}
}