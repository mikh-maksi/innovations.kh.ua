<?php

mysql_connect($mysql['server'], $mysql['name'], $mysql['pass']);
mysql_select_db($mysql['db']);
mysql_query("SET NAMES utf8");
