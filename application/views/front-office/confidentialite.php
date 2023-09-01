<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Qitkif</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" type="image/x-icon" href="<?= base_url('public/assets/favicon.ico') ?>" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url('public/css/front-office/styles.css') ?>" rel="stylesheet" />
    <style type="text/css">
        * {
            font-family: 'Montserrat', sans-serif;
        }

        .gt {
            /*            font-family: 'Oswald', sans-serif !important ;*/
            font-family: Helvetica !important;
            font-weight: bold;
        }

        .montserrat {
            font-family: 'Montserrat', sans-serif;
        }

        .btn {
            background-color: DodgerBlue;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 20px;
            padding: 10px;
        }

        /* Darker background on mouse-over */
        .btn:hover {
            background-color: RoyalBlue;
        }
    </style>
</head>

<body id="page-top">



    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="<?php echo base_url(); ?>"><img src="<?= base_url('public/assets/img/logo.png') ?>" alt="..." style="height: 4.5rem" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                    <li class="nav-item"><a class="nav-link me-lg-3" href="<?php echo base_url(); ?>">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="<?php echo base_url(); ?>">A propos</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="<?php echo base_url(); ?>">Fonctionnalités</a></li>

                    <li class="nav-item"><a class="nav-link me-lg-3" href="<?php echo base_url(); ?>">Télécharger</a></li>
                    <!-- <li class="nav-item"><a class="nav-link me-lg-3" href="#contact-us">Nous contacter</a></li> -->
                </ul>
                <!-- <button class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                        <span class="d-flex align-items-center">
                            <i class="bi-chat-text-fill me-2"></i>
                            <span class="small">Nous contacter</span>
                        </span>
                    </button> -->
            </div>
        </div>
    </nav>


    <div style="min-height: 400px; margin-top: 140px;">
        <div class="container px-5">
            <h1>Confidentialités</h1>
            <h3>Collecte des Données</h3>
            <p>L’Utilisateur consent expressément à ce que ses Données soient collectées par QITKIF à l’occasion :</p>
            <ul>
                <li>De la création d’un Espace Client ;</li>
                <li>De la réalisation d’une Transaction ;</li>
                <li>Du transfert de fonds depuis le Porte-Monnaie Électronique ;</li>
                <li>De la participation au système de Parrainage ;</li>
                <li>De la procédure de résolution amiable des litiges.</li>
            </ul>
            <h3>Utilisation des données</h3>
            <p>L’Utilisateur donne son accord exprès et sans réserve à ce que ses données personnelles soient utilisées par QITKIF pour les finalités suivantes :</p>
            <ul>
                <li>Prise de contact avec l’Utilisateur ;</li>
                <li>Accès de l’Utilisateur aux différentes fonctionnalités de l’Application et/ou du Site ;</li>
                <li>Adapter le contenu des Services – y compris le contenu de l’Application et/ou du Site ;</li>
                <li>Amélioration et réalisation des Services ;</li>
                <li>Répondre à des obligations légales, lutter contre la fraude, déceler les usages contraires aux CGU ;</li>
                <li>Envoi de propositions commerciales et/ou promotionnelles ;</li>
                <li>Envoi d’enquêtes de satisfaction ;</li>
                <li>Réalisation de statistiques.</li>
            </ul>

            <h3>Communication des données personnelles</h3>
            <p>Afin d’assurer la bonne exécution des Services, QITKIF sera amenée à communiquer les Données au(x) Prestataire(s).</p>
            <p>À titre exceptionnel, QITKIF peut être amenée à communiquer les Données :</p>
            <ul>
                <li>Aux autorités administratives et judiciaires autorisées, uniquement sur réquisition judiciaire ;</li>
                <li>Pour des raisons exclusivement techniques, aux prestataires du site assurant le traitement ainsi que l’hébergement des données traitées.</li>
            </ul>


            <h3>Droits de l’Utilisateur</h3>
            <p>L’Utilisateur bénéficie d’un droit d’accès, de rectification, de portabilité, d’effacement de ses données à caractère personnel ou de limitation du traitement, qu’il peut exercer à tout moment via son Espace Personnel.</p>
            <p>L’Utilisateur peut également, à tout moment, s’opposer au traitement de ses données personnelles pour des motifs légitimes.</p>
            <p>L’Utilisateur pourra exercer ses droits en adressant un courrier électronique à l’adresse suivante : <a target="_blank" href="contact@QitKif.com">contact@QitKif.com</a>, en renseignant dans le champ objet « Données personnelles ». QITKIF s’engage à traiter la demande de l’Utilisateur dans un délai maximum de trente (30) jours à compter de la réception dudit courrier électronique.</p>

            <h3>Conservation des données</h3>
            <p>QITKIF conservera les Données dans un environnement sécurisé pendant la durée nécessaire à la réalisation des finalités pour lesquelles elles ont été collectées et dans le respect de la réglementation en vigueur.</p>
            <p>Les Données sont conservées pendant toute la durée d’utilisation des Services par l’Utilisateur, augmentée d’une durée de trois (3) ans à compter de la clôture par l’Utilisateur de son Espace Personnel, ou de la cessation de l’utilisation des Services, à des fins d’animation et de prospection, sans préjudice des obligations de conservation ou des délais de prescription.</p>



        </div>

    </div>



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
                    <p><img style="width: 25px;" src="<?php echo base_url('public/assets/whatsapp.png') ?>" alt="whatsapp icon"><span class="text-white "><a class="text-white " target="_blank" style="text-decoration: none" href="https://api.whatsapp.com/send?phone=<?php echo trim($contact[0]->whatsapp, "+"); ?>"><?php echo $contact[0]->whatsapp; ?></a> </span></p>
                    <p><img style="width: 25px;" src="<?php echo base_url('public/assets/facebook.png') ?>" alt="whatsapp icon"><span class="text-white "> <a class="text-white " target="_blank" style="text-decoration: none" href="<?php echo $contact[0]->facebook; ?>">QitKif</a></span></p>
                    <p><img style="width: 25px;" src="<?php echo base_url('public/assets/location.png') ?>" alt="whatsapp icon"><span class="text-white "> <?php echo $contact[0]->adresse; ?></span></p>
                    <p class="text-white">
                        <a href="<?php echo base_url(); ?>confidentialite" style="text-decoration: none" class="text-white" target='_blank'>
                            <i class="fa-solid fa-cog"></i><span class="ml-2"> Confidentialités</span></a>
                    </p>
                    <p class="text-white">
                        <a href="<?php echo base_url(); ?>faq" class="text-white" target="_blank" style="text-decoration: none">
                            <i class="fa-solid fa-cog"></i><span class="ml-2"> FAQ</span></a>
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