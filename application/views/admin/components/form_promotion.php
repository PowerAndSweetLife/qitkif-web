<?php if($action === "create"): ?>
    <form class="modal-content" onsubmit="submitPromotion(event,this)" action="<?= base_url("admin/promotion/create") ?>">
<?php else: ?>
    <form class="modal-content" onsubmit="submitPromotion(event,this)" action="<?= base_url("admin/promotion/update") ?>">
        <input type="hidden" name="id" value="<?= $post->id ?>">
<?php endif; ?>
    <div class="modal-header">
        <?php if($action === "create"): ?>
            <h1 class="modal-title fs-5">Nouvelle promotion</h1>
        <?php else: ?>
            <h1 class="modal-title fs-5">Modifier promotion</h1>
        <?php endif; ?>
        <button type="button" id="close-modal-promotion" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Lien :</label>
            <input type="text" class="form-control" name="lien" value="<?= $post->lien ?? null ?>">
            <p class="message-error"><?= form_error("lien") ?></p>
        </div>
        <div class="form-group mt-2">
            <label class="mr-4">Icon :</label>
            <span class="<?= $action === "create" ? 'd-none' : '' ?>">
                <img class="icon-categorie" src="<?= $action === "update" ? base_url('public/images/icon_promotion/' . $post->icon) : '' ?>" alt="icone" id="categorie-icon-preview">
            </span>
            <input type="text" name="icon" value="<?= $post->icon ?? null ?>" readonly id="categorie-icon" class="form-control <?= form_error('icon') ? 'error' : '' ?>" placeholder="Choisir une image..." role="button" onclick="browseFile('#categorie-icon-file')">
            <p class="message-error"><?= form_error("icon") ?></p>
            <input type="file" name="icon-file" class="d-none" accept=".png,.jpg,.jpeg,.gif" id="categorie-icon-file" onchange="previewIconCategorie(this)">
        </div>    
        <div class="form-group">
            <label>Message :</label>
            <textarea class="form-control" name="message"><?= $post->message ?? null ?></textarea>
            <p class="message-error"><?= form_error("message") ?></p>
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