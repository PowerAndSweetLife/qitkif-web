
<form class="modal-content" onsubmit="submitPropos(event,this)" action="<?= base_url("admin/propos/update") ?>">
        
        <div class="modal-header">
            <h1 class="modal-title fs-5">Modifier à propos</h1>
            <button type="button" id="close-modal-propos" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="header-gt">Titre :</label>
                <input type="text" class="form-control <?= form_error('nom') ? 'error' : '' ?>" id="header-gt" name="titre" value="<?= $dataP->titre ?? null ?>">
                <p class="message-error"><?= form_error("titre") ?></p>
            </div>
            <div class="form-group">
                <label for="header-gt">Contenu :</label>
                <textarea class="form-control <?= form_error('nom') ? 'error' : '' ?>" id="header-gt" name="contenu" ><?= $dataP->contenu ?? null ?></textarea>
                <p class="message-error"><?= form_error("contenu") ?></p>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="submit" class="_btn _btn-success w-100">Modifier</button>
        </div>
    </form>