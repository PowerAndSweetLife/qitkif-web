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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link href="<?= base_url('public/css/front-office/styles.css') ?>" rel="stylesheet" />
    <style type="text/css">
        * {
            font-family: 'Montserrat', sans-serif !important;
        }
        .btn-link {
            text-decoration: none !important;
            font-weight: bold ;
            color: #343a40 !important;
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

                    <li class="nav-item"><a class="nav-link me-lg-3" href="<?php echo base_url(); ?>">Télécharger</a>
                    </li>
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

        <!-- FAQ ! -->
        <div class="pt-2 pb-5" style="overflow: hidden; background-color: #fee085; background-color: white; min-height: 700px;">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h2 class="text-center mb-4">F.A.Q</h2>

                        <div class="accordion" id="accordionExample">
                            <?php foreach($lists as $k => $item): ?>
                            <div class="card">
                                <div class="card-header" id="heading-<?= $k ?>">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left <?= $k > 0 ? 'collapsed' : '' ?>" type="button" data-toggle="collapse" data-target="#collapse-<?= $k ?>" aria-expanded="true" aria-controls="collapse-<?= $k ?>">
                                            <?= $item->title ?>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse-<?= $k ?>" class="collapse <?= $k === 0 ? 'show' : '' ?>" aria-labelledby="heading-<?= $k ?>" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <?= $item->content ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                            <!-- <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Comment s'inscrire ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Il faut d’abord télécharger l’application sur Play Store (pour les téléphone
                                        Android), App Store( pour les téléphone
                                        IOS) ou sur qitkif.com.
                                        A l’ouverture de l’application, cliquer sur S’INSCRIRE et renseigner le
                                        formulaire.
                                        Valider le formulaire, après avoir cocher les conditions générales, en faisant
                                        SUIVANT.
                                        Un code de 4 chiffres sera envoyé sur le numéro de téléphone que vous avez
                                        utilisé renseigné dans le formulaire.
                                        Saisissez ce code de 4 chiffres et VALIDER, vous serez amené à créer un nouveau
                                        code de 4 chiffres (avec double
                                        validation). Ce code sera désormais votre code d’identification.
                                        Pour vous connecter à l’application, vous identifiant seront votre numéro de
                                        téléphone (celui enregistré dans le
                                        formulaire) et le code de 4 chiffres que vous avez créé.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Mot de passe oublié, que faire ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Lors de votre connexion à l’application, si vous avez oublié votre code de
                                        connexion. Il vous suffit de cliquer sur
                                        « Code oublié ». Un nouveau code vous sera envoyé sur le numéro que vous utilisé
                                        pour vous connecter.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Que faire quand mon compte est bloqué ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Si votre compte est bloqué, contacter le support en envoyant un mail à
                                        contact@qitkif.com ou en envoyant un
                                        message WhatsApp au +2250759241000 ou +2250707839168. En quelques minutes votre
                                        compte sera rétabli.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            Peut-on signaler un vendeur ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Oui en contactant le support ou en laissant un message dans l’application «
                                        Service client ». Une icône de
                                        conversation dans le menu horizontal de l’application est là à cet effet.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingSix">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            Peut-on signaler un acheteur ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Oui en contactant le support ou en laissant un message dans l’application «
                                        Service client ». Une icône de
                                        conversation dans le menu horizontal de l’application est là à cet effet.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingSeven">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                            Comment QitKif accompagne ses utilisateurs?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                                    <div class="card-body">
                                        QitKif assure la sécurité des transaction en étant au début et à la fin de
                                        chaque transaction.
                                        L'application dispose d'administrateur qui s'assure que les transactions se
                                        déroule bien. Les délais d'exécution
                                        sont surveillés et la communication avec les utilisateurs est assurer.
                                        En cas de litiges, une médiation est immédiatement ouverte entre le vendeur et
                                        l'acheteur pour une résolution
                                        rapide.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingEight">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                            Comment trouver un vendeur ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Si vous êtes un acheteur et que vous souhaitez trouver un vendeur pour lui faire
                                        une offre d’achat, il faut faire
                                        « Acheter » dans le menu horizontal de l’application. Et rechercher votre
                                        vendeur à partir de son identifiant, son
                                        numéro de téléphone ou son adresse mail. Mais au préalable, il faut que le
                                        vendeur ait un compte QitKif.
                                        Une fois le vendeur trouvé dans la liste qui apparaitra, sélectionnez le et
                                        faites « Suivant ».
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingNine">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                            Comment trouver un client ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Si vous êtes un vendeur et que vous souhaitez trouver un acheteur pour lui faire
                                        une proposition de vente, il faut
                                        faire « Vendre » dans le menu horizontal de l’application. Et rechercher votre
                                        acheteur à partir de son identifiant,
                                        son numéro de téléphone ou son adresse mail. Mais au préalable, il faut que
                                        l’acheteur ait un compte QitKif.
                                        Une fois l’acheteur trouvé dans la liste qui apparaitra, sélectionnez le et
                                        faites « Suivant ».
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header" id="headingTen">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                            Comment parler au service client ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Il vous suffit d’envoyer votre message dans l’application « Service client ».
                                        Une icône de conversation dans le menu
                                        horizontal de l’application est là à cet effet. Ou en envoyant un mail à
                                        contact@qitkif.com ou en envoyant un
                                        message WhatsApp au +2250759241000 ou +2250707839168.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTen">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                            Peut-on être vendeur et client en même temps ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Oui. Avec le seul compte que vous avez créé, vous pouvez à la fois vendre et
                                        acheter.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingEleven">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                            En tant que vendeur, au bout de combien de temps je recevrai mon argent ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Dès que l’acheteur valide la réception de son article, votre argent est
                                        immédiatement versé sur votre compte.
                                        Lorsque vous expédiez le colis à l’acheteur, vous définissez le temps maximum de
                                        livraison. Dès que ce temps est
                                        atteint (bien entendu avec une marge prévue par l’application), si l’acheteur ne
                                        valide pas la réception, l’application
                                        lui envoie une notification, ainsi qu’à vous le vendeur, pour demander à
                                        l’acheteur de valider la réception ou d’ouvrir
                                        un litige en cas de non réception ou de non-conformité du colis. Si l’acheteur
                                        ne réagit pas, la transaction est
                                        considérée comme terminée et l’argent est immédiatement versé sur le compte du
                                        vendeur.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTwelve">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                            Comment se rétracter après un achat ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Après un achat, il est possible d’annuler la commande avant que le vendeur ait
                                        effectué la mise en livraison.
                                        L’acheteur se voit dans ce cas restituer son argent de façon automatique. Si le
                                        vendeur a déjà livré le colis,
                                        l’annulation n’est plus possible. Mais une médiation peut être ouverte, à la
                                        demande de l’acheteur. La plateforme
                                        de QitKif gèrera la médiation entre le vendeur et l’acheteur.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThirteen">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                            Le prélèvement sur mon compte mobile money se fait en instantané ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Le prélèvement est instantané dès que vous validez l’achat.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingFourteen">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                                            Livreur et colis en retard, que faire ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Ouvrir un litige via l’application « Service client ». Une icône de conversation
                                        dans le menu horizontal de
                                        l’application est là à cet effet. Un communication sera établi avec le vendeur
                                        pour trouver une solution rapide.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingFifteen">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                                            Peut-on rajouter plusieurs comptes de transfert mobile à son profil ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseFifteen" class="collapse" aria-labelledby="headingFifteen" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Oui, vous pouvez rajouter plusieurs comptes de paiement à votre profil. Pour le
                                        faire, allez dans les paramètres de
                                        votre profil et ajouter de nouveau compte de paiement.
                                        Lors d’une vente ou d’un achat vous aurez la possibilité de choisir le compte
                                        que vous souhaitez utiliser.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingSixTeen">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSixTeen" aria-expanded="false" aria-controls="collapseSixTeen">
                                            En cas de litige, que faire ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseSixTeen" class="collapse" aria-labelledby="headingSixTeen" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Ouvrir un litige via l’application « Service client ». Une icône de conversation
                                        dans le menu horizontal de
                                        l’application est là à cet effet. Un communication sera établi avec le vendeur
                                        et l’acheteur pour trouver une solution
                                        rapide.
                                        Avant d’ouvrir un litige, il ne faut surtout pas valider la livraison du colis.
                                        Aucun litige concernant une transaction
                                        clôturée ne peut être accepté.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingSevenTeen">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSevenTeen" aria-expanded="false" aria-controls="collapseSevenTeen">
                                            Quand recevoir mon argent, lorsque le client ne confirme pas la réception ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseSevenTeen" class="collapse" aria-labelledby="headingSevenTeen" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Lorsque vous expédiez le colis à l’acheteur, vous définissez le temps maximum de
                                        livraison. Dès que ce temps est
                                        atteint (bien entendu avec une marge prévue par l’application), si l’acheteur ne
                                        valide pas la réception, l’application
                                        lui envoie une notification, ainsi qu’à vous le vendeur, pour demander à
                                        l’acheteur de valider la réception ou d’ouvrir
                                        un litige en cas de non réception ou de non-conformité du colis. Si l’acheteur
                                        ne réagit pas, la transaction est
                                        considérée comme terminée et l’argent est immédiatement versé sur le compte du
                                        vendeur.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingEighteen">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseEighteen" aria-expanded="false" aria-controls="collapseEighteen">
                                            Comment je peux être remboursé alors que j'ai été déjà prélevé et le colis
                                            n'est pas conforme ? Ou comment
                                            gérer une réclamation ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseEighteen" class="collapse" aria-labelledby="headingEighteen" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Après ouverture d’un litige, les téléconseillers de la plateforme QitKif vont
                                        établir une communication entre le
                                        vendeur et l’acheteur pour trouver une solution. Des preuves de non-conformité
                                        seront demandées à l’acheteur et
                                        comparées aux éléments ayant suscités le vente ou l’achat. Cette médiation a
                                        pour but de déterminer qui de
                                        l’acheteur ou du vendeur est en tort.
                                        En cas de tort du vendeur, il est demandé au vendeur de récupérer son colis et
                                        l’acheteur est immédiatement
                                        remboursé.
                                        En cas de tort de l’acheteur, il est dans l’obligation d’accepter le colis, le
                                        vendeur est dans ce cas payé.
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header" id="headingNineteen">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseNineteen" aria-expanded="false" aria-controls="collapseNineteen">
                                            Qu'est ce qui caractérise QitKif ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseNineteen" class="collapse" aria-labelledby="headingNineteen" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Ce qui caractérise QitKif, c’est la sécurité et la garantie des transactions. La
                                        sécurité en ce que l’argent est bloqué
                                        par un système qui n’est pas accessible à QitKif. C’est l’algorithme des mobiles
                                        money qui le gère.
                                        La garantie en ce sens que l’acheteur est sûr de recevoir son article commandé
                                        et le vendeur est garantie d’être
                                        payé.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTwenty">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwenty" aria-expanded="false" aria-controls="collapseTwenty">
                                            Nos données sont-elles en sécurité ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwenty" class="collapse" aria-labelledby="headingTwenty" data-parent="#accordionExample">
                                    <div class="card-body">
                                        L’application QitKif ne conserve que vos les informations que vous avez
                                        renseignées à la création de votre compte.
                                        Aucune donnée de paiement n’est conservée.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTwentyone">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwentyone" aria-expanded="false" aria-controls="collapseTwentyone">
                                            Quelle est la politique de sécurité ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwentyone" class="collapse" aria-labelledby="headingTwentyone" data-parent="#accordionExample">
                                    <div class="card-body">
                                        QitKif utilise les derniers standards de sécurité. Cela pour vous proposer la
                                        meilleure expérience qui puisse exister
                                        dans le domaine du commerce entre particuliers. Vos données personnelles sont
                                        protégées par des technologies
                                        absolument infaillibles, pour que vous puissiez toujours utiliser notre service
                                        l’esprit léger et les yeux fermés.
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header" id="headingTwentytwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwentytwo" aria-expanded="false" aria-controls="collapseTwentytwo">
                                            Mon compte peut-il piraté ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwentytwo" class="collapse" aria-labelledby="headingTwentytwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Tant que vous conservez vos identifiant de connexion de façon personnelle, votre
                                        compte ne peut pas être piraté.
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header" id="headingTwentythree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwentythree" aria-expanded="false" aria-controls="collapseTwentythree">
                                            Le mot de passe de paiement dans l'application correspond-il à celui de mon
                                            compte mobile money?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwentythree" class="collapse" aria-labelledby="headingTwentythree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Le mot de passe de confirmation de paiement dans l’application est votre code de
                                        connexion. Il est différent de
                                        celui de votre compte mobile money. L’application ne demandera jamais votre code
                                        de paiement mobile money.
                                        Après avoir valider le paiement dans l’application, c’est votre opérateur de
                                        compte mobile money qui se charge
                                        par un code de validation de finaliser la transaction. Pour dire que QitKif n’a
                                        pas autorité à exécuter une action sur
                                        votre compte mobile money.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTwentyfour">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwentyfour" aria-expanded="false" aria-controls="collapseTwentyfour">
                                            Comment se fait le paiement sur QitKif ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwentyfour" class="collapse" aria-labelledby="headingTwentyfour" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Après validation de votre commande, vous passez au paiement en le validant.
                                        Votre opérateur mobile vous enverra
                                        un code SMS pour exécuter le paiement en dehors de l’application. La
                                        finalisation de la transaction est faite en
                                        dehors de l’application, donc QitKif ne saurait savoir, ni garder votre code de
                                        paiement mobile money.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTwentyfive">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwentyfive" aria-expanded="false" aria-controls="collapseTwentyfive">
                                            QitKif a-t-elle accès à mes données de mon mobile money ?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwentyfive" class="collapse" aria-labelledby="headingTwentyfive" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Non, La finalisation de la transaction est faite en dehors de l’application,
                                        donc QitKif ne saurait savoir, ni garder
                                        vos code de paiement mobile money.
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
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
                    <p><img style="width: 25px;" src="<?php echo base_url('public/assets/whatsapp.png') ?>" alt="whatsapp icon"><span class="text-white "><a class="text-white " target="_blank" style="text-decoration: none" href="https://api.whatsapp.com/send?phone=<?php echo trim($contact[0]->whatsapp, " +");
                                                                                                                                                                                                                                                                            ?>">
                                <?php echo $contact[0]->whatsapp; ?>
                            </a> </span></p>
                    <p><img style="width: 25px;" src="<?php echo base_url('public/assets/facebook.png') ?>" alt="whatsapp icon"><span class="text-white "> <a class="text-white " target="_blank" style="text-decoration: none" href="<?php echo $contact[0]->facebook; ?>">QitKif</a></span></p>
                    <p><img style="width: 25px;" src="<?php echo base_url('public/assets/location.png') ?>" alt="whatsapp icon"><span class="text-white ">
                            <?php echo $contact[0]->adresse; ?>
                        </span></p>
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
                <div class="mb-2"> Créé par <a href="https://nir-info.mg">Nir'info</a> &copy;
                    <?php echo "2023"; ?>
                </div>
            </div>
        </div>
    </footer>



    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- Core theme JS-->
    <script src="<?= base_url('public/js/front-office/scripts.js') ?>"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>