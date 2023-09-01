<h1 class="h3">Contact</h1>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Contact enregistrés</span>
        <span>
            <button class="_btn _btn-primary" onclick="createContact()">
                <i class="fa-solid fa-edit"></i>
                <span>Modifier</span>
            </button>
			<button type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#modal-contact" id="open-modal-contact"></button>
        </span>
    </h6>
    <div class="form-table">
        
        <div class="table-responsive table-sticky">
            <table class="table">
                <thead>
                    <tr>
                        <th>Whatsapp</th>
                        <th>Facebook</th>
                        <th>Adresse</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($contact as $list): ?>
                        <tr>
                            <td><?= $list->whatsapp ?></td>
                            <td><?= $list->facebook ?></td>
                            <td><?= $list->adresse ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-contact" tabindex="-1" aria-labelledby="modal-contact" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" id="form-contact">
     <!-- <?php include('components/form_contact.php') ?> -->
  </div>
</div>