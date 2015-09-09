<?php
if ($_SERVER['SERVER_NAME'] == 'ubuntu.casa') {
	return array(
		'dir-action' => __DIR__.'/../src/Controller/action/',
		'dir-view' => __DIR__.'/../src/view/',
		'dir-cache' => __DIR__.'/../data/cache/',
		'dirPublic' => '/code.education/di-service-container/public/',

		'dbhost'        => 'localhost',
		'dbname'        => 'di-service-container',
		'dbuser'        => 'minello',
		'dbpassword'    => 'camarao',
	);
} else {
	return array(
		'dir-action' => __DIR__.'/../src/Controller/action/',
		'dir-view' => __DIR__.'/../src/view/',
		'dir-cache' => __DIR__.'/../data/cache/',
		'dirPublic' => '/',

		'dbhost'        => '',
		'dbname'        => 'di-service-container',
		'dbuser'        => '',
		'dbpassword'    => '',
	);
}