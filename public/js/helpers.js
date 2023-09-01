const BASE_URL = 'http://localhost/qitkif-api/'
// const BASE_URL = 'https://qitkif.com/'
let in_message_panel = false;
class Alert{
    constructor(){

    }
    confirm(callback){
        Swal.fire({
            title: 'Confirmation',
            text: "Voulez-vous vraiment poursuivre ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#be123c',
            cancelButtonColor: '#202124',
            confirmButtonText: 'OUI',
            cancelButtonText: 'NON'
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        })
    }
}

function loadImage(file,callback){
	let fr = new FileReader();
	fr.readAsDataURL(file);
	fr.onloadend = function (e) {
		base64 = fr.result;
        callback(base64);
	};
}
function getExtension(filename){
    let splited = filename.split(".");
    let lastIndex = splited.length - 1;
    return "." + splited[lastIndex];
}

function combineForm(form_1, form_2) {
    for (var pair of form_2.entries()) {
        form_1.append(pair[0], pair[1]);
    }
    return form_1;
}

function base_url(uri = '') {
    return BASE_URL + uri;
} 

function scrollTobottom(elem) {
    const dom = document.querySelector(elem);
    try {
        dom.scrollTop = dom.scrollHeight;
    } catch (error) {
        
    }
    
}
function zoomIn(elem) {
    const img = $("#zoom-box img");
    const src = $(elem).prop('src');
    $(img).prop('src',src);
    $("#zoom-box").removeClass('d-none');
}
function zoomOut() {
    $("#zoom-box").addClass('d-none');
}
function datetimeFormat(datetime) {
    return moment(datetime).format('DD/MM/YYYY') + ' à ' + moment(datetime).format('HH:mm');
}

function getMiniMessengerLoader() {
    return `<div class="placeholder-glow px-3">
    <span class="placeholder col-12" style="height: 25px;"></span>
    <div class="d-flex mt-2">
        <span class="placeholder" style="height: 50px; width: 50px; border-radius: 50%;"></span>
        <div class="ps-2" style="flex: 1;">
            <span class="placeholder col-12"></span>
            <span class="placeholder placeholder-sm col-7"></span>
        </div>
    </div>
    <div class="messenger-body mt-4">
        <div class="message-left px-0">
            <div class="message-content" style="background-color: transparent; min-width: 75%">
                <span class="placeholder col-12" style="color: #636e72; height: 60px"></span>
            </div>
        </div>
        <div class="message-right px-0">
            <div class="message-content" style="background-color: transparent; min-width: 75%">
                <span class="placeholder col-12" style="color: #636e72; height: 60px"></span>
            </div>
        </div>
        <div class="message-left px-0">
            <div class="message-content" style="background-color: transparent; min-width: 75%">
                <span class="placeholder col-12" style="color: #636e72; height: 60px"></span>
            </div>
        </div>
        <div class="message-right px-0">
            <div class="message-content" style="background-color: transparent; min-width: 75%">
                <span class="placeholder col-12" style="color: #636e72; height: 60px"></span>
            </div>
        </div>
    </div>
    
    <div class="messenger-footer px-3">
        <span class="placeholder col-12" style="height: 40px"></span>
    </div>
</div>`
}