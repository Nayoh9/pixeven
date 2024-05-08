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

    <form method="POST" action="project.php" class="row new_project_form d-flex flex-column align-items-center" enctype="multipart/form-data">

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

        <div class="col-md-6">
            <label class="form-label" for="project_img">Photo du projet</label>
            <input type="file" class="form-control" id="project_img" name="project_img" accept="image/png, image/jpeg, image/jpg, video/mp4" required>
            <p class="fs-6 fw-bold text-center mb-0">Taille maximum du fichier : 5 MO</p>
        </div>

        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Créer le projet</button>
        </div>
    </form>

    <?php include "footer.php"; ?>