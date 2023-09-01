<form class="form-container shadow shadow-sm mt-5" action="<?= base_url('admin/profil/updatePassword') ?>" onsubmit="updatePassword(event,this)">
    <h6 class="form-title d-flex justify-content-between">
        <span>Modifier mon mot de passe</span>
        <span>
            <button class="_btn _btn-success">
                <i class="fa-solid fa-user-pen"></i>
                <span>Modifier</span>
            </button>
        </span>
    </h6>
    <div class="form-table">
        <div action="<?= base_url('admin/profil/update') ?>" class="row">
            <div class="col-md-8">
                <div class="form-group mt-3">
                    <label>Nouveau mot de passe :</label>
                    <div class="form-password">
                        <span onclick="togglePassword(this)" class="eye" data-show="true"><i class="fa-regular fa-eye-slash"></i></span>
                        <input 
                            type="password" 
                            name="new_password" 
                            class="form-control <?= form_error('new_password') ? 'error' : '' ?><?= isset($not_identic) ? 'error' : '' ?>" 
                            aria-describedby="emailHelp" 
                            value="<?= $new_password ?? null ?>"
                        >
                        <p class="message-error"><?= form_error("new_password") ?></p>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label>Confirmer mot de passe :</label>
                    <div class="form-password">
                        <span onclick="togglePassword(this)" class="eye" data-show="true"><i class="fa-regular fa-eye-slash"></i></span>
                        <input 
                            type="password" 
                            name="confirm_password" 
                            class="form-control <?= form_error('confirm_password') ? 'error' : '' ?><?= isset($not_identic) ? 'error' : '' ?>" 
                            aria-describedby="emailHelp" 
                            value="<?= $confirm_password ?? null ?>"
                        >
                        <p class="message-error"><?= form_error("confirm_password") ?></p>
                    </div>
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
                            <p class="message-error">Mot de passe incorrect !</p>
                        <?php endif ?>
                    </div>
                </div>

                <?php if(isset($not_identic)): ?>
                    <p class="message-error">Les deux mot de passe ne sont pas identique</p>
                <?php endif ?>

            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</form>