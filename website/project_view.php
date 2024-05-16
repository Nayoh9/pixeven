    <?php
    include "includes/functions.php";


    if (!empty($_GET["id"])) {

        $project_id = htmlspecialchars($_GET["id"]);

        try {
            $get_project = $db->query("SELECT
            projects.*,
            GROUP_CONCAT(categories.name)
            FROM
            projects
            INNER JOIN categories ON FIND_IN_SET(
            categories.id,
            projects.categories
            )
            WHERE
            projects.id = $project_id");

            $result_get_project = $get_project->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            var_dump($error_db);
            header("Location: " . $template_url . "index.php?error=$error_db");
            die();
        };

        if (empty($result_get_project["id"])) {
            header("location: $template_url" . "index.php?error=invalid_project_id");
        }

        $picture_list = explode(",", $result_get_project["picture_list"]);
        $page_title = "Pixeven - " . $result_get_project["title"];
        include "header.php";
    ?>

        <div class="background">
            <div class="project-view-gutter"></div>

            <div id="portfolio-wrapper" class="popup_content_area zoom-anim-dialog project_view">
                <div class="popup_modal_img">
                    <img src="<?= $result_get_project["picture"] ?>" alt="photo d'un projet" />
                </div>

                <div class="popup_modal_content">
                    <div class="portfolio_info">
                        <div class="portfolio_info_text">
                            <h2 class="title"></h2>
                            <div class="desc">
                                <p>

                                </p>
                            </div>
                            <a href="<?= htmlspecialchars($result_get_project["link"]) ?>" class="btn tj-btn-primary">live preview <i class="fal fa-arrow-right"></i></a>
                        </div>
                        <div class="portfolio_info_items">
                            <div class="info_item">
                                <div class="key">Category</div>
                                <div class="value"><?= htmlspecialchars($result_get_project["GROUP_CONCAT(categories.name)"]); ?></div>
                            </div>
                            <div class="info_item">
                                <div class="key">Client</div>
                                <div class="value">Artboard Studio</div>
                            </div>
                            <div class="info_item">
                                <div class="key">Start Date</div>
                                <div class="value">August 20, 2023</div>
                            </div>
                            <div class="info_item">
                                <div class="key">Designer</div>
                                <div class="value"><a href="#">ThemeJunction</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="portfolio_gallery owl-carousel">

                        <?php
                        foreach ($picture_list as $picture_link) {
                        ?>
                            <div class="gallery_item">
                                <img src="<?= $picture_link; ?>" alt="photo d'un projet" class="project_picture" />
                            </div>
                        <?php } ?>

                    </div>


                    <div class="portfolio_description">
                        <h2 class="title">Project Description</h2>
                        <div class="desc">
                            <?= $result_get_project["description"] ?>
                        </div>
                    </div>

                    <div class="portfolio_story_approach">
                        <!-- <div class="portfolio_story">
                            <div class="story_title">
                                <h4 class="title">The story</h4>
                            </div>
                            <div class="story_content">
                                <p>
                                    There are many variations of passages of Lorem Ipsum
                                    available, but the majority have suffered alteration in some
                                    form, by injected humour, or randomised words which don't look
                                    even slightly believable. If you are going to use a passage of
                                    Lorem Ipsum, you need to be sure there isn't anything
                                    embarrassing hidden in the middle of text. There are many
                                    variations of passages of Lorem Ipsum available, but the
                                    majority have suffered alteration in some form, by injected
                                    humour, or randomised words which don't look even slightly
                                    believable. If you are going to use a passage of Lorem Ipsum,
                                    you need to be sure there isn't anything embarrassing hidden
                                    in the middle of text.
                                </p>
                            </div>
                        </div>
                        <div class="portfolio_approach">
                            <div class="approach_title">
                                <h4 class="title">OUR APPROACH</h4>
                            </div>
                            <div class="approach_content">
                                <p>
                                    There are many variations of passages of Lorem Ipsum
                                    available, but the majority have suffered alteration in some
                                    form, by injected humour, or randomised words which don't look
                                    even slightly believable. If you are going to use a passage of
                                    Lorem Ipsum, you need to be sure there isn't anything
                                    embarrassing hidden in the middle of text. There are many
                                    variations of passages of Lorem Ipsum available, but the
                                    majority have suffered alteration in some form, by injected
                                    humour, or randomised words which don't look even slightly
                                    believable. If you are going to use a passage of Lorem Ipsum,
                                    you need to be sure there isn't anything embarrassing hidden
                                    in the middle of text.
                                </p>
                            </div>
                        </div>
                    </div> -->

                        <div class="portfolio_navigation">
                            <div class="navigation_item prev-project">
                                <a href="#" class="project">
                                    <i class="fal fa-arrow-left"></i>
                                    <div class="nav_project">
                                        <div class="label">Previous Project</div>
                                        <h3 class="title">Sebastian</h3>
                                    </div>
                                </a>
                            </div>


                            <div class="navigation_item next-project">
                                <a href="#" class="project">
                                    <div class="nav_project">
                                        <div class="label">Next Project</div>
                                        <h3 class="title">Qwillo</h3>
                                    </div>
                                    <i class="fal fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php

    } else {

        try {
            $get_projects_count = $db->query("SELECT id FROM projects");
            $result_get_projects_count = $get_projects_count->fetchALL(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            var_dump($error_db);
        }

        // Pagination 
        @$page = $_GET["page"];
        empty($page) && $page = 1;
        $project_per_page = 6;
        $number_of_page = ceil(count($result_get_projects_count) / $project_per_page);
        $start = ($page - 1) * $project_per_page;

        try {
            $get_projects = $db->query("SELECT * FROM projects ORDER BY projects.id DESC LIMIT $start, $project_per_page");
            $result_get_projects = $get_projects->fetchALL(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            var_dump($error_db);
        }

        if (count($result_get_projects) === 0) {
            header("location:$template_url" . "projects_view.php?page=1");
        }

        $page_title = "Tous nos projets";
        include "header.php";
        ?>

            <section class="portfolio-section" id="works-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h2 class="section-title wow fadeInUp mt-5" data-wow-delay=".3s">
                                    Tous nos travaux
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="portfolio-filter text-center wow fadeInUp" data-wow-delay=".5s">

                                <div class="portfolio-box wow fadeInUp" data-wow-delay=".6s">
                                    <div class="portfolio-sizer"></div>
                                    <div class="gutter-sizer"></div>
                                    <div class="col-md-12">
                                        <?php
                                        $counter = 0;
                                        foreach ($result_get_projects as $project) {
                                            if ($project["deleted"] === 0) {
                                        ?>
                                                <div class="portfolio-item branding">
                                                    <div class="image-box">
                                                        <img src="<?= $project["picture"] ?>" alt="photo d'un projet" />
                                                    </div>
                                                    <div class="content-box">
                                                        <a href="<?= $template_url . "project_view.php?id=" . $project["id"] ?>">
                                                            <h3 class="portfolio-title"><?= htmlspecialchars($project["title"]) ?></h3>
                                                            <p><?= htmlspecialchars($project["hook"]) ?></p>
                                                            <i class="flaticon-up-right-arrow"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                        <?php

                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 d-flex justify-content-center ">
                            <?php
                            for ($i = 1; $i <= $number_of_page; $i++) {

                                if ($page != $i) {
                                    echo "<a href=?page=$i>$i</a>&nbsp";
                                } else {
                                    echo "<p class=current_page>$i</p> &nbsp";
                                }
                            }
                            ?>
                        </div>
            </section>

            </main>

        <?php
    }
    include "footer.php";
        ?>