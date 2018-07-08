<?php
require_once("functions.php");
include_once("emoji.php");
staffRequired(1);
if(!isset($part[1])) die("{$emoji['warn']} Podaj wymagane argumenty (nick).");
$nick = $part[1];
$user_select_query = $db->query("SELECT * FROM `users` WHERE `nick` LIKE '{$nick}' LIMIT 1");
if($user_select_query->num_rows == 0) die("{$emoji['warn']} Taki użytkownik nie istnieje.");
while($select_result = $user_select_query->fetch_assoc())
{
	if($select_result['gg'] == $from) die("{$emoji['info']} Nie możesz wyrzucić samego siebie.");
	$target_gg = $select_result['gg'];
	$is_online = $select_result['online'];
	$is_on_vanish = $select_result['vanish'];
	$target_nick = $select_result['nick'];
}
if($is_online == 0) die("{$emoji['info']} Użytkownik {$target_nick} nie jest zalogowany.");
if($is_on_vanish == 1 AND $user_record['staff'] <= 2) die("{$emoji['info']} Użytkownik {$target_nick} nie jest zalogowany.");
$commander = $user_record['nick'];
$db->query("UPDATE `users` SET `online` = 0 WHERE `nick` LIKE '{$target_nick}'");
if(!isset($part[2]))
{
	send("{$emoji['door']} Użytkownik {$target_nick} został wyrzucony z czatu przez {$commander}.", getUsers('online', 'gg'));
	send("{$emoji['door']} Zostałeś wyrzucony z czatu przez {$commander}.", $target_gg);
	die();
}
else
{
	unset($part[0]);
	unset($part[1]);
	$reason = implode(' ', $part);
	send("{$emoji['door']} Użytkownik {$target_nick} został wyrzucony z czatu przez {$commander}.\nPowód: {$reason}", getUsers('online', 'gg'));
	send("{$emoji['door']} Zostałeś wyrzucony z czatu przez {$commander}.\nPowód: {$reason}", $target_gg);
	die();
}
?>