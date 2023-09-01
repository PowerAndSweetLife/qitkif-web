    <!-- App badge section-->
    <section class="" id="download">
        <div class="container px-5">
            <h2 class="text-center  font-alt mb-4 gt">Obtenez l'application dès maintenant !</h2>
            <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center">
                <a target="_blank" class="me-lg-3 mb-4 mb-lg-0" href="<?php echo $header[0]->link_google_play ?>"><img class="app-badge" src="<?= base_url('public/assets/img/google-play-badge.svg') ?>" alt="..." /></a>
                <!-- <a target="_blank" href="<?php echo $header[0]->link_app_store ?>"><img class="app-badge" src="<?= base_url('public/assets/img/app-store-badge.svg') ?>" alt="..." /></a> -->
                <a download href="<?php echo  base_url()."public/images/".$header[0]->apk ;?>" data-file="<?php echo $header[0]->apk ;?>" class="fileAPK">
                    <button class="btn"><i class="fa fa-download"></i> Télécharger</button>
                </a>
                
            </div>
        </div>
    </section>
    <!-- Contact us -->

    <section style="background-color:#1664b1" id="contact-us">
        <div class="container px-5">
            <!-- <h2 class="text-center text-white font-alt mb-4">Nous contacter</h2>
                <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center">
                    <form action="">
                        <input type="text" class="form-control mb-2" placeholder="Email">
                        <textarea class="form-control mb-2" placeholder="Message"></textarea>
                        <input type="submit" class="btn btn-primary btn-block" value="Envoyer">
                    </form>
                </div> -->
            <div class="row">
                <h2 class="text-center text-white font-alt mb-4 gt">Nous contacter</h2>
                <div class="col-md-6 mt-3">
                    <p><img style="width: 25px;" src="<?php echo base_url('public/assets/whatsapp.png') ?>" alt="whatsapp icon"><span class="text-white ms-2"><a class="text-white " target="_blank" style="text-decoration: none" href="https://api.whatsapp.com/send?phone=<?php echo trim($contact[0]->whatsapp,"+"); ?>"><?php echo $contact[0]->whatsapp; ?></a> </span></p>
                    <p><img style="width: 25px;" src="<?php echo base_url('public/assets/facebook.png') ?>" alt="whatsapp icon"><span class="text-white ms-2"> <a class="text-white " target="_blank" style="text-decoration: none" href="<?php echo $contact[0]->facebook; ?>">QitKif</a></span></p>
                    <p><img style="width: 25px;" src="<?php echo base_url('public/assets/location.png') ?>" alt="whatsapp icon"><span class="text-white ms-2"> <?php echo $contact[0]->adresse; ?></span></p>
                    <p class="text-white">
                    	<a href="<?php echo base_url() ;?>confidentialite" class="text-white" target="_blank" style="text-decoration: none">
                            <i class="fa-solid fa-cog"></i><span class="ms-2"> Confidentialités</span></a>
                    </p>
                    <p class="text-white">
                    	<a href="<?php echo base_url() ;?>faq" class="text-white" target="_blank" style="text-decoration: none">
                            <i class="fa-regular fa-circle-question"></i></i><span class="ms-2"> FAQ</span>
                        </a>
                    </p>
                    <p class="text-white">
                    	<a href="<?= base_url('tutoriels') ?>" class="text-white" style="text-decoration: none">
                            <i class="fa-solid fa-circle-info"></i></i><span class="ms-2">Tutoriels</span>
                        </a>
                    </p>

                </div>
                <div class="col-md-6">
                    <form action="<?php echo base_url() ?>mail" method="post" class="form-group">
                        <input type="text" class="form-control mb-2" placeholder="Nom" required name="nom">
                        <input type="text" class="form-control mb-2" placeholder="Numéro téléphone" required name="num-tel">
                        <input type="text" class="form-control mb-2" placeholder="Email" required name="email">
                        <textarea class="form-control mb-2" placeholder="Message" required name="message"></textarea>
                        <input type="submit" class="btn btn-primary" value="Envoyer">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="bg-black text-center py-2">
        <div class="container px-5">

            <div class="text-white-50 small">
                <!-- <div class="mb-2">&copy; Powered by <a href="https://nir-info.mg">Nir'info</a></div> -->
                <div class="mb-2"> Créé par <a href="https://nir-info.mg">Nir'info</a> &copy; <?php echo "2023"; ?></div>
            </div>
        </div>
    </footer>



    <!-- Bootstrap core JS-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= base_url('public/js/front-office/scripts.js') ?>"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>