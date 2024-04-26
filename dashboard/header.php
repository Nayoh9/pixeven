<?php include "includes/functions.php"; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/dashboard.css">
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <header class="row">
                <h1 class="col-md-12 text-center"><?= $page_title ?></h1>
                <div class="col-md-12 d-flex justify-content-center">
                    <ul class="col-auto list-group flex-row flex-wrap ">
                        <li class="col-auto"> <a href="create_project.php">Ajouter un projet</a></li>
                        <li class="col-auto"><a href="create_category.php">Ajouter une catégorie</a></li>
                        <li class="col-auto"> <a href="consult_projects.php">Consulter mes projets</a></li>
                        <li class="col-auto"><a href="consult_categories.php">Consulter mes categories</a></li>
                        <li class="col-auto"><a href="settings.php">Mes paramètres</a></li>
                    </ul>
                </div>
            </header>



            <?php
            if (!empty($_GET["error"])) {
                $error = htmlspecialchars(parse_error($_GET["error"]));
            ?>
                <div class="col-md-12 text-center d-flex justify-content-center mt-2">
                    <div class="col-md-4 alert alert-danger">
                        <p class="m-0"><?php echo $error; ?></p>
                    </div>
                </div>


            <?php } ?>