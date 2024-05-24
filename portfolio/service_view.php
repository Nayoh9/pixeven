    <?php
    include "includes/functions.php";

    $ok_service_view = "accueil";
    $not_ok_service_view = "accueil";

    $error = false;

    if (empty($_GET["id"])) {
        $error = "invalid_service";
        header("location: $template_url" . "$not_ok_service?error=$error");
        die();
    } else {

        $service_id = $_GET["id"];

        try {
            $get_service = $db->query("SELECT * FROM services WHERE services.id = $service_id");
            $result_get_service = $get_service->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            var_dump($error_db);
        }

        if (empty($result_get_service)) {
            $error = "cant_find_var";
            header("location: $template_url" . "$not_ok_service_view?error=$error");
            die();
        }

        $page_title = "Pixeven " . $result_get_service["name"];
        include "header.php";
    ?>
        <div class="background">

            <div class="service_view_gutter"></div>
            <div id="service-wrapper" class="popup_content_area zoom-anim-dialog ">
                <div class="popup_modal_img">
                    <img src="<?= $result_get_service["picture"]; ?>" alt="photo d'une prestation" />
                </div>

                <div class=" popup_modal_content">
                    <div class="service_details">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="service_details_content">
                                    <div class="service_info">
                                        <h6 class="subtitle">PRESTATION</h6>
                                        <h2 class="title"> <?= $result_get_service["name"] ?></h2>
                                        <div class="desc">
                                            <p>
                                                Elizabeth some dodgy chavs are you taking the piss faff
                                                about pardon amongst car boot a load of old tosh is
                                                cracking goal blow off telling brown.
                                            </p>

                                            <p>
                                                Brolly show off show off pick your nose and blow off
                                                well A bit of how’s your father tomfoolery blimey, me
                                                old mucker starkers Queen’s English dropped a clanger
                                                bite your arm spiffing good time burke Why chancer.
                                                Hotpot bum bag cracking goal young delinquent naff
                                                bugger cup of chars bender loo it’s all gone to pot the
                                                nancy cheeky.
                                            </p>

                                            <p>
                                                At public school cras bog some dodgy chav Richard Why
                                                argy bargy vagabon William bender matie boy, off his nut
                                                chancer Jeffrey up the kyver say mufty you mug ummm
                                                telling pear shaped Oxford owt to do with me do one so
                                                said are you taking his.
                                            </p>
                                        </div>

                                        <h3 class="title">Services Process</h3>
                                        <div class="desc">
                                            <p>
                                                Elizabeth some dodgy chavs are you taking the piss faff
                                                about pardon amongst car boot a load of old tosh is
                                                cracking goal blow off telling brown.
                                            </p>
                                        </div>
                                        <ul>
                                            <li>Reinvent Your Business to Better</li>
                                            <li>Pioneering the Internet's First</li>
                                            <li>Pioneering the Design World's First</li>
                                            <li>Pioneering the Design World's First</li>
                                            <li>Pioneering the Design World's First</li>
                                            <li>Pioneering the Design World's First</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    <?php
    }
    include "footer.php";
    ?>