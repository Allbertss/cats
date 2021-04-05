<?php
	$N = $_GET['N'];

	if ($N <= 0)
		die('N has to be bigger than 0');
	if ($N > 1000000)
		die('N has to be less than 1000001');
?>