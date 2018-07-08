<?php
//\\ DA //\\
//\\ WID //\\
//\\ W //\\
//\\ POTĘŻNEJ //\\
//\\ CZAPCE //\\
include_once("emoji.php");
$owner_commands = array_slice(scandir('./cmd/owner/'), 2);
$admin_commands = array_slice(scandir('./cmd/admin/'), 2);
$operator_commands = array_slice(scandir('./cmd/operator/'), 2);
$trusted_commands = array_slice(scandir('./cmd/trusted/'), 2);
$user_commands = array_slice(scandir('./cmd/user/'), 2);
echo "{$emoji['list']} Lista komend dostępnych dla ciebie:\n";
if(4 <= $user_record['staff'])
{
	foreach($owner_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
	foreach($admin_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
	foreach($operator_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
	foreach($trusted_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
	foreach($user_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
}
elseif(3 <= $user_record['staff'])
{
	foreach($admin_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
	foreach($operator_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
	foreach($trusted_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
	foreach($user_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
}
elseif(2 <= $user_record['staff'])
{
	foreach($operator_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
	foreach($trusted_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
	foreach($user_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
}
elseif(1 <= $user_record['staff'])
{
	foreach($operator_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
	foreach($user_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
}
elseif(0 == $user_record['staff'])
{
	foreach($user_commands as $f)
	{
		$cmd_name_array = explode('.', $f);
		$cmd_name = $cmd_name_array[0];
		echo "| /{$cmd_name}\n";
	}
}
die();
?>