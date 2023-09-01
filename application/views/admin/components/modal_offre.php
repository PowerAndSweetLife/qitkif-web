<div class="modal-body pt-5 px-5">
    <div class="offre-state-wrapper position-relative">
        <div class="offre-state-content">
            <div class="d-flex align-items-center bg-theme">
                <span class="text-success icon"><i class="fa-solid fa-circle-check"></i></span>
                <span class="ms-2 mb-0 h4">Offre</span>
            </div>
            <span class="state">Envoyé</span>
        </div>
    </div>  

    <div class="offre-state-wrapper position-relative">
        <div class="offre-state-content">
            <?php if($state < 3): ?>
                <div class="d-flex align-items-center bg-theme">
                    <span class="icon"><i class="fa-regular fa-circle"></i></span>
                    <span class="ms-2 mb-0 h4">Paiement</span>
                </div>
                <span class="state">En attente</span>
            <?php else : ?>
                <div class="d-flex align-items-center bg-theme">
                    <span class="text-success icon"><i class="fa-solid fa-circle-check"></i></span>   
                    <span class="ms-2 mb-0 h4">Paiement</span>
                </div>
                <span class="state">Effectué</span>
            <?php endif; ?>
        </div>
    </div>

    <div class="offre-state-wrapper position-relative">
        <div class="offre-state-content">
            <?php if($state === 3): ?>
                <div class="d-flex align-items-center bg-theme">
                    <span class="icon text-primary"><i class="fa-solid fa-circle"></i></span>
                    <span class="ms-2 mb-0 h4">Préparation de commande</span>
                </div>
                <span class="state">En cours</span>
            <?php else : ?>
                <?php if($state < 3): ?>
                    <div class="d-flex align-items-center bg-theme">
                        <span class="icon"><i class="fa-regular fa-circle"></i></span>
                        <span class="ms-2 mb-0 h4">Préparation de commande</span>
                    </div>
                    <span class="state">En attente</span>
                <?php else : ?>
                    <div class="d-flex align-items-center bg-theme">
                        <span class="text-success icon"><i class="fa-solid fa-circle-check"></i></span>   
                        <span class="ms-2 mb-0 h4">Préparation de commande</span>
                    </div>
                    <span class="state">Effectué</span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="offre-state-wrapper position-relative">
        <div class="offre-state-content">
            <?php if($state >= 5): ?>
                <div class="d-flex align-items-center bg-theme">
                    <span class="text-success icon"><i class="fa-solid fa-circle-check"></i></span> 
                    <span class="ms-2 mb-0 h4">Mise en livraison</span>
                </div>
                <span class="state">Effectué</span>
            <?php else : ?>
                <div class="d-flex align-items-center bg-theme">
                    <span class="icon"><i class="fa-regular fa-circle"></i></span> 
                    <span class="ms-2 mb-0 h4">Mise en livraison</span>
                </div>
                <span class="state">En attente</span>
            <?php endif; ?>
        </div>
    </div>
    <div class="offre-state-wrapper position-relative">
        <div class="offre-state-content">
            <?php if($state === 5): ?>
                <div class="d-flex align-items-center bg-theme">
                    <span class="icon text-primary"><i class="fa-solid fa-circle"></i></span>
                    <span class="ms-2 mb-0 h4">Livraison</span>
                </div>
                <span class="state">En cours</span>
            <?php else : ?>
                <?php if($state < 5): ?>
                    <div class="d-flex align-items-center bg-theme">
                        <span class="icon"><i class="fa-regular fa-circle"></i></span>
                        <span class="ms-2 mb-0 h4">Livraison</span>
                    </div>
                    <span class="state">En attente</span>
                <?php else : ?>
                    <div class="d-flex align-items-center bg-theme">
                        <span class="text-success icon"><i class="fa-solid fa-circle-check"></i></span>
                        <span class="ms-2 mb-0 h4">Livraison</span>
                    </div>
                    <span class="state">Effectué</span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="offre-state-wrapper position-relative" style="border-left-color: transparent;">
        <div class="offre-state-content">
            <?php if($state > 5): ?>
                <div class="d-flex align-items-center bg-theme">
                    <span class="icon text-success"><i class="fa-solid fa-circle-check"></i></span>
                    <span class="ms-2 mb-0 h4">Cloture</span>
                </div>
                <span class="state">Effectué</span>
            <?php else : ?>
                <div class="d-flex align-items-center bg-theme">
                    <span class="icon"><i class="fa-regular fa-circle"></i></span>
                    <span class="ms-2 mb-0 h4">Cloture</span>
                </div>
                <span class="state">En attente</span>
            <?php endif; ?>
        </div>
    </div>         
</div>