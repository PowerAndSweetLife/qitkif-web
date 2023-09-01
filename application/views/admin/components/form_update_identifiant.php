<form class="form-container shadow shadow-sm" action="<?= base_url('admin/profil/updateIdentifiant') ?>" onsubmit="updateIdentifiant(event,this)">
    <h6 class="form-title d-flex justify-content-between">
        <span>Modifier mon identifiant</span>
        <span>
            <button class="_btn _btn-success">
                <i class="fa-solid fa-user-pen"></i>
                <span>Modifier</span>
            </button>
        </span>
    </h6>
    <div class="form-table">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Identifiant :</label>
                    <input type="text" name="username" class="form-control <?= form_error("username") ? 'error' : '' ?>" value="<?= $username ?>">
                    <p class="message-error"><?= form_error("username") ?></p>
                </div>
                <div class="form-group mt-3">
                    <label>Photo de profil :</label>
                    <input type="text" name="photo" id="photo-admin-input" class="form-control" value="<?= $photo ?>" readonly role="button" placeholder="Choisir une image..." accept=".jpeg,.jpg,.png" onclick="browseFile('#photo-admin-file')">
                </div>
                <div class="form-group mt-3">
                    <label>Votre mot de passe :</label>
                    <div class="form-password">
                        <span onclick="togglePassword(this)" class="eye" data-show="true"><i class="fa-regular fa-eye-slash"></i></span>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control <?= form_error('password') ? 'error' : '' ?><?= isset($pwd_incorrect) ? 'error' : '' ?>" 
                            aria-describedby="emailHelp" 
                            value="<?= $password ?? null ?>"
                        >
                        <p class="message-error mb-0"><?= form_error("password") ?></p>
                        <?php if(isset($pwd_incorrect)): ?>
                            <p class="message-error mb-0">Mot de passe incorrect !</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <div class="admin-photo-wrapper mt-4">
                    <img src="<?= $photo ? base_url('public/images/profils_admin/' . $photo) : base_url('public/images/avatar.png') ?>" id="admin-photo-preview">
                </div>
            </div>
        </div>
    </div>
</form>
