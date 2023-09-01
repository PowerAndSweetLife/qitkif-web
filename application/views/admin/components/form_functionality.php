
<form class="modal-content" onsubmit="submitFunctionality(event,this)" action="<?= base_url("admin/functionality/update") ?>">
        
        <div class="modal-header">
            <h1 class="modal-title fs-5">Modifier à propos</h1>
            <button type="button" id="close-modal-propos" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="header-gt">Entête fonctionnalité 1 :</label>
                <input type="text" class="form-control <?= form_error('func1') ? 'error' : '' ?>" id="header-gt" name="func1" value="<?= $dataF->func1 ?? null ?>">
                <p class="message-error"><?= form_error("func1") ?></p>
            </div>
            <div class="form-group">
                <label for="header-gt">Contenu 1 :</label>
                <textarea class="form-control <?= form_error('content1') ? 'error' : '' ?>" id="header-gt" name="content1"><?= $dataF->content1 ?? null ?></textarea>
                <p class="message-error"><?= form_error("content1") ?></p>
            </div>
            <div class="form-group">
                <label for="header-gt">Entête fonctionnalité 2 :</label>
                <input type="text" class="form-control <?= form_error('func2') ? 'error' : '' ?>" id="header-gt" name="func2" value="<?= $dataF->func2 ?? null ?>">
                <p class="message-error"><?= form_error("func2") ?></p>
            </div>
            <div class="form-group">
                <label for="header-gt">Contenu 2 :</label>
                <textarea class="form-control <?= form_error('content2') ? 'error' : '' ?>" id="header-gt" name="content2"><?= $dataF->content2 ?? null ?></textarea>
                
                <p class="message-error"><?= form_error("content2") ?></p>
            </div>
            <div class="form-group">
                <label for="header-gt">Entête fonctionnalité 3 :</label>
                <input type="text" class="form-control <?= form_error('func3') ? 'error' : '' ?>" id="header-gt" name="func3" value="<?= $dataF->func3 ?? null ?>">
                <p class="message-error"><?= form_error("func3") ?></p>
            </div>
            <div class="form-group">
                <label for="header-gt">Contenu 3 :</label>
                <textarea class="form-control <?= form_error('content3') ? 'error' : '' ?>" id="header-gt" name="content3"><?= $dataF->content3 ?? null ?></textarea>
                
                <p class="message-error"><?= form_error("content3") ?></p>
            </div>
            <div class="form-group">
                <label for="header-gt">Entête fonctionnalité 4 :</label>
                <input type="text" class="form-control <?= form_error('func3') ? 'error' : '' ?>" id="header-gt" name="func4" value="<?= $dataF->func4 ?? null ?>">
                <p class="message-error"><?= form_error("func3") ?></p>
            </div>
            <div class="form-group">
                <label for="header-gt">Contenu 4 :</label>
                <textarea class="form-control <?= form_error('content4') ? 'error' : '' ?>" id="header-gt" name="content4"><?= $dataF->content4 ?? null ?></textarea>
                
                <p class="message-error"><?= form_error("content4") ?></p>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="submit" class="_btn _btn-success w-100">Modifier</button>
        </div>
    </form>