$(document).ready(function ($) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //Url base
    let home_domain = window.location.origin + window.location.pathname;

    //Array de erros
    var errors = [];
    //Alterando Sidebar
    $("body").addClass("sidebar-collapse");

    //Selecionar menu users sidebar
    $("li.users").addClass("menu-open");

    function mensagemError(campo, valid = true) {
        if (valid) {
            campo.removeClass("is-invalid is-warning").addClass("is-valid");
        } else {
            campo.removeClass("is-valid is-warning").addClass("is-invalid");
        }
    }

    //mensagem de erro
    function erroMessage(text = "") {
        Swal.fire("Erro!", text, "error");
    }

    //Mensagem de sucesso
    function succesMesage(text = "Ação realizada com sucesso!") {
        Swal.fire("Sucesso!", text, "success");
    }

    function getCPF(cpf) {
        $.getJSON(home_domain + `/getUser/${cpf}`, function (data) {
            if (data.length !== 0) {
                for (dados in data) {
                    if (dados !== "cpf") $(`#${dados}`).val(data[dados]);
                    // else if (dados === 'papel') {
                    //     $(this).prop("selected", true).trigger('change');
                    //     // $("option").each(function (i) {
                    //     //     if ($(this).text() === data[dados])
                    //     //         $(this).prop("selected", true).trigger('change');
                    //     // })
                    // }
                }
                $("#cpf")
                    .removeClass("is-invalid is-valid")
                    .addClass("is-warning");
                $("button[type='submit']")
                    .addClass("edit")
                    .find("div#texto")
                    .text("Editar");
                $("#senha").prop("required", false);
                $("#senha_confirmation").prop("required", false);
                $("#del").prop("hidden", false);
            } else {
                $("#cpf").removeClass("is-warning");
                $("button[type='submit']")
                    .removeClass("edit")
                    .find("div#texto")
                    .text("Salvar");
                $("#senha").prop("required", true);
                $("#senha_confirmation").prop("required", true);
                $("#del").prop("hidden", true);
            }
            $("#papel").trigger("change");
        });
    }

    //Validando sessões do formulário
    function validateSection(sessao) {
        let checked = 0;
        let valid = true;
        errors = [];
        sessao.each(function (i) {
            if (
                $(this).attr("type") !== "button" &&
                $(this).attr("type") !== "submit"
            ) {
                if (
                    ($(this).attr("id") == "senha" ||
                        $(this).attr("id") == "senha_confirmation") &&
                    $(this).prop("required")
                ) {
                    if ($(this).val().length < 6 || $(this).val().length > 9) {
                        errors[
                            $(this).attr("id")
                        ] = `As senhas devem possuir entre 6 a 9 digitos`;
                    } else if ($(this).attr("id") == "senha_confirmation") {
                        if ($("#senha").val() !== $(this).val())
                            errors[$(this).attr("id")] = `Senhas distintas`;
                    }
                }
                if ($(this).attr("id") === "nome") {
                    if ($(this).val().split(" ").length < 2)
                        errors[$(this).attr("id")] = `O nome deve ser completo`;
                }
            }
        });

        for (indice in errors) {
            $(`#${indice}`).addClass("is-invalid").next().text(errors[indice]);
            valid = false;
        }
        if (!valid) {
            erroMessage("Verifique os campos obrigatórios do formulário!");
        }

        return valid;
    }

    //limpar mensagens
    function clearMessage() {
        $("form :input").each(function (i) {
            if (
                $(this).attr("type") !== "button" &&
                $(this).attr("type") !== "submit"
            ) {
                $(this).removeClass("is-invalid is-warning is-valid");
            }
        });
    }

    // $("#cpf").change(function () {
    //     if ($(this).val().length !== 14) {
    //         mensagemError($(this), false);
    //     } else {
    //         mensagemError($(this));
    //     }
    // });

    //Iniciando iput mask
    $("#cpf").inputmask("999.999.999-99", {
        onincomplete: function () {
            mensagemError($(this), false);
        },
        oncomplete: function () {
            mensagemError($(this));
            getCPF($(this).val());
        },
    });

    $(".select2").select2({
        theme: "bootstrap4",
    });
    $(".select2").val(" ").trigger("change");

    //Ação no botão de voltar/limpar
    $(".card-footer button[type='button']").click(function () {
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
                cancelButtonText: "Não",
            }).then((result) => {
                if (result.value) {
                    $("form")[0].reset();
                    $(".select2").val(" ").trigger("change");
                    clearMessage();
                    $("#senha").prop("required", true);
                    $("#senha_confirmation").prop("required", true);
                    $("#del").prop("hidden", true);
                    Swal.fire("Sucesso!", "Formulário limpo!", "success");
                }
            });
        }
    });

    //Ação no form
    $("form").submit(function (e) {
        e.preventDefault();
        clearMessage();
        if ($("button[type='submit']").hasClass("edit"))
            url = home_domain + "/update";
        else url = home_domain + "/store";

        if (validateSection($("form :input"))) {
            //Chamada ajax no servidor
            let dados = new FormData($("form")[0]);
            $.ajax({
                type: "post",
                url: url,
                data: dados,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#texto").prop("hidden", true);
                    $("#spinner").prop("hidden", false);
                    $("button[type='submit']").prop("disabled", true);
                },
                complete: function () {
                    $("#texto").prop("hidden", false);
                    $("#spinner").prop("hidden", true);
                    $("button[type='submit']").prop("disabled", false);
                },
                success: function () {
                    succesMesage();
                    $("form")[0].reset();
                    $(".select2").val(" ").trigger("change");
                    $("#cpf").removeClass("is-warning");
                    $("#senha").prop("required", true);
                    $("#senha_confirmation").prop("required", true);
                    $("button[type='submit']")
                        .removeClass("edit")
                        .find("div#texto")
                        .text("Salvar");
                    $("#del").prop("hidden", true);
                },
                error: function (data) {
                    $("#texto").prop("hidden", false);
                    $("#spinner").prop("hidden", true);
                    $("button").prop("disabled", false);
                    if (data.status == 422) {
                        for (var response in data.responseJSON.errors) {
                            $(`.${response}`).text(
                                data.responseJSON.errors[response][0]
                            );
                            $(`#${response}`)
                                .addClass("is-invalid")
                                .removeClass("is-valid");
                        }
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error interno!",
                            text:
                                "Favor entrar em contato com o responsável pelo sistema.",
                        });
                    }
                },
            });
        }
    });

    //Ação de excluir
    $(document).on("click", "#del", function () {
        Swal.fire({
            title: "Atenção!",
            text:
                "Esta ação irá excluir o usuário, deseja continuar ? ",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim",
            cancelButtonText: "Não",
        }).then((result) => {
            if (result.value) {
                let dados = new FormData($("form")[0]);
                $.ajax({
                    type: "post",
                    url: home_domain + "/delete",
                    data: dados,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $(this).prop("disabled", true);
                        $(this).text("Aguarde..");
                    },
                    complete: function () {
                        $(this).prop("disabled", false);
                        $(this).text("Excluir");
                    },
                    success: function () {
                        succesMesage();
                        $("form")[0].reset();
                        $(".select2").val(" ").trigger("change");
                        $("#cpf").removeClass("is-warning");
                        $("#senha").prop("required", true);
                        $("#senha_confirmation").prop("required", true);
                        $("button[type='submit']")
                            .removeClass("edit")
                            .find("div#texto")
                            .text("Salvar");
                        $("#del").prop("hidden", true);
                    },
                    error: function (data) {
                        $(this).prop("disabled", false);
                        $(this).text("Excluir");
                        if (data.status == 422) {
                            for (var response in data.responseJSON.errors) {
                                $(`.${response}`).text(
                                    data.responseJSON.errors[response][0]
                                );
                                $(`#${response}`)
                                    .addClass("is-invalid")
                                    .removeClass("is-valid");
                            }
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error interno!",
                                text:
                                    "Favor entrar em contato com o responsável pelo sistema.",
                            });
                        }
                    },
                });
            }
        });
    });
});
