<?php
function getUsers($who, $mode)
{
	extract($GLOBALS);
	if(!isset($mode) || !$mode || $mode == '') $mode = 'gg';
	$users = array();
	$users_query = $db->query("SELECT * FROM `users` WHERE `{$who}` = 1");
	while($users_gathered = $users_query->fetch_assoc()) $users[] = $users_gathered[$mode];
	//$users_string = implode(',', $users);
	return $users;
}
function staffRequired($staff)
{
	extract($GLOBALS);
	if($user_record['staff'] < $staff) die("{$emoji['no_entry']} Nie posiadasz wystarczających uprawnień do wykonania tej komendy.");
}
function status($description, $status)
{
	extract($GLOBALS);
	$status = str_replace(1, STATUS_BACK, $status);
	$status = str_replace(2, STATUS_FFC, $status);
	$status = str_replace(3, STATUS_AWAY, $status);
	$status = str_replace(4, STATUS_DND, $status);
	$status = str_replace(5, STATUS_INVISIBLE, $status);
	$P->setStatus($description, $status);
}

function send($message, $recipient = '')
{
	extract($GLOBALS);
	//if(!isset($recipient) || !$recipient || $recipient == '') $recipient = $from;
	$M->addText($message);
	$M->setRecipients($recipient);
	$P->push($M);
	$M->clear();
}

?>