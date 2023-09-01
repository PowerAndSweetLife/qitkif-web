<?php if(!empty($messages)): ?>
    <div class="center-header">
        <div class="d-flex bg-primary text-light px-3">
            <div class="w-50 text-start py-1">Ticket N° <?= $service->numero ?></div>
            <div class="w-50 text-end py-1"><?= $service->type === "litige" ? "Reglement litige" : "Assistance technique" ?></div>
        </div>
        <div class="px-3 py-2 d-flex">
            <img src="<?= base_url('public/images/avatar.png') ?>" alt="photo de profil" class="photo-messenger">
            <div class="ps-3">
                <strong><?= $service->acheteur->pseudo ?></strong><br>
                <span><?= $service->acheteur->phone ?></span>
            </div>
        </div>
    </div>
    <div class="center-body px-3 py-2">
        <?php foreach($messages as $message): ?>
            <?php if($message->sender === "user"): ?>
                <?php if($message->message): ?>
                    <div class="message-left">
                        <div class="message-content">
                            <?= $message->message ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($message->piece_jointe): ?>
                    <div class="message-left">
                        <div class="message-piece-jointe">
                            <img src="<?= base_url('public/piece_jointe/' . $message->piece_jointe) ?>">
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <?php if($message->message): ?>
                    <div class="message-right">
                        <div class="message-content">
                            <?= $message->message ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($message->piece_jointe): ?>
                    <div class="message-right">
                        <div class="message-piece-jointe">
                            <img src="<?= base_url('public/piece_jointe/' . $message->piece_jointe) ?>">
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    
    <form class="d-none" id="form-service-info">
        <input type="hidden" name="id-user" value="<?= $service->id_user ?>" id="id-user-messenger">
        <input type="hidden" name="id-service" value="<?= $service->id ?>" id="id-service-messenger">
    </form>
    <form class="center-footer px-3" action="<?= base_url('admin/messenger/send') ?>" onsubmit="sendMessage(event,this)">
        <span role="button" class="messenger-icon" onclick="browseFile('#messenger-file')">
            <i class="fa-solid fa-paperclip"></i>
        </span>
        <input type="file" class="d-none" id="messenger-file" name="piece-jointe">
        <textarea name="message" class="form-control ms-2" rows="1" placeholder="Votre message..." style="resize: none;"></textarea>
        <button class="messenger-icon send" style="border: none; background: transparent;">
            <i class="fa-solid fa-location-arrow"></i>
        </button>
    </form>
<?php endif; ?>