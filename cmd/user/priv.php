<?php
require_once("functions.php");
include_once("emoji.php");
echo "{$emoji['x']} Wystąpił błąd. Zalecane jest przekazanie poniższej treści błędu właścicielowi czatu w celu diagnostyki błędu.\n\nDodatkowe informacje: UWAGA UWAGA, TA KOMENDA NIE DZIAŁA JAK POWINNA.\n\n\n\n";
if(!isset($part[1]) OR !isset($part[2])) die("{$emoji['warn']} Podaj wymagane argumenty (nick, wiadomość).");
$nick = $part[1];
$user_select_query = $db->query("SELECT * FROM `users` WHERE `nick` LIKE '{$nick}' LIMIT 1");
if($user_select_query->num_rows == 0) die("{$emoji['warn']} Taki użytkownik nie istnieje.");
unset($part[0]);
unset($part[1]);
$message = implode(' ', $part);
while($select_result = $user_select_query->fetch_assoc())
{
	if($select_result['gg'] == $from) die("{$emoji['warn']} Nie możesz wysłać wiadomości prywatnej do siebie.");
	$target_gg = $select_result['gg'];
	$target_nick = $select_result['nick'];
}
//settype($target_gg, 'integer');
//echo var_dump($target_gg);
send("{$emoji['msg']} Wiadomość prywatna wysłana przez {$user_record['nick']}:\n".$message, $target_gg);
die("{$emoji['msg']} Wiadomość prywatna została dostarczona do {$target_nick}.");
?>