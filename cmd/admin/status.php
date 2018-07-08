<?php
require_once("functions.php");
include_once("emoji.php");
staffRequired(3);
//die("{$emoji['x']} Wystąpił błąd. Zalecane jest przekazanie poniższej treści błędu właścicielowi czatu w celu diagnostyki błędu.\n\nDodatkowe informacje: wymagane jest ponowne zdefiniowanie stałych odpowiadających za statusy GG w plikach biblioteki BotAPI.");
if(!isset($part[2])) $part[2] = '';
if(!isset($part[1])) die("{$emoji['warn']} Podaj wymagane argumenty (status, opis)."); 
$true_part = $part;
unset($true_part[0]);
unset($true_part[1]);
$description = implode(' ', $true_part);
status($description, $part[1]);
die("{$emoji['checkmark']} Status został pomyślnie zmieniony.");
?>