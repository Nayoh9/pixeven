    <?php
    $page_title = "Mes categories";
    include "header.php";

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
                    <a href=" modify_category.php?id=<?= htmlspecialchars($category["id"]) ?>">
                        <div class="card-body">
                            <p class="mb-0"><?= htmlspecialchars($category["name"]) ?></p>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>

        <?php include "footer.php"; ?>