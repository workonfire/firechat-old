<?php
staffRequired(4);
$db->query("UPDATE `users` SET `online` = 1 WHERE `online` = 0 AND `banned` = 0");
send("{$emoji['info']} {$user_record['nick']} zalogował wszystkich użytkowników na czat.", getUsers('online', 'gg'));
die();
?>