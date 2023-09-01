<h1 class="h3">Listes des vendeurs</h1>
<?php if(isset($delete_error)): ?>
<?php endif; ?>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Vendeur enregistrés</span>
    </h6>
    <div id="table-pagination">
        <?php include('components/table_paiement_vendeur.php') ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-paiement-vendeur" tabindex="-1" aria-labelledby="modal-paiement-vendeur" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" id="form-paiement-vendeur">
    <?php include('components/form_paiement_vendeur.php') ?>
  </div>
</div>