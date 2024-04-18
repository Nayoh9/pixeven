<?php
$page_title = "Créer un nouveau projet";
include "header.php"
?>

<div class="row d-flex justify-content-center">
    <form method="POST" action="check_project.php" class="col-md-6" enctype="multipart/form-data">

        <div class="col-md-12">
            <label class="form-label">Catégorie</label>
            <select class="form-select" aria-label="multiple select example" size="3" name="project_category[]" multiple>
                <option value="graphic_design" id="project_category">Graphic design</option>
                <option value="logo">Logo</option>
                <option value="motion_design">Motion</option>
            </select>
        </div>

        <div class="col-md-12">
            <label class="form-label" for="project_title">Titre du projet</label>
            <input type="text" placeholder="Goodtime.." class="form-control" id="project_title" name="project_title">
        </div>

        <div class="col-md-12">
            <label class="form-label" for="project_description">Description</label>
            <textarea type="text" class="form-control" placeholder="Voici un nouveau design.." id="project_description" name="project_description"></textarea>
        </div>

        <div class="col-md-12">
            <label class="form-label" for="project_img">Image</label>
            <input type="file" class="form-control" id="project_img" name="project_img">
        </div>

        <div class="col-md-12 text-center mt-2">
            <button type="submit" class="btn btn-primary">Créer le projet</button>
        </div>

    </form>
</div>