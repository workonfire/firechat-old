<?php
if(!isset($part[1])) die("{$emoji['warn']} Podaj wymagane argumenty (wiadomość).");
unset($part[0]);
$msg = implode(' ', $part);
send("* {$user_record['nick']} {$msg}", getUsers('online', 'gg'));
?>