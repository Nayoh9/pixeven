    <?php
    require_once __DIR__ . '../../../vendor/autoload.php';

    $error_db = "error_no_results_found";

    // **Dotenv config**

    $dotenvPath = __DIR__ . '/../../.env';
    $dotenv = Dotenv\Dotenv::createImmutable(dirname($dotenvPath));
    $loaded = $dotenv->load();

    $cloudinary_api_key = $_ENV['CLOUDINARY_API_KEY'];
    $cloudinary_api_secret = $_ENV['CLOUDINARY_API_SECRET'];
    $cloudinary_cloud_name = $_ENV['CLOUDINARY_CLOUD_NAME'];

    // **Dotenv config**


    // **DB connexion** //

    $db_user = $_ENV["DB_USER"];
    $db_pass = $_ENV["DB_PASS"];
    $db_host = $_ENV["DB_HOST"];

    $user = $db_user;
    $pass = $db_pass;
    $host = $db_host;
    try {
        $db = new PDO("mysql:host=$host;dbname=pixeven", $user, $pass);
    } catch (PDOException $e) {
        die("Error connexion to DB");
        // e->getmessage()
    }

    // **DB connexion** //

    // **Cloudinary config**

    // Use the Configuration class 
    use Cloudinary\Configuration\Configuration;
    // Configure an instance of your Cloudinary cloud
    Configuration::instance("cloudinary://$cloudinary_api_key:" . "$cloudinary_api_secret@" . "$cloudinary_cloud_name" . "?secure=true");

    // **Cloudinary config**
