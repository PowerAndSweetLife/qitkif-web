
<form class="modal-content" onsubmit="submitContact(event,this)" action="<?= base_url("admin/contact/update") ?>">
        
    <div class="modal-header">
        <h1 class="modal-title fs-5">Modifier contact</h1>
        <button type="button" id="close-modal-contact" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="header-gt">Whatsapp :</label>
            <input type="text" class="form-control <?= form_error('whatsapp') ? 'error' : '' ?>" id="header-gt" name="whatsapp" value="<?= $contact->whatsapp ?? null ?>">
            <p class="message-error"><?= form_error("whatsapp") ?></p>
        </div>
        <div class="form-group mt-2">
            <label for="header-st">Facebook :</label>
            <input type="text" class="form-control <?= form_error('facebook') ? 'error' : '' ?>" id="header-st" name="facebook" value="<?= $contact->facebook ?? null ?>">
            <p class="message-error"><?= form_error("facebook") ?></p>
        </div>
        <div class="form-group mt-2">
            <label for="header-st">Adresse :</label>
            <input type="text" class="form-control <?= form_error('adresse') ? 'error' : '' ?>" id="header-st" name="adresse" value="<?= $contact->adresse ?? null ?>">
            <p class="message-error"><?= form_error("adresse") ?></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="_btn _btn-success w-100">Modifier</button>
    </div>
</form>
