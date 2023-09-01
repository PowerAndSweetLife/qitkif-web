<?php if($action === "create"): ?>

    <form class="modal-content" onsubmit="submitDescription(event,this)" action="<?= base_url("admin/description/create") ?>">

<?php else: ?>

    <form class="modal-content" onsubmit="submitDescription(event,this)" action="<?= base_url("admin/description/update") ?>">

        <input type="hidden" name="id" value="<?= $post->id ?>">

<?php endif; ?>

    <div class="modal-header">

        <?php if($action === "create"): ?>

            <h1 class="modal-title fs-5">Nouvelle description</h1>

        <?php else: ?>

            <h1 class="modal-title fs-5">Modifier description</h1>

        <?php endif; ?>

        <button type="button" id="close-modal-description" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

    </div>

    <div class="modal-body">

        <div class="form-group">

            <label for="categorie-name">Entête :</label>

            <textarea class="form-control <?= form_error('entete') ? 'error' : '' ?>" id="entete" name="entete"><?= $post->entete ?? null ?></textarea>

            <p class="message-error"><?= form_error("entete") ?></p>

        </div>

        <div class="form-group">

            <label for="categorie-name">Contenu :</label>

            <textarea class="form-control <?= form_error('contenu') ? 'error' : '' ?>" id="contenu" name="contenu"><?= $post->contenu ?? null ?></textarea>

            <p class="message-error"><?= form_error("contenu") ?></p>

        </div>

        <div class="form-group mt-2">

            <label for="operateur-logo" class="mr-4">Image :</label>

            <span class="<?= $action === "create" ? 'd-none' : '' ?>">

                <img class="icon-categorie" src="<?= $action === "update" ? base_url('public/images/' . $post->image) : '' ?>" alt="icone" id="description-logo-preview">

            </span>

            <input type="text" name="logo" value="<?= $post->image ?? null ?>" readonly id="description-logo" class="form-control <?= form_error('image') ? 'error' : '' ?>" placeholder="Choisir une image..." role="button" onclick="browseFile('#operateur-logo-file')">

            <p class="message-error"><?= form_error("logo") ?></p>

            <input type="file" name="logo-file" class="d-none" accept=".png,.jpg,.jpeg,.gif" id="operateur-logo-file" onchange="previewImageDescription(this)">

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