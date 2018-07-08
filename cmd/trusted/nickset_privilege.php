<?php
require_once("functions.php");
include_once("emoji.php");
staffRequired(2);
if(!isset($part[1]) OR !isset($part[2])) die("{$emoji['warn']} Podaj wymagane argumenty (nick, tak/nie).");
$user_select_query = $db->query("SELECT * FROM `users` WHERE `nick` LIKE '{$part[1]}' LIMIT 1");
if($user_select_query->num_rows == 0) die("{$emoji['warn']} Taki użytkownik nie istnieje.");
while($select_result = $user_select_query->fetch_assoc()) $target_gg = $select_result['gg'];
if($part[2] == 'tak')
{
	$db->query("UPDATE `users` SET `nick_set` = 0 WHERE `nick` LIKE '{$part[1]}'");
	send("{$emoji['info']} {$user_record['nick']} umożliwił ci ponowną zmianę nicku.", $target_gg);
}
elseif($part[2] == 'nie')
{
	$db->query("UPDATE `users` SET `nick_set` = 1 WHERE `nick` LIKE '{$part[1]}'");
	send("{$emoji['info']} {$user_record['nick']} uniemożliwił ci dokonania ponownej zmiany nicku.", $target_gg);
}
#send("{$emoji['info']} {$user_record['nick']} umożliwił ci ponowną zmianę nicku.", $target_gg);
die("{$emoji['checkmark']} Uprawnienia zostały pomyślnie zaktualizowane.");
?>