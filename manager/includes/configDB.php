<?php 

$dbacc = new PDO('mysql:host=127.0.0.1;dbname=shop_accountant', 'root','');

function data_cleaner($data){
	$one = strip_tags(stripslashes($data));
	$two = htmlspecialchars($one);
	$three = htmlentities($two);
	$cleaned = stripcslashes($three);
	return $cleaned;
}
?>