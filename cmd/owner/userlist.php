<?php
#send("Trwa pobieranie danych...", $from);
staffRequired(4);
echo "{$emoji['list']} Lista zarejestrowanych użytkowników:\n";
$users_query = $db->query("SELECT * FROM `users`");
while($users = $users_query->fetch_assoc()) echo "| {$users['nick']}\n";
die();
?>