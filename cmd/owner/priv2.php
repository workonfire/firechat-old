<?php
staffRequired(4);
echo "This command is strongly haunted. Please do not scare any of present ghosts, otherwise you'll die (probably).\n\n";
require_once("functions.php");
include_once("emoji.php");
if(!isset($part[1])) die("{$emoji['warn']} Podaj wymagane argumenty (nick, wiadomość).");
$nick = $part[1];
$user_select_query = $db->query("SELECT * FROM `users` WHERE `nick` LIKE '{$nick}' LIMIT 1");
if($user_select_query->num_rows == 0) die("{$emoji['warn']} Taki użytkownik nie istnieje.");
while($select_result = $user_select_query->fetch_assoc())
{
	$target_gg = $select_result['gg'];
	$target_nick = $select_result['nick'];
}
$commander = $user_record['nick'];
unset($part[0]);
unset($part[1]);
$message = implode(' ', $part);
send("{$emoji['info']} Wiadomość prywatna wysłana przez {$commander}:\n {$message}", $target_gg);
die("{$emoji['msg']} Wiadomość prywatna została dostarczona do {$target_nick}.");
?>