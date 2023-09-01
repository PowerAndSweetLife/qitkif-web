
<form class="modal-content" onsubmit="submitHeader(event,this)" action="<?= base_url("admin/header/update") ?>">
        
    <div class="modal-header">
        <h1 class="modal-title fs-5">Modifier header</h1>
        <button type="button" id="close-modal-header" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="header-gt">Grand titre :</label>
            <input type="text" class="form-control <?= form_error('nom') ? 'error' : '' ?>" id="header-gt" name="great_title" value="<?= $dataH->great_title ?? null ?>">
            <p class="message-error"><?= form_error("great_title") ?></p>
        </div>
        <div class="form-group mt-2">
            <label for="header-st">Sous-titre :</label>
            <input type="text" class="form-control <?= form_error('nom') ? 'error' : '' ?>" id="header-st" name="sub_great_title" value="<?= $dataH->sub_great_title ?? null ?>">
            <p class="message-error"><?= form_error("sub_great_title") ?></p>
        </div>
        <div class="form-group mt-2">
            <label for="header-st">slogan :</label>
            <input type="text" class="form-control <?= form_error('nom') ? 'error' : '' ?>" id="header-st" name="slogan" value="<?= $dataH->slogan ?? null ?>">
            <p class="message-error"><?= form_error("slogan") ?></p>
        </div>
        <div class="form-group mt-2">
            <label for="header-st">Lien Play Store :</label>
            <input type="text" class="form-control <?= form_error('nom') ? 'error' : '' ?>" id="header-st" name="link_google_play" value="<?= $dataH->link_google_play ?? null ?>">
            <p class="message-error"><?= form_error("link_google_play") ?></p>
        </div>
        <div class="form-group mt-2">
            <label for="header-st">Lien App Store :</label>
            <input type="text" class="form-control <?= form_error('nom') ? 'error' : '' ?>" id="header-st" name="link_app_store" value="<?= $dataH->link_app_store ?? null ?>">
            <p class="message-error"><?= form_error("link_app_store") ?></p>
        </div>
        <div class="form-group mt-2">
            <label for="header-st">Fichier APK: </label>
            <input type="file" class="form-control <?= form_error('apk') ? 'error' : '' ?>" id="header-st" name="apk" value="<?= $dataH->apk ?? null ?>">
            <p class="message-error"><?= form_error("apk") ?></p>
        </div>
        <div class="form-group mt-2">
            <label for="header-icon" class="mr-4">Image :</label>
            <span>
                <img class="icon-categorie" src="<?= base_url('public/images/'. $dataH->image) ?>" alt="icone" id="categorie-icon-preview">
            </span>
            <input type="text" name="image" value="<?= $dataH->image ?? null ?>" readonly id="categorie-icon" class="form-control <?= form_error('icon') ? 'error' : '' ?>" placeholder="Choisir une image..." role="button" onclick="browseFile('#header-icon-file')">
            <p class="message-error"><?= form_error("icon") ?></p>
            <input type="file" name="icon-file" class="d-none" accept=".png,.jpg,.jpeg,.gif" id="header-icon-file" onchange="previewIconCategorie(this)">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="_btn _btn-success w-100">Modifier</button>
    </div>
</form>
