<h1 class="h3">Listes des opérateurs</h1>
<?php if(isset($delete_error)): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-error">
    <strong>Il y a une erreur!</strong>
    <p class="mb-0">Suppression impossible! Cette item est déjà utilisé</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Opérateurs enregistrés</span>
        <span>
            <button class="_btn _btn-primary" onclick="createOperateur()">
                <i class="fa-solid fa-plus"></i>
                <span>Ajouter</span>
            </button>
			<button type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#modal-operateur" id="open-modal-operateur"></button>
        </span>
    </h6>
    <div class="form-table">
        <div class="row my-3">
            <div class="col-md-6 col-lg-4"></div>
            <div class="col-md-6 col-lg-4"></div>
            <form class="col-md-6 col-lg-4 position-relative" onsubmit="filterOperateur(event,this)">
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
                        <th>Logo</th>
                        <th>Nom</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lists as $list): ?>
                    <tr>
                        <td>
                            <img class="icon-categorie" src="<?= base_url('public/images/' . $list->logo) ?>" alt="icone">
                        </td>
                        <td><?= $list->nom ?></td>
                        <td>
                            <span role="button" class="btn-tooltip text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editer" onclick="updateOperateur(<?= $list->id ?>)">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </span>
                            <span role="button" class="btn-tooltip ms-1 text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Supprimer" onclick="deleteOperateur(<?= $list->id ?>)">
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
<div class="modal fade" id="modal-operateur" tabindex="-1" aria-labelledby="modal-operateur" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" id="form-operateur">
     <?php include('components/form_operateur.php') ?>
  </div>
</div>