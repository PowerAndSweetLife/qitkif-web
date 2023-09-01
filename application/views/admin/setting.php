<h1 class="h4">Configuration paiement</h1>
<div class="form-container shadow shadow-sm">
    <div class="form-table">
        <div class="table-responsive table-sticky">
            <table class="table">
                <thead>
                    <tr>
                        <!-- <th>Timbre etat</th> -->
                        <th>Commission vendeur</th>
                        <th>Commission acheteur</th>
                        <!-- <th>Frais de l'operateur</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- <td><?= $paiement->timbre ?></td> -->
                        <td><?= $paiement->commission_acheteur ?>%</td>
                        <td><?= $paiement->commission_vendeur ?>%</td>
                        <!-- <td><?= $paiement->frais_operateur ?>%</td> -->
                        <td>
                            <button class="_btn _btn-primary" onclick="update(1,this)" data-url="<?= base_url('admin/setting/get') ?>">Modifier</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" id="form-content">
    <?php include('components/form_setting_paiement.php') ?>
  </div>
</div>
