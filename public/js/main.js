
$(document).ready(function () {
    $('.sidebar-link').each(function(){
        $(this).on("click", (e) => {
            e.preventDefault();
            $('.content-loader').removeClass('d-none');
            $(".user-menu-wrapper").addClass("d-none");
            getPage($(this).attr("href"), this);
        })
        
    })
});

function getPage(url, node_link) {
    $.get(url,
        (data, textStatus, jqXHR) =>  {
            $(".content").html(data);
            
            $('.sidebar-link').removeClass('active')
            $(node_link).addClass('active')
            in_message_panel = false;
            $('.content-loader').addClass('d-none');
            showTooltip();
        },
    );
}

function showTooltip() {
    const tooltip = document.querySelector('.tooltip');
    if(tooltip) {
        $(tooltip).remove();
    }

    const elemtooltips = document.querySelectorAll('.btn-tooltip')
    for(let elem of elemtooltips){
        new bootstrap.Tooltip(elem)
    }
}

function togglePassword(elem){
    var input = $(elem).next("input");
    var show = $(elem).data("show");

    console.log(show);

    if(show){
        $(input).prop('type','text');
        $(elem).html('<i class="fa-regular fa-eye"></i>')
    }else{
        $(input).prop('type','password');
        $(elem).html('<i class="fa-regular fa-eye-slash"></i>')
    }
    $(elem).data("show",!show);
}

function browseFile(idInput) {
    $(idInput).click();
}

function previewIconCategorie(elem) {
    const file = elem.files[0];
    const preview = $("#categorie-icon-preview");
    $("#categorie-icon").val(file.name);
    loadImage(file, base64 => {
        $(preview).prop("src",base64);
        $(preview).parent().removeClass('d-none');
    })
}
function submitCategorie(e,form) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done(res => {
        if(res.success) {
            $("#close-modal-categorie").click();
            $(".content").html(res.page);
            showTooltip();
            showSuccessAlert();
        }else {
            $('#form-categorie').html(res.page);
        }
    })
}
function createCategorie() {
    $.get(base_url('admin/categorie/getForm'),
        function (data, textStatus, jqXHR) {
          $("#form-categorie").html(data);
          $("#open-modal-categorie").click();  
        },
    );
}
function updateCategorie(id) {
    $.get(base_url('admin/categorie/show'), {id: id},
        function (data, textStatus, jqXHR) {
          $("#form-categorie").html(data);
          $("#open-modal-categorie").click();  
        },
    );
}
function deleteCategorie(id) {
    const alert = new Alert();
    alert.confirm(() => {
        $.post(base_url('admin/categorie/delete'), {id: id},
            function (data, textStatus, jqXHR) {
                $(".content").html(data);
                showTooltip();
            }
        );
    })
    
}

function filterCategorie(e,elem) {
    e.preventDefault();
    $.post(base_url('admin/categorie/filter'), {query: $(elem).find("input").val()},
        function (data, textStatus, jqXHR) {
            $(".content").html(data);
            showTooltip();
        }
    );
}

//========================================================================================//

function createOperateur() {
    $.get(base_url('admin/operateur/getForm'),
        function (data, textStatus, jqXHR) {
          $("#form-operateur").html(data);
          $("#open-modal-operateur").click();  
        },
    );
}
function previewLogoOperateur(elem)
{
    const file = elem.files[0];
    const preview = $("#operateur-logo-preview");
    $("#operateur-logo").val(file.name);
    loadImage(file, base64 => {
        $(preview).prop("src",base64);
        $(preview).parent().removeClass('d-none');
    })
}

function submitOperateur(e,form) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done(res => {
        if(res.success) {
            $("#close-modal-operateur").click();
            $(".content").html(res.page);
            showSuccessAlert();
            showTooltip();
        }else {
            $('#form-operateur').html(res.page);
        }
    })
}

function updateOperateur(id) {
    $.get(base_url('admin/operateur/show'), {id: id},
        function (data, textStatus, jqXHR) {
          $("#form-operateur").html(data);
          $("#open-modal-operateur").click();  
        },
    );
}

function deleteOperateur(id) {
    const alert = new Alert();
    alert.confirm(() => {
        $.post(base_url('admin/operateur/delete'), {id: id},
            function (data, textStatus, jqXHR) {
                $(".content").html(data);
                showTooltip();
            }
        );
    }) 
}
function filterOperateur(e,elem) {
    e.preventDefault();
    $.post(base_url('admin/operateur/filter'), {query: $(elem).find("input").val()},
        function (data, textStatus, jqXHR) {
            $(".content").html(data);
            showTooltip();
        }
    );
}




/**
 * 
 * Promotions section
 * 
 * 
 */


function submitPromotion(e,form) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done(res => {
        if(res.success) {
            $("#close-modal-promotion").click();
            $(".content").html(res.page);
            showSuccessAlert();
            showTooltip();
        }else {
            $('#form-operateur').html(res.page);
        }
    })
}

function createPromotions() {
    $.get(base_url('admin/promotion/getForm'),
        function (data, textStatus, jqXHR) {
          $("#form-promotion").html(data);
          $("#open-modal-promotion").click();  
        },
    );
}
function updatePromotions(id) {
    $.get(base_url('admin/promotion/show'), {id: id},
        function (data, textStatus, jqXHR) {
          $("#form-promotion").html(data);
          $("#open-modal-promotion").click();  
        },
    );
}
function deletePromotions(id) {
    const alert = new Alert();
    alert.confirm(() => {
        $.post(base_url('admin/promotion/delete'), {id: id},
            function (data, textStatus, jqXHR) {
                $(".content").html(data);
                showTooltip();
            }
        );
    })
    
}
function filterPromotions(e,elem) {
    e.preventDefault();
    $.post(base_url('admin/promotion/filter'), {query: $(elem).find("input").val()},
        function (data, textStatus, jqXHR) {
            $(".content").html(data);
            showTooltip();
        }
    );
}



/**
 * 
 * Promotions section end
 * 
 * 
 */



/**
 * 
 * HEADER
 *  
 */
function createHeader() {
    $.get(base_url('admin/header/getForm'),
        function (data, textStatus, jqXHR) {
          $("#form-header").html(data);
          $("#open-modal-header").click();  
        },
    );
}
function submitHeader(e,form) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done(res => {
        if(res.success) {
            $("#close-modal-header").click();
            $(".content").html(res.page);
            showSuccessAlert();
            showTooltip();
        }else {
            $('#form-header').html(res.page);
        }
    })
}


////////////////////////////////////////////////////////


/***
 * 
 *  A PROPOS
 * 
 * 
 */
function createPropos() {
    $.get(base_url('admin/propos/getForm'),
        function (data, textStatus, jqXHR) {
          $("#form-propos").html(data);
          $("#open-modal-propos").click();  
        },
    );
}

function submitPropos(e,form) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done(res => {
        if(res.success) {
            $("#close-modal-propos").click();
            $(".content").html(res.page);
            showSuccessAlert();
            showTooltip();
        }else {
            $('#form-propos').html(res.page);
        }
    })
}

//////////////////////////////



/***
 * 
 *  A PROPOS
 * 
 * 
 */
function createFunctionality() {
    $.get(base_url('admin/functionality/getForm'),
        function (data, textStatus, jqXHR) {
          $("#form-functionality").html(data);
          $("#open-modal-functionality").click();  
        },
    );
}

function submitFunctionality(e,form) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done(res => {
        if(res.success) {
            $("#close-modal-propos").click();
            $(".content").html(res.page);
            showSuccessAlert();
            showTooltip();
        }else {
            $('#form-propos').html(res.page);
        }
    })
}




//========================================================================================//

function createDescription() {
    $.get(base_url('admin/description/getForm'),
        function (data, textStatus, jqXHR) {
          $("#form-description").html(data);
          $("#open-modal-description").click();  
        },
    );
}
function previewImageDescription(elem)
{
    const file = elem.files[0];
    const preview = $("#description-logo-preview");
    $("#description-logo").val(file.name);
    loadImage(file, base64 => {
        $(preview).prop("src",base64);
        $(preview).parent().removeClass('d-none');
    })
}

function submitDescription(e,form) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done(res => {
        if(res.success) {
            $("#close-modal-description").click();
            $(".content").html(res.page);
            showSuccessAlert();
        }else {
            $('#form-description').html(res.page);
        }
    })
}

function updateDescription(id) {
    $.get(base_url('admin/description/show'), {id: id},
        function (data, textStatus, jqXHR) {
          $("#form-description").html(data);
          $("#open-modal-description").click();  
        },
    );
}

function deleteDescription(id) {
    const alert = new Alert();
    alert.confirm(() => {
        $.post(base_url('admin/description/delete'), {id: id},
            function (data, textStatus, jqXHR) {
                $(".content").html(data);
                showTooltip();
            }
        );
    }) 
}
function filterDescription(e,elem) {
    e.preventDefault();
    $.post(base_url('admin/description/filter'), {query: $(elem).find("input").val()},
        function (data, textStatus, jqXHR) {
            $(".content").html(data);
        }
    );
}

// Contact:
function createContact() {
    $.get(base_url('admin/contact/getForm'),
        function (data, textStatus, jqXHR) {
          $("#form-contact").html(data);
          $("#open-modal-contact").click();  
        },
    );
}

function submitContact(e,form) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done(res => {
        if(res.success) {
            $("#close-modal-contact").click();
            $(".content").html(res.page);
            showSuccessAlert();
            showTooltip();
        }else {
            $('#form-contact').html(res.page);
        }
    })
}


function openMessenger(id) {
    //in_message_panel = true;
    //$(".messenger").removeClass("d-none").html(getMiniMessengerLoader());
    $.get(base_url('admin/messenger/get/'), {id: id},
        function (data, textStatus, jqXHR) {
            // $(".messenger").html(data)
            // scrollTobottom('.messenger-body');
            $(".content").html(data);
            $('.sidebar-link').removeClass('active')
            in_message_panel = true;
            scrollTobottom('.message-wrapper');
            $('.content-loader').addClass('d-none');
            showTooltip();

            $.getJSON(base_url('admin/messenger/getUnreadCount'),
                function (data, textStatus, jqXHR) {
                    if(data.count > 0) {
                        $("#unread-message-count").text(data.count)
                    } else {
                        $("#unread-message-count").text(null)
                    }
                    
                }
            );
        },
    );
}

function closeMessenger() {
    in_message_panel = false;
    $(".messenger").addClass("d-none")
}

function sendMessage(e, form) {
    e.preventDefault();
    const data = combineForm(new FormData(form),new FormData(document.querySelector("#form-service-info")));
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done((res) => {
        if(res.success) {
            let piece_jointe = "";
            if(res.pieceJointe) {
                piece_jointe = `<div class="message-piece-jointe">
                                        <img src="${base_url('public/piece_jointe/' + res.pieceJointe) }" onclick="zoomIn(this)">
                                    </div>`
                                    }
                                    $(".message-wrapper").append(`<div class="alert message-list d-flex" role="alert">
                                    <div>
                                        <img src="${ base_url('public/images/avatar.png') }" class="photo-messenger">
                                    </div>
                                    <div class="ps-3 w-100">
                                        <div class="d-flex justify-content-between">
                                            <strong class="alert-heading">Moi</strong>
                                            <span class="text-muted">${ res.date_ }</span>
                                        </div>
                                        ${res.message ? res.message : ""}
                                        ${piece_jointe}
                                    </div>
                                </div>`)

            conn.send(JSON.stringify({
                "type" : "message",
                "to": res.to,
                "idService": res.idService,
                "pieceJointe" : res.pieceJointe,
                "message" : res.message,
                "date_": res.date_,
                "userId": -1
            }));
            scrollTobottom('.message-wrapper');
            form.reset();
        }
    })
}

function openMessengerPage(e,elem) {
    e.preventDefault();
    $('.content-loader').removeClass('d-none');
    $.getJSON(base_url('admin/messenger/getPageToRender/'),
        function (data, textStatus, jqXHR) {
            if(data.page === "assist") {
                getPage(base_url('admin/assistance'), document.querySelector("#assist-link"))
            } else {
                getPage(base_url('admin/litige'), document.querySelector("#litige-link"))
            }
        },
    );
}
function setMessagePage(idService) {
    $.get(base_url('admin/messenger/getContent/'), {id: idService, page: true},
        function (data, textStatus, jqXHR) {
            $(".message-panel.center").html(data)
            scrollTobottom('.center-body');
            $.getJSON(base_url('admin/messenger/getUnreadCount'),
                function (data, textStatus, jqXHR) {
                    if(data.count > 0) {
                        $("#unread-message-count").text(data.count)
                    } else {
                        $("#unread-message-count").text(null)
                    }
                    
                }
            );
        },
    );
}


function markAsResolved(id,type) {
    $.post(base_url(`admin/${type}/resolved`), {id: id, type: type},
        function (data, textStatus, jqXHR) {
            $(".content").html(data);
            showTooltip();
        },
    );
    
}

/**
 * Profil admin
 * 
 */

function previewPhotoAdmin(elem) {
    const file = elem.files[0];
    const preview = $("#admin-photo-preview");
    $("#photo-admin-input").val(file.name);
    loadImage(file, base64 => {
        $(preview).prop("src",base64);
    })
}

function updateIdentifiant(e,form) {
    let form_photo = document.querySelector("#form-photo-admin");
    const data = combineForm(new FormData(form),new FormData(form_photo));
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done(res => {
        $("#update-identifiant").html(res.page);
        if(res.success) {
            form_photo.reset();
            showSuccessAlert();
        }
    })
    .fail(err => {

    })
}
function updatePassword(e,form) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done(res => {
        if(res.success) {
            showSuccessAlert();
        } else {
           
        }
        $("#update-password").html(res.page);
    })
    .fail(err => {

    })
}
function remboursement(idService) {
    const modal = bootstrap.Modal.getOrCreateInstance(document.querySelector("#modal-remboursement"));
    $.get(base_url('admin/remboursement/show'), {idService: idService},
        function (data, textStatus, jqXHR) {
            $("#form-remboursement").html(data);
        },
    );
    modal.show();
}
function submitRemboursement(e,form) {
    e.preventDefault();
    const modal = bootstrap.Modal.getOrCreateInstance(document.querySelector("#modal-remboursement"));
    const spinner = form.querySelector(".spinner");
    const btn_submit = form.querySelector('button[type=submit]');
    const fields = form.querySelectorAll('.form-control');
    const message_errors = form.querySelectorAll('.message-error');
    $(spinner).removeClass('d-none');
    $(btn_submit).prop('disabled',true);
    $.ajax({
        type: "post",
        url: $(form).attr('action'),
        data: $(form).serialize(),
        dataType: "json",
    })
    .done(res => { 
        $(fields).removeClass('error');
        $(message_errors).text(null);
        $("#paiement-error").addClass('d-none');
        if(res.success) {
            modal.hide();
            showSuccessAlert();
            getPage(base_url("admin/remboursement"), document.querySelector("#remboursement-link"));
        }
        else {
            if(res.error_post) {
                for (const key in res.errors) {
                    if(res.errors[key]) {
                        let field = form.querySelector(`.form-control[name=${key}]`);
                        $(field).addClass('error');
                        $(field).next('.message-error').text(res.errors[key]);
                    }                  
                }
            } else {
                if(res.nopending) {
                    $("#paiement-error").text(res.transaction.statusMessage).removeClass('d-none');
                } else {
                    setErrorAPIPaiement(res.transaction);
                }
                
            }
        }
    })
    .fail(err => {

    })
    .always(() => {
        $(spinner).addClass('d-none');
        $(btn_submit).prop('disabled',false);
    })
}

function paginate(e,elem) {
    e.preventDefault();
    $.get($(elem).attr('href'),
        function (data, textStatus, jqXHR) {
            $("#table-pagination").html(data);
            showTooltip();
        }
    );
}
function deleteInPagination(id,url) {
    const alert = new Alert();
    alert.confirm(() => {
        $.post(url, {id: id},
            function (data, textStatus, jqXHR) {
                $("#table-pagination").html(data);
                showTooltip();
            }
        );
    })
}
function filterInPagination(e,elem) {
    e.preventDefault();
    $.post($(elem).attr('action'), $(elem).serialize(),
        function (data, textStatus, jqXHR) {
            $("#table-pagination").html(data);
            showTooltip();
        },
    );
}
function payVendeur(idPaiement) {
    const modal = bootstrap.Modal.getOrCreateInstance(document.querySelector("#modal-paiement-vendeur"));
    $.get(base_url('admin/paiement/show'), {idPaiement: idPaiement},
        function (data, textStatus, jqXHR) {
            $("#form-paiement-vendeur").html(data);
        },
    );
    modal.show();
}
function submitPaiementVendeur(e,form) {
    e.preventDefault();
    const modal = bootstrap.Modal.getOrCreateInstance(document.querySelector("#modal-paiement-vendeur"));
    const spinner = form.querySelector(".spinner");
    const btn_submit = form.querySelector('button[type=submit]');

    const fields = form.querySelectorAll('.form-control');
    const message_errors = form.querySelectorAll('.message-error');

    $(spinner).removeClass('d-none');
    $(btn_submit).prop('disabled',true);
    $.ajax({
        type: "post",
        url: $(form).attr('action'),
        data: $(form).serialize(),
        dataType: "json",
    })
    .done(res => {

        $(fields).removeClass('error');
        $(message_errors).text(null);
        $("#paiement-error").addClass('d-none');

        if(res.success) {
            modal.hide();
            showSuccessAlert();
            getPage(base_url("admin/paiement"), document.querySelector("#paiement-link"));
        }
        else {
            if(res.error_post) {
                for (const key in res.errors) {
                    if(res.errors[key]) {
                        let field = form.querySelector(`.form-control[name=${key}]`);
                        $(field).addClass('error');
                        $(field).next('.message-error').text(res.errors[key]);
                    }                  
                }
            } else {
                if(res.nopending) {
                    $("#paiement-error").text(res.transaction.statusMessage).removeClass('d-none');
                } else {
                    setErrorAPIPaiement(res.transaction);
                }
                
            }
        }
    })
    .fail(err => {

    })
    .always(() => {
        $(spinner).addClass('d-none');
        $(btn_submit).prop('disabled',false);
    })
}

function setErrorAPIPaiement(transaction) {
    let paiementError = null;
    let code = Number(transaction.code);
    switch (code) {
        case 400:
            paiementError = 'Données incorrectes saisies dans la demande';
            break;
        case 401:
            paiementError = 'Paramètres non complets';
            break;
        case 402:
            paiementError = "Le numéro de téléphone de paiement n'est pas correct";
            break;
        case 403:
            paiementError = "Le numéro de téléphone du dépôt n'est pas correct";
            break;
        case 404:
            paiementError = "Délai d'expiration dans USSD PUSH/Annulation dans USSD PUSH";
        case 406:
            paiementError = "Le numéro de téléphone de paiement obtenu n'est pas pour le portefeuille d'argent mobile";
            break;
        case 460:
            paiementError = 'Le solde du compte de paiement du payeur est faible';
            break;
        case 461:
            paiementError =  "Une erreur s'est produite lors du paiement";
            break;
        case 462:
            paiementError = "Ce type de transaction n'est pas encore pris en charge, processeur introuvable";
            break;
        case 500:
            paiementError = transaction.statusMessage;
            break;
        default:
          break;
    }
    $("#paiement-error").text(paiementError).removeClass('d-none');
}

function showOffre(id) {
    const modal = bootstrap.Modal.getOrCreateInstance(document.querySelector("#modal-offre"));
    $.get(base_url('admin/offre/progression'), {idOffre: id},
        function (data, textStatus, jqXHR) {
            $("#modal-offre-content").html(data);
        },
    );
    modal.show();
}

function paginateTransaction(page, self) {
    $.get($(self).data('url'), {page: page},
        function (data, textStatus, jqXHR) {
            $("#list-transaction").html(data);
            showTooltip();
        }
    );
}

function retrait() {
    const modal = bootstrap.Modal.getOrCreateInstance(document.querySelector("#modal-form"));
    $.get(base_url('admin/plateforme/retrait'),
        function (data, textStatus, jqXHR) {
          $("#form-content").html(data);
          modal.show();  
        },
    );
}


/*===================================FAQ=============================*/

function createFaq() {
    $.get(base_url('admin/faq/getForm'),
        function (data, textStatus, jqXHR) {
          $("#form-faq").html(data);
          $("#open-modal-faq").click();  
        },
    );
}

function submitFaq(e,form) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(form).attr("action"),
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
    })
    .done(res => {
        if(res.success) {
            $("#close-modal-faq").click();
            $(".content").html(res.page);
            showSuccessAlert();
            showTooltip();
        }else {
            $('#form-faq').html(res.page);
        }
    })
}

function updateFaq(id) {
    $.get(base_url('admin/faq/show'), {id: id},
        function (data, textStatus, jqXHR) {
          $("#form-faq").html(data);
          $("#open-modal-faq").click();  
        },
    );
}

function deleteFaq(id) {
    const alert = new Alert();
    alert.confirm(() => {
        $.post(base_url('admin/faq/delete'), {id: id},
            function (data, textStatus, jqXHR) {
                $(".content").html(data);
                showTooltip();
            }
        );
    }) 
}
function filterFaq(e,elem) {
    e.preventDefault();
    $.post(base_url('admin/faq/filter'), {query: $(elem).find("input").val()},
        function (data, textStatus, jqXHR) {
            $(".content").html(data);
            showTooltip();
        }
    );
}
