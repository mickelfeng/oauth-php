<?php

/**
 * Installs all tables in the mysql.sql file, using the default mysql connection
 * 安装服务器端的数据库
 */
include "./../../../../server/config.php";
$_db = $dbOptions;

/* Change and uncomment this when you need to: */
mysql_connect($_db["server"], $_db["username"],$_db["password"]);
if (mysql_errno())
{
	die(' Error '.mysql_errno().': '.mysql_error());
}
var_dump($_db["database"]);
mysql_select_db($_db["database"]);
$sql = file_get_contents(dirname(__FILE__) . '/mysql.sql');
$ps  = explode('#--SPLIT--', $sql);

foreach ($ps as $p)
{
	$p = preg_replace('/^\s*#.*$/m', '', $p);
	
	mysql_query($p);
	if (mysql_errno())
	{
		die(' Error '.mysql_errno().': '.mysql_error());
	}
}

?>
