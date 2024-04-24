<?php
$page_title = "Mes projets";
include "header.php";

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
        projects.id;"
    );
    $result_get_projects = $get_projects->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $error_db;
    die();
}
?>

<div class="row consult_project">
    <?php foreach ($result_get_projects as $project) {
        if ($project["deleted"] === 0) { ?>
            <div class="col-md-4 text-center ">
                <a href="http://localhost/pixeven/dashboard/modify_project.php?id=<?= $project["id"]; ?>">
                    <p><?= htmlspecialchars($project["title"]); ?></p>
                    <img src="<?= $project["picture"] ?>" alt="photo d'un projet créer" class="consult_projects_picture">
                    <p>Catégories :</p>
                    <p><?= htmlspecialchars($project["GROUP_CONCAT(categories.name)"]);  ?></p>
                </a>
            </div>
    <?php }
    } ?>
</div>

<?php include "footer.php" ?>