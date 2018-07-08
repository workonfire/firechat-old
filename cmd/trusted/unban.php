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
	if($select_result['gg'] == $from) die("{$emoji['warn']} Nie możesz odbanować samego siebie.");
	if($select_result['banned'] == 0) die("{$emoji['info']} Ten użytkownik nie ma bana.");
	$target_gg = $select_result['gg'];
	$target_nick = $select_result['nick'];
}
$commander = $user_record['nick'];
$db->query("UPDATE `users` SET `banned` = 0 WHERE `nick` LIKE '{$target_nick}'");
$db->query("UPDATE `users` SET `ban_commander` = '' WHERE `nick` LIKE '{$target_nick}'");
$db->query("UPDATE `users` SET `ban_reason` = '' WHERE `nick` LIKE '{$target_nick}'");
send("{$emoji['unbanned']} Użytkownik {$target_nick} został odbanowany przez {$commander}.", getUsers('online', 'gg'));
send("{$emoji['unbanned']} Zostałeś odbanowany przez {$commander}.", $target_gg);
die();
?>