<?php
require_once("functions.php");
include_once("emoji.php");
staffRequired(2);
if(!isset($part[1])) die("{$emoji['warn']} Podaj wymagane argumenty (nick).");
$nick = $part[1];
$user_select_query = $db->query("SELECT * FROM `users` WHERE `nick` LIKE '{$nick}' LIMIT 1");
if($user_select_query->num_rows == 0) die("{$emoji['warn']} Taki użytkownik nie istnieje.");
while($select_result = $user_select_query->fetch_assoc())
{
	$target_gg = $select_result['gg'];
	$is_online = $select_result['online'];
	$target_nick = $select_result['nick'];
}
if($is_online == 1) die("{$emoji['x']} Użytkownik {$target_nick} jest już zalogowany.");
$commander = $user_record['nick'];
if(!isset($part[2]))
{
	send("{$emoji['door']} Zostałeś zalogowany na czat przez {$commander}.", $target_gg);
	send("{$emoji['door']} Użytkownik {$target_nick} został zalogowany na czat przez {$commander}.", getUsers('online', 'gg'));
	$db->query("UPDATE `users` SET `online` = 1 WHERE `nick` LIKE '{$target_nick}'");
	die();
}
else
{
	unset($part[0]);
	unset($part[1]);
	$reason = implode(' ', $part);
	send("{$emoji['door']} Zostałeś zalogowany na czat przez {$commander}.\nPowód: {$reason}", $target_gg);
	send("{$emoji['door']} Użytkownik {$target_nick} został zalogowany na czat przez {$commander}.\nPowód: {$reason}", getUsers('online', 'gg'));
	$db->query("UPDATE `users` SET `online` = 1 WHERE `nick` LIKE '{$target_nick}'");
	die();
}
?>