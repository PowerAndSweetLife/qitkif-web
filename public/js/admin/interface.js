let window_width = window.innerWidth;

$(document).ready(function () {
    if(window_width <= 768){
        $('.sidebar').addClass('hide');
    }
    $(window).on('resize', function() {
        if($(this).innerWidth() <= 768 ){
            $('.sidebar').addClass('hide');
        }else{
            $('.sidebar').removeClass('hide');
        }
    })
    const elemtooltips = document.querySelectorAll('.btn-tooltip')
    for(let elem of elemtooltips){
        new bootstrap.Tooltip(elem)
    }

    if(localStorage.length === 0 ) {
        $('body').removeClass("dark");
        $('.mode-menu').html('<i class="fa-solid fa-moon"></i>').data("light",true);

    } else {
        if(localStorage.getItem("mode") === "light") {
            $('body').removeClass("dark");
            $('.mode-menu').html('<i class="fa-solid fa-moon"></i>').data("light",true);
        } else {
            $('body').addClass("dark");
            $('.mode-menu').html('<i class="fa-solid fa-sun"></i>').data("light",false);
        }
    }
});

function toggleSidebar() {
    $('.sidebar').toggleClass('hide');
    $('.backdrop').toggleClass('d-none');
}

function toggleMode(self){
    let value = $(self).data('light');
    $('body').toggleClass('dark');

    if(value){
        $(self).html('<i class="fa-solid fa-sun"></i>')
        localStorage.setItem("mode","dark")
    }else{
        $(self).html('<i class="fa-solid fa-moon"></i>')
        localStorage.setItem("mode","light")
    }

    $(self).data('light',!value);

}
function toggleUserMenu() {
    $(".user-menu-wrapper").toggleClass("d-none");
}

function showSuccessAlert() {
    $("#message-success").addClass("show");
    let t_out = setTimeout( () => {
        hideSuccessAlert();
        clearTimeout(t_out);
    }, 5000);
}
function hideSuccessAlert() {
    $("#message-success").removeClass("show");
}
