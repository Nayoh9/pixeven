    <?php
    include "includes/functions.php";

    $error = false;
    $ok_check_modified_category = "consult_categories.php";
    $not_ok_check_modified_category = "consult_categories.php";

    if (empty($_POST["category_name"])) {
        $error = "no_category_name";
    }

    if (empty($_POST["project_values"])) {
        $error = "cant_find_var";
    }

    if (!empty($error)) {
        header("location: $not_ok_check_modified_category?error=$error");
    };

    $name = htmlspecialchars($_POST["category_name"]);
    $id = htmlspecialchars($_POST["project_values"]["0"]);

    try {
        $update_category = $db->prepare("UPDATE categories
        SET 
            categories.name = :name
        WHERE 
            categories.id = $id
    ");

        $update_category->execute([
            'name' => $name
        ]);
    } catch (PDOException $e) {
        header("location: $not_ok_check_modified_category?error=$error_db");
        die();
    }

    header("location:$ok_check_modified_category");
