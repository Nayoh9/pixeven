    <?php
    require_once __DIR__ . '../../../vendor/autoload.php';

    $error_db = "error_no_results_found";

    // **Dotenv config**

    // Chemin vers le fichier .env
    $dotenvPath = __DIR__ . '/../../.env';

    // Charger les variables d'environnement depuis le fichier .env
    $dotenv = Dotenv\Dotenv::createImmutable(dirname($dotenvPath));
    $loaded = $dotenv->load();

    // var_dump($loaded);

    $cloudinary_api_key = getenv('CLOUDINARY_API_KEY');
    $cloudinary_api_secret = getenv('CLOUDINARY_API_SECRET');
    $cloudinary_cloud_name = getenv('CLOUDINARY_CLOUD_NAME');

    var_dump(getenv('CLOUDINARY_API_KEY'));
    die();


    // **Dotenv config**


    // **DB connexion** //

    $user = 'root';
    $pass = 'y';
    $host = "localhost";
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
    Configuration::instance('cloudinary://397588225888239:e_Y8joQRZWZVUiV3sXNiaLQZ_Pw@dwkwlok28?secure=true');

    // **Cloudinary config**
