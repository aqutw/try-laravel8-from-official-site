<?php 
$a = posix_getpwuid(posix_geteuid());
$username = $a['name'];
print_r($a);
