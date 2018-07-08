<?php
require_once("functions.php");
include_once("emoji.php");
$user_select_query = $db->query("SELECT * FROM `users` WHERE `gg` = '{$user_record['gg']}'");
if($user_record['afk'] == 0 AND $user_record['vanish'] == 1)
{
	$db->query("UPDATE `users` SET `afk` = 1 WHERE `gg` = '{$user_record['gg']}'");
	die("{$emoji['checkmark']} Tryb AFK został włączony i nikt tego nie zauważył.");
}
elseif($user_record['afk'] == 1 AND $user_record['vanish'] == 1)
{
	$db->query("UPDATE `users` SET `afk` = 0 WHERE `gg` = '{$user_record['gg']}'");
	die("{$emoji['checkmark']} Tryb AFK został wyłączony i nikt tego nie zauważył.");
}
elseif($user_record['afk'] == 0)
{
	$db->query("UPDATE `users` SET `afk` = 1 WHERE `gg` = '{$user_record['gg']}'");
	send("{$emoji['sleep']} {$user_record['nick']} jest teraz AFK.", getUsers('online', 'gg'));
}
else
{
	$db->query("UPDATE `users` SET `afk` = 0 WHERE `gg` = '{$user_record['gg']}'");
	send("{$emoji['sleep']} {$user_record['nick']} nie jest już AFK.", getUsers('online', 'gg'));
}
?>