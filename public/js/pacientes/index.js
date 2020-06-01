$(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    //Url base
    let home_domain = window.location.origin + window.location.pathname;

    //Array de erros
    var errors = [];
    //Alterando Sidebar
    $("body").addClass("sidebar-collapse");

    function mensagemError(campo, valid = true) {
        if (valid) {
            campo.removeClass("is-invalid").addClass("is-valid");
        } else {
            campo.removeClass("is-valid").addClass("is-invalid");
        }
    }

    //mensagem de erro
    function erroMessage(text = "") {
        Swal.fire("Erro!", text, "error");
    }

    //Mensagem de sucesso
    function succesMesage(text = 'Ação realizada com sucesso!') {
        Swal.fire("Sucesso!", text, "success");
    }

    //Validando sessões do formulário
    function validateSection(sessao) {
        let checked = 0;
        let valid = true;
        errors = [];
        sessao.each(function(i) {
            if (
                $(this).attr("type") !== "button" &&
                $(this).attr("type") !== "submit"
            ) {
                //Condição para radio
                if ($(this).attr("type") === "radio" && $(this).is(":checked"))
                    checked++;
                else if (
                    $(this).attr("type") !== "radio" &&
                    $(this).val() === "" &&
                    $(this).hasClass("required")
                ) {
                    errors[$(this).attr("id")] = `Campo Vazio`;
                }
            }
        });
        if (checked < 2)
            errors["radio"] = "É necessário selecionar uma das opções";

        for (indice in errors) {
            $(`#${indice}`)
                .addClass("is-invalid")
                .next()
                .text(errors[indice]);
            valid = false;
        }
        if (!valid) {
            if (!$("div#clinicas input.is-invalid").length)
                $("#tab-info a#pessoais-tab").trigger("click");
            erroMessage("Verifique os campos obrigatórios do formulário!");
        }

        return valid;
    }

    //limpar mensagens
    function clearMessage() {
        $("form :input").each(function(i) {
            if (
                $(this).attr("type") !== "button" &&
                $(this).attr("type") !== "submit"
            ) {
                $(this)
                    .removeClass("is-invalid")
                    .removeClass("is-valid");
            }
        });
    }
    //ativar e desativar menu
    function menuTabs(menu) {
        //Recuperando id da seção
        let id_secao = menu.attr("id").split("-tab")[0];
        //desativando e ativando menu
        $("#tab-info a").removeClass("active");
        menu.addClass("active");
        //desativando e ativando seção
        $("div.tab-pane").removeClass("show active");
        $("#" + id_secao).addClass("show active");

        //Alterando texto de botão salvar
        if (id_secao === "pessoais") {
            //Alterando botão de submit
            $(".float-right")
                .addClass("prox")
                .find("#texto")
                .text("Proximo");
            //Alterando botão de voltar/limpar
            $(".card-footer button[type='button']")
                .addClass("reset")
                .addClass("btn-default")
                .removeClass("btn-danger")
                .text("Limpar");
        } else {
            $(".float-right")
                .removeClass("prox")
                .find("#texto")
                .text("Salvar");
            $(".card-footer button[type='button']")
                .removeClass("reset")
                .removeClass("btn-default")
                .addClass("btn-danger")
                .text("Voltar");
        }
    }

    $("#cpf").change(function() {
        if ($(this).val().length !== 14) {
            mensagemError($(this), false);
        } else {
            mensagemError($(this));
        }
    });

    //Iniciando iput mask
    $("#cpf").inputmask("999-999-999-99", {
        onincomplete: function() {
            mensagemError($(this), false);
        },
        oncomplete: function() {
            mensagemError($(this));
        }
    });

    //Mascara telefone
    $("#telefone").inputmask("(99) [9]9999-9999");

    //mascara data-coleta
    $("[role='datapicker']").datepicker({
        todayBtn: "linked",
        language: "pt-BR",
        autoclose: true,
        orientation: "bottom left"
    });
    //data de nascimento
    Inputmask("datetime", {
        jitMasking: true,
        inputFormat: "dd/mm/yyyy",
        placeholder: "dd/mm/yyyy"
    }).mask("#nascimento");

    //Ação no menu
    $("#tab-info a").on("click", function(e) {
        e.preventDefault();
        menuTabs($(this));
    });

    //ação checkbox de coleta
    $(".input-group-text input").change(function() {
        let input = $(this)
            .attr("id")
            .split("ck_")[1];
        let input_datapicker =
            $(`#${input}`).attr("role") !== undefined ? true : false;
        if ($(this).is(":checked")) {
            $(`#${input}`).prop("disabled", false);
            if (input_datapicker) $(`#${input}`).datepicker("show");
        } else {
            $(`#${input}`).prop("disabled", true);
            if (input_datapicker) $(`#${input}`).datepicker("update", "");
            else $(`#${input}`).val("");
        }
    });

    //Ação no botão de voltar/limpar
    $(".card-footer button[type='button']").click(function() {
        if (!$(this).hasClass("reset")) {
            $("#tab-info a#pessoais-tab").trigger("click");
        } else {
            Swal.fire({
                title: "Atenção!",
                text:
                    "Esta ação irá limpar todos os campos de todas as seções do formulário, deseja continuar ? ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim",
                cancelButtonText: "Não"
            }).then(result => {
                if (result.value) {
                    $("form")[0].reset();
                    $("[role='datapicker']").prop("disabled", true)
                    $("#viagem").prop("disabled",true)
                    clearMessage();
                    Swal.fire("Sucesso!", "Formulário limpo!", "success");
                }
            });
        }
    });

    //Ação no form
    $("form").submit(function(e) {
        e.preventDefault();
        clearMessage();
        let btn_salvar = $(".float-right");
        
        if (
            btn_salvar.hasClass("prox") &&
            validateSection($("form div#pessoais :input"))
        ) {
            $("#tab-info a#clinicas-tab").trigger("click");
        } else if (
            !btn_salvar.hasClass("prox") &&
            validateSection($("form :input"))
        ) {
            //Chamada ajax no servidor
            let dados = new FormData($("form")[0]);
            $.ajax({
                type: "post",
                url: home_domain + "/store",
                data: dados,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("#texto").prop("hidden", true);
                    $("#spinner").prop("hidden", false);
                    $("button[type='submit']").prop("disabled", true);
                },
                complete: function() {
                    $("#texto").prop("hidden", false);
                    $("#spinner").prop("hidden", true);
                    $("button[type='submit']").prop("disabled", false);
                },
                success: function () {
                    succesMesage();
                    $("form")[0].reset();
                    $("[role='datapicker']").prop("disabled", true)
                    $("#viagem").prop("disabled",true)
                    $("#tab-info a#pessoais-tab").trigger("click");
                },
                error: function() {}
            });
        }
    });
});
