<h1 class="h3">Listes des promotions</h1>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Promotions enregistrées</span>
        <span>
            <button class="_btn _btn-primary" onclick="createPromotions()">
                <i class="fa-solid fa-plus"></i>
                <span>Ajouter</span>
            </button>
			<button type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#modal-promotion" id="open-modal-promotion"></button>
        </span>
    </h6>
    <div class="form-table">
        <div class="row my-3">
            <div class="col-md-6 col-lg-4"></div>
            <div class="col-md-6 col-lg-4"></div>
            <form class="col-md-6 col-lg-4 position-relative" onsubmit="filterPromotions(event,this)">
                <input type="search" class="form-control" placeholder="Recherche" value="<?= $query ?? null ?>">
                <button class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="table-responsive table-sticky">
            <table class="table">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Lien</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lists as $list): ?>
                        <tr>
                            <td>
                            <img class="icon-categorie" src="<?= base_url('public/images/icon_promotion/' . $list->icon) ?>" alt="icone">
                            </td>
                            <td><?= $list->lien ?></td>
                            <td><?= $list->message ?></td>
                            <td>
                                <span role="button" class="btn-tooltip text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editer" onclick="updatePromotions(<?= $list->id ?>)">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </span>
                                <span role="button" class="btn-tooltip ms-1 text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Supprimer" onclick="deletePromotions(<?= $list->id ?>)">
                                    <i class="fa-regular fa-trash-can"></i>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
<div class="modal fade" id="modal-promotion" tabindex="-1" aria-labelledby="modal-promotion" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" id="form-promotion">
     <?php include('components/form_promotion.php') ?>
  </div>
</div>
  