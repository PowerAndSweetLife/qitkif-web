<?php if($action === "create"): ?>

<form class="modal-content" onsubmit="submitFaq(event,this)" action="<?= base_url("admin/faq/create") ?>">

<?php else: ?>

<form class="modal-content" onsubmit="submitFaq(event,this)" action="<?= base_url("admin/faq/update") ?>">

    <input type="hidden" name="id" value="<?= $post->id ?>">

<?php endif; ?>

<div class="modal-header">

    <?php if($action === "create"): ?>

        <h1 class="modal-title fs-5">Nouvelle F.A.Q</h1>

    <?php else: ?>

        <h1 class="modal-title fs-5">Modifier F.A.Q</h1>

    <?php endif; ?>

    <button type="button" id="close-modal-faq" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

</div>

<div class="modal-body">

    <div class="form-group">

        <label for="categorie-name">Titre :</label>

        <textarea class="form-control <?= form_error('title') ? 'error' : '' ?>" id="title" name="title"><?= $post->title ?? null ?></textarea>

        <p class="message-error"><?= form_error("title") ?></p>

    </div>

    <div class="form-group">

        <label for="categorie-name">Contenu :</label>

        <textarea class="form-control <?= form_error('content') ? 'error' : '' ?>" rows="5" id="content" name="content"><?= $post->content ?? null ?></textarea>

        <p class="message-error"><?= form_error("content") ?></p>

    </div>

</div>

<div class="modal-footer">

    <?php if($action === "create"): ?>

        <button type="submit" class="_btn _btn-primary w-100">Enregistrer</button>

    <?php else: ?>

        <button type="submit" class="_btn _btn-success w-100">Modifier</button>

    <?php endif; ?>

</div>

</form>