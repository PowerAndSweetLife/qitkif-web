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
    <link href="<?= base_url('public/css/front-office/styles.css?v=' . APP_VERSION) ?>" rel="stylesheet" />
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
            <a class="navbar-brand fw-bold" href="#page-top"><img src="<?= base_url('public/assets/img/logo.png') ?>" alt="..." style="height: 4.5rem" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <?php if($withRedirection): ?>
                <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                    <li class="nav-item"><a class="nav-link me-lg-3" href="<?= base_url() ?>#accueil">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="<?= base_url() ?>#propos">A propos</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="<?= base_url() ?>#features">Fonctionnalités</a></li>

                    <li class="nav-item"><a class="nav-link me-lg-3" href="<?= base_url() ?>#download">Télécharger</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3 active" href="<?= base_url('tutoriels')  ?>">Tutoriels</a></li>
                    <!-- <li class="nav-item"><a class="nav-link me-lg-3" href="#contact-us">Nous contacter</a></li> -->
                </ul>
                <?php else: ?>
                <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#accueil">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#propos">A propos</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#features">Fonctionnalités</a></li>

                    <li class="nav-item"><a class="nav-link me-lg-3" href="#download">Télécharger</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="<?= base_url('tutoriels')  ?>">Tutoriels</a></li>
                    <!-- <li class="nav-item"><a class="nav-link me-lg-3" href="#contact-us">Nous contacter</a></li> -->
                </ul>
                <?php endif ?>

                <!-- <button class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                        <span class="d-flex align-items-center">
                            <i class="bi-chat-text-fill me-2"></i>
                            <span class="small">Nous contacter</span>
                        </span>
                    </button> -->
            </div>
        </div>
    </nav>