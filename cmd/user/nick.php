<?php
include_once("emoji.php");
if($user_record['nick_set'] == 1 AND $user_record['staff'] <= 2) die("{$emoji['no_entry']} Nie możesz zmienić swojego nicku drugi raz. Jeśli chcesz inny, poproś o zmianę kogoś z rangą.");
if(!isset($part[1])) die("{$emoji['warn']} Podaj wymagane argumenty (nick).");
$part[1] = str_replace(array('!', '@', '#', '*', '$', '<'), '', $part[1]);
$user_select_query = $db->query("SELECT * FROM `users` WHERE `nick` LIKE '{$part[1]}'");
if($user_select_query->num_rows >= 1) die("{$emoji['warn']} Ktoś już ma taki nick.");
$db->query("UPDATE `users` SET `nick` = '{$part[1]}' WHERE `gg` = {$from}");
$db->query("UPDATE `users` SET `nick_set` = 1 WHERE `gg` = {$from}");
send("{$emoji['info']} {$user_record['nick']} zmienił swój nick na {$part[1]}.", getUsers('online', 'gg'));
?>