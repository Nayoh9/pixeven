    <?php
    $page_title = "categorie";
    include "header.php";

    $error = false;

    $ok_category = "category.php";
    $not_ok_category = "category.php";


    if (!empty($_POST["direction"])) {

        switch ($_POST["direction"]) {

            case 'create':

                if (empty($_POST["category_name"])) {
                    $error = "invalid_category_name";
                    header("location:$not_ok_category?error=$error");
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
                    header("location: $not_ok_category?error=$error_db");
                    die();
                }

                header("location: $ok_category");
                die();
                break;

            case "modify":

                if (empty($_POST["category_name"])) {
                    $error = "no_category_name";
                }

                if (empty($_POST["category_id"])) {
                    $error = "cant_find_var";
                }

                if (!empty($error)) {
                    header("location: $not_ok_category?error=$error");
                };

                $name = htmlspecialchars($_POST["category_name"]);
                $id = htmlspecialchars($_POST["category_id"]);

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
                    header("location: $not_ok_category?error=$error_db");
                    die();
                }

                header("location:$ok_category");
                die();

                break;

            case "delete":

                $error = false;

                if (empty($_POST["category_id"])) {
                    $error = "cant_find_var";
                    header("location: $not_ok_category?error=$error");
                    die();
                }

                $id = htmlspecialchars($_POST["category_id"]);

                try {
                    $get_category = $db->query("UPDATE categories
                    SET 
                        categories.deleted = 1 
                    WHERE 
                        categories.id = $id");
                } catch (PDOException $e) {
                    header("location: $not_ok_category?error=$error_db");
                    die();
                }

                header("location:$ok_category");
                die();

            case 'restore':

                if (empty($_POST["category_id"])) {
                    $error = "cant_find_var";
                    header("location: $not_ok_category?error=$error");
                    die();
                }

                $id = htmlspecialchars($_POST["category_id"]);

                try {
                    $restore_category = $db->query(
                        "UPDATE 
                    categories
                SET 
                    deleted = 0
                WHERE 
                    categories.id = $id"
                    );
                } catch (\PDOException $e) {
                    var_dump($error_db);
                    header("location: $not_ok_category?error=$error");
                    die();
                }

                header("location:$ok_category");
                die();

                break;

            default:
        }
    }







    if (empty($_GET)) {
        try {
            $get_categories = $db->query("SELECT * FROM categories ORDER BY categories.name");
            $result_get_categories = $get_categories->fetchALL(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($error_db);
            die();
        }
    ?>

        <div class="row">
            <div class="col-md-12 d-flex flex-wrap">
                <?php foreach ($result_get_categories as $category) { ?>
                    <div class="card col-md-4 mb-3">
                        <div class="card-header">
                            <div>
                                <?= $category["deleted"] === 0 ? "<p class='visible fw-bold mb-0'>Visible</p>" : "<p class='deleted fw-bold mb-0'>Non visible</p>" ?>
                            </div>
                        </div>
                        <a href="category.php?id=<?= htmlspecialchars($category["id"]) ?>">
                            <div class="card-body">
                                <p class="mb-0"><?= $category["name"] ?></p>
                            </div>
                        </a>

                        <?php if ($category["deleted"] === 1) { ?>

                            <form action="category.php" method="POST" class="col-md-12 d-flex justify-content-center">

                                <input type="hidden" name="direction" value="restore">
                                <input type="hidden" name="category_id" value="<?= $category["id"]; ?>">
                                <button type="submit" class="btn btn-success mt-1">Restaurer</button>

                            </form>

                        <?php } ?>
                    </div>
                <?php } ?>
            </div>


        <?php } else if ($_GET["id"]) {

        if (!empty($_GET["id"])) {
            $category_id = htmlspecialchars($_GET["id"]);
        } else {
            $error = "invalid_category_id";
            header("location: $not_ok_category.php?error=$error");
            die();
        }

        try {
            $get_category = $db->query("SELECT * FROM categories WHERE categories.id =$category_id;");
            $result_get_category = $get_category->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            var_dump($error_db);
            header("location: $not_ok_category.php?error=$error_db");
            die();
        }

        if (empty($result_get_category["id"])) {
            $error = "invalid_category_id";
            header("location: $not_ok_category.php?error=$error");
            die();
        }

        $category_id = $result_get_category["id"];
        ?>

            <div class="row justify-content-center">

                <form method="POST" id="modify_target_form" class="col-md-6">

                    <input type="hidden" name="direction" id="direction" value="">
                    <input type="hidden" name="category_id" value="<?= $category_id; ?>">


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
                                    <button type="submit" id="modal-save"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center col-md-12" id="target_data_container" data-title="<?= htmlspecialchars($result_get_category["name"]) ?>">
                        <!-- Button trigger modal -->

                        <button type="button" id="delete_button" class="btn btn-danger mx-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Effacer la catégorie
                        </button>

                        <button type="button" id="modify_button" class="btn btn-primary mx-5" data-bs-toggle="modal" data-bs-target="#exampleModal" name="category_id">
                            Modifier la catégorie
                        </button>
                    </div>
                </form>
            </div>

        <?php }
    include "footer.php"; ?>