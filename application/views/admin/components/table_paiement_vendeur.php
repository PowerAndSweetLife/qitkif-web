<div class="form-table">
        <div class="row my-3">
            <div class="col-md-6 col-lg-4"></div>
            <div class="col-md-6 col-lg-4"></div>
            <form class="col-md-6 col-lg-4 position-relative" action="<?= base_url('admin/user/filter') ?>" onsubmit="filterInPagination(event,this)">
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
                        <th>Pseudo</th>
                        <th>Nom & prénoms</th>
                        <th>Contact</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lists as $list): ?>
                    <tr>
                        <td><?= $list->pseudo ?></td>
                        <td><?= $list->firstname ?> <?= $list->lastname ?></td>
                        <td><?= $list->phone ?></td>
                        <td><?= number_format($list->montant,0,'.',' ') ?></td>
                        <td><?= datetimeFormat($list->date_) ?></td>
                        <td>
                            <?php if((int)$list->is_paid === 0): ?>
                                <span role="button" class="btn-tooltip ms-1 text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Payer" onclick="payVendeur(<?= $list->p_id ?>)">
                                    <i class="fa-solid fa-hand-holding-dollar"></i>
                                </span>
                            <?php else: ?>
                                <span class="btn-tooltip ms-1 text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Payer">
                                    <i class="fa-solid fa-hand-holding-dollar"></i>
                                </span>
                            <?php endif; ?>
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
                <li class="page-item"><a class="page-link me-2" onclick="paginate(event,this)" href="<?= base_url('admin/paiement/page/' . ((int)$currentPage - 1) ) ?>">Préc</a></li>
            <?php else: ?>
                <li class="page-item disabled"><a class="page-link me-2" href="#">Préc</a></li>
            <?php endif; ?>

            
            
            <?php if($isLast): ?>
                <li class="page-item disabled"><a class="page-link me-2" href="#">Suiv</a></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link me-2" onclick="paginate(event,this)" href="<?= base_url('admin/paiement/page/' . ((int)$currentPage + 1) ) ?>">Suiv</a></li>
            <?php endif; ?>

        </ul>
    </nav>
    <?php endif; ?>