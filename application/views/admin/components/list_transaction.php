<div class="lists">
    <?php foreach($histories as $history): ?>
        <?php if($history->motif === "retrait"): ?>
            <div class="alert alert-secondary py-2 mb-2">
                <div class="d-flex justify-content-between">
                    <strong><?= datetimeFormat($history->date_) ?></strong>
                    <!-- <span role="button" class="text-danger"><i class="fa-solid fa-trash-can"></i></span> -->
                </div>
                <span>Retrait d'un montant de <?= price($history->montant) ?> FCFA</span><br>
            </div>
        <?php else: ?>
            <div class="alert alert-secondary py-1 mb-2">
                <div class="d-flex justify-content-between">
                    <strong><?= datetimeFormat($history->date_) ?></strong>
                    <!-- <span role="button" class="text-danger"><i class="fa-solid fa-trash-can"></i></span> -->
                </div>
                <span>Reception d'un montant de <?= price($history->montant) ?> FCFA</span><br>
                <span>Commission d' <?= $history->motif === "achat" ? "un achat" : "une vente" ?></span><br>
                <span>Réf: <?= $history->motif === "achat" ? "#A" . str_pad($history->id_offre, 5, "0", STR_PAD_LEFT) : "#V" . str_pad($history->id_offre, 5, "0", STR_PAD_LEFT) ?></span><br>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    
</div>
<?php if($pagination): ?>
    <div class="list-pagination d-flex justify-content-center mt-2">
        <div class="d-flex justify-content-around" style="min-width: 400px;">
            <?php if($page > 1): ?>
                <span role="button" data-url="<?= base_url('admin/plateforme/paginate') ?>" onclick="paginateTransaction(<?= $page - 1 ?>,this)">
                    <span style="font-size: 13px;">
                        <i class="fa-solid fa-chevron-left"></i><i class="fa-solid fa-chevron-left"></i>
                    </span>
                    <span>Page précedent</span>
                </span>
            <?php else: ?>
                <span>
                    <span style="font-size: 13px;">
                        <i class="fa-solid fa-chevron-left"></i><i class="fa-solid fa-chevron-left"></i>
                    </span>
                    <span>Page précedent</span>
                </span>
            <?php endif; ?>
            <span>
                <strong><?= $page ?></strong>
                <span class="mx-1">/</span>
                <span><?= $nbrePage ?></span>
            </span>
            <?php if($page < $nbrePage): ?>
                <span role="button" data-url="<?= base_url('admin/plateforme/paginate') ?>" onclick="paginateTransaction(<?= $page + 1 ?>,this)">
                    <span>Page suivant</span>
                    <span style="font-size: 13px;">
                        <i class="fa-solid fa-chevron-right"></i><i class="fa-solid fa-chevron-right"></i>
                    </span>
                </span>
            <?php else: ?>
                <span>
                    <span>Page suivant</span>
                    <span style="font-size: 13px;">
                        <i class="fa-solid fa-chevron-right"></i><i class="fa-solid fa-chevron-right"></i>
                    </span>
                </span>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>