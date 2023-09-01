<div class="row">
    <div class="col-sm-8">
        <h1 class="h3">Assistances techniques</h1>
    </div>
    <div class="col-sm-4">
        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modal-new-message">
            <span class="me-2"><i class="fa-solid fa-user-pen"></i></span> Ecrire
        </button>
    </div>
</div>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Messages enregistrés</span>
    </h6>
    <div class="form-table">
        <div class="row my-3">
            <div class="col-md-6 col-lg-4">
            </div>
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
                        <th>Client</th>
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
                        <td><?= $list->user->pseudo ?? 'Tous les clients' ?></td>
                        <td><?= datetimeFormat($list->created_at) ?></td>
                        <td>
                            <?php if((int)$list->start_by_admin): ?>
                                <?php if((int)$list->closed):  ?>
                                    <span class="resolved">Fermé</span>
                                <?php else: ?>
                                    <span class="unresolved">Ouvert</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if((int)$list->closed):  ?>
                                    <span class="resolved">Résolu</span>
                                <?php else: ?>
                                    <span class="unresolved">Non résolu</span>
                                <?php endif; ?>
                            <?php endif ?>
                        </td>
                        <td>
                            <span role="button" class="btn-tooltip text-primary" style="font-size: 1.1rem;" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editer" onclick="openMessenger(<?= $list->id ?>)">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <?php if((int)$list->start_by_admin): ?>
                                <?php if((int)$list->closed === 0):  ?>
                                    <span role="button" class="btn-tooltip ms-1 text-secondary" style="font-size: 1.2rem;" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Fermer la discussion" onclick="markAsResolved(<?= $list->id ?>,'assistance')">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                <?php else: ?>
                                    <span class="btn-tooltip ms-1 text-success" style="font-size: 1.2rem;">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </span>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if((int)$list->closed === 0):  ?>
                                    <span role="button" class="btn-tooltip ms-1 text-secondary" style="font-size: 1.2rem;" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Marquer comme résolu" onclick="markAsResolved(<?= $list->id ?>,'assistance')">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </span>
                                <?php else: ?>
                                    <span class="btn-tooltip ms-1 text-success" style="font-size: 1.2rem;">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </span>
                                <?php endif; ?>
                            <?php endif ?>
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
  
<div class="modal fade" id="modal-new-message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="post" onsubmit="sendMessageToUser(event, this)" action="<?= base_url('admin/assistance/startNew') ?>">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nouveau message aux utilisateur</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Objet</label>
                    <input type="text" class="form-control" name="object">
                    <span class="invalid-feedback">Ce champ est requis</span>
                </div>
                <div class="form-group mb-3">
                    <label>Message</label>
                    <textarea name="message" class="form-control" rows="4"></textarea>
                    <span class="invalid-feedback">Ce champ est requis</span>
                </div>
                <div class="form-group mb-3">
                    <label>Les utilisateurs peuvent-ils repondre ?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="no-reply" value="1" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            NON
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="no-reply" value="0" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            OUI
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Envoyer le message</button>
            </div>
        </form>
    </div>
</div>