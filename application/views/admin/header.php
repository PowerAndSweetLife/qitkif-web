<h1 class="h3">Entête</h1>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Entête enregistrés</span>
        <span>
            <button class="_btn _btn-primary" onclick="createHeader()">
                <i class="fa-solid fa-edit"></i>
                <span>Modifier</span>
            </button>
            <button type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#modal-header" id="open-modal-header"></button>
        </span>
    </h6>
    <div class="form-table">
        
        <div class="table-responsive table-sticky">
            <table class="table">
                <thead>
                    <tr>
                        <th>Grand titre</th>
                        <th>Sous titre</th>
                        <th>Slogan</th>
                        <th>Lien Play Store</th>
                        <th>Lien App Store</th>
                        <th>Fichier APK</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dataH as $list): ?>
                        <tr>
                            <td><?= $list->great_title ?></td>
                            <td><?= $list->sub_great_title ?></td>
                            <td><?= $list->slogan ?></td>
                            <td><a target="_blank" href="<?= $list->link_google_play ?>">Lien Play Store</a></td>
                            <td><a target="_blank" href="<?= $list->link_app_store ?>">Lien App Store</a></td>
                            <td><a download href="<?php echo base_url()."public/images/".$list->apk ;?>"><?php echo $list->apk ;?></a></td>
                            <td>
                                <img class="icon-categorie" src="<?= base_url('public/images/' . $list->image) ?>" alt="icone">
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
<div class="modal fade" id="modal-header" tabindex="-1" aria-labelledby="modal-header" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog" id="form-header">
     <!-- <?php include('components/form_header.php') ?> -->
  </div>
</div>