<?php
include 'includes/functions.php';

$ok_deleted_category = "consult_categories.php";
$not_ok_deleted_category = "consult_categories.php";

$error = false;

if (empty($_POST["project_values"])) {
    $error = "cant_find_var";
    header("location: $not_ok_deleted_category?error=$error");
    die();
}

$id = htmlspecialchars($_POST["project_values"]);

try {
    $get_category = $db->query("UPDATE categories
    SET 
        categories.deleted = 1 
    WHERE 
        categories.id = $id");
} catch (PDOException $e) {
    header("location: $not_ok_deleted_category?error=$error_db");
    die();
}

header("location:$ok_deleted_category");
