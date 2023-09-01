<form class="modal-content" onsubmit="_submit(event,this)" action="<?= base_url("admin/plateforme/runRetrait") ?>">
    <div class="modal-header">
        <h1 class="modal-title fs-5">Retirer de l'argent</h1>
        <button type="button" id="close-modal-categorie" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <?php if(isset($soldeError)): ?>
            <div class="alert alert-danger">
                Solde de compte insuffisant
            </div>
        <?php endif; ?>
        <?php if(isset($apiError)): ?>
            <div class="alert alert-danger">
                <?= $apiError ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="categorie-name">Numéro :</label>
            <select class="form-control <?= form_error('numero') ? 'error' : '' ?>" name="numero">
                <?php foreach($comptes as $compte): ?>
                    <?php if(isset($post)): ?>
                        <option value="<?= $compte->id ?>" <?= (int)$compte->id === (int)$post->numero ? 'selected' : ''  ?> ><?= $compte->numero ?></option>
                    <?php else: ?>
                        <option value="<?= $compte->id ?>"><?= $compte->numero ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <p class="message-error"><?= form_error("numero") ?></p>
        </div>
        <div class="form-group">
            <label for="categorie-name">Montant :</label>
            <input type="number" class="form-control <?= form_error('montant') ? 'error' : '' ?>" name="montant" value="<?= $post->montant ?? null ?>">
            <p class="message-error"><?= form_error("montant") ?></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="_btn _btn-success w-100">
            <span id="submit-loader" class="spinner-border spinner-border-sm me-2 d-none"></span>
            <span>Retirer</span>
        </button>
    </div>
</form>