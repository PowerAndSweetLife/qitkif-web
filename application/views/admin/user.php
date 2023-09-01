<h1 class="h3">Listes des utilisateurs</h1>
<?php if(isset($delete_error)): ?>
<?php endif; ?>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Utilisateurs enregistrés</span>
    </h6>
    <div id="table-pagination">
        <?php include('components/table_user.php') ?>
    </div>
</div>
