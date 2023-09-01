<form class="modal-content" onsubmit="submitRemboursement(event,this)" action="<?= base_url("admin/remboursement/create") ?>">
    <input type="hidden" name="idService" value="<?= $post->idService ?? null ?>">
    <div class="modal-header">
        <h1 class="modal-title fs-5">Remboursement d'un client</h1>
        <button type="button" id="close-modal-categorie" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Pseudo du client :</label>
            <input type="text" class="form-control <?= form_error('pseudo') ? 'error' : '' ?>" name="pseudo" value="<?= $post->pseudo ?? null ?>" readonly>
            <p class="message-error"><?= form_error("pseudo") ?></p>
        </div>
        <div class="form-group">
            <label>Montant :</label>
            <input type="text" class="form-control" name="montant" value="<?= $post->montant ?? null ?>">
            <p class="message-error"></p>
        </div>

        <div class="alert alert-danger d-none" id="paiement-error"></div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="_btn _btn-primary w-100">
            <span class="spinner-border spinner-border-sm spinner d-none"></span> Rembourser
        </button>
    </div>
</form>