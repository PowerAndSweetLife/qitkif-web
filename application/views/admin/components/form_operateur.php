<?php if($action === "create"): ?>
    <form class="modal-content" onsubmit="submitOperateur(event,this)" action="<?= base_url("admin/operateur/create") ?>">
<?php else: ?>
    <form class="modal-content" onsubmit="submitOperateur(event,this)" action="<?= base_url("admin/operateur/update") ?>">
        <input type="hidden" name="id" value="<?= $post->id ?>">
<?php endif; ?>
    <div class="modal-header">
        <?php if($action === "create"): ?>
            <h1 class="modal-title fs-5">Nouvel opérateur</h1>
        <?php else: ?>
            <h1 class="modal-title fs-5">Modifier un opérateur</h1>
        <?php endif; ?>
        <button type="button" id="close-modal-operateur" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="categorie-name">Nom :</label>
            <input type="text" class="form-control <?= form_error('nom') ? 'error' : '' ?>" id="categorie-name" name="nom" value="<?= $post->nom ?? null ?>">
            <p class="message-error"><?= form_error("nom") ?></p>
        </div>
        <div class="form-group mt-2">
            <label for="operateur-logo" class="mr-4">Logo :</label>
            <span class="<?= $action === "create" ? 'd-none' : '' ?>">
                <img class="icon-categorie" src="<?= $action === "update" ? base_url('public/images/' . $post->logo) : '' ?>" alt="icone" id="operateur-logo-preview">
            </span>
            <input type="text" name="logo" value="<?= $post->logo ?? null ?>" readonly id="operateur-logo" class="form-control <?= form_error('logo') ? 'error' : '' ?>" placeholder="Choisir une image..." role="button" onclick="browseFile('#operateur-logo-file')">
            <p class="message-error"><?= form_error("logo") ?></p>
            <input type="file" name="logo-file" class="d-none" accept=".png,.jpg,.jpeg,.gif" id="operateur-logo-file" onchange="previewLogoOperateur(this)">
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