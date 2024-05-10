<?php
include "/Users/yohann/localhost/pixeven/dashboard/includes/functions.php";

if (!empty($_GET["id"])) {

    $project_id = htmlspecialchars($_GET["id"]);

    try {
        $get_project_info = $db->query("SELECT
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

        $result_get_project_info = $get_project_info->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
        var_dump($error_db);
        header("Location: " . $template_url . "index.php?error=$error_db");
        die();
    };
} else {
    header("Location: " . $template_url . "index.php?error=cant_find_project");
    die();
}

$page_title = "Pixeven - " . $result_get_project_info["title"];
include "includes/header.php";

?>

<div class="background">
    <div class="project-view-gutter"></div>

    <div id="portfolio-wrapper" class="popup_content_area zoom-anim-dialog project_view">
        <div class="popup_modal_img">
            <img src="<?= $result_get_project_info["picture"] ?>" alt="photo d'un projet" />
        </div>

        <div class="popup_modal_content">
            <div class="portfolio_info">
                <div class="portfolio_info_text">
                    <h2 class="title"></h2>
                    <div class="desc">
                        <p>

                        </p>
                    </div>
                    <a href="<?= htmlspecialchars($result_get_project_info["link"]) ?>" class="btn tj-btn-primary">live preview <i class="fal fa-arrow-right"></i></a>
                </div>
                <div class="portfolio_info_items">
                    <div class="info_item">
                        <div class="key">Category</div>
                        <div class="value"><?= htmlspecialchars($result_get_project_info["GROUP_CONCAT(categories.name)"]); ?></div>
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
                <div class="gallery_item">
                    <img src="./assets/img/portfolio-gallery/p-gallery-1.jpg" alt="" />
                </div>
                <div class="gallery_item">
                    <img src="./assets/img/portfolio-gallery/p-gallery-2.jpg" alt="" />
                </div>
                <div class="gallery_item">
                    <img src="./assets/img/portfolio-gallery/p-gallery-3.jpg" alt="" />
                </div>
                <div class="gallery_item">
                    <img src="./assets/img/portfolio-gallery/p-gallery-4.jpg" alt="" />
                </div>
            </div>

            <div class="portfolio_description">
                <h2 class="title">Project Description</h2>
                <div class="desc">
                    <?= $result_get_project_info["description"] ?>
                </div>
            </div>

            <div class="portfolio_story_approach">
                <div class="portfolio_story">
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
            </div>

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


<?php include "includes/footer.php" ?>