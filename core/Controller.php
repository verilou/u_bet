<?
/**
* Core Controller
*/
class Controller
{
	protected $layout = "default";
	public function setLayout($value){
		$this->layout = $value;
	}
	public function getLayout() {
		return $this->layout;
	}
	public function render($view = 'index', $data = []) {
		if (empty($_SESSION)) {
			$this->setLayout("no_session");
		}
		extract($data);
		ob_start();
		$success = include(ROOT . "views/" . str_replace("Controller", "", get_class($this)) . "/" . $view . ".php");
		$content_for_layout = ob_get_clean();
		if (!$success) {
			var_dump(ROOT . "views/" . get_class($this) . "/" . $view . ".php");
			require("404.php");
		} else {
			require("views/layout/" . $this->layout . ".php");
		}
	}
	public function newObjectModel($model) {
		include_once("models/" . $model . "Model.php");
		$class_name = $model . "Model";
		$obj = new $class_name;
		return $obj;
	}
	public function upload_img($path, $id) {
		$dossier = ROOT . $path; 
		$extensions = array('.png', '.jpg', '.jpeg');
		$extension = strrchr($_FILES['fichier']['name'], '.');
		$fichier = $id . $extension;
		if(!in_array($extension, $extensions)) {
			return 'Vous devez uploader un fichier de type png, jpg, jpeg';
		}
		if(filesize($_FILES['fichier']['tmp_name']) > 400000) {
			return 'Le fichier est trop gros...';
		}
		if (move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . '/' . $fichier)) {
			return $dossier . '/' . $fichier;
		} else {
			return "Echec de l'upload !";
		}
	}
}