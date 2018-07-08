<?php
include_once("emoji.php");
if($user_record['vanish'] == 1) echo "{$emoji['door']} Wylogowałeś się z czatu na trybie niewidocznym.";
else echo "{$emoji['door']} Wylogowałeś się z czatu.";
$db->query("UPDATE `users` SET `online` = 0 WHERE `gg` = {$from}");
try
{
	if($user_record['vanish'] == 0) send("{$emoji['door']} {$user_record['nick']} wylogował się.", getUsers('online', 'gg'));
}
catch(Exception $e)
{
	// Nic
}
die();
?>