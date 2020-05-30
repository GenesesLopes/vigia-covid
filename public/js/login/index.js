$(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    let home_domain = window.location.origin;
    
    //Habilitar/desabilitar botão
    function buttonDisabled() {
        if ($("#senha").hasClass("is-valid") && $("#cpf").hasClass("is-valid"))
            $("button").prop("disabled", false);
        else $("button").prop("disabled", true);
    }

    $("#cpf").change(function() {
        if ($(this).val().length !== 14) {
            $(this)
                .removeClass("is-valid")
                .addClass("is-invalid");
        } else {
            $(this)
                .removeClass("is-invalid")
                .addClass("is-valid");
        }
    });

    //Iniciando iput mask
    $("#cpf").inputmask("999.999.999-99", {
        onincomplete: function() {
            $(this)
                .removeClass("is-valid")
                .addClass("is-invalid");
        },
        oncomplete: function() {
            $(this)
                .removeClass("is-invalid")
                .addClass("is-valid");
        }
    });

    //Validação de senha
    $("#senha").keyup(function(e) {
        $(this).val().length <= 9 && $(this).val().length >= 6
            ? $(this)
                  .addClass("is-valid")
                  .removeClass("is-invalid")
            : $(this)
                  .addClass("is-invalid")
                  .removeClass("is-valid");
        // if(e.keyCode !== 13)
            // buttonDisabled();
        
    });

   
    //Login Form
    $("form").submit(function(e) {

        let dados = new FormData($("form")[0]);
        e.preventDefault();
        $("#cpf").removeClass("is-invalid is-valid")
        $("#senha").removeClass("is-invalid is-valid")
        $.ajax({
            type: "post",
            url: home_domain + "/login",
            data: dados,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $("#texto").prop("hidden", true);
                $("#spinner").prop("hidden", false);
                $("button").prop("disabled", true);
            },
            complete: function() {
                $("#texto").prop("hidden", false);
                $("#spinner").prop("hidden", true);
                $("button").prop("disabled", false);
            },
            success: function () {
                window.location.href = home_domain + '/interno';
            },
            error: function(data) {
                $("#texto").prop("hidden", false);
                $("#spinner").prop("hidden", true);
                $("button").prop("disabled", false);
                if(data.status == 422){
                    for(var response in data.responseJSON.errors ){
                        $(`.${response}`).text(data.responseJSON.errors[response][0])
                        $(`#${response}`).addClass('is-invalid').removeClass('is-valid')
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error interno!',
                        text: 'Favor entrar em contato com o responsável pelo sistema.',
                      })
                }
            }
        });
    });
});
