    <?php
    $page_title = "Mes categories";
    include "header.php";

    try {
        $get_categories = $db->query("SELECT * FROM categories");
        $result_get_categories = $get_categories->fetchALL(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        var_dump($error_db);
        die();
    }
    ?>
    <div class="row consult_categories_categories_list">
        <div class="col-md-auto">
            <?php foreach ($result_get_categories as $category) {
                if ($category["deleted"] === 0) { ?>
                    <p> <a href="modify_category.php?id=<?= htmlspecialchars($category["id"]) ?>"><?= htmlspecialchars($category["name"]) ?></a></p>
            <?php }
            } ?>
        </div>
    </div>

    <?php include "footer.php"; ?>