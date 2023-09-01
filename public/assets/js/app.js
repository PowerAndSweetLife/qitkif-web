$(document).ready(function() {
    $('.clicker-menu').each(function(){
        $(this).on("click", () => {
            // e.preventDefault();
            $('.clicker-menu').removeClass('active')
            $(this).addClass('active')
        })
        
    })

    
})