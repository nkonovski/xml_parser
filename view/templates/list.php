<!DOCTYPE html>
<html>
<head>
	<meta charset="charset=utf-8">
	<title><?php echo $tpl_vars['name']  ?></title>
</head>
<body>
<h1>List of all <$php echo $tpl_vars['name']  ?></h1>

<?php foreach ($tpl_vars['errors'] as $error){
	echo  $error.'</br>';
} ?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	<label>Search</label>
	<input type="text" value="" placeholder="Search by author" name="keyword"/>
	<input type="submit" value="Search" name="doSearch" />
</form>


<?php foreach ($tpl_vars['data'] as $row){
	echo $row['name'].'  Author: '.$row['author'].'  added on '.row['date_upd'].' </br>';
} ?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	<input type="submit" value="Scan" name="doScan" />
</form>

</body>
</html>