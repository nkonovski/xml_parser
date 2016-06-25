<?php
require_once (config/settings.php);
require_once (config/includes.php);



$pages = array(
	'book' => 'BookControler'
);

if (!$page = $_GET['page']){
	$page = 'book';
}

if(!$id = (int)$_GET['id']){
	$id = null;
}

if (isset($pages[$page])) {
	$controller = new $pages[$page]($id);
	$controller->run();
}