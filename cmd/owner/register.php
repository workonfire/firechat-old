<?php
require_once("functions.php");
include_once("emoji.php");
staffRequired(4);
if(!isset($part[1])) die("{$emoji['warn']} Podaj wymagane argumenty (gg).");
if(!is_numeric($part[1])) die("{$emoji['warn']} Numer GG musi być liczbą.");
#$user_select_query = $db->query("SELECT * FROM `users` WHERE `nick` LIKE '{$part[1]}' LIMIT 1");
#if($user_select_query->num_rows == 0) die("{$emoji['warn']} Taki użytkownik nie istnieje.");
#while($select_result = $user_select_query->fetch_assoc()) $target_gg = $select_result['gg'];
$db->query("INSERT INTO `users` (`gg`, `nick`) VALUES ('{$part[1]}', '{$part[1]}')");
#die("{$emoji['trash']} Użytkownik {$part[1]} został usunięty z bazy danych.");
send("{$emoji['info']} Użytkownik {$part[1]} zarejestrował się na czacie.", getUsers('online', 'gg'));
die();
?>