<?php
use Ramsey\Uuid\Uuid;

$database_name = $_ENV["DATABASE_NAME"];
$database_host = $_ENV["DATABASE_HOST"];
$database_username = $_ENV["DATABASE_USERNAME"];
$database_password = $_ENV["DATABASE_PASSWORD"];
$database_port = $_ENV["DATABASE_PORT"];

$pdo = new PDO(
    "mysql:host=" .
        $database_host .
        ";dbname=" .
        $database_name .
        ";port=" .
        $database_port,
    $database_username,
    $database_password,
);

$seeder = new \tebazil\dbseeder\Seeder($pdo);
$seeder_file_path = __DIR__ . "/../data/countries.json";

$count = (int) $pdo->query("SELECT COUNT(*) FROM country")->fetchColumn();

if ($count === 0) {
    try {
        $countries = file_get_contents($seeder_file_path);
        $countries = json_decode($countries, true);
        $countries = array_map(function ($row) {
            return [
                'identifier' =>  Uuid::uuid4()->toString(),
                'currency_code' => $row['code'],
                'currency_name' => $row['name'],
                'country_name'  => $row['country'],
                'country_code'  => $row['countryCode'],
                'country_flag'  => $row['flag'] ?? '',
            ];
        }, $countries);
        $seeder->table("country")->data($countries)->rowQuantity(count($countries));
        $seeder->refill();
    } catch (Exception $e) {
        echo "failed to load the contents of $seeder_file_path: " .
            $e->getMessage();
    }
}
