

jQuery.fn.parle = function(first, two, three, four, pxArray) {


    if(  typeof(pxArray[0]) == 'undefined' ) var move1 = '0'; else var move1 = pxArray[0];
    if(  typeof(pxArray[0]) == 'undefined' ) var move11 = '-271'; else var move11 = pxArray[1];
    if(  typeof(pxArray[1]) == 'undefined' ) var move2 = '-100'; else var move2 = pxArray[2];
    if(  typeof(pxArray[1]) == 'undefined' ) var move22 = '-271'; else var move22 = pxArray[3];
    if(  typeof(pxArray[2]) == 'undefined' ) var move3 = '-200'; else var move3 = pxArray[4];
    if(  typeof(pxArray[2]) == 'undefined' ) var move33 = '-271'; else var move33 = pxArray[5];
    if(  typeof(pxArray[3]) == 'undefined' ) var move4 = '-100'; else var move4 = pxArray[6];
    if(  typeof(pxArray[3]) == 'undefined' ) var move44 = '-271'; else var move44 = pxArray[7];

    var p1 = move1+'px '+move11+'px';
    var p2 = move2+'px '+move22+'px';
    var p3 = move3+'px '+move33+'px';
    var p4 = move4+'px '+move44+'px';

    $(this).oneTime(first,function() {
        $(this).css({backgroundPosition: p1});
    }).oneTime(two,function() {
        $(this).css({backgroundPosition: p2});
    }).oneTime(three,function() {
        $(this).css({backgroundPosition: p3});
    }).oneTime(four,function() {
        $(this).css({backgroundPosition: p4});
    });
};

jQuery.fn.muet = function(first, two, three, four, pxArray) {

    if(  typeof(pxArray[0]) == 'undefined' ) var move1 = '0'; else var move1 = pxArray[0];
    if(  typeof(pxArray[0]) == 'undefined' ) var move11 = '0'; else var move11 = pxArray[1];
    if(  typeof(pxArray[1]) == 'undefined' ) var move2 = '-100'; else var move2 = pxArray[2];
    if(  typeof(pxArray[1]) == 'undefined' ) var move22 = '0'; else var move22 = pxArray[3];
    if(  typeof(pxArray[2]) == 'undefined' ) var move3 = '-200'; else var move3 = pxArray[4];
    if(  typeof(pxArray[2]) == 'undefined' ) var move33 = '0'; else var move33 = pxArray[5];
    if(  typeof(pxArray[3]) == 'undefined' ) var move4 = '-100'; else var move4 = pxArray[6];
    if(  typeof(pxArray[3]) == 'undefined' ) var move44 = '0'; else var move44 = pxArray[7];

    var p1 = move1+'px '+move11+'px';
    var p2 = move2+'px '+move22+'px';
    var p3 = move3+'px '+move33+'px';
    var p4 = move4+'px '+move44+'px';

    $(this).oneTime(first,function() {
        $(this).css({backgroundPosition: p1});
    }).oneTime(two,function() {
        $(this).css({backgroundPosition:  p2});
    }).oneTime(three,function() {
        $(this).css({backgroundPosition:  p3});
    }).oneTime(four,function() {
        $(this).css({backgroundPosition:  p4});
    });
};

jQuery.fn.muetFonction = function(timeArray, pxArray){

    if (typeof(timeArray) === 'undefined') {
        var timeArray = new Array();
    }

    if(  typeof(timeArray[0]) == 'undefined' ) var first = 1200; else var first = timeArray[0];
    if(  typeof(timeArray[1]) == 'undefined' ) var two = 300; else var two = timeArray[1];
    if(  typeof(timeArray[2]) == 'undefined' ) var three = 600; else var three = timeArray[2];
    if(  typeof(timeArray[3]) == 'undefined' ) var four = 900; else var four = timeArray[3];
    if(  typeof(timeArray[4]) == 'undefined' ) var loop = 1200; else var loop = timeArray[4];

    if (typeof(pxArray) === 'undefined')
          var pxArray = new Array();


    $(this).muet(first, two, three, four, pxArray);
    $(this).everyTime(loop,function(){
        $(this).muet(first, two, three, four, pxArray);
    });
}
jQuery.fn.parleFonction = function(timeArray, pxArray){


    if (typeof(timeArray) === 'undefined') {
        var timeArray = new Array();
    }

    if(  typeof(timeArray[0]) == 'undefined' ) var first = 1200; else var first = timeArray[0];
    if(  typeof(timeArray[1]) == 'undefined' ) var two = 300; else var two = timeArray[1];
    if(  typeof(timeArray[2]) == 'undefined' ) var three = 600; else var three = timeArray[2];
    if(  typeof(timeArray[3]) == 'undefined' ) var four = 900; else var four = timeArray[3];
    if(  typeof(timeArray[4]) == 'undefined' ) var loop = 1200; else var loop = timeArray[4];

    if (typeof(pxArray) === 'undefined')
        var pxArray = new Array();

    $(this).parle(first, two, three, four, pxArray);
    $(this).everyTime(loop,function(){
        $(this).parle(first, two, three, four, pxArray);
    });
}


//addClass : ajoute la class pour la bulle qui s'affiche au dessus du perso
//si on clique sur un personnage mais c'est un autre qui répond
//  idDiv contient alors un espace : le premier ID css de l'item qu'on clique et le second, de l'item qui parle
//idPerso : l'ID bdd du personnage qui parle
//repns : si le personnage a une réponse toute faite
//arrayMuet1 : loop des animations au repos (par defaut [1200, 300, 600, 900, 1200)
//arrayMuet2 : pixels qui changent au repos (par defaut [0, 0, -100, 0, -200, 0, -100, 0])
//arrayParle1 : loop des animations dialogue (par defaut [1200, 300, 600, 900, 1200)
//arrayParle2 : pixels qui changent dialogue (par defaut [271, -100, -271, -200, -100, -271)
jQuery.fn.dialogue = function(addClass, idDiv, idPerso, repns, arrayMuet1, arrayMuet2, arrayParle1, arrayParle2){
    if (typeof(arrayMuet1) === 'undefined')
        var arrayMuet1 = new Array();
    if (typeof(arrayMuet2) === 'undefined')
        var arrayMuet2 = new Array();
    if (typeof(arrayParle1) === 'undefined')
        var arrayParle1 = new Array();
    if (typeof(arrayParle2) === 'undefined')
        var arrayParle2 = new Array();

    var idClick = '';
    if( idDiv.indexOf(' ') > 0 ) {
        var arraySplit = idDiv.split(' ');
        idDiv = arraySplit[1];
        idClick = arraySplit[0];
    }else
        idClick = idDiv;

    if (typeof(repns) === 'undefined')
        var dataAjax = {
            idDiv: idDiv,
            idPerso: idPerso,
            talk: 'muetFonction([' + arrayMuet1 + '], [' + arrayMuet2 + '])',
            stopTalk: 'parleFonction([' + arrayParle1 + '], [' + arrayParle2 + '])'
        };
    else{
        var dataAjax = {
            idDiv: idDiv,
            idPerso: idPerso,
            talk: 'muetFonction([' + arrayMuet1 + '], [' + arrayMuet2 + '])',
            stopTalk: 'parleFonction([' + arrayParle1 + '], [' + arrayParle2 + '])',
            repns: repns
        };
    }

    $(document).on("click", '#'+idClick, function(event) {
        if ($("#onTalk").val() == 0 && $("#onMyTalk").val() == 0) {
            $("#texto").removeClass().addClass(addClass);
            if (arret == 0 || arrestation == 1) {
                $("#texto").show();
                $("#onTalk").val(1);
                $("#"+idDiv).stopTime().parleFonction(arrayParle1, arrayParle2);

                var request = $.ajax({
                    url: "/ajaxquote",
                    type: "GET",
                    data: dataAjax,

                });
                request.done(function (msg) {
                    $("#texto").html(msg);
                });

            } else {
                arret = 0;
                $("#" + idDiv).stopTime().muetFonction(arrayMuet1, arrayMuet2);
                $("#texto").invisible();
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
    })
}