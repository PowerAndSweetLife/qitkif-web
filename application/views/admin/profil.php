<h1 class="h3">Modification profil</h1>

<form class="d-none" id="form-photo-admin">
    <input type="file" id="photo-admin-file" name="photo-file" class="d-none" onchange="previewPhotoAdmin(this)">
</form>

<div id="update-identifiant">
    <?php include('components/form_update_identifiant.php') ?>
</div>

<div id="update-password">
    <?php include('components/form_update_password.php') ?>
</div>