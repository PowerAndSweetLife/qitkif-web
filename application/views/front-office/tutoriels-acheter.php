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
            Une fois la perle rare trouvée. Et que vous être prêt à la commander. Demandez à votre vendeur de télécharger l’application QitKif, si il ne l’a pas déjà.  
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
            <p><span class="step-number">4</span> Pour acheter ! </p>
            <div>
                <img width="100%" src="<?= base_url('public/images/tuto/achat-3.PNG') ?>" alt="">
            </div>
        </div>
        <div class="mt-5">
            <p><span class="step-number">5</span> Que voulez-vous acheter ? Renseignez ce que vous souhaitez et faites suivant ! Mettez votre prix et après avoir vérifi é le récapitulatif, envoyez votre offre en confi rmant votre code de connexion  ! </p>
            <div>
                <img width="100%" src="<?= base_url('public/images/tuto/achat-4.PNG') ?>" alt="">
            </div>
        </div>
        <div class="mt-5">
            <p><span class="step-number">6</span> Le vendeur recevrera votre proposition et la validéra ou la modifi era, ensuite vous pourrez passer au paiement et suivre l’evolution de votre colis.</p>
        </div>
    </div>
</div>
