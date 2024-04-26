    <?php
    $page_title = "Mes paramètres";
    include "header.php";
    ?>

    <div class="row justify-content-center">
        <form method="POST" action="check_settings.php" class="col-md-6">
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Ma photo de profil</label>
                <input id="profile_picture" name="profile_picture" type="file" class="form-control" accept="image/png, image/jpeg, image/jpg" required>
            </div>
            <div>
                <label for="textarea" class="form-label">Mon titre principal</label>
                <textarea name="main_title" class="form-control" id="textarea" rows="10"></textarea>
            </div>

            <div class="col-md-12">

                <div class="d-flex">
                    <div class="col-md-6">
                        <label class="form-label" for="">Années d'experience</label>
                        <input class="form-control text-center w-75" step="0.5" type="number" min="1">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="form-label">Projets réalisés</label>
                        <input class="form-control text-center w-75" step="0.5" type="number" min="1">
                    </div>
                </div>


                <div class="d-flex">
                    <div class="col-md-6">
                        <label class="form-label" for="">Clients satisfaits</label>
                        <input class="form-control text-center w-75" step="0.5" type="number" min="1">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Années d'experience</label>
                        <input class="form-control text-center w-75" step="0.5" type="number" min="1">
                    </div>
                </div>

            </div>

            <div class="mt-3 col-md-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Appliquer</button>
            </div>
        </form>

    </div>

    <?php include "footer.php"; ?>