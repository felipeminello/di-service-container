<?php
if ($_SERVER['SERVER_NAME'] == '192.168.1.4') {
	return array(
		'dir-action' => __DIR__.'/../src/Controller/action/',
		'dir-view' => __DIR__.'/../src/view/',
		'dir-cache' => __DIR__.'/../data/cache/',
		'dirPublic' => '/code.education/di-service-container/public/',

		'dbhost'        => 'localhost',
		'dbname'        => 'di-service-container',
		'dbuser'        => 'root',
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