    <?php
    $page_title = "projet";
    include "header.php";

    $error = false;
    $ok_project = "project.php";
    $not_ok_project = "project.php";

    use Cloudinary\Api\Upload\UploadApi;

    if (!empty($_POST["direction"])) {

        switch ($_POST["direction"]) {
            case 'create':

                if (empty($_POST["project_title"])) {
                    $error = "no_project_title";
                };

                if (empty($_POST["project_description"])) {
                    $error = "no_project_description";
                }

                if (empty($_POST["project_categories"])) {
                    $error = "no_categories_selected";
                }

                if (!empty($_FILES["project_img"]["tmp_name"])) {

                    if ($_FILES["project_img"]["size"] > 5000000) {

                        $error = "invalid_file_size";
                        header("location: $not_ok_project?error=$error");
                        die();
                    };

                    try {
                        $tmpFilePath = $_FILES["project_img"]["tmp_name"];
                        $upload = new UploadApi();

                        $picture_uid = uniqid("img_");

                        $options = [
                            'public_id' => $picture_uid,
                            'use_filename' => true,
                            'overwrite' => false,
                            'allowed_formats' => ['jpg', 'jpeg', 'png'],
                            'folder' => "pixeven/project_img"
                        ];

                        $result = $upload->upload($tmpFilePath, $options);

                        // echo "<pre/>";
                        // echo (json_encode($result, JSON_PRETTY_PRINT));
                        // echo "<pre/>";
                    } catch (\Throwable $e) {
                        // var_dump($e->getMessage());
                        $error = "image_format_not_allowed";
                    }
                } else {
                    $error = "no_file_downloaded";
                }

                if (!empty($error)) {
                    header("location: $not_ok_project?error=$error");
                    die();
                }

                $title = htmlspecialchars($_POST["project_title"]);
                $picture = $result["secure_url"];
                $description = htmlspecialchars($_POST["project_description"]);
                $categories = implode(",", $_POST["project_categories"]);
                $slug = "project" . "-" . "$title";

                if (empty($error)) {
                    try {
                        $create_project = $db->prepare("INSERT INTO projects (
                            title,
                            picture, 
                            picture_uid,
                            description, 
                            categories,
                            slug
                            ) VALUES (
                            :title,
                            :picture,
                            :picture_uid,
                            :description,
                            :categories,
                            :slug
                        )");

                        $create_project->execute([
                            'title' => $title,
                            'picture' => $picture,
                            'picture_uid' => $picture_uid,
                            'description' => $description,
                            'categories' => $categories,
                            'slug' => $slug
                        ]);
                    } catch (PDOException $e) {
                        // echo $error_db;
                        // var_dump($e);
                        header("location: $not_ok_project?error=$error_db");
                        die();
                    }

                    header("location: $ok_project");
                } else {
                    header("location: $not_ok_project?error=$error");
                };
                break;


            case 'modify':

                if (empty($_POST["project_title"])) {
                    $error = "no_project_title";
                }

                if (empty($_POST["project_categories"])) {
                    $error = "no_categories_selected";
                }

                if (empty($_POST["project_description"])) {
                    $error = "no_project_description";
                }

                if (empty($_POST["project_id"])) {
                    $error = "cant_find_var";
                }

                if (!empty($error)) {
                    header("location:$not_ok_project?error=$error");
                    die();
                }

                $id = $_POST["project_id"];

                try {
                    $get_project = $db->query("SELECT * FROM projects WHERE projects.id = $id");
                    $result_get_project = $get_project->fetch(PDO::FETCH_ASSOC);
                } catch (\PDOException $e) {
                    var_dump($error_db);
                    die();
                }

                $picture_uid = $result_get_project["picture_uid"];

                if (!empty($_FILES["project_img"]["tmp_name"])) {

                    if ($_FILES["project_img"]["size"] <= 5000000) {

                        try {
                            // Chemin temporaire du fichier uploadé
                            $tmpFilePath = $_FILES["project_img"]["tmp_name"];
                            $upload = new UploadApi();

                            // Options
                            $options = [
                                'public_id' => $picture_uid,
                                'use_filename' => false,
                                'overwrite' => true,
                                'allowed_formats' => ['jpg', 'jpeg', 'png'],
                                'folder' => "pixeven/project_img",
                            ];

                            $result = $upload->upload($tmpFilePath, $options);
                            $picture = $result["secure_url"];

                            // echo "<pre/>";
                            // echo (json_encode($result, JSON_PRETTY_PRINT));
                            // echo "<pre/>";
                        } catch (\Throwable $e) {
                            // var_dump($e->getMessage());
                            $error = "image_format_not_allowed";
                        }
                    }
                }

                if (!empty($error)) {
                    header("location: $not_ok_project?error=$error");
                    die();
                } else {

                    empty($picture) && $picture = $result_get_project["picture"];
                    $title = htmlspecialchars($_POST["project_title"]);
                    $description = htmlspecialchars($_POST["project_description"]);
                    $categories = implode(",", $_POST["project_categories"]);
                    $slug = "project" . "-" . "$title";
                    $last_modification = date("Y-m-d H:i:s");

                    try {
                        $update_project = $db->prepare(
                            "UPDATE 
                                projects 
                            SET 
                                title = :title,
                                picture = :picture,
                                description = :description,
                                categories = :categories,
                                slug = :slug,
                                last_modification = :last_modification
                            WHERE 
                                projects.id = :id"
                        );

                        $update_project->execute([
                            'title' => $title,
                            'picture' => $picture,
                            'description' => $description,
                            'categories' => $categories,
                            'slug' => $slug,
                            'last_modification' => $last_modification,
                            'id' => $id
                        ]);
                    } catch (PDOException $e) {
                        header("location: $not_ok_project?error=$error_db");
                        die();
                    }

                    header("location: $ok_project");
                }

                break;


            case "delete":

                if (empty($_POST["project_id"])) {
                    $error = "cant_find_var";
                    header("location:$not_ok_project?error=$error");
                    die();
                }

                $id = htmlspecialchars($_POST["project_id"]);

                try {
                    $deleted_project = $db->query(
                        "UPDATE 
                        projects 
                    SET 
                        projects.deleted = 1
                    WHERE 
                        projects.id = $id"
                    );
                } catch (PDOException $e) {
                    $error = "something_went_wrong_while_deleting_project";
                }

                if (empty($error)) {
                    header("location: $ok_project");
                    die();
                }

                header("location: $not_ok_project?error=$error");
                break;


            case 'restore':

                if (empty($_POST["project_id"])) {
                    $error = "cant_find_var";
                    header("location: $not_ok_project?error=$error");
                    die();
                }

                $id = htmlspecialchars($_POST["project_id"]);

                try {
                    $restore_project = $db->query(
                        "UPDATE 
                    projects
                SET 
                    deleted = 0
                WHERE 
                    projects.id = $id"
                    );
                } catch (\PDOException $e) {
                    var_dump($error_db);
                    header("location: $not_ok_project?error=$error");
                    die();
                }

                header("location:$ok_project");
                die();
                break;

            default:
        }
    }
    // Traiter si j'ai quelque chose .... !empty
    if (empty($_GET)) {

        try {
            $get_projects = $db->query(
                "SELECT
                -- Tout selectionner dans projects
                projects.*,
                -- Rassembler dans une chaine de caractère les categories.name
                GROUP_CONCAT(categories.name)
            FROM
                projects
                -- Chercher dans project_categories si il ya des categories_id
            INNER JOIN categories ON FIND_IN_SET(
                    categories.id,
                    projects.categories
                )
            GROUP BY
                projects.id
            
            ORDER BY 
            projects.id 
            DESC",

            );
            $result_get_projects = $get_projects->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $error_db;
            die();
        }
    ?>
        <div class="row">
            <?php foreach ($result_get_projects as $project) { ?>

                <div class="col-md-4 mb-2 ">
                    <a href="http://localhost/pixeven/dashboard/project.php?id=<?= $project["id"]; ?>">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <p class="mb-0 fw-bold"><?= htmlspecialchars($project["title"]); ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <?= $project["deleted"] === 0 ? "<p class='visible fw-bold mb-0'>Visible</p>" : "<p class='deleted fw-bold mb-0'>Non visible</p>" ?>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body text-center">
                                <img src="<?= $project["picture"] ?>" alt="photo d'un projet créer" class="consult_projects_picture">
                                <p>Catégories :</p>
                                <p><?= htmlspecialchars($project["GROUP_CONCAT(categories.name)"]);  ?></p>
                            </div>
                        </div>
                    </a>

                    <?php if ($project["deleted"] === 1) { ?>

                        <form action="project.php" method="POST" class="col-md-12 d-flex justify-content-center">

                            <input type="hidden" name="direction" value="restore">
                            <input type="hidden" name="project_id" value="<?= $project["id"]; ?>">
                            <button type="submit" class="btn btn-success mt-1">Restaurer</button>

                        </form>

                    <?php } ?>
                </div>

            <?php }  ?>
        </div>

    <?php }

    // Verifier si getid 
    if (!empty($_GET["id"])) {

        if (!empty($_GET["id"])) {
            $project_id = (int) htmlspecialchars($_GET["id"]);
        } else {
            $error = "invalid_project_id";
            header("location:$not_ok_project?error=$error");
            die();
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
            header("location: $not_ok_project?error=$error_db");
            die();
        }

        if (empty($result_get_project["id"])) {
            $error = "invalid_project_id";
            header("location:$not_ok_project?error=$error");
            die();
        }

        try {
            $get_categories = $db->query("SELECT * FROM categories");
            $result_get_categories = $get_categories->fetchALL(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("location: $not_ok_project?error=$error_db");
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
                    <?php foreach ($result_get_categories as $category) {
                        if ($category["deleted"] === 0) { ?>

                            <option <?php if (str_contains($result_get_project["categories"], $category["id"])) { ?> selected <?php } ?> value="<?= $category["id"] ?>" id="categories_<?= $category["id"] ?>">
                                <?= $category["name"] ?>
                            </option>

                    <?php }
                    } ?>
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

                <div class="text-center col-md-12" id="target_data_container" data-title="<?= htmlspecialchars($result_get_project["title"]) ?>">

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

    <?php }

    include "footer.php" ?>