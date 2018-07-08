<?php
include_once("emoji.php");
$desc[1] = "Operator ({$emoji['operator']})";
$desc[2] = "Zaufany ({$emoji['trusted']})";
$desc[3] = "Administrator ({$emoji['admin']})";
$desc[4] = "Właściciel ({$emoji['owner']})";
echo "{$emoji['bag']} Obsługa czatu:\n";
$admins_query = $db->query("SELECT * FROM `users` WHERE `staff` > 0 AND `staff` < 5 ORDER BY `staff` DESC");
while($admins = $admins_query->fetch_assoc()) echo "| {$admins['nick']} - {$desc[$admins['staff']]}\n";
die();
?>