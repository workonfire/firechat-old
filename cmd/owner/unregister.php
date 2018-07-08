<?php
require_once("functions.php");
include_once("emoji.php");
staffRequired(4);
if(!isset($part[1])) die("{$emoji['warn']} Podaj wymagane argumenty (nick).");
$user_select_query = $db->query("SELECT * FROM `users` WHERE `nick` LIKE '{$part[1]}' LIMIT 1");
if($user_select_query->num_rows == 0) die("{$emoji['warn']} Taki użytkownik nie istnieje.");
while($select_result = $user_select_query->fetch_assoc()) $target_gg = $select_result['gg'];
$db->query("DELETE FROM `users` WHERE `users`.`gg` = {$target_gg}");
die("{$emoji['trash']} Użytkownik {$part[1]} został usunięty z bazy danych.");
?>