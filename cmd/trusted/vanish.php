<?php
require_once("functions.php");
include_once("emoji.php");
staffRequired(2);
$user_select_query = $db->query("SELECT * FROM `users` WHERE `gg` = '{$user_record['gg']}'");
if($user_record['vanish'] == 0)
{
	$db->query("UPDATE `users` SET `vanish` = 1 WHERE `gg` = '{$user_record['gg']}'");
	die("{$emoji['checkmark']} Tryb niewidoczny został włączony.");
}
else
{
	$db->query("UPDATE `users` SET `vanish` = 0 WHERE `gg` = '{$user_record['gg']}'");
	die("{$emoji['checkmark']} Tryb niewidoczny został wyłączony.");
}
?>