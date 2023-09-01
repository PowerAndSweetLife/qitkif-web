<div class="form-table">
        <div class="row my-3">
            <div class="col-md-6 col-lg-4"></div>
            <div class="col-md-6 col-lg-4"></div>
            <form class="col-md-6 col-lg-4 position-relative" action="<?= base_url('admin/offre/filter') ?>" onsubmit="filterInPagination(event,this)">
                <input type="search" class="form-control" name="query" placeholder="Recherche" value="<?= $query ?? null ?>">
                <button class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="table-responsive table-sticky">
            <table class="table">
                <thead>
                    <tr>
                        <th>Réference</th>
                        <th>Objet</th>
                        <th>Acheteur</th>
                        <th>Vendeur</th>
                        <th>Type</th>
                        <th>Montant</th>
                        <th>Mode de remise</th>
                        <th>Catégorie</th>
                        <th>Etat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lists as $list): ?>
                    <tr class="table-tr" onclick="showOffre(<?= $list->id ?>)">
                        <td><?= str_pad($list->id, 5, '0', STR_PAD_LEFT) ?></td>
                        <td><?= ucfirst($list->nom_objet) ?></td>
                        <td><?= $list->acheteur->pseudo ?></td>
                        <td><?= $list->vendeur->pseudo ?></td>
                        <td><?= ucfirst($list->action) ?></td>
                        <td><?= price($list->montant) ?> CFA</td>
                        <td><?= ucfirst($list->mode_remise) ?></td>
                        <td><?= $list->categorie->nom ?></td>
                        <td><?= Offre::STATES_ADMIN[(int)$list->etat] ?></td>
                        <td>
                            <span role="button" class="btn-tooltip ms-1 text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Supprimer" onclick="deleteInPagination(<?= $list->id ?>,'<?= base_url('admin/offre/delete') ?>')">
                                <i class="fa-regular fa-trash-can"></i>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($isPaginate): ?>
    <nav aria-label="Page navigation" class="d-flex w-100 justify-content-center mb-2">
        <ul class="pagination">
            <?php if((int)$currentPage > 1): ?>
                <li class="page-item"><a class="page-link me-2" onclick="paginate(event,this)" href="<?= base_url('admin/offre/page/' . ((int)$currentPage - 1) ) ?>">Préc</a></li>
            <?php else: ?>
                <li class="page-item disabled"><a class="page-link me-2" href="#">Préc</a></li>
            <?php endif; ?>

            
            
            <?php if($isLast): ?>
                <li class="page-item disabled"><a class="page-link me-2" href="#">Suiv</a></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link me-2" onclick="paginate(event,this)" href="<?= base_url('admin/offre/page/' . ((int)$currentPage + 1) ) ?>">Suiv</a></li>
            <?php endif; ?>

        </ul>
    </nav>
    <?php endif; ?>