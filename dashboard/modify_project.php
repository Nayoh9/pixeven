    <?php
    $page_title = "Mon projet";
    $not_ok_modify_project = "consult_projects.php";
    include "header.php";

    $project_id = htmlspecialchars($_GET["id"]);

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
        var_dump($error_db);
        die();
    }

    if (empty($result_get_project["id"])) {
        $error = "invalid_project_id";
        header("location: consult_project.php?error=$error");
    }

    try {
        $get_categories = $db->query("SELECT * FROM categories");
        $result_get_categories = $get_categories->fetchALL(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        var_dump($error_db);
        die();
    }

    // To recover the picture and project id for the check
    $project_values = $result_get_project["id"] . ',' . $result_get_project["picture_uid"] . "," . $result_get_project["picture"];
    ?>

    <div class="row d-flex justify-content-center project">
        <div class="col-md-6">
            <form method="POST" id="modify_project_form" enctype="multipart/form-data">

                <div class="text-center">
                    <label for="project_title" class="form-label">Titre :</label>
                    <input class="form-control col-auto text-center" id="project_title" name="project_title" value="<?= htmlspecialchars($result_get_project["title"]); ?>">
                </div>

                <div class="text-center">
                    <div id="preview">
                        <img id="preview_child" class="project_picture" src="<?= $result_get_project["picture"]; ?>" alt="Photo d'un projet">
                    </div>
                    <input class="col-md-6 mt-2 form-control" name="project_img" type="file" id="file_to_upload" accept="image/png, image/jpeg, image/jpg">
                </div>

                <div class="text-center">
                    <p>Catégories :</p>
                    <p><?= htmlspecialchars($result_get_project["GROUP_CONCAT(categories.name)"]);  ?></p>
                </div>

                <select class="categories_list form-select mb-3" aria-label="multiple select example" size="3" name="project_categories[]" multiple>
                    <?php foreach ($result_get_categories as $category) { ?>
                        <option <?php if (str_contains($result_get_project["categories"], $category["id"])) { ?> selected <?php } ?> value="<?= $category["id"] ?>" id="categories_<?= $category["id"] ?>">
                            <?= htmlspecialchars($category["name"]) ?>
                        </option>
                    <?php } ?>
                </select>

                <div class="text-center mb-3 ">
                    <textarea type="" class="col-md-12" name="project_description" id="project_description" rows="15"><?= $result_get_project["description"]; ?></textarea>
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

                <div class="text-center col-md-12" id="project_data_container" data-title="<?= htmlspecialchars($result_get_project["title"]) ?>">

                    <!-- Button trigger modal -->
                    <button type="button" id="delete_button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Effacer le projet
                    </button>

                    <button type="button" id="modify_button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" name="project_id">
                        Modifier le projet
                    </button>
            </form>
        </div>
    </div>
    </div>

    <?php include "footer.php" ?>