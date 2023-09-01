<h1 class="h3">A propos</h1>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Propos enregistrés</span>
        <span>
            <button class="_btn _btn-primary" onclick="createPropos()">
                <i class="fa-solid fa-edit"></i>
                <span>Modifier</span>
            </button>
			<button type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#modal-propos" id="open-modal-propos"></button>
        </span>
    </h6>
    <div class="form-table">
        
        <div class="table-responsive table-sticky">
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Contenu</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($dataP as $list): ?>
                        <tr>
                            <td><?= $list->titre ?></td>
                            <td><?= $list->contenu ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <nav aria-label="Page navigation" class="d-flex w-100 justify-content-center mb-2">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Préc</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Suiv</a></li>
        </ul>
    </nav> -->
</div>


<!-- Modal -->
<div class="modal fade" id="modal-propos" tabindex="-1" aria-labelledby="modal-propos" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" id="form-propos">
  </div>
</div>