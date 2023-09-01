<h1 class="h3">Listes des litiges</h1>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Litiges enregistrés</span>
    </h6>
    <div class="form-table">
        <div class="row my-3">
            <div class="col-md-6 col-lg-4"></div>
            <div class="col-md-6 col-lg-4"></div>
            <form class="col-md-6 col-lg-4 position-relative" onsubmit="filterCategorie(event,this)">
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
                        <th>Ticket N°</th>
                        <th>Objet</th>
                        <th>Acheteur</th>
                        <th>Vendeur</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lists as $list): ?>
                    <tr>
                        <td style="font-weight: 700;"><?= $list->numero ?></td>
                        <td><?= $list->objet ?></td>
                        <td>
                            <a href="#" onclick="openMessenger(<?= $list->id ?>, <?= $list->acheteur->id ?>)"><?= $list->acheteur->pseudo ?></a>
                        </td>
                        <td>
                            <a href="#" onclick="openMessenger(<?= $list->id ?>, <?= $list->vendeur->id ?>)"><?= $list->vendeur->pseudo ?></a>
                        </td>
                        <td><?= datetimeFormat($list->created_at) ?></td>
                        <td>
                            <?php if((int)$list->closed):  ?>
                                <span class="resolved">Résolu</span>
                            <?php else: ?>
                                <span class="unresolved">Non résolu</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- <span role="button" class="btn-tooltip text-primary" style="font-size: 1.1rem;" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editer">
                                <i class="fa-solid fa-envelope"></i>
                            </span> -->
                            
                            <?php if((int)$list->closed === 0):  ?>
                                <span role="button" class="btn-tooltip ms-1 text-secondary" style="font-size: 1.2rem;" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Marquer comme résolu" onclick="markAsResolved(<?= $list->id ?>,'litige')">
                                    <i class="fa-regular fa-circle-check"></i>
                                </span>
                            <?php else: ?>
                                <span class="btn-tooltip ms-1 text-success" style="font-size: 1.2rem;">
                                    <i class="fa-solid fa-circle-check"></i>
                                </span>
                            <?php endif; ?>
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