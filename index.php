<?php
	$N = $_GET['N'];

	if ($N <= 0)
		die('N has to be bigger than 0');
	if ($N > 1000000)
		die('N has to be less than 1000001');

	$redis = new Redis();
	try {
		$connectedRedis = $redis->connect(HOSTNAME, PORT);
		if (!$connectedRedis)
			throw new Exception();
	} catch (Exception $exception) {
			die($exception->getMessage());
	}

	//$redis->flushall(); // deletes all counts & cache
	$redis->close();
?>