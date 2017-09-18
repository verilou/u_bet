<?php
session_start();
define("ROOT" , str_replace('index.php', "", $_SERVER['SCRIPT_FILENAME']));
define("WEBROOT", str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]));
$controller_name = 'userController';
$PathArgument = ['user'];
$action = 'display';
require("core/Controller.php");
require("core/Model.php");
if (!empty($_GET["path"])) 
{
	if (strstr($_GET['path'], "/"))
	{
		$PathArgument = explode("/", $_GET['path']);
		$controller_name = $PathArgument[0] . "Controller";
		if (isset($PathArgument[1]))
		{
			$action = $PathArgument[1];
		}
	}
}
if(file_exists("controllers/" . $controller_name . ".php"))
{
	require("controllers/" . $controller_name .  ".php");
}
else
{
	var_dump(strtolower($controller_name), "ok");
	include ('404.php');
	die();
}
if (class_exists($controller_name)) {	
	$controller = new $controller_name;
	if (method_exists($controller, $action)) {	
		unset($PathArgument[0]);
		unset($PathArgument[1]);
		call_user_func_array(array($controller, $action), $PathArgument);
	} else {
		var_dump("ici");
		include ('404.php');
		die();
	}
} else {
	var_dump("laa");
	include ('404.php');
	die();
}
