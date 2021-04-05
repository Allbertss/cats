<?php
	require 'settings.php';

	$date = new DateTime();
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

	if (!$redis->exists('countAll'))
		$redis->set('countAll', 1);
	else
		$redis->set('countAll', $redis->get('countAll') + 1);

	$countN = 'count' . $N;
	if (!$redis->exists($countN))
		$redis->set($countN, 1);
	else
		$redis->set($countN, $redis->get($countN) + 1);

	if (!$redis->exists($N)) {
		$breeds = explode("\n", file_get_contents('cats.txt'));
		$keys = array_rand($breeds, 3);
		$cats = [trim($breeds[$keys[0]]), trim($breeds[$keys[1]]), trim($breeds[$keys[2]])];
		$stringCats = $cats[0] . ', ' . $cats[1] . ', ' . $cats[2];
		$redis->setex($N, CACHE_TIME, $stringCats);
	}
	$cats = $redis->get($N);

	echo($cats);

	$cats = explode(',', $cats);
	$json = [
		'datetime' => $date->format('Y-m-d H:i:s'),
		'N' => $N,
		'Cats' => $cats,
		'countAll' => $redis->get('countAll'),
		'countN' => $redis->get($countN)
	];
	file_put_contents('log.txt', json_encode($json) . PHP_EOL, FILE_APPEND);

	//$redis->flushall(); // deletes all counts & cache
	$redis->close();
?>