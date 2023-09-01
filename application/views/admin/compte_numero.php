<h1 class="h3">Listes des numéros de paiement</h1>
<?php if(isset($delete_error)): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-error">
    <strong>Il y a une erreur!</strong>
    <p class="mb-0">Suppression impossible! Cette item est déjà utilisé</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Numéros enregistrés</span>
        <span>
            <button class="_btn _btn-primary" onclick="create(this)">
                <i class="fa-solid fa-plus"></i>
                <span>Ajouter</span>
            </button>
        </span>
    </h6>
    <div class="form-table">
        <div class="table-responsive table-sticky">
            <table class="table">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Nom du propriétaire</th>
                        <th>Prénoms du propriétaire</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lists as $list): ?>
                    <tr>
                        <td><?= $list->numero ?></td>
                        <td><?= $list->firstname ?></td>
                        <td><?= $list->lastname ?></td>
                        <td>
                            <span role="button" class="btn-tooltip text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editer" onclick="update(<?= $list->id ?>,this)" data-url="<?= base_url('admin/plateforme/getOneNumero') ?>">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </span>
                            <span role="button" class="btn-tooltip ms-1 text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Supprimer" onclick="_delete(<?= $list->id ?>,this)" data-url="<?= base_url('admin/plateforme/deleteNumero') ?>">
                                <i class="fa-regular fa-trash-can"></i>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" id="form-content">
    <?php include('components/form_plateforme_numero.php') ?>
  </div>
</div>