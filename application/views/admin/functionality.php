<h1 class="h3">A propos</h1>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>A propos enregistrés</span>
        <span>
            <button class="_btn _btn-primary" onclick="createFunctionality()">
                <i class="fa-solid fa-edit"></i>
                <span>Modifier</span>
            </button>
			<button type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#modal-functionality" id="open-modal-functionality"></button>
        </span>
    </h6>
    <div class="form-table">
        
        <div class="table-responsive table-sticky">
            <table class="table">
                <thead>
                    <tr>
                        <th>Entête 1</th>
                        <th>Fonctionnalité 1</th>
                        <th>Entête 2</th>
                        <th>Fonctionnalité 2</th>
                        <th>Entête 3</th>
                        <th>Fonctionnalité 3</th>
                        <th>Entête 4</th>
                        <th>Fonctionnalité 4</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($dataF as $list): ?>
                        <tr>
                            <td><?= $list->func1 ?></td>
                            <td><?= $list->content1 ?></td>
                            <td><?= $list->func2 ?></td>
                            <td><?= $list->content2 ?></td>
                            <td><?= $list->func3 ?></td>
                            <td><?= $list->content3 ?></td>
                            <td><?= $list->func4 ?></td>
                            <td><?= $list->content4 ?></td>
                            
                           
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
<div class="modal fade" id="modal-functionality" tabindex="-1" aria-labelledby="modal-header" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" id="form-functionality">
  </div>
</div>