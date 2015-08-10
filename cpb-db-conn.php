<?php
include("cpb-config.php");
mysql_pconnect(CPB_DB_HOSTNAME,CPB_DB_USERNAME,CPB_DB_PASSWORD);
/*Connect the database using utf8.*/
mysql_query("SET NAMES utf8");
mysql_select_db(CPB_DB_NAME);
?>