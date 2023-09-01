function create() {
    const form = document.querySelector("#modal-form");
    if(!form) {
        alert("undefined modal ...");
        return false;
    }
    const modal = bootstrap.Modal.getOrCreateInstance(form);

    modal.show();
}
function update(id, self) {
    const modal = bootstrap.Modal.getOrCreateInstance(document.querySelector("#modal-form"));
    $.get($(self).data('url'), {id: id},
        function (data, textStatus, jqXHR) {
          $("#form-content").html(data);
          modal.show();  
        },
    );
}

function _submit(e, form) {
    e.preventDefault();
    const modal = bootstrap.Modal.getOrCreateInstance(document.querySelector("#modal-form"));
    const submitLoader = $("#submit-loader");
    $(submitLoader).removeClass("d-none");
    $(submitLoader).parent("button").prop("disabled", true);
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
            $(".content").html(res.page);
            showSuccessAlert();
            showTooltip();
            modal.hide();
        }else {
            $('#form-content').html(res.page);
        }
    })
    .always(() => {
        $(submitLoader).addClass("d-none");
        $(submitLoader).parent("button").prop("disabled", false);
    })
}
function _delete(id, self) {
    const alert = new Alert();
    alert.confirm(() => {
        $.post($(self).data('url'), {id: id},
            function (data, textStatus, jqXHR) {
                $(".content").html(data);
                showTooltip();
            }
        );
    })
}

function sendMessageToUser(e, form) {
    e.preventDefault()
    
    const inputs = $(form).find('input.form-control,textarea.form-control')
    $(inputs).removeClass('is-invalid')
    $.post($(form).attr('action'), $(form).serialize(),
        function (data, textStatus, jqXHR) {
            if(data.success === false) {
                console.log(data);
                for(let input of inputs) {
                    if(data.errors.includes($(input).attr('name'))) {
                        $(input).addClass('is-invalid')
                    }
                }
            } else {
                const modal = bootstrap.Modal.getOrCreateInstance(document.querySelector("#modal-new-message"));
                modal.hide();
                $("#assist-link").click()
            }
        },
        "json"
    );
}
