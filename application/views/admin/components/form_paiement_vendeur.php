<form class="modal-content" onsubmit="submitPaiementVendeur(event,this)" action="<?= base_url("admin/paiement/vendeur") ?>">
    <input type="hidden" name="idPaiement" value="<?= $post->idPaiement ?? null ?>">
    <div class="modal-header">
        <h1 class="modal-title fs-5">Paiement d'un vendeur</h1>
        <button type="button" id="close-modal-categorie" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Pseudo du vendeur :</label>
            <input type="text" class="form-control <?= form_error('pseudo') ? 'error' : '' ?>" name="pseudo" value="<?= $post->pseudo ?? null ?>" readonly>
            <p class="message-error"><?= form_error("pseudo") ?></p>
        </div>
        <div class="form-group">
            <label>Montant :</label>
            <input type="text" class="form-control <?= form_error('montant') ? 'error' : '' ?>" name="montant" value="<?= $post->montant ?? null ?>">
            <p class="message-error"><?= form_error("montant") ?></p>
        </div>

        <div class="alert alert-danger d-none" id="paiement-error"></div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="_btn _btn-primary w-100">
            <span class="spinner-border spinner-border-sm spinner d-none"></span> Payer
        </button>
    </div>
</form>