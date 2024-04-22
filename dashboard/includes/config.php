    <?php
    require_once __DIR__ . '../../../vendor/autoload.php';

    $error_db = "error_no_results_found";

    // **Dotenv config**

    $dotenvPath = __DIR__ . '/../../.env';
    $dotenv = Dotenv\Dotenv::createImmutable(dirname($dotenvPath));
    $loaded = $dotenv->load();

    // Cloudinary env vars
    $cloudinary_api_key = $_ENV['CLOUDINARY_API_KEY'];
    $cloudinary_api_secret = $_ENV['CLOUDINARY_API_SECRET'];
    $cloudinary_cloud_name = $_ENV['CLOUDINARY_CLOUD_NAME'];

    // PDO en vars
    $db_user = $_ENV["DB_USER"];
    $db_pass = $_ENV["DB_PASS"];
    $db_host = $_ENV["DB_HOST"];

    // Tiny mce en vars
    $tiny_mce_key = $_ENV["TINY_MCE_KEY"];

    // **Dotenv config**


    // **DB connexion** //

    try {
        $db = new PDO("mysql:host=$db_host;dbname=pixeven", $db_user, $db_pass);
    } catch (PDOException $e) {
        die("Error connexion to DB");
        // e->getmessage()
    }

    // **DB connexion** //

    // **Cloudinary config**


    use Cloudinary\Configuration\Configuration;

    Configuration::instance("cloudinary://$cloudinary_api_key:" . "$cloudinary_api_secret@" . "$cloudinary_cloud_name" . "?secure=true");

    // **Cloudinary config**
