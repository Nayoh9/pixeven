    <?php
    require_once __DIR__ . '../../../vendor/autoload.php';

    $error_db = "error_no_results_found";

    // Redirection forms
    $deleted_target;
    $modified_target;


    if (!empty($page_title)) {

        switch ($page_title) {
            case 'Mon projet':
                $deleted_target = "check_deleted_project.php";
                $modified_target = "check_modified_project.php";
                break;

            case 'Ma catégorie':
                $deleted_target = "check_deleted_category.php";
                $modified_target = "check_modified_category.php";
                break;

            default:
                $deleted_target;
                $modified_target;
                break;
        }
    }


    // **Dotenv config**

    $dotenvPath = __DIR__ . '/../../.env';
    $dotenv = Dotenv\Dotenv::createImmutable(dirname($dotenvPath));
    $loaded = $dotenv->load();

    // Cloudinary env vars
    $cloudinary_api_key = $_ENV['CLOUDINARY_API_KEY'];
    $cloudinary_api_secret = $_ENV['CLOUDINARY_API_SECRET'];
    $cloudinary_cloud_name = $_ENV['CLOUDINARY_CLOUD_NAME'];

    // PDO env vars
    $db_user = $_ENV["DB_USER"];
    $db_pass = $_ENV["DB_PASS"];
    $db_host = $_ENV["DB_HOST"];

    // Tiny mce env vars
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







    // {
    //     socials : {
    //         facebook : {
    //             title : facebook,
    //             icon: facebook.svg;
    //         }        
    //     }
    // }