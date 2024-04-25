<?php
$page_title = "Créer une nouvelle catégorie";
include "header.php";
?>
<div class="row justify-content-center ">
    <form method="POST" class="col-md-6" action="check_category.php">
        <label for="category_name" class="form-label">Nom de la catégorie</label>
        <input class="form-control mb-2" name="category_name" type="text" required>
        <div class="col-md-12 d-flex justify-content-center ">
            <button type="submit" class="btn btn-primary ">Créer la catégorie</button>
        </div>
    </form>
</div>

<?php include "footer.php" ?>