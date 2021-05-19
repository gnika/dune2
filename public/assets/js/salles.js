
$(document).on("click", '[id^="retour"]', function(event) {
    var direction = $('#'+this.id).attr('alt');

    if( typeof(direction) != 'undefined') {
        if ($("#onTalk").val() == 0 && $("#onMyTalk").val() == 0 && !$("#diamant").length) {
            $('#onTalk').val(1);

            var request = $.ajax({
                url: '/' + direction,
                type: "POST"
            });
            request.done(function (msg) {
                $("#inThePlace").fadeOut(1000);
                setTimeout(function () {
                    $("#inThePlace").hide();
                    $("#inThePlace").html(msg);
                    $("#inThePlace").fadeIn(1000);
                }, 1000);

            });
        }else if( $("#onMyTalk").val() == 1  && $('#textoLink').css('display') == 'none' ){
            $('#mesTexto a').addClass('clignote');
            setTimeout(function (){
                $('#mesTexto a').removeClass('clignote');

            }, 1000);
        }else {
            $('#textoIn').addClass('clignoteBulle');
            setTimeout(function (){
                $('#textoIn').removeClass('clignoteBulle');

            }, 1000);
        }
    }else{
        recompenseDisplay('Vous n\'avez pas encore débloqué cet accès');
    }
});

$(document).on("click", '[id^="porte_"]', function(event) {
    if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){

        if($(this).attr('class').endsWith('_1')){
            var direction = $('#'+this.id).attr('alt');
            var request = $.ajax({
                url: '/'+direction,
                type: "POST"
            });
            request.done(function(msg) {
                $("#inThePlace").fadeOut(1000);
                setTimeout(function(){
                    $("#inThePlace").hide();
                    $("#inThePlace").html(msg);
                    $("#inThePlace").fadeIn(1000);
                }, 1000);

            });
        }
    }else if( $("#onMyTalk").val() == 1  && $('#textoLink').css('display') == 'none'){
        if($(this).attr('class').endsWith('_1')) {
            $('#mesTexto a').addClass('clignote');
            setTimeout(function () {
                $('#mesTexto a').removeClass('clignote');

            }, 1000);
        }
    }else {
        if($(this).attr('class').endsWith('_1')) {
            $('#textoIn').addClass('clignoteBulle');
            setTimeout(function () {
                $('#textoIn').removeClass('clignoteBulle');

            }, 1000);
        }
    }
});

$(document).on("click", '[id^="vers_"]', function(event) {
    if ($("#onTalk").val() == 0 && $("#onMyTalk").val() == 0) {

        var direction = $('#' + this.id).attr('alt');


        if( typeof(direction) != 'undefined'){

            var request = $.ajax({
                url: '/' + direction,
                type: "POST"
            });
            request.done(function (msg) {console.log(msg);
                $("#inThePlace").fadeOut(1000);
                setTimeout(function () {
                    $("#inThePlace").hide();
                    $("#inThePlace").html(msg);
                    $("#inThePlace").fadeIn(1000);
                }, 1000);

            });
    } else {
        recompenseDisplay('Vous n\'avez pas encore débloqué cet accès');
    }
}else if( $("#onMyTalk").val() == 1  && $('#textoLink').css('display') == 'none' ){
        $('#mesTexto a').addClass('clignote');
        setTimeout(function (){
            $('#mesTexto a').removeClass('clignote');

        }, 1000);
    }else {
        $('#textoIn').addClass('clignoteBulle');
        setTimeout(function (){
            $('#textoIn').removeClass('clignoteBulle');

        }, 1000);
    }
});

$(document).on("click", '.msg', function(event) {

    $('#checkMessage').trigger('click');
});