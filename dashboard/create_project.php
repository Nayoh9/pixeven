    <?php
    $page_title = "Créer un nouveau projet";
    include "header.php";

    try {
        $get_categories = $db->query("SELECT * FROM categories");
        $result_get_categories = $get_categories->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        var_dump($error_db);
        die();
    }
    ?>

    <div class="row d-flex justify-content-center">
        <form method="POST" action="check_project.php" class="new_project_form col-md-6" enctype="multipart/form-data">

            <div class="col-md-12">
                <label class="form-label">Catégorie(s)</label>
                <select class="project_categories_list form-select" aria-label="multiple select example" size="3" name="project_categories[]" multiple required>
                    <?php foreach ($result_get_categories as $category) { ?>
                        <option value="<?= $category["id"] ?>" id="categories_<?= $category["id"] ?>"><?= htmlspecialchars($category["name"]) ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label" for="project_title">Titre du projet</label>
                <input type="text" placeholder="Goodtime.." class="form-control" id="project_title" name="project_title" required>
            </div>

            <div class="col-md-12">
                <label class="form-label">Description du projet</label>
                <textarea type="text" class="form-control" placeholder="Voici un nouveau design.." rows="15" name="project_description"></textarea>
            </div>

            <div class="col-md-12">
                <label class="form-label" for="project_img">Photo du projet</label>
                <input type="file" class="form-control" id="project_img" name="project_img" accept="image/png, image/jpeg, image/jpg" required>
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Créer le projet</button>
            </div>

        </form>

    </div>

    <?php include "footer.php"; ?>