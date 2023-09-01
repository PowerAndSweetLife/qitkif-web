
<form class="modal-content" onsubmit="_submit(event,this)" action="<?= base_url("admin/setting/update") ?>">
    <div class="modal-header">
        <h1 class="modal-title fs-5">Modification</h1>
    </div>
    <div class="modal-body">
        <!-- <div class="form-group">
            <label for="categorie-name">Timbre d'etat :</label>
            <input type="number" class="form-control <?= form_error('timbre') ? 'error' : '' ?>" name="timbre" value="<?= $post->timbre ?? null ?>">
            <p class="message-error"><?= form_error("timbre") ?></p>
        </div> -->
        <div class="form-group">
            <label class="label-commission">Commission acheteur :</label>
            <input type="text" class="form-control <?= form_error('commission_acheteur') ? 'error' : '' ?>" name="commission_acheteur" value="<?= $post->commission_acheteur ?? null ?>">
            <p class="message-error"><?= form_error("commission_acheteur") ?></p>
        </div>
        <div class="form-group">
            <label class="label-commission">Commission vendeur :</label>
            <input type="text" class="form-control <?= form_error('commission_vendeur') ? 'error' : '' ?>" name="commission_vendeur" value="<?= $post->commission_vendeur ?? null ?>">
            <p class="message-error"><?= form_error("commission_vendeur") ?></p>
        </div>
        <div class="form-group d-none">
            <label class="label-commission">Frais de l'operateur :</label>
            <input type="number" class="form-control <?= form_error('frais_operateur') ? 'error' : '' ?>" name="frais_operateur" value="<?= $post->frais_operateur ?? null ?>">
            <p class="message-error"><?= form_error("frais_operateur") ?></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="_btn _btn-success w-100">Modifier</button>
    </div>
</form>