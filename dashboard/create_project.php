    <?php
    $page_title = "Créer un nouveau projet";
    include "header.php";
    include "includes/functions.php";

    try {
        $get_categories = $db->query("SELECT * FROM categories");
        $result_get_categories = $get_categories->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        var_dump($error_db);
        die();
    }
    ?>

    <form method="POST" action="project.php" class="row new_project_form d-flex flex-column align-items-center" enctype="multipart/form-data" id="valid_project_form">

        <input type="hidden" name="direction" value="create">

        <div class="col-md-6">
            <label class="form-label" for="project_title">Titre du projet</label>
            <input type="text" placeholder="Goodtime.." class="form-control" id="project_title" name="project_title" required>
            <p class="mb-0"></p>
        </div>

        <div class="col-md-6">
            <label class="form-label">Catégorie(s)</label>
            <select class="project_categories_list form-select" aria-label="multiple select example" size="3" name="project_categories[]" multiple required>
                <?php
                if (!empty($result_get_categories)) {
                    foreach ($result_get_categories as $category) {
                        if ($category["deleted"] === 0) { ?>
                            <option value="<?= $category["id"] ?>" id="categories_<?= $category["id"] ?>"><?= htmlspecialchars($category["name"]);  ?></option>
                <?php
                        }
                    }
                }
                ?>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label" for="project_hook">Courte description du projet</label>
            <input type="text" class="form-control" id="project_hook" name="project_hook" required>
        </div>

        <div class="col-md-8">
            <label class="form-label">Description du projet</label>
            <textarea type="text" class="form-control" placeholder="Voici un nouveau design.." rows="15" name="project_description"></textarea>
        </div>

        <div class="col-md-6 text-center ">
            <label for="project_link" class="form-label">Lien du projet</label>
            <input name="project_link" id="project_link" type="text" placeholder="lien de votre projet" class="form-control">
        </div>

        <div class="col-md-6 text-center">
            <label class="form-label" for="project_img">Photo de présentation du projet</label>
            <input type="file" class="form-control" id="project_img" name="project_img" accept="image/png, image/jpeg, image/jpg" required>
        </div>

        <div class="col-md-6 text-center">
            <label for="project_pictures" class="form-label">Photos du projet</label>
            <input type="file" class="form-control" id="project_pictures" name="project_pictures[]" accept="image/png, image/jpeg, image/jpg" multiple required>
        </div>

        <p class="fs-6 fw-bold text-center mb-0">Taille maximum des fichiers : 5 MO</p>

        <div class="col-md-6" id="files_container">

        </div>

        <div class="col-md-12 text-center">
            <button type="submit" id="valid_project_button" class="btn btn-primary">Créer le projet</button>
        </div>
    </form>

    <?php include "footer.php"; ?>