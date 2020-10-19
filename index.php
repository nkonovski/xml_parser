<?php
require_once ("config/settings.php");
require_once ("config/includes.php");

$pages = array(
	'book' => 'BookController'
);

$page = isset($_GET['page']) ? $_GET['page'] : 'page';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!in_array($page, array_keys($pages))){
	$page = 'book';
}

if (isset($pages[$page])) {
	$controller = new $pages[$page]($id);
	$controller->run();
}