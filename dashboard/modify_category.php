<?php
$page_title = "Ma catégorie";
include "header.php";

$error = false;

if (!empty($_GET["id"])) {
    $category_id = htmlspecialchars($_GET["id"]);
} else {
    $error = "invalid_category_id";
    header("location: consult_categories.php?error=$error");
}

try {
    $get_category = $db->query("SELECT * FROM categories WHERE categories.id =$category_id;");
    $result_get_category = $get_category->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    var_dump($error_db);
    header("location: consult_categories.php?error=$error_db");
}

if (empty($result_get_category["id"])) {
    $error = "invalid_category_id";
    header("location: consult_categories.php?error=$error");
    exit();
}

$project_values = $result_get_category["id"];

?>

<div class="row justify-content-center">
    <form method="POST" id="modify_target_form" class="col-md-6">

        <div class="mb-5 mt-5">
            <label for="category_name" class="form-label">Nom de la catégorie :</label>
            <input type="text" id="category_name" name="category_name" class="form-control" value="<?= $result_get_category["name"]; ?>" required>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" id="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" id="modal-save" name="project_values" value="<?= $project_values; ?>"></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center col-md-12" id="project_data_container" data-title="<?= htmlspecialchars($result_get_category["name"]) ?>">
            <!-- Button trigger modal -->

            <button type="button" id="delete_button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Effacer la catégorie
            </button>

            <button type="button" id="modify_button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" name="project_id">
                Modifier la catégorie
            </button>
        </div>
    </form>
</div>

<?php include "footer.php"; ?>