  <?php
  include "/Users/yohann/localhost/pixeven/dashboard/includes/functions.php";

  try {
    $get_settings = $db->query("SELECT * FROM settings");
    $result_get_settings = $get_settings->fetch(PDO::FETCH_ASSOC);
  } catch (\PDOException $e) {
    var_dump($error_db);
  }

  include "includes/header.php";


  $socials = json_decode($result_get_settings["socials"], true);
  $stats = json_decode($result_get_settings["stats"], true);

  try {
    $get_projects = $db->query(
      "SELECT
      -- Tout selectionner dans projects
      projects.*,
      -- Rassembler dans une chaine de caractère les categories.name
      GROUP_CONCAT(categories.name)
      FROM
      projects
      -- Chercher dans project_categories si il ya des categories_id
     INNER JOIN categories ON FIND_IN_SET(
          categories.id,
          projects.categories
      )
      GROUP BY
      projects.id
    ORDER BY 
      projects.id 
    DESC",
    );

    $result_get_projects = $get_projects->fetchALL(PDO::FETCH_ASSOC);
  } catch (\PDOException $e) {
    var_dump($error_db);
  }
  ?>




  <main class="site-content" id="content">
    <!-- HERO SECTION START -->
    <section class="hero-section d-flex align-items-center" id="intro">
      <div class="intro_text">
        <svg viewBox="0 0 1320 300">
          <text x="50%" Y="50%" text-anchor="middle">Pixeven</text>
        </svg>
      </div>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="hero-content-box">
              <h1 class="hero-title wow fadeInLeft" data-wow-delay="1.2s">
                <?= $result_get_settings["profile_title"]; ?>
              </h1>

              <div class="hero-image-box d-md-none text-center wow fadeInRight" data-wow-delay="1.3s">
                <img src="assets/img/hero/me.png" alt="" />
              </div>

              <p class="lead wow fadeInLeft" data-wow-delay="1.4s">
                Réflexion, creation, innovation.
              </p>
              <div class="button-box d-flex flex-wrap align-items-center">
                <ul class="ul-reset social-icons wow fadeInLeft" data-wow-delay="1.6s">

                  <?php
                  foreach ($socials as $social) {
                    if (!empty($social["icon"])) {
                  ?>
                      <li>
                        <a href="<?= $social["link"] ?>" target="_blank"><i class="<?= $social["icon"] ?>"></i></a>
                      </li>
                  <?php
                    }
                  }
                  ?>

                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 d-none d-md-block">
            <div class="hero-image-box text-center wow fadeInRight" data-wow-delay="1.5s">
              <img src="<?= $result_get_settings["profile_picture"] ?>" alt="Photo d'un homme" />
            </div>
          </div>
        </div>

        <div class="funfact-area">
          <div class="row">
            <div class="col-6 col-lg-4">
              <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                <div class="number">
                  <span class="odometer" data-count="<?= htmlspecialchars($stats["years_of_experience"]); ?>">0</span>
                </div>
                <div class="text">Années <br />d'Experience</div>
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                <div class="number">
                  <span class="odometer" data-count="<?= htmlspecialchars($stats["achieved_projects"]) ?>">0</span>+
                </div>
                <div class="text">Projets <br />réalisés</div>
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center">
                <div class="number">
                  <span class="odometer" data-count="<?= htmlspecialchars($stats["satisfied_customers"]) ?>">0</span>K
                </div>
                <div class="text">Clients <br />Satisfaits</div>
              </div>
            </div>
            <!-- <div class="col-6 col-lg-3">
                  <div
                    class="funfact-item d-flex flex-column flex-sm-row flex-wrap align-items-center"
                  >
                    <div class="number">
                      <span class="odometer" data-count="14">0</span>
                    </div>
                    <div class="text">Années <br />d'Experience</div>
                  </div>
                </div> -->
          </div>
        </div>
      </div>
    </section>
    <!-- HERO SECTION END -->

    <!-- SERVICES SECTION START -->
    <section class="services-section" id="services-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-header text-center">
              <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">
                Nos prestations
              </h2>
              <p class="wow fadeInUp" data-wow-delay=".4s">
                Nous concrétisons vos idées et donc vos souhaits sous la forme
                d'un projet unique qui vous inspire et inspire vos clients.
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="services-widget position-relative">
              <div class="service-item current d-flex flex-wrap align-items-center wow fadeInUp" data-wow-delay=".5s">
                <div class="left-box d-flex flex-wrap align-items-center">
                  <span class="number">01</span>
                  <h3 class="service-title">Prestation</h3>
                </div>
                <div class="right-box">
                  <p>
                    Description prestation
                  </p>
                </div>
                <i class="flaticon-up-right-arrow"></i>
                <button data-mfp-src="#service-wrapper" class="service-link modal-popup"></button>
              </div>
              <div class="service-item d-flex flex-wrap align-items-center wow fadeInUp" data-wow-delay=".6s">
                <div class="left-box d-flex flex-wrap align-items-center">
                  <span class="number">02</span>
                  <h3 class="service-title">Prestation</h3>
                </div>
                <div class="right-box">
                  <p>
                    Description prestation
                  </p>
                </div>
                <i class="flaticon-up-right-arrow"></i>
                <button data-mfp-src="#service-wrapper" class="service-link modal-popup"></button>
              </div>
              <div class="service-item d-flex flex-wrap align-items-center wow fadeInUp" data-wow-delay=".7s">
                <div class="left-box d-flex flex-wrap align-items-center">
                  <span class="number">03</span>
                  <h3 class="service-title">Prestation</h3>
                </div>
                <div class="right-box">
                  <p>
                    Description prestation
                  </p>
                </div>
                <i class="flaticon-up-right-arrow"></i>
                <button data-mfp-src="#service-wrapper" class="service-link modal-popup"></button>
              </div>
              <div class="service-item d-flex flex-wrap align-items-center wow fadeInUp" data-wow-delay=".8s">
                <div class="left-box d-flex flex-wrap align-items-center">
                  <span class="number">04</span>
                  <h3 class="service-title">Prestation</h3>
                </div>
                <div class="right-box">
                  <p>
                    Description prestation
                  </p>
                </div>
                <i class="flaticon-up-right-arrow"></i>
                <button data-mfp-src="#service-wrapper" class="service-link modal-popup"></button>
              </div>
              <div class="active-bg wow fadeInUp" data-wow-delay=".5s"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- SERVICES SECTION END -->

    <!-- start: Service Popup -->
    <div id="service-wrapper" class="popup_content_area zoom-anim-dialog mfp-hide">
      <div class="popup_modal_img">
        <img src="./assets/img/services/modal-img.jpg" alt="" />
      </div>

      <div class="popup_modal_content">
        <div class="service_details">
          <div class="row">
            <div class="col-lg-7 col-xl-8">
              <div class="service_details_content">
                <div class="service_info">
                  <h6 class="subtitle">SERVICES</h6>
                  <h2 class="title">UI/UX Design</h2>
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
            <div class="col-lg-5 col-xl-4">
              <div class="tj_main_sidebar">
                <div class="sidebar_widget services_list">
                  <div class="widget_title">
                    <h3 class="title">All Services</h3>
                  </div>
                  <ul>
                    <li class="active">
                      <button>
                        <i class="flaticon-design"></i>
                        Branding Design
                      </button>
                    </li>
                    <li>
                      <button>
                        <i class="flaticon-3d-movie"></i>
                        3D Animation
                      </button>
                    </li>
                    <li>
                      <button>
                        <i class="flaticon-ux-design"></i>
                        UI/UX Design
                      </button>
                    </li>
                    <li>
                      <button>
                        <i class="flaticon-web-design"></i>
                        Web Design
                      </button>
                    </li>
                    <li>
                      <button>
                        <i class="flaticon-ui-design"></i>
                        App Design
                      </button>
                    </li>
                  </ul>
                </div>

                <div class="sidebar_widget contact_form">
                  <div class="widget_title">
                    <h3 class="title">Get in Touch</h3>
                  </div>

                  <form action="index.html">
                    <div class="form_group">
                      <input type="text" name="name" id="name" placeholder="Name" autocomplete="off" />
                    </div>
                    <div class="form_group">
                      <input type="email" name="semail" id="semail" placeholder="Email" autocomplete="off" />
                    </div>
                    <div class="form_group">
                      <textarea name="smessage" id="smessage" placeholder="Your message" autocomplete="off"></textarea>
                    </div>
                    <div class="form_btn">
                      <button class="btn tj-btn-primary" type="submit">
                        Send Message
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end: Service Popup -->

    <!-- PORTFOLIO SECTION START -->
    <section class="portfolio-section" id="works-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-header text-center">
              <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">
                Nos Travaux Recents
              </h2>
              <p class="wow fadeInUp" data-wow-delay=".4s">
                Nous concrétisons vos idées et donc vos souhaits sous la forme
                d'un projet web unique qui vous inspire et inspire vos
                clients.
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="portfolio-filter text-center wow fadeInUp" data-wow-delay=".5s">

              <!-- <div class="button-group filter-button-group">
                    <button data-filter="*" class="active">All</button>
                    <button data-filter=".uxui">UX/UI</button>
                    <button data-filter=".branding">Branding</button>
                    <button data-filter=".mobile-app">Apps</button>
                    <div class="active-bg"></div>
                  </div>
                </div> -->

              <div class="portfolio-box wow fadeInUp" data-wow-delay=".6s">
                <div class="portfolio-sizer"></div>
                <div class="gutter-sizer"></div>
                <div class="col-md-12">


                  <?php
                  foreach ($result_get_projects as $project) {
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

                  <?php } ?>

                </div>
              </div>
            </div>
          </div>
    </section>
    <!-- PORTFOLIO SECTION END -->




    <!-- SKILLS SECTION START -->
    <section class="skills-section" id="skills-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-header text-center">
              <h2 class="section-title wow fadeInUp" data-wow-delay=".3s">
                Mes compétences
              </h2>
              <p class="wow fadeInUp" data-wow-delay=".4s">
                Nous concrétisons vos idées et donc vos souhaits sous la forme
                d'un projet web unique qui vous inspire et inspire vos
                clients.
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="skills-widget d-flex flex-wrap justify-content-center align-items-center">
              <div class="skill-item wow fadeInUp" data-wow-delay=".3s">
                <div class="skill-inner">
                  <div class="icon-box">
                    <img src="assets/img/icons/figma.svg" alt="" />
                  </div>
                  <!-- <div class="number">92%</div> -->
                </div>
                <p>Procrate</p>
              </div>
              <div class="skill-item wow fadeInUp" data-wow-delay=".4s">
                <div class="skill-inner">
                  <div class="icon-box">
                    <img src="assets/img/icons/sketch.svg" alt="" />
                  </div>
                  <!-- <div class="number">80%</div> -->
                </div>
                <p>Blender</p>
              </div>
              <div class="skill-item wow fadeInUp" data-wow-delay=".5s">
                <div class="skill-inner">
                  <div class="icon-box">
                    <img src="assets/img/icons/xd.svg" alt="" />
                  </div>
                  <!-- <div class="number">85%</div> -->
                </div>
                <p>After Effects</p>
              </div>
              <div class="skill-item wow fadeInUp" data-wow-delay=".6s">
                <div class="skill-inner">
                  <div class="icon-box">
                    <img src="assets/img/icons/wp.svg" alt="" />
                  </div>
                  <!-- <div class="number">99%</div> -->
                </div>
                <p>Final Cut Pro</p>
              </div>
              <div class="skill-item wow fadeInUp" data-wow-delay=".7s">
                <div class="skill-inner">
                  <div class="icon-box">
                    <img src="assets/img/icons/react.svg" alt="" />
                  </div>
                  <!-- <div class="number">89%</div> -->
                </div>
                <p>Illustrator</p>
              </div>
              <div class="skill-item wow fadeInUp" data-wow-delay=".8s">
                <div class="skill-inner">
                  <div class="icon-box">
                    <img src="assets/img/icons/js.svg" alt="" />
                  </div>
                  <!-- <div class="number">93%</div> -->
                </div>
                <p>Logic Pro</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- SKILLS SECTION END -->

    <!-- CONTACT SECTION START -->
    <section class="contact-section" id="contact-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-7 order-2 order-md-1">
            <div class="contact-form-box wow fadeInLeft" data-wow-delay=".3s">
              <div class="section-header">
                <h2 class="section-title">Travaillons ensemble !</h2>
                <p>
                  Nous concevons des choses magnifiquement designées et nous
                  aimons ce que nous faisons.
                </p>
              </div>

              <div class="tj-contact-form">
                <form action="index.html">
                  <div class="row gx-3">
                    <div class="col-sm-6">
                      <div class="form_group">
                        <input type="text" name="fname" id="fname" placeholder="Prénom" autocomplete="off" />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form_group">
                        <input type="text" name="lname" id="lname" placeholder="Nom" autocomplete="off" />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form_group">
                        <input type="email" name="email" id="email" placeholder="Adresse E-mail" autocomplete="off" />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form_group">
                        <input type="tel" name="phone" id="phone" placeholder="Numéro de téléphone" autocomplete="off" />
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form_group">
                        <select name="service" id="service" class="tj-nice-select">
                          <option value="" selected disabled>
                            Choisir une prestation
                          </option>
                          <option value="branding">Branding Design</option>
                          <option value="web">Web Design</option>
                          <option value="uxui">UI/UX Design</option>
                          <option value="app">App Design</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form_group">
                        <textarea name="message" id="message" placeholder="Message"></textarea>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form_btn">
                        <button type="submit" class="btn tj-btn-primary">
                          Envoyer
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-5 offset-lg-1 col-md-5 d-flex flex-wrap align-items-center order-1 order-md-2">
            <div class="contact-info-list">
              <ul class="ul-reset">
                <li class="d-flex flex-wrap align-items-center position-relative wow fadeInRight" data-wow-delay=".4s">
                  <div class="icon-box">
                    <i class="flaticon-phone-call"></i>
                  </div>
                  <div class="text-box">
                    <p>Téléphone</p>
                    <a href="tel:0123456789">+01 123 654 8096</a>
                  </div>
                </li>
                <li class="d-flex flex-wrap align-items-center position-relative wow fadeInRight" data-wow-delay=".5s">
                  <div class="icon-box">
                    <i class="flaticon-mail-inbox-app"></i>
                  </div>
                  <div class="text-box">
                    <p>E-mail</p>
                    <a href="mailto:mail@mail.com">pixeven.pro@gmail.com</a>
                  </div>
                </li>
                <li class="d-flex flex-wrap align-items-center position-relative wow fadeInRight" data-wow-delay=".6s">
                  <div class="icon-box">
                    <i class="flaticon-location"></i>
                  </div>
                  <div class="text-box">
                    <p>Adresse</p>
                    <a href="#">Warne Park Street Pine, <br />FL 33157, New York</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- CONTACT SECTION END -->
  </main>
  <?php include "includes/footer.php" ?>