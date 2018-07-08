<?php
require_once("functions.php");
include_once("emoji.php");
staffRequired(3);
if(!isset($part[1]) OR !isset($part[2])) die("{$emoji['warn']} Podaj wymagane argumenty (nick, ranga).");
$nick = $part[1];
$staff = $part[2];
if($staff > 4) die("{$emoji['warn']} Ranga musi mieć wartość mniejszą od czterech.");
//if(!is_numeric($staff)) die("{$emoji['warn']} Niepoprawny format rangi.");
$user_select_query = $db->query("SELECT * FROM `users` WHERE `nick` LIKE '{$nick}' LIMIT 1");
if($user_select_query->num_rows == 0) die("{$emoji['warn']} Taki użytkownik nie istnieje.");
while($select_result = $user_select_query->fetch_assoc())
{
	if($select_result['gg'] == $from) die("{$emoji['warn']} Nie możesz zmienić rangi samemu sobie.");
	if($user_record['staff'] < $select_result['staff']) die("{$emoji['warn']} Nie możesz nadać komuś rangi większej niż twoja.");
	$target_nick = $select_result['nick'];
}
$commander = $user_record['nick'];
$staff = str_replace('user', 0, $staff);
$staff = str_replace('operator', 1, $staff);
$staff = str_replace('trusted', 2, $staff);
$staff = str_replace('administrator', 3, $staff);
$staff = str_replace('owner', 4, $staff);
$db->query("UPDATE `users` SET `staff` = {$staff} WHERE `nick` LIKE '{$target_nick}'");
switch($staff)
{
	case 4: $permissions = "właściciela ({$emoji['owner']})"; break;
	case 3: $permissions = "administratora ({$emoji['admin']})"; break;
	case 2: $permissions = "zaufanego użytkownika ({$emoji['trusted']})"; break;
	case 1: $permissions = "operatora ({$emoji['operator']})"; break;
	default: $permissions = "zwykłego użytkownika"; break;
}
send("{$emoji['info']} Użytkownik {$target_nick} posiada teraz uprawnienia {$permissions}.", getUsers('online', 'gg'));
?>