<?php
include_once("emoji.php");
echo "{$emoji['list']} Zalogowani użytkownicy:\n";
if($user_record['staff'] >= 2)
{
	$online_query = $db->query("SELECT * FROM `users` WHERE `online` = 1 AND `vanish` = 1");
	while($online = $online_query->fetch_assoc()) echo "| **VANISH** {$online['nick']}\n";
	$online_query = $db->query("SELECT * FROM `users` WHERE `online` = 1 AND `vanish` = 0 AND `afk` = 1");
	while($online = $online_query->fetch_assoc()) echo "| **AFK** {$online['nick']}\n";
	$online_query = $db->query("SELECT * FROM `users` WHERE `online` = 1 AND `vanish` = 0 AND `afk` = 0");
	while($online = $online_query->fetch_assoc()) echo "| {$online['nick']}\n";
	die();
}
else
{
	$online_query = $db->query("SELECT * FROM `users` WHERE `online` = 1 AND `vanish` = 0 AND `afk` = 1");
	while($online = $online_query->fetch_assoc()) echo "| **AFK** {$online['nick']}\n";
	$online_query = $db->query("SELECT * FROM `users` WHERE `online` = 1 AND `vanish` = 0 AND `afk` = 0");
	while($online = $online_query->fetch_assoc()) echo "| {$online['nick']}\n";
	die();
	#die("{$emoji['list']} Zalogowani użytkownicy:\n{$online_users_string}");
}
?>