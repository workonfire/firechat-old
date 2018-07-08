<?php
require_once("functions.php");
include_once("emoji.php");
staffRequired(2);
//die("{$emoji['x']} Wystąpił błąd. Zalecane jest przekazanie poniższej treści błędu właścicielowi czatu w celu diagnostyki błędu.\n\nDodatkowe informacje: UWAGA UWAGA, TA KOMENDA NIE DZIAŁA JAK POWINNA.\n\n\n\n");
if(!isset($part[1])) die("{$emoji['warn']} Podaj wymagane argumenty (wiadomość).");
unset($part[0]);
$message = implode(' ', $part);
$users = array();
$users_query = $db->query("SELECT * FROM `users` WHERE `banned` = 0");
while($all_users = $users_query->fetch_assoc()) $users[] = $all_users['gg'];
send("{$emoji['msg']} Wiadomość wysłana do wszystkich użytkowników przez {$user_record['nick']}:\n\n{$message}", $users);
die();

?>