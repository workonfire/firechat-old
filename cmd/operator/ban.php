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
	if($select_result['gg'] == $from) die("{$emoji['info']} Nie możesz zbanować samego siebie.");
	if($select_result['banned'] == 1) die("{$emoji['info']} Ten użytkownik ma już bana.");
	$target_gg = $select_result['gg'];
	$target_nick = $select_result['nick'];
}
$commander = $user_record['nick'];
$db->query("UPDATE `users` SET `banned` = 1 WHERE `nick` LIKE '{$target_nick}'");
$db->query("UPDATE `users` SET `online` = 0 WHERE `nick` LIKE '{$target_nick}'");
$db->query("UPDATE `users` SET `ban_commander` = '{$commander}' WHERE `nick` LIKE '{$target_nick}'");
if(!isset($part[2]))
{
	send("{$emoji['banned']} Użytkownik {$target_nick} został zbanowany przez {$commander}.", getUsers('online', 'gg'));
	send("{$emoji['banned']} Zostałeś zbanowany przez {$commander}.", $target_gg);
	die();
}
else
{
	unset($part[0]);
	unset($part[1]);
	$reason = implode(' ', $part);
	$db->query("UPDATE `users` SET `ban_reason` = '{$reason}' WHERE `nick` LIKE '{$target_nick}'");
	send("{$emoji['banned']} Użytkownik {$target_nick} został zbanowany przez {$commander}.\nPowód: {$reason}", getUsers('online', 'gg'));
	send("{$emoji['banned']} Zostałeś zbanowany przez {$commander}.\nPowód: {$reason}", $target_gg);
	die();
}
?>