<?php include('components/header.php')  ?>
    <!-- Mashead header-->
    <header class="masthead" id="accueil">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-up">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3 gt" id=""><?php echo $header[0]->great_title; ?></h1>
                        <p class="lead fw-normal text-muted mb-5"><?php echo  $header[0]->sub_great_title; ?></p>
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <a target="_blank" class="me-lg-3 mb-4 mb-lg-0" href="<?php echo $header[0]->link_google_play ?>"><img class="app-badge" src="<?= base_url('public/assets/img/google-play-badge.svg') ?>" alt="..." /></a>
                            <!-- <a target="_blank" href="<?php echo $header[0]->link_app_store ?>"><img class="app-badge" src="<?= base_url('public/assets/img/app-store-badge.svg') ?>" alt="..." /></a> -->
                            <a download href="<?php echo  base_url()."public/images/".$header[0]->apk ;?>" data-file="<?php echo $header[0]->apk ;?>" class="fileAPK">
                                <button class="btn"><i class="fa fa-download"></i> Télécharger</button>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up">
                    <!-- Masthead device mockup feature-->
                    <div class="masthead-device-mockup" data-aos="zoom-out-left">
                        <svg class="circle" data-aos="zoom-out-right" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                                    <stop class="gradient-start-color" offset="0%"></stop>
                                    <stop class="gradient-end-color" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg><svg class="shape-1 d-none d-sm-block" viewBox="0 0 240.83 240.83" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(120.42 -49.88) rotate(45)"></rect>
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(-49.88 120.42) rotate(-45)"></rect>
                        </svg><svg class="shape-2 d-none d-sm-block" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg>
                        <div class="device-wrapper">
                            <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                                <div class="screen bg-black">
                                    <!-- PUT CONTENTS HERE:-->
                                    <!-- * * This can be a video, image, or just about anything else.-->
                                    <!-- * * Set the max width of your media to 100% and the height to-->
                                    <!-- * * 100% like the demo example below.-->
                                    <!-- <video muted="muted" autoplay="true" loop="" style="max-width: 100%; height: 100%"><source src="<?= base_url('public/assets/img/demo-screen.mp4'); ?>" type="video/mp4" /></video> -->
                                    <img src="<?= base_url('public/images/') . $header[0]->image; ?>" alt="illustration" style="max-width: 100%; height: 100%;object-fit: scale-down;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Quote/testimonial aside-->
    <aside class="text-center bg-gradient-primary-to-secondary">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center" data-aos="fade-up">
                <div class="col-xl-8" >
                    <div class="h2 fs-1 text-white mb-4 gt">" <?php echo $header[0]->slogan; ?> "</div>
                    <!-- <img src="assets/img/logo.png" alt="..." style="height: 3rem" /> -->
                </div>
            </div>
        </div>
    </aside>
    <!-- App features section-->
    <section id="propos">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-8 order-lg-1 mb-5 mb-lg-0">
                    <div class="container-fluid px-5">
                        <div class="row gx-5">
                            <div class="col-md-6 mb-5">
                                <!-- Feature item-->
                                <div class="text-center" data-aos="fade-up">
                                    <i class="bi bi-shield-lock icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt gt"><?= $fonctionality[0]->func1; ?></h3>
                                    <p class="text-muted mb-0"><?= $fonctionality[0]->content1; ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <!-- Feature item-->
                                <div class="text-center" data-aos="fade-up">
                                    <i class="bi bi-chat-left-text icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt gt"><?= $fonctionality[0]->func2; ?></h3>
                                    <p class="text-muted mb-0"><?= $fonctionality[0]->content2; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-5 mb-md-0">
                                <!-- Feature item-->
                                <div class="text-center" data-aos="fade-up">
                                    <i class="bi bi-shop icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt gt"><?= $fonctionality[0]->func3; ?></h3>
                                    <p class="text-muted mb-0"><?= $fonctionality[0]->content3; ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Feature item-->
                                <div class="text-center" data-aos="fade-up">
                                    <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                                    <h3 class="font-alt gt"><?= $fonctionality[0]->func4; ?></h3>
                                    <p class="text-muted mb-0"><?= $fonctionality[0]->content4; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-lg-0">
                    <!-- Features section device mockup-->
                    <div class="features-device-mockup">
                        <svg class="circle" data-aos="zoom-out-right" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                                    <stop class="gradient-start-color" offset="0%"></stop>
                                    <stop class="gradient-end-color" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg><svg class="shape-1 d-none d-sm-block" viewBox="0 0 240.83 240.83" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(120.42 -49.88) rotate(45)"></rect>
                            <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(-49.88 120.42) rotate(-45)"></rect>
                        </svg><svg class="shape-2 d-none d-sm-block" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg>
                        <div class="device-wrapper" data-aos="zoom-out-left">
                            <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                                <div class="screen bg-black">
                                    <!-- PUT CONTENTS HERE:-->
                                    <!-- * * This can be a video, image, or just about anything else.-->
                                    <!-- * * Set the max width of your media to 100% and the height to-->
                                    <!-- * * 100% like the demo example below.-->
                                    <!-- <video muted="muted" autoplay="" loop="" style="max-width: 100%; height: 100%"><source src="assets/img/demo-screen.mp4" type="video/mp4" /></video> -->
                                    <img src="<?= base_url('public/images/') . $header[0]->image; ?>" alt="illustration" style="max-width: 100%; height: 100%;object-fit: scale-down;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic features section-->
    <section class="bg-gradient-primary-to-secondary" id="features">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                <div class="col-md-12">
                    <?php for ($fonct = 0; $fonct < count($fonctionnement); $fonct++) : ?>
                        <?php if($fonct % 2 != 0) : ?>
                        <div class="row mt-5" data-aos="fade-left">
                            <div class="col-md-4 col-sm-12">
                                <img class="w-100" style="min-height: 150px;" src="<?= base_url('public/images/') . $fonctionnement[$fonct]->image; ?>" alt="">
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <h2 class="text-white gt"><?php echo $fonct + 1; ?>. <?php echo $fonctionnement[$fonct]->entete; ?></h2>
                                <p class="text-white"><?php echo $fonctionnement[$fonct]->contenu; ?></p>
                            </div>
                            
                        </div>
                        <?php else: ?>
                            <div class="row mt-5" data-aos="fade-right">
                            <div class="col-md-8 col-sm-12">
                                <h2 class="text-white gt"><?php echo $fonct + 1; ?>. <?php echo $fonctionnement[$fonct]->entete; ?></h2>
                                <p class="text-white"><?php echo $fonctionnement[$fonct]->contenu; ?></p>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <img class="w-100" style="min-height: 150px;" src="<?= base_url('public/images/') . $fonctionnement[$fonct]->image; ?>" alt="">
                            </div>
                        </div>
                        <?php endif ; ?>
                        
                    <?php endfor; ?>
                </div>
            </div>
    </section>

    <!-- Call to action section-->
    <!-- <section class="cta">
            <div class="cta-content">
                <div class="container px-5">
                    <h2 class="text-white display-1 lh-1 mb-4">
                        Stop waiting.
                        <br />
                        Start building.
                    </h2>
                    <a class="btn btn-outline-light py-3 px-4 rounded-pill" href="https://startbootstrap.com/theme/new-age" target="_blank">Download for free</a>
                </div>
            </div>
        </section> -->
<?php include('components/footer.php') ?>