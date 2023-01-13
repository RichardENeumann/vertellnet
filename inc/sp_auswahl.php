<?php
$_GET['bst'] = isset($_GET['bst'])? $_GET['bst'] : 'a';
$_GET['spr'] = isset($_GET['spr']) ? $_GET['spr'] : 'hoog' ;

printf("<a href=\"?spr=hoog&bst=%s\">hoog</a> - ", $_GET['bst']);
printf("<a href=\"?spr=plat&bst=%s\">plat</a> ", $_GET['bst']);
?>