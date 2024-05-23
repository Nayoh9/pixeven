 <!-- FOOTER AREA START -->
 <footer class="tj-footer-area">
     <div class="container">
         <div class="row">
             <div class="col-md-12 text-center">
                 <div class="footer-logo-box">
                     <a href="<?= $template_url . "accueil" ?>"> <img src=<?= $template_url . "assets/img/logo/logo.png" ?> alt="logo pixeven" /></a>
                 </div>
                 <div class="footer-menu">
                     <?php
                        if ($page_title === "Pixeven") {
                        ?>
                         <nav>
                             <ul>
                                 <li><a href="#services-section">Services</a></li>
                                 <li><a href="#works-section">Réalisations</a></li>
                                 <li><a href="#skills-section">Compétences</a></li>
                                 <li><a href="#contact-section">Contact</a></li>
                             </ul>
                         </nav>

                     <?php
                        } else {
                        ?>
                         <nav>
                             <ul>
                                 <li><a href="<?= $template_url . "accueil" ?>">Pixeven</a></li>
                                 <li><a href="<?= $template_url . "projects" ?>">Tous les projets</a></li>
                             </ul>
                         </nav>
                     <?php } ?>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <!-- FOOTER AREA END -->

 <!-- CSS here -->
 <script src="<?= $template_url . 'assets/js/jquery.min.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/bootstrap.bundle.min.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/nice-select.min.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/backToTop.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/smooth-scroll.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/appear.min.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/wow.min.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/gsap.min.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/one-page-nav.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/lightcase.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/owl.carousel.min.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/isotope.pkgd.min.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/odometer.min.js'; ?>"></script>
 <script src="<?= $template_url . 'assets/js/main.js'; ?>"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.2.0-beta/noty.min.js"></script>

 </body>

 </html>