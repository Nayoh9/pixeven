    <?php
    $page_title = "Mes paramètres";
    include "header.php";

    try {
        $get_settings = $db->query('SELECT * FROM settings');
        $result_get_settings = $get_settings->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        var_dump($error_db);
        die();
    }

    $stats = json_decode($result_get_settings["stats"]);

    ?>

    <div class="row justify-content-center">
        <form method="POST" action="check_settings.php" class="col-md-6">

            <div class="mb-3 text-center">
                <label for="file_to_upload" class="form-label">Ma photo de profil
                    <div id="preview" class="text-center ">
                        <img id="preview_child" class="form_img" src="<?= $result_get_settings["profile_picture"]; ?>" alt="Photo d'un projet">
                    </div>
                </label>
                <input class="col-md-6 mt-2 form-control" id="file_to_upload" name="profile_picture" type="file" id="file_to_upload" accept="image/png, image/jpeg, image/jpg">
            </div>

            <div>
                <label for="textarea" class="form-label">Mon titre principal</label>
                <textarea name="profile_title" class="form-control" rows="10"><?= htmlspecialchars($result_get_settings["profile_title"]); ?></textarea>
            </div>

            <div class="col-md-12">

                <p class="text-center mb-4 mt-4">Statistiques</p>

                <div class="d-flex">
                    <div class="col-md-6">
                        <label class="form-label" for="years_of_experience">Années d'experience</label>
                        <input class="form-control text-center w-100" id="years_of_experience" name="years_of_experience" step="0.5" type="number" min="1" value="<?= htmlspecialchars($stats->years_of_experience); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="achieved_projects">Projets réalisés</label>
                        <input class="form-control text-center w-100" id="achieved_projects" name="achieved_projects" step="0.5" type="number" min="1" value="<?= htmlspecialchars($stats->achieved_projects); ?>" required>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-12 justify-content-center ">
                        <label class="form-label" for="satisfied_customers">Clients satisfaits</label>
                        <input class="form-control text-center w-100" id="satisfied_customers" name="satisfied_customers" step="0.5" type="number" min="1" value="<?= htmlspecialchars($stats->satisfied_customers); ?>" required>
                    </div>

                </div>
            </div>

            <div>
                <p class="mb-4 mt-4 text-center">Réseaux sociaux</p>

                <div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <label class="form-label" for="social_icon_1">Icône du réseau 1</label>
                            <input type="text" class="form-control" id="social_icon_1" name="social_icon_1" placeholder="ex : fa-brands fa-instagram">

                            <label class="form_label" for="social_link_1">Lien du réseau 1</label>
                            <input class="form-control" id="social_link_1" name="social_link_1" type="text">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="social_icon_2">Icône du réseau 2</label>
                            <input type="text" class="form-control" id="social_icon_2" name="social_icon_1" placeholder="ex : fa-brands fa-instagram">

                            <label class="form_label" for="social_link_2">Lien du réseau 2</label>
                            <input class="form-control" id="social_link_2" name="social_link_2" type="text">
                        </div>
                    </div>

                    <div class="d-flex mt-4 ">
                        <div class="col-md-6">
                            <label class="form-label" for="social_icon_1">Icône du réseau 3</label>
                            <input type="text" class="form-control" id="social_icon_1" name="social_icon_1" placeholder="ex : fa-brands fa-instagram">

                            <label class="form_label" for="social_link_1">Lien du réseau 3</label>
                            <input class="form-control" id="social_link_1" name="social_link_1" type="text">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="social_icon_2">Icône du réseau 4</label>
                            <input type="text" class="form-control" id="social_icon_2" name="social_icon_1" placeholder="ex : fa-brands fa-instagram">

                            <label class="form_label" for="social_link_2">Lien du réseau 4</label>
                            <input class="form-control" id="social_link_2" name="social_link_2" type="text">
                        </div>
                    </div>




                </div>

            </div>
            <div class="mt-3 col-md-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Appliquer</button>
            </div>
        </form>

    </div>

    <?php include "footer.php"; ?>