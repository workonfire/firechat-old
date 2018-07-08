<?php
staffRequired(3);
send("{$emoji['info']} {$user_record['nick']} wyrzucił wszystkich użytkowników z czatu.", getUsers('online', 'gg'));
$db->query("UPDATE `users` SET `online` = 0 WHERE `online` = 1 AND `gg` != {$user_record['gg']}");
die();
?>