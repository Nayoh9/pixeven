<?php
require_once __DIR__ . '../../../vendor/autoload.php';

$template_url = "http://localhost/pixeven/portfolio/";
$error_db = "error_no_results_found";

// **Dotenv config**
$dotenvPath = __DIR__ . './../../.env';
$dotenv = Dotenv\Dotenv::createImmutable(dirname($dotenvPath));
$loaded = $dotenv->load();

// PDO env vars
$db_user = $_ENV["DB_USER"];
$db_pass = $_ENV["DB_PASS"];
$db_host = $_ENV["DB_HOST"];

// PHP MAILER env vars
$brevo_host = $_ENV["BREVO_HOST"];
$brevo_port = $_ENV["BREVO_PORT"];
$brevo_username = $_ENV["BREVO_USERNAME"];
$brevo_password = $_ENV["BREVO_PASSWORD"];

// **DB connexion** //
try {
    $db = new PDO("mysql:host=$db_host;dbname=pixeven", $db_user, $db_pass);
} catch (PDOException $e) {
    die("Error connexion to DB");
    // e->getmessage()
}
