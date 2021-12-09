function showPass() {
    var x = document.getElementById("login_password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

///////////////
//settear cookie en el menu para la selección de salas
//////////////
$(document).ready(function() {
    $(".sala").each(function(index) {
        console.log(index + 1);
        $(this).click(function() {
            Cookies.set('sala', 'sala' + (index + 1))
            $('.sala form').submit();
        });


    })


});

//////////////
//Cargar sala cookie
//////////////
$(document).ready(function() {
    if (Cookies.get('sala') != 'nada') {
        console.log(Cookies.get('sala'));
        $("body .region-mesas").addClass(Cookies.get('sala'));
    }
});

//////////////
//Poner si la mesa esta ocupadada
//////////////
$(document).ready(function() {
    $(".mesa img").each(function(index) {
        if ($(this).attr("data-status") == "Ocupado/Reservado") {
            $(this).addClass('ocupada');

        }

    })
    $(".mesa").each(function(index) {
        if ($(this).attr("data-status") == "Ocupado/Reservado") {
            $(this).removeClass('btn-abrirPop');
            $(this).addClass('btn-abrirPop2');
        }
    })

});
//////////////
//POPUP
//////////////




$(document).ready(function() {
    $(".btn-abrirPop").each(function(index) {
        $(this).click(function() {
            $(".crearReserva .idMesa").val($(this).attr('data-id'))
            console.log($(this).attr('data-id'))
        });
    })
    $(".btn-abrirPop2").each(function(index) {
        $(this).click(function() {
            $(".editarReserva .idMesa").val($(this).attr('data-id'))
            console.log($(this).attr('data-id'))
        });
    })

});

$(document).ready(function() {
    $(".btn-cerrarPop").click(function() {
        $("#overlay").removeClass('active');
        $("#popup").removeClass('active');
    });
    $(".btn-abrirPop").click(function() {
        $("#popup").removeClass('hide');
        $("#overlay").addClass('active');
        $("#popup").addClass('active');
        $("#popup2").addClass('hide');
    });


    $(".btn-abrirPop2").click(function() {
        $("#popup2").removeClass('hide');
        $("#overlay").addClass('active');
        $("#popup2").addClass('active');
        $("#popup").addClass('hide');



    });

});


////////Obtener valores del id



// function getvalues(id) {
//     var name = $(`.nombre[data*='${id}` + "||'").attr('data-name');
//     var surname = $(`.apellido[data*='${id}` + "||'").attr('data-sur');
//     var email = $(`.email[data*='${id}` + "||'").attr('data-mail');
//     var age = $(`.edad[data*='${id}` + "||'").attr('data-age');

//     console.log(name + "  " + age + "  " + id);
//     $("#popup2 #nombre").val(name);
//     $("#popup2 #apellido").val(surname);
//     $("#popup2 #edad").val(age);
//     $("#popup2 #id").val(id);
// }