<?php
mysql_connect($db_host, $db_user, $db_pass);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");
mysql_select_db($db_db);
?>
