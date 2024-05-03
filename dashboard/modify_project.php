    <?php
    $page_title = "Mon projet";
    $not_ok_modify_project = "consult_projects.php";
    include "header.php";

    if (!empty($_GET["id"])) {
        $project_id = htmlspecialchars($_GET["id"]);
    } else {
        $error = "invalid_project_id";
        header("location: consult_projects.php?error=$error");
    }

    try {
        $get_project = $db->query("SELECT
            projects.*,
            GROUP_CONCAT(categories.name) 
        FROM
            projects
        INNER JOIN categories ON FIND_IN_SET(
            categories.id,
            projects.categories
            )
        WHERE
            projects.id = $project_id");

        $result_get_project = $get_project->fetch(PDO::FETCH_ASSOC);
        $get_project->closeCursor();
    } catch (PDOException $e) {
        header("location: $not_ok_modify_project?error=$error_db");
        die();
    }

    if (empty($result_get_project["id"])) {
        $error = "invalid_project_id";
        header("location:$not_ok_modify_project?error=$error");
        die();
    }

    try {
        $get_categories = $db->query("SELECT * FROM categories");
        $result_get_categories = $get_categories->fetchALL(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        header("location: $not_ok_modify_project?error=$error_db");
        die();
    }

    // Necessary infomations sent via in the button form
    $project_id = $result_get_project["id"];

    ?>

    <div class="row d-flex justify-content-center project">
        <form method="POST" class="col-md-6" id="modify_target_form" enctype="multipart/form-data">

            <input type="hidden" name="direction" id="direction" value="">
            <input type="hidden" name="project_id" value="<?= $project_id; ?>">

            <div class="text-center">
                <label for="project_title" class="form-label">Titre :</label>
                <input class="form-control col-auto" id="project_title" name="project_title" value="<?= htmlspecialchars($result_get_project["title"]); ?>" required>
            </div>

            <div class="text-center">
                <label for="file_to_upload">
                    <div id="preview">
                        <img id="preview_child" class="form_img" src="<?= $result_get_project["picture"]; ?>" alt="Photo d'un projet">
                    </div>
                </label>

                <input class="col-md-6 mt-2 form-control" name="project_img" type="file" id="file_to_upload" accept="image/png, image/jpeg, image/jpg">
                <p class="fs-6 mb-0">Taille maximum du fichier 5 MO</p>
            </div>

            <div class="text-center">
                <p>Catégories :</p>
                <p><?= htmlspecialchars($result_get_project["GROUP_CONCAT(categories.name)"]);  ?></p>
            </div>

            <select class="project_categories_list form-select mb-3" aria-label="multiple select example" size="3" name="project_categories[]" multiple required>
                <?php foreach ($result_get_categories as $category) { ?>
                    <option <?php if (str_contains($result_get_project["categories"], $category["id"])) { ?> selected <?php } ?> value="<?= $category["id"] ?>" id="categories_<?= $category["id"] ?>">
                        <?= htmlspecialchars($category["name"]) ?>
                    </option>
                <?php } ?>
            </select>

            <div class="text-center mb-3 ">
                <textarea class="col-md-12" name="project_description" rows="15"><?= $result_get_project["description"]; ?></textarea>
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
                            <button type="submit" id="modal-save"></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center col-md-12" id="project_data_container" data-title="<?= htmlspecialchars($result_get_project["title"]) ?>">

                <!-- Button trigger modal -->
                <button type="button" id="delete_button" class="btn btn-danger mx-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Effacer le projet
                </button>

                <button type="button" id="modify_button" class="btn btn-primary mx-5" data-bs-toggle="modal" data-bs-target="#exampleModal" name="project_id">
                    Modifier le projet
                </button>

            </div>
        </form>
    </div>
    </div>

    <?php include "footer.php" ?>