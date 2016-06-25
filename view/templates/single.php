<!DOCTYPE html>
<html>
<head>
	<meta charset="charset=utf-8">
	<title><?php echo $tpl_vars['name']  ?></title>
</head>
<body>
<h1>Load single record from <$php echo $tpl_vars['name']  ?></h1>

<?php foreach ($tpl_vars['errors'] as $error){
	echo  $error.'</br>';
} ?>


<?php 
	echo 'Name: '. $tpl_vars['model']->name .' </br>';
	echo 'Author: '. $tpl_vars['model']->author .'</br>';
	echo 'added on '. $tpl_vars['model']->date_upd .' </br>';
?>

<a href="<?php echo $tpl_vars['back_url'] ?>">Back</a>

</body>
</html>