    <?php
    include "includes/functions.php";

    $ok_check_category = "index.php";
    $not_ok_check_category = "create_category.php";

    $error = false;

    if (empty($_POST["category_name"])) {
        $error = "invalid_category_name";
        header("location:$not_ok_check_category?error=$error");
        die();
    }

    $name = $_POST["category_name"];

    try {
        $create_category = $db->prepare("INSERT INTO categories (
        name
    ) VALUES (
        :name
    )");
        $create_category->execute([
            'name' => $name
        ]);
    } catch (PDOException $e) {
        header("location: $not_ok_check_category?error=$error_db");
        die();
    }

    header("location: $ok_check_category");
