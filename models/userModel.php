<?php
/**
* 
*/
class userModel extends Model
{
	public function dataInsert($data)
	{
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("INSERT INTO user (pseudo, nom, prenom, email, password, genre, age) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$query->bindValue(1, $_POST['pseudo'], PDO::PARAM_STR);
		$query->bindValue(2, $_POST['nom'], PDO::PARAM_STR);
		$query->bindValue(3, $_POST['prenom'], PDO::PARAM_STR);
		$query->bindValue(4, $_POST['email'], PDO::PARAM_STR);
		$query->bindValue(5, $data, PDO::PARAM_STR);
		$query->bindValue(6, intval($_POST['genre']), PDO::PARAM_INT);
		$query->bindValue(7, intval($_POST['age']), PDO::PARAM_INT);
		$query->execute();
	}
	public function getEvent($arg){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("SELECT * FROM event WHERE date_fin > CURRENT_DATE ORDER BY date_debut ASC LIMIT ?, ?");
		$query->bindValue(1, $arg[0], PDO::PARAM_INT);
		$query->bindValue(2, $arg[1], PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
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
	public function remove_token($arg){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("UPDATE user SET token = token - ? WHERE id_user = ?");
		$query->bindValue(1, $arg, PDO::PARAM_INT);
		$query->bindValue(2, $_SESSION["id_user"], PDO::PARAM_INT);
		$result = $query->execute();
		return $result;
	}
	public function add_bet($event, $token, $team){
		$pdo = self::pdoConnexion();
		$query_1 = $pdo->prepare("INSERT INTO bet (event_id, id_user, token, team) VALUES (?, ?, ?, ?)");
		$query_1->bindValue(1, $event, PDO::PARAM_INT);
		$query_1->bindValue(2, $_SESSION["id_user"], PDO::PARAM_INT);
		$query_1->bindValue(3, $token, PDO::PARAM_INT);
		$query_1->bindValue(4, $team, PDO::PARAM_STR);
		$result_1 = $query_1->execute();
		$bet = "bet" . substr($team, 4);
		if ($bet === "betA") {
			$query_2 = $pdo->prepare("UPDATE event SET betA = betA + ? WHERE event_id = ?");
		} else if ($bet === "betB") {
			$query_2 = $pdo->prepare("UPDATE event SET betB = betB + ? WHERE event_id = ?");
		}
		$query_2->bindValue(1, intval($token), PDO::PARAM_INT);
		$query_2->bindValue(2, intval($event), PDO::PARAM_INT);
		$result_2 = $query_2->execute();
		$result = [$result_1, $result_2];
		return $result;
	}
	public function get_cote($arg, $event){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("SELECT $arg FROM event WHERE event_id = ?");
		$query->bindValue(1, $event, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_COLUMN);
		return $result;
	}
	public function get_user_bet($arg){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("SELECT * FROM bet INNER JOIN event ON event.event_id = bet.event_id where bet.id_user = ?");
		$query->bindValue(1, intval($arg), PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;

	}
	public function update_event_status($arg, $event){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("UPDATE event SET status = ? WHERE event_id = ?");
		$query->bindValue(1, $arg, PDO::PARAM_INT);
		$query->bindValue(2, $event, PDO::PARAM_INT);
		$result = $query->execute();
		return $result;
	}

	public function update_bet_status($arg1, $arg2, $arg3){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("UPDATE bet SET status = ? WHERE bet_id = ? AND id_user = ?");
		$query->bindValue(1, $arg1, PDO::PARAM_INT);
		$query->bindValue(2, $arg2, PDO::PARAM_INT);
		$query->bindValue(3, $arg3, PDO::PARAM_INT);
		$result = $query->execute();
		return $result;
	}
	public function get_bet_status($arg){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("SELECT status FROM bet WHERE bet_id = ?");
		$query->bindValue(1, $arg, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_COLUMN);
		return $result;
	}
	public function get_bet_value($arg){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("SELECT token FROM bet WHERE bet_id = ?");
		$query->bindValue(1, $arg, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_COLUMN);
		return $result;
	}
	public function add_token($token, $id){
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("UPDATE user SET token = token + ? WHERE id_user = ?");
		$query->bindValue(1, $token, PDO::PARAM_INT);
		$query->bindValue(2, $id, PDO::PARAM_INT);
		$result = $query->execute();
		return $result;

	}
}