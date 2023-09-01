<h1 class="h3">Listes des F.A.Q</h1>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>FAQ enregistrés</span>
        <span>
            <button class="_btn _btn-primary" onclick="createFaq()">
                <i class="fa-solid fa-plus"></i>
                <span>Ajouter</span>
            </button>
			<button type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#modal-faq" id="open-modal-faq"></button>
        </span>
    </h6>
    <div class="form-table">
        <div class="row my-3">
            <div class="col-md-6 col-lg-4"></div>
            <div class="col-md-6 col-lg-4"></div>
            <form class="col-md-6 col-lg-4 position-relative" onsubmit="filterFaq(event,this)">
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
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lists as $list): ?>
                    <tr>
                        <td><?= $list->title ?></td>
                        <td><?= $list->content ?></td>
                        <td>
                            <span role="button" class="btn-tooltip text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editer" onclick="updateFaq(<?= $list->id ?>)">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </span>
                            <span role="button" class="btn-tooltip ms-1 text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Supprimer" onclick="deleteFaq(<?= $list->id ?>)">
                                <i class="fa-regular fa-trash-can"></i>
                            </span>
                        </td>
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
<div class="modal fade" id="modal-faq" tabindex="-1" aria-labelledby="modal-faq" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg" id="form-faq">
    <?php include('components/form_faq.php') ?>
  </div>
</div>