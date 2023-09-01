<div class="container px-5" style="margin-top: 8rem;">
    <h2 class="montserrat text-center display-4">Tutoriels</h2>
    <ul class="nav nav-underline mt-4 px-0">
        <li class="nav-item">
            <a class="nav-link tab <?= $active === 'vendre' ? 'active' : '' ?>" href="<?= base_url('tutoriels/vendre') ?>">Comment vendre avec Quitkif</a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab <?= $active === 'acheter' ? 'active' : '' ?>" href="<?= base_url('tutoriels/acheter') ?>">Comment acheter avec Quitkif</a>
        </li>
    </ul>
    <div class="mt-5">
        <p>
            <span class="step-number">1</span>
            Une fois votre acheteur trouvé. Et que vous être prêt à vendre. Demandez à votre acheteur de télécharger l’application QitKif, si il ne l’a pas déjà. 
        </p>
        
        <div class="mt-4">
            <p><span class="step-number">2</span> Si vous-même, n’avez pas QitKif, télécharger le et créer votre compte.</p>
            <div>
                <img width="100%" src="<?= base_url('public/images/tuto/vente-1.PNG') ?>" alt="">
            </div>
        </div>
        <div class="mt-5">
            <p><span class="step-number">3</span> Connectez-vous à votre compte</p>
            <div>
                <img width="100%" src="<?= base_url('public/images/tuto/vente-2.PNG') ?>" alt="">
            </div>
        </div>
        <div class="mt-5">
            <p><span class="step-number">4</span> Pour vendre ! </p>
            <div>
                <img width="100%" src="<?= base_url('public/images/tuto/vente-3.PNG') ?>" alt="">
            </div>
        </div>
        <div class="mt-5">
            <p><span class="step-number">5</span> Que voulez-vous vendre ? Renseignez ce que vous souhaitez et faites suivant ! Mettez votre prix et après avoir vérifi é le récapitulatif, envoyez votre offre en confirmant votre code de connexion ! </p>
            <div>
                <img width="100%" src="<?= base_url('public/images/tuto/vente-4.PNG') ?>" alt="">
            </div>
        </div>
        <div class="mt-5">
            <p><span class="step-number">6</span> L’acheteur recevrera votre proposition et la validéra ou la modifiera, ensuite vous pourrez activer le paiement et losque l’acheteur procédera au paiement, vous pourrez préparer et expédier le colis colis. </p>
        </div>
    </div>
</div>
