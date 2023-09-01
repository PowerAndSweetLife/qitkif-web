<h1 class="h3">Messages</h1>
<div class="form-container shadow shadow-sm">
    <h6 class="form-title d-flex justify-content-between">
        <span>Ticket N° <?= $service->numero ?></span>
        <strong><?= $service->type === "litige" ? "Reglement litige" : "Assistance technique" ?></strong>
    </h6>
    <div>
        <div class="message-wrapper" id="message-content">
            <?php foreach($messages as $message): ?>
                <div class="alert message-list d-flex" role="alert">
                    <div>
                        <?php if($message->sender === 'user'): ?>
                            <?php if((int)$service->start_by_admin): ?>
                                <img src="<?= $message->photo ? 
                                    base_url('public/images/profils/' . $message->photo) : base_url('public/images/avatar.png') ?>" 
                                    class="photo-messenger">
                            <?php else: ?>
                                <img src="<?= $service->_sender->photo ? 
                                    base_url('public/images/profils/' . $service->_sender->photo) : base_url('public/images/avatar.png') ?>" 
                                    class="photo-messenger">
                            <?php endif ?>
                        <?php else: ?>
                            <img src="<?= base_url('public/images/avatar.png') ?>" class="photo-messenger">
                        <?php endif; ?>
                    </div>
                    <div class="ps-3 w-100">
                        <div class="d-flex justify-content-between">
                            <?php if((int)$service->start_by_admin): ?>
                                <strong class="alert-heading"><?= $message->sender === 'user' ? $message->pseudo : 'Moi' ?></strong>
                            <?php else: ?>
                                <strong class="alert-heading"><?= $message->sender === 'user' ? $service->_sender->pseudo : 'Moi' ?></strong>
                            <?php endif ?>
                            <span class="text-muted"><?= datetimeFormat($message->date_) ?></span>
                        </div>
                        <?php if($message->message): ?>
                            <?= $message->message ?>
                        <?php endif; ?>
                        
                        <?php if($message->piece_jointe): ?>
                            <div class="message-piece-jointe">
                                <img src="<?= base_url('public/piece_jointe/' . $message->piece_jointe) ?>" onclick="zoomIn(this)">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="d-flex justify-content-center w-100">
            <?php if((int)$service->closed): ?>
                <div class="form-message w-100 py-2 text-danger">
                    <h4>Discussion fermé</h4>
                </div>
            <?php else: ?>
                <form class="d-none" id="form-service-info">
                    <input type="hidden" name="id-user" value="<?= $idUser ?>" id="id-user-messenger">
                    <input type="hidden" name="id-service" value="<?= $service->id ?>" id="id-service-messenger">
                </form>
                <form class="form-message w-100 px-3" action="<?= base_url('admin/messenger/send') ?>" onsubmit="sendMessage(event,this)">
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
        </div>
    </div>
</div>
