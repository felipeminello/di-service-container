<?php
$host = 'localhost';
$dbname = 'di-service-container';
$user = 'root';
$password = 'camarao';

$db = new \PDO("mysql:host={$host};dbname={$dbname}", $user, $password);