<?php
/**
* Model core for reusable query
*/
class Model
{
	public static function pdoConnexion()
	{
		if (!isset($dbh)) {		
			try {
			    $dbh = new PDO('mysql:host=localhost;dbname=u_bet', 'root');
			    return $dbh;

			} catch (PDOException $e) {
			    print "Erreur !: " . $e->getMessage() . "<br/>";
			    die();
			}

		}
	}
	public function select_user($data_user)
	{
		$pdo = self::pdoConnexion();
		$query = $pdo->prepare("SELECT * FROM user WHERE email LIKE ?");
		$query->bindValue(1, $data_user, PDO::PARAM_STR);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
}