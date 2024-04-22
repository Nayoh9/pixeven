<?php
$page_title = "Dashboard";
include "header.php"
?>


<div class="row">
    <div class="col-md-auto">

        <ul class="col-md-auto list-group mb-5  ">
            <li class="list-group-item col-auto "> <a href="create_project.php">Ajouter un projet</a></li>
            <li class="list-group-item col-auto ">Ajouter une catégorie</li>
        </ul>

        <ul class="col-md-auto list-group ">
            <li class="list-group-item col-auto "> <a href="consult_project.php">Consulter mes projets</a></li>
            <li class="list-group-item col-auto ">Consulter mes categories</li>
        </ul>
    </div>
</div>
<?php include "footer.php";
