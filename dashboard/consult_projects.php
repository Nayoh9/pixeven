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
    <?php foreach ($result_get_projects as $project) {
        if ($project["deleted"] === 0) { ?>
            <div class="col-md-4 mb-2 ">
                <a href="http://localhost/pixeven/dashboard/modify_project.php?id=<?= $project["id"]; ?>">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-0 fw-bold"><?= htmlspecialchars($project["title"]); ?></p>
                                </div>
                                <div class="col-auto">
                                    ETAT
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
            </div>
    <?php }
    } ?>
</div>

<?php include "footer.php" ?>