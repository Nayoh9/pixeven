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
    // Gestion des erreurs de requête
    echo "Erreur de requête : " . $e->getMessage();
    die();
}

?>

<div class="row ">
    <?php foreach ($result_get_projects as $project) { ?>
        <div class="col-md-4 text-center ">
            <p><?= $project["id"] ?></p>
            <p><?= htmlspecialchars($project["title"]); ?></p>
            <img src="<?= $project["picture"] ?>" alt="photo d'un projet créer" class="consult_projects_picture">
            <p>Catégories :</p>
            <p><?= htmlspecialchars($project["GROUP_CONCAT(categories.name)"]);  ?></p>
        </div>
    <?php } ?>
</div>

<?php include "footer.php" ?>