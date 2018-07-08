<?php
require_once("functions.php");
include_once("emoji.php");
staffRequired(2);
if(!isset($part[1]) OR !isset($part[2])) die("{$emoji['warn']} Podaj wymagane argumenty (poprzedni nick, nowy nick).");
$old_nick = $part[1];
$new_nick = $part[2];
$user_select_query = $db->query("SELECT * FROM `users` WHERE `nick` LIKE '{$old_nick}' LIMIT 1");
if($user_select_query->num_rows == 0) die("{$emoji['warn']} Taki użytkownik nie istnieje.");
$commander = $user_record['nick'];
$db->query("UPDATE `users` SET `nick` = '{$new_nick}' WHERE `nick` LIKE '{$old_nick}'");
send("{$emoji['info']} {$commander} zmienił nick użytkownikowi {$old_nick} na {$new_nick}.", getUsers('online', 'gg'));
?>