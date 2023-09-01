<h1 class="h4 mb-0">Compte de la plateforme</h1>
<hr class="mt-0 mb-5">
<div class="d-flex">
    <div class="compte-plateforme shadow-sm px-2 py-1">
        <strong>Soldes disponibles</strong>
        <hr class="m-0">
        <div class="compte-content py-4">
            <span class="amount"><?= price($compte->soldes) ?></span>
            <span class="curracy">FCFA</span>
        </div>
    </div>
    <div class="compte-plateforme solde shadow-sm px-2 py-1">
        <strong>Commissions</strong>
        <hr class="m-0">
        <div class="compte-content py-4">
            <span class="amount"><?= format($compte->nbre_commission) ?></span>
        </div>
    </div>
    <div class="compte-plateforme retrait shadow-sm px-2 py-1">
        <strong>Retrait</strong>
        <hr class="m-0">
        <div class="compte-content py-4">
            <span class="amount"><?= format($compte->nbre_retrait) ?></span>
        </div>
    </div>
    <div class="compte-plateforme action shadow-sm px-2 py-1">
        <strong>Faire un retrait</strong>
        <hr class="m-0">
        <div class="compte-content py-4">
            <button class="_btn _btn-primary _btn-lg" onclick="retrait()">Faire un retrait</button>
        </div>
    </div>
</div>

<h1 class="h4 mt-5 mb-0">Historique de transaction</h1>
<hr class="m-0">
<div class="history-transaction-wrapper py-4" id="list-transaction">
    <?php include("components/list_transaction.php") ?>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" id="form-content">
    <?php include('components/form_plateforme_retrait.php') ?>
  </div>
</div>