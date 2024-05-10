<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?= $result_get_settings["meta_description_homepage"] ?>" />

    <!-- Site Title -->
    <title><?= empty($page_title) ? $result_get_settings["meta_title_homepage"] : $page_title; ?></title>

    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="./assets/img/favicon.png" />
    <link rel="shortcut icon" type="image/png" href="./assets/img/favicon.png" />

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/animate.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/font-awesome-pro.min.css" />
    <link rel="stylesheet" href="assets/css/flaticon_gerold.css" />
    <link rel="stylesheet" href="assets/css/nice-select.css" />
    <link rel="stylesheet" href="assets/css/backToTop.css" />
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/css/odometer-theme-default.css" />
    <link rel="stylesheet" href="assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <link rel="stylesheet" href="assets/css/project-view.css">

</head>

<body>
    <!-- Preloader Area Start -->
    <!-- <div class="preloader">
      <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
        <path id="preloaderSvg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
      </svg>

      <div class="preloader-heading">
        <div class="load-text">
          <span>C</span>
          <span>h</span>
          <span>a</span>
          <span>r</span>
          <span>g</span>
          <span>e</span>
          <span>m</span>
          <span>e</span>
          <span>n</span>
          <span>t</span>
        </div>
      </div>
    </div> -->
    <!-- Preloader Area End -->

    <!-- start: Back To Top -->
    <div class="progress-wrap" id="scrollUp">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- end: Back To Top -->

    <!-- HEADER START -->
    <header class="tj-header-area header-absolute">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-wrap align-items-center">
                    <div class="logo-box">
                        <a href="<?= $template_url . "index.php" ?>">
                            <img src="assets/img/logo/logo.png" alt="" />
                        </a>
                    </div>

                    <div class="header-menu">
                        <nav>
                            <ul>
                                <li><a href="#services-section">Services</a></li>
                                <li><a href="#works-section">Réalisations</a></li>
                                <li><a href="#skills-section">Compétences</a></li>
                                <li><a href="#contact-section">Contact</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="header-button">
                        <a href="#" class="btn tj-btn-primary">Engagez nous!</a>
                    </div>

                    <div class="menu-bar d-lg-none">
                        <button>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header class="tj-header-area header-2 header-sticky sticky-out">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-wrap align-items-center">
                    <div class="logo-box">
                        <a href="<?= $template_url . "index.php" ?>">
                            <img src="assets/img/logo/logo.png" alt="" />
                        </a>
                    </div>

                    <div class="header-menu">
                        <nav>
                            <ul>
                                <li><a href="#services-section">Services</a></li>
                                <li><a href="#works-section">Réalisations</a></li>
                                <li><a href="#skills-section">Compétences</a></li>
                                <li><a href="#contact-section">Contact</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="header-button">
                        <a href="#" class="btn tj-btn-primary">Engagez nous!</a>
                    </div>

                    <div class="menu-bar d-lg-none">
                        <button>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER END -->