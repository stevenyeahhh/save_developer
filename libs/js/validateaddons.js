$.validator.addMethod("regexp", function (value, element, regexp) {
    var re = new RegExp(regexp);
    return this.optional(element) || re.test(value);
}, "");

$(function () {
    $("#dialog-confirm").dialog({
        autoOpen: false,
        resizable: false,
        height: 400,
        modal: true,
        buttons: {
            "Aceptar": function () {
                console.log("Entra2");
                //$(this).attr("acepto", true);
                console.log($("a[href*=eliminar]").attr("href"));
                window.location.href = $("a[href*=eliminar]").attr("href");
                $(this).dialog("close");

            },
            Cancelar: function () {
                console.log("Entra3");
                //$(this).attr("acepto",false);
                $(this).dialog("close");
            }
        }
    });
});

$(document).ready(function () {
//    $(".report").append("<img style='width:40px;height:40px' src='"+BASE+"/img/excel.png'></div>");

    $(".slider-tabla").bootstrapSwitch({onText:"SI",offText:"NO"});
//    $(document).on("click", ".btn-control-agregar", function(ev) {
//        $(".contenedor-forms").append("<tr>" + $(".tr-original").html() + "</tr>")
//    });

    $("a[href*=eliminar]").on("click", function (ev) {
        console.log("Entra1");
        //alert("HOLA");
        ev.preventDefault();
        console.log($("#dialog-confirm").dialog("open").attr("acepto"));
    });
//    $(".report").attr("href",window.location.href+"/1")
    NProgress.done();
});
////////////////////////conectar con facebook
//App ID:1681772598704166
//API Version:v2.5
//App Secret:4b6804fc91280077edf58ebb3a55a4e2
window.fbAsyncInit = function () {
    FB.init({
        appId: '1681772598704166',
        xfbml: true,
        version: 'v2.5'
    });
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function crearBootstrapSwitch(clase, url) {

//    $(document).ready(function() {
//        $(clase).bootstrapSwitch();
//            alert("hola: "+clase);
    $(clase).on("switchChange.bootstrapSwitch", function (event, state) {
//            alert($(this).val());
        //console.log(event);
        //console.log(state);
//        alert(BASE + url);
        $.ajax({
//            url: CONTROLLERPATH + url,
            url: BASE + url,
            type: "POST",
            data: {
                usuario: $(this).val(),
                estado: state ? 1 : 0
            },
            error: function (error) {
                console.log(error);
                $("<div class='mensaje alert alert-danger'></div>").insertBefore("h1").text("Ha ocurrido un error").append('<button type="button" class="close" data-dismiss="alert">&times;</button>').show().delay(100).fadeOut(5000);

            },
            success: function (success) {
                console.log(success);

                $("<div class='mensaje alert alert-success'></div>").insertBefore("h1").text(success).append('<button type="button" class="close" data-dismiss="alert">&times;</button>').show().delay(100).fadeOut(5000);
            }
        });
    })
//    });

}


NProgress.start();
