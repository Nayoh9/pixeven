    <?php
    $page_title = "Mes paramètres";
    include "header.php";
    include "includes/functions.php";

    try {
        $get_settings = $db->query('SELECT * FROM settings');
        $result_get_settings = $get_settings->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        var_dump($error_db);
        die();
    }

    $stats = json_decode($result_get_settings["stats"]);
    $settings_values = $result_get_settings["profile_picture"] . ',' . $result_get_settings["id"] . ',' . $result_get_settings["profile_picture_uid"];
    ?>

    <div class="row">
        <form method="POST" action="check_settings.php" class="col-md-12 d-flex flex-column align-items-center " enctype="multipart/form-data">

            <div class="col-md-6 mb-3 text-center">
                <label for="file_to_upload" class="form-label">Ma photo de profil
                    <div id="preview" class="text-center">
                        <img id="preview_child" class="form_img rounded-1" src="<?= $result_get_settings["profile_picture"]; ?>" alt="Photo de profil">
                    </div>
                </label>

                <input class="col-md-6 mt-2 form-control" name="profile_picture" type="file" id="file_to_upload" accept="image/png, image/jpeg, image/jpg" value="<?= $result_get_settings["profile_picture"]; ?>">
                <p class="fs-6 fw-bold text-center">Taille maximum du fichier 5 MO</p>
            </div>

            <div class="col-md-8">
                <label for="textarea" class="form-label">Mon titre principal</label>
                <textarea name="profile_title" class="form-control" rows="10"><?= htmlspecialchars($result_get_settings["profile_title"]); ?></textarea>
            </div>

            <div class="col-md-6">
                <label for="meta_title" class="form-label mt-3">Titre du portfolio<b>(sera affiché dans l'onglet du navigateur) </b></label>
                <input type="text" class="form-control w-50" name="meta_title" id="meta_title" value="<?= $result_get_settings["meta_title_homepage"] ?>" required>
            </div>

            <div class="col-md-6">
                <label for="meta_description" class="form-label mt-3">Description du portfolio <b>(sera affiché en dessous du nom du site dans le moteur de recherche)</b></label>
                <input type="text" class="form-control" name="meta_description" id="meta_description" value="<?= $result_get_settings["meta_description_homepage"]; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="projects_to_display" class="form-label mt-3">Nombre de projets à afficher</label>
                <input type="number" min="0" max="6" class="form-control w-50" name="projects_to_display" id="projects_to_display" value="<?= $result_get_settings["projects_to_display"] ?>" required>
            </div>

            <div class="col-md-8">
                <h2 class="text-center mb-4 mt-4">Statistiques</h2>
                <div class="d-flex justify-content-center">
                    <div class="col-md-4 me-1 text-center">
                        <label class="form-label" for="years_of_experience">Années d'experience</label>
                        <input class="form-control text-center" id="years_of_experience" name="years_of_experience" step="0.5" type="number" min="1" value="<?= htmlspecialchars($stats->years_of_experience); ?>" required>
                    </div>

                    <div class="col-md-4 ms-1 text-center">
                        <label class="form-label" for="achieved_projects">Projets réalisés</label>
                        <input class="form-control text-center" id="achieved_projects" name="achieved_projects" step="0.5" type="number" min="1" value="<?= htmlspecialchars($stats->achieved_projects); ?>" required>
                    </div>
                </div>

                <div class="d-flex justify-content-center  text-center ">
                    <div class="col-md-8 justify-content-center ">
                        <label class="form-label" for="satisfied_customers">Clients satisfaits</label>
                        <input class="form-control text-center" id="satisfied_customers" name="satisfied_customers" step="0.5" type="number" min="1" value="<?= htmlspecialchars($stats->satisfied_customers); ?>" required>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <h2 class="mb-4 mt-4 text-center">Réseaux sociaux</h2>
                <div class="d-flex justify-content-center ">
                    <div class="col-md-4 me-2">
                        <label class="form-label" for="social_icon_1">Icône du réseau 1</label>
                        <input type="text" class="form-control" id="social_icon_1" name="social_1[icon]" placeholder="ex : instagram">

                        <label class="form_label" for="social_link_1">Lien du réseau 1</label>
                        <input class="form-control" id="social_link_1" name="social_1[link]" placeholder="ex : https://instagram.com/pseudo" type="text">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="social_icon_2">Icône du réseau 2</label>
                        <input type="text" class="form-control" id="social_icon_2" name="social_2[icon]" placeholder="ex : instagram">

                        <label class="form_label" for="social_link_2">Lien du réseau 2</label>
                        <input class="form-control" id="social_link_2" name="social_2[link]" placeholder="ex : https://instagram.com/pseudo" type="text">
                    </div>
                </div>

                <div class="d-flex mt-4 justify-content-center">
                    <div class="col-md-4 me-2">
                        <label class="form-label" for="social_icon_3">Icône du réseau 3</label>
                        <input type="text" class="form-control" id="social_icon_3" name="social_3[icon]" placeholder="ex : instagram">

                        <label class="form_label" for="social_link_3">Lien du réseau 3</label>
                        <input class="form-control" id="social_link_3" name="social_3[link]" placeholder="ex : https://instagram.com/pseudo" type="text">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="social_icon_4">Icône du réseau 4</label>
                        <input type="text" class="form-control" id="social_icon_4" name="social_4[icon]" placeholder="ex : instagram">

                        <label class="form_label" for="social_link_4">Lien du réseau 4</label>
                        <input class="form-control" id="social_link_4" name="social_4[link]" placeholder="ex : https://instagram.com/pseudo" type="text">
                    </div>
                </div>
            </div>
    </div>

    <div class="mt-3 col-md-12 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary" name="settings_values" value="<?= $settings_values; ?>">
            Appliquer
        </button>
    </div>

    </form>
    </div>

    <?php include "footer.php"; ?>