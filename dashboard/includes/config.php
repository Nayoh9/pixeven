    <?php
    // DB connexion
    $user = 'root';
    $pass = 'y';
    $host = "localhost";
    try {
        $db = new PDO("mysql:host=$host;dbname=tp_5", $user, $pass);
    } catch (PDOException $e) {
        die("Error connexion to DB");
        // e->getmessage()
    }

    $error_db = "error_no_results_found";
