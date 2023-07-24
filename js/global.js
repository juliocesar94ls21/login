$(document).ready(function(){
    var htmlInputCad = '<span>Seu nome:</span><div class="unwhapp-input input-add"><i class="fa-solid fa-user"></i><input type="text" id="nome" required class="input-form-default" placeholder="George Smith" /></div>',
    htmlChecked = '<span id="lembrar">Continuar logado ? </span> <input id="input-lembrar" type="checkbox" name="lembrar" />',
    htmlBadgeSucess = '<span class="badge-sucess badge d-flex align-items-center p-1 pe-2 text-success-emphasis bg-success-subtle border border-success-subtle rounded-pill"><img class="rounded-circle me-1" width="24" height="24" src="img/perfilfbwd.png" alt="">Operação realizada com sucesso</span>',
    htmlBadgeError = '<span class="badge-error badge d-flex align-items-center p-1 pe-2 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-pill"><img class="rounded-circle me-1" width="24" height="24" src="img/perfilfbwd.png" alt="">Houve uma falha</span>',
    htmlSpinner = '<i class="fa-solid fa-spinner fa-spin"></i>';
    cadClicked = false,
    logClicked = true;

    $(".unwhapp-form").on("submit", function(e){
        e.preventDefault();
    })

    $(".btn-cad").on("click", function(){
        $(".divide-section").text("Cadastro");
        if(cadClicked == false){
            $(".unwhapp-form").prepend(htmlInputCad);
            $(".unwhapp-btn-submit div button").eq(0).removeClass("btn-entry").addClass("btn-cad");
            $(".unwhapp-btn-submit div button").eq(1).removeClass("btn-cad").addClass("btn-entry");
        }
        $("#lembrar, #input-lembrar").remove();
        if(cadClicked == true){
            if($("#nome").val() != "" && $("#email").val() != "" && $("#senha").val() != ""){
                $.ajax({
                    url : "App/request.class.php",
                    data : {name : $("#nome").val(), email : $("#email").val(), senha: $("#senha").val()},
                    type: "post",
                    dataType: "json",
                    error: function(jqXHR, textStatus, msg) {
                        $("body").prepend(htmlBadgeError);
                        const Timeout = setTimeout(hideBadgeError, 2000);
                    },
                    success: function(data){
                        if(typeof(data.error) == 'undefined'){
                            $("body").prepend(htmlBadgeSucess);
                            const Timeout = setTimeout(hideBadge, 2000);
                        }
                        else{
                            $("body").prepend(htmlBadgeError);
                            
                            const Timeout = setTimeout(hideBadgeError, 2000);
                        }
                    }
                });
            }
            else{
                alert("Preencha todos os campos");
            }
        }
        cadClicked = true;
        logClicked = false;
    });
    $(".btn-entry").on("click", function(){
        $(".divide-section").text("Login");
        if(logClicked == false){
            $(".unwhapp-form span").eq(0).remove();
            $(".input-add").remove();
            $(".unwhapp-btn-submit div button").eq(1).removeClass("btn-entry").addClass("btn-cad");
            $(".unwhapp-btn-submit div button").eq(0).removeClass("btn-cad").addClass("btn-entry");
            $("#unwhapp-checked").html(htmlChecked);
        }
        if(logClicked == true){
            $(this).prepend(htmlSpinner);
            var checkedOut = 0
            if($("#input-lembrar").is(':checked')){
                checkedOut = 1;
            }
            if($("#email").val() != "" && $("#senha").val() != ""){
                $.ajax({
                    url : "App/requestLogin.class.php",
                    data : {email : $("#email").val(), senha: $("#senha").val(), "checkedOut": checkedOut},
                    type: "post",
                    dataType: "json",
                    error: function(jqXHR, textStatus, msg) {
                        alert(textStatus + msg)
                        $("body").prepend(htmlBadgeError);
                        const Timeout = setTimeout(hideBadgeError, 2000);
                    },
                    success: function(data){
                        if(typeof(data.error) == 'undefined'){
                            if(data.sucess == true){
                                window.location.href = data.redirect;
                            }
                        }
                        else{
                            $("body").prepend(htmlBadgeError);
                            $(".badge-error").text(data.error);
                            $(".btn-entry .fa-spinner").remove();
                            const Timeout = setTimeout(hideBadgeError, 2000);
                        }
                    }
                });
            }
            else{
                alert("Preencha todos os campos");
            }
        }
        logClicked = true;
        cadClicked = false;
    });

    $(".icon-eye-pass").on("click", function(){
        var elem = $("#senha");
        if(elem.attr("type") == "text")
            elem.attr("type", "password");
        else
            elem.attr("type", "text");
    });
    function hideBadgeError(){
        $(".badge-error").fadeOut().addClass("hide-display");
    }
    function hideBadge(){
        $(".badge-sucess").fadeOut().addClass("hide-display");
    }
})