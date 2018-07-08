<?php
require_once("functions.php");
include_once("emoji.php");
if($user_record['online'] == 1) die("{$emoji['info']} Jesteś już zalogowany.");

/*
if($user_record['staff'] >= 2)
{
	$online_query = $db->query("SELECT * FROM `users` WHERE `online` = 1 AND `vanish` = 1");
	while($online = $online_query->fetch_assoc()) echo "| **VANISH** {$online['nick']}\n";
	$online_query = $db->query("SELECT * FROM `users` WHERE `online` = 1 AND `vanish` = 0");
	while($online = $online_query->fetch_assoc()) echo "| {$online['nick']}\n";
	die();
}
else
{
	$online_query = $db->query("SELECT * FROM `users` WHERE `online` = 1 AND `vanish` = 0");
	while($online = $online_query->fetch_assoc()) echo "| {$online['nick']}\n";
	die();
	#die("{$emoji['list']} Zalogowani użytkownicy:\n{$online_users_string}");
}
*/

else
{
	//$online_users_array = getUsers('online', 'nick');
	//$online_users_string = implode("\n| ", $online_users_array);
	$user_select_query = $db->query("SELECT * FROM `users` WHERE `online` = 1");
	if($user_record['vanish'] == 0 AND $user_select_query->num_rows !== 0) send("{$emoji['door']} {$user_record['nick']} zalogował się.", getUsers('online', 'gg'));
	try 
	{
		$db->query("UPDATE `users` SET `online` = 1 WHERE `gg` = {$from}");
		echo "{$emoji['door']} Zalogowałeś się na czat.\n\nZalogowani użytkownicy:\n";
		if($user_record['staff'] >= 2)
		{
			$online_query = $db->query("SELECT * FROM `users` WHERE `online` = 1 AND `vanish` = 1");
			while($online = $online_query->fetch_assoc()) echo "| **VANISH** {$online['nick']}\n";
			$online_query = $db->query("SELECT * FROM `users` WHERE `online` = 1 AND `vanish` = 0");
			while($online = $online_query->fetch_assoc()) echo "| {$online['nick']}\n";
			die();
		}
		else
		{
			$online_query = $db->query("SELECT * FROM `users` WHERE `online` = 1 AND `vanish` = 0");
			while($online = $online_query->fetch_assoc()) echo "| {$online['nick']}\n";
			die();
		}
	}
	catch(Exception $e)
	{
		echo "{$emoji['door']} Zalogowałeś się na czat.\n\nZalogowani użytkownicy: brak";
	}
	#echo "{$emoji['door']} Zalogowałeś się na czat.\n\nZalogowani użytkownicy:\n| {$online_users_string}";
	die();
}

?>