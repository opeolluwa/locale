<?php


$database_name = $_ENV['DATABASE_NAME'];
$database_host = $_ENV['DATABASE_HOST'];
$database_username = $_ENV['DATABASE_USERNAME'];
$database_password = $_ENV['DATABASE_PASSWORD'];
$database_port = $_ENV['DATABASE_PORT'] ?? '3306';


echo " the database host is $database_host";