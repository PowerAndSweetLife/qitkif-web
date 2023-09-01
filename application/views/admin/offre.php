<h1 class="h3">Listes des offres</h1>
<?php if(isset($delete_error)): ?>
<?php endif; ?>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Offres enregistrés</span>
    </h6>
    <div id="table-pagination">
        <?php include('components/table_offre.php') ?>
    </div>
</div>

<div class="modal fade" id="modal-offre" tabindex="-1" aria-labelledby="modal-offre" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" id="form-offre">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">Détail de l'offre</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="modal-offre-content"></div>
    </div>
  </div>
</div>