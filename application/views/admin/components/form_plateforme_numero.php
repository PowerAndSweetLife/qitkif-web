<?php if($action === "create"): ?>
    <form class="modal-content" onsubmit="_submit(event,this)" action="<?= base_url("admin/plateforme/createNumero") ?>">
<?php else: ?>
    <form class="modal-content" onsubmit="_submit(event,this)" action="<?= base_url("admin/plateforme/updateNumero") ?>">
        <input type="hidden" name="id" value="<?= $post->id ?>">
<?php endif; ?>
    <div class="modal-header">
        <?php if($action === "create"): ?>
            <h1 class="modal-title fs-5">Ajouter un numéro</h1>
        <?php else: ?>
            <h1 class="modal-title fs-5">Modifier un numéro</h1>
        <?php endif; ?>
        <button type="button" id="close-modal-categorie" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="categorie-name">Numéro :</label>
            <div class="d-flex">
                <input type="text" value="+225" class="form-control me-1" disabled style="width: 75px; font-size: 1.2rem">
                <input type="text" class="form-control <?= form_error('numero') ? 'error' : '' ?>" name="numero" value="<?= $post->numero ?? null ?>">
            </div>
            <div class="d-flex">
                <div style="width: 75px;" class="me-2"></div>
                <p class="message-error"><?= form_error("numero") ?></p>
            </div>
            
        </div>
        <div class="form-group">
            <label for="categorie-name">Nom du proprietaire :</label>
            <input type="text" class="form-control <?= form_error('firstname') ? 'error' : '' ?>" name="firstname" value="<?= $post->firstname ?? null ?>">
            <p class="message-error"><?= form_error("firstname") ?></p>
        </div>
        <div class="form-group">
            <label for="categorie-name">Prénoms du proprietaire :</label>
            <input type="text" class="form-control <?= form_error('lastname') ? 'error' : '' ?>" name="lastname" value="<?= $post->lastname ?? null ?>">
            <p class="message-error"><?= form_error("lastname") ?></p>
        </div>
    </div>
    <div class="modal-footer">
        <?php if($action === "create"): ?>
            <button type="submit" class="_btn _btn-primary w-100">Enregistrer</button>
        <?php else: ?>
            <button type="submit" class="_btn _btn-success w-100">Modifier</button>
        <?php endif; ?>
    </div>
</form>