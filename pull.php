<?php
// firechat 1.1.1 by workonfire (GG:542177)
$version = "1.1.1";

// Debugowanie
#error_reporting(E_ALL);

// Dołączanie bibliotek
require_once("api/MessageBuilder.php");
require_once("api/PushConnection.php");
require_once("config.php");
require_once("functions.php");
include_once("emoji.php");

// Ustalanie kluczowych zmiennych
$from = $_GET['from'];
$to = $_GET['to'];
$msg = file_get_contents("php://input");
$cmd = explode(' ', strtolower(str_replace(array('/', '.'), '', trim($msg))));
$cmd = $cmd[0];
$part = explode(' ', $msg);

// Łączenie z serwerem BotAPI i bazą danych
$M = new MessageBuilder();
$P = new PushConnection($_GET['to'], $BotAPI_login, $BotAPI_password);
$db = new mysqli($db_host, $db_login, $db_password, $db_basename);

// Sprawdzanie połączenia
if(!$db) die("{$emoji['no_entry']} Wystąpił problem z połączeniem się z bazą danych.");

// Rejestracja
$user = $db->query("SELECT * FROM `users` WHERE `gg` = {$from}");
if($user->num_rows == 0)
{	if($P->isBot($from)) die("{$emoji['x']} Rejestracja zakończyła się niepowodzeniem.");
	$db->query("INSERT INTO `users` (`gg`, `nick`, `online`, `staff`, `nick_set`) VALUES ({$from}, '{$from}', 0, 0, 0)");
	send("{$emoji['info']} Użytkownik {$from} zarejestrował się na czacie.", getUsers('online', 'gg'));
	die("{$emoji['info']} Rejestracja przebiegła pomyślnie. Użyj komendy /join, by się zalogować.");
}
else $user_record = $user->fetch_assoc();

// Ustalenie znaczków dla rang
switch($user_record['staff'])
{
	case '4': $staff_char = "{$emoji['owner']} "; break; // Właściciel
	case '3': $staff_char = "{$emoji['admin']} "; break; // Administrator
	case '2': $staff_char = "{$emoji['trusted']} "; break; // Zaufany
	case '1': $staff_char = "{$emoji['operator']} "; break; // Operator
	default: $staff_char = ''; break;
}

// Sprawdzenie, czy użytkownik jest zbanowany
if($user_record['banned'] == 1)
{
	if($user_record['ban_reason'] == '') die("{$emoji['banned']} Zostałeś zbanowany przez {$user_record['ban_commander']}.");
	else die("{$emoji['banned']} Zostałeś zbanowany przez {$user_record['ban_commander']}.\nPowód: {$user_record['ban_reason']}");
}

// Sprawdzenie, czy użytkownik jest zalogowany
if($user_record['online'] == 0)
{
	// Jeśli nie
	if($cmd !== 'join') die("{$emoji['info']} Nie jesteś zalogowany. Użyj komendy /join, by to zrobić.");
}
if($msg{0} != '/' AND $msg{0} != '.' AND $user_record['online'] == 1)
{
	// Jeśli tak
	$msg = implode(' ', $part);
	if($user_record['staff'] < 2)
	{
		$msg = str_ireplace(array('kurw', 'huj', 'jeb', 'pierd', 'cip', 'pizd', 'rucha'), '***', $msg);
	}
	if($user_record['afk'] == 1)
	{
		$db->query("UPDATE `users` SET `afk` = 0 WHERE `gg` = '{$user_record['gg']}'");
		send("{$emoji['sleep']} {$user_record['nick']} nie jest już AFK.", getUsers('online', 'gg'));
	}
	send("{$staff_char}{$user_record['nick']}: {$msg}", getUsers('online', 'gg'));
}
else
{
	
	$cmd_paths = array('cmd/owner/', 'cmd/admin/', 'cmd/operator/', 'cmd/trusted/', 'cmd/user/');
	if(file_exists($cmd_paths[0].$cmd.'.php')) include($cmd_paths[0].$cmd.'.php');
	elseif(file_exists($cmd_paths[1].$cmd.'.php')) include($cmd_paths[1].$cmd.'.php');
	elseif(file_exists($cmd_paths[2].$cmd.'.php')) include($cmd_paths[2].$cmd.'.php');
	elseif(file_exists($cmd_paths[3].$cmd.'.php')) include($cmd_paths[3].$cmd.'.php');
	elseif(file_exists($cmd_paths[4].$cmd.'.php')) include($cmd_paths[4].$cmd.'.php');
	else die("{$emoji['warn']} Komenda /{$cmd} nie istnieje.");
}
// $db->close();
?>