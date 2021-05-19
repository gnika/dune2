$(document).ready(function() {
	// alert('a');
})

function openDoorLoin(idPorte, idType){
	$("#porte_"+idPorte).stopTime().mouvDoorLoin(idPorte, idType);
}
function openTrappe(idPorte, idType){
	$("#porte_"+idPorte).attr('class', 'porte_'+idType+'_1');
	$("#porte_"+idPorte).after('<div id="openTrappe">&nbsp;</div>');
}
function openIndice(){
	var request = $.ajax({
		url: '/openindice',
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
function openDocuments(){
	var request = $.ajax({
		url: '/documents',
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
function openJournal(){
	var request = $.ajax({
		url: '/journal',
		type: "GET"
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
function returnVillage(){
	var request = $.ajax({
		url: '/village4',
		type: "GET",
		data: { returnBoussole:1 }
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

function openDoorCote(idPorte, idType){
	$("#porte_"+idPorte).stopTime().mouvDoorCote(idPorte, idType);
}

jQuery.fn.mouvDoorLoin = function(idPorte, idType){
	$(this).everyTime(1000,function(){
		$(this).openDoorLoin(idPorte, idType);
	});
}
jQuery.fn.mouvDoorCote = function(idPorte, idType){
	$(this).everyTime(1000,function(){
		$(this).openDoorCote(idPorte, idType);
	});
}

jQuery.fn.openDoorCote = function(idPorte, idType) {
	$(this).oneTime(200,function() {
		$(this).css({backgroundPosition:'3px 2px'});
	}).oneTime(400,function() {
		$(this).css({backgroundPosition:'3px -318px'});
	}).oneTime(600,function() {
		$(this).css({backgroundPosition:'3px -638px'});
	}).oneTime(800,function() {
		$(this).css({backgroundPosition:'3px -958px'});
	}).oneTime(1000,function() {
		$("#porte_"+idPorte).removeClass('porte_'+idType+'_0').addClass('porte_'+idType+'_1');
		$(this).css({backgroundPosition:'3px -1279px'});
		$(this).stopTime();
	});		
};


jQuery.fn.openDoorLoin = function(idPorte, idType) {
	$(this).oneTime(200,function() {
		$(this).css({backgroundPosition:'2px 0px'});
	}).oneTime(400,function() {
		$(this).css({backgroundPosition:'2px -200px'});
	}).oneTime(600,function() {
		$(this).css({backgroundPosition:'2px -400px'});
	}).oneTime(800,function() {
		$(this).css({backgroundPosition:'2px -600px'});
	}).oneTime(1000,function() {
		$("#porte_"+idPorte).removeClass('porte_'+idType+'_0').addClass('porte_'+idType+'_1');
		$(this).css({backgroundPosition:'2px -800px'});
		$(this).stopTime();
	});		
};


function changeQuest(idQuest, idPerso, idQuestExterne){
	var request = $.ajax({ 
				url: url_site+'Core/ajax/changequest', 
				type: "POST",
				data: { idQ: idQuest, idP: idPerso, idQuestE: idQuestExterne},			
				});
}

function ajaxClef(idPorte, etat, idObject){
	var request = $.ajax({ 
				url: '/ajaxporte',
				type: "GET",
				data: { porte: idPorte, etatPorte: etat, objectId: idObject},			
				});
}
function hormones(){
	var request = $.ajax({
				url: '/hormones',
				type: "GET",
				data: { objectId: 3},			
				});
}
function marquepage(){
	var request = $.ajax({
				url: '/marquepage',
				type: "GET",
				data: { objectId: 22},			
				});
	
	request.done(function(msg) { 
		messagesDisplay();
		afficheObject();
	});
}
function mv_nuage(){
	$(".sprite_nuage").removeClass('hide');
	var request = $.ajax({
				url: '/tournevis',
				type: "GET",
				data: { objectId: 5},			
				});
}

function openSafe(){
	$("#safe").attr('src', '/images/safe_open.png');
	$("#safe").attr('class', 'open_safe');
	$("#documents").removeClass('hide');
	var request = $.ajax({
		url: '/opensafe',
		type: "GET",
		data: { objectId: 29},
	});
}

function majQuete(idQuete, idPerso, idExterne, message=null){
	var request = $.ajax({
		url: '/majquete',
		type: "GET",
		data: {	idQuete: idQuete, idPerso: idPerso, idExterne: idExterne, message: message	},
	})
	request.done(function(msg) {
		messagesDisplay();
		afficheObject();
	});;
}

function learnLang(){
	var request = $.ajax({
				url: '/chakobsa',
				type: "GET",
				data: { objectId: 5},			
				});
}
function openPortePrison(){
	var request = $.ajax({
				url: '/clecouloircachot',
				type: "GET",
				data: { objectId: 20},			
				});
				
		afficheObject();
		$('#couloircachot').attr('id', 'couloircachotouvert');
		$('.porteFond').attr('class', 'porteFonddisplay');
}
function takeClef(){
	var request = $.ajax({
				url: '/clecouloircachottake',
				type: "GET"
				});
				
	request.done(function(msg) { 
		messagesDisplay();
		$('#clef_cachot').remove();
		afficheObject();
	});

}
function killRat(){
	
	$("#rat").remove();
	$('#rat_image').attr("id", "rat_explosion");
		$("#rat_explosion").css("background-image", "url(/images/explosion.png)");
		
	$('#rat_explosion').oneTime(200,function() {
		$('#rat_explosion').css({backgroundPosition:'-64px 0px'});
		
	}).oneTime(300,function() {
		$('#rat_explosion').css({backgroundPosition:'-128px 0px'});
	}).oneTime(400,function() {
		$('#rat_explosion').css({backgroundPosition:'-194px 0px'});
	}).oneTime(500,function() {
		$('#rat_explosion').css({backgroundPosition:'-258px 0px'});
	}).oneTime(600,function() {
		
		$('#rat_explosion').after('<img id="clef_cachot" onclick="takeClef()" src="/images/objet/clef.png" />');
		$('#rat_explosion').remove();
		$('#rat_explosion').stopTime();
	});	

	var request = $.ajax({
				url: '/killrat',
				type: "GET"
				});

}

function killSerrure(){
	
	$('#serrure_no_brulure').attr("id", "serrure_explosion");
		$("#serrure_explosion").css("background-image", "url(/images/explosion.png)");
		
	$('#serrure_explosion').oneTime(200,function() {
		$('#serrure_explosion').css({backgroundPosition:'-64px 0px'});
		
	}).oneTime(300,function() {
		$('#serrure_explosion').css({backgroundPosition:'-128px 0px'});
	}).oneTime(400,function() {
		$('#serrure_explosion').css({backgroundPosition:'-194px 0px'});
	}).oneTime(500,function() {
		$('#serrure_explosion').css({backgroundPosition:'-258px 0px'});
	}).oneTime(600,function() {
		
		$('#serrure_explosion').after('<div id="vers_portePrison" alt="couloircachot" class="portePrison"></div><div id="serrure_brulure"></div>');
		$('#serrure_explosion').stopTime();
		$('#serrure_explosion').remove();
	});	

	var request = $.ajax({
				url: '/killserrure',
				type: "GET"
				});

}

function killSafe(){

	$('#serrure').attr("class", "serrure_explosionchambre");
		$(".serrure_explosionchambre").css("background-image", "url(/images/explosion.png)");

	$('.serrure_explosionchambre').oneTime(200,function() {
		$('.serrure_explosionchambre').css({backgroundPosition:'-64px 0px'});

	}).oneTime(300,function() {
		$('.serrure_explosionchambre').css({backgroundPosition:'-128px 0px'});
	}).oneTime(400,function() {
		$('.serrure_explosionchambre').css({backgroundPosition:'-194px 0px'});
	}).oneTime(500,function() {
		$('.serrure_explosionchambre').css({backgroundPosition:'-258px 0px'});
	}).oneTime(600,function() {
		$('.serrure_explosionchambre').stopTime();
		$('#safe').attr('src', "/images/safe_open.png");
		$('#safe').after('<img src="/images/objet/docbrule.png" id="documents" style="left: 757px;" class="docbrule"/>');

		$('.serrure_explosionchambre').hide();

	});


	var request = $.ajax({
				url: '/killsafe',
				type: "GET"
				});



}

function afficheGraphe(){
	var request = $.ajax({
				url: '/infohumeur',
				type: "GET",
				data: { ajax: 1},			
				});
	request.done(function(msg) {
				$("#resultAjax").empty(); 
				$("#resultAjax").html(msg);
				$('#sortie_graph').css({'display': 'block'});
				$('#buttonObjet, #infojoueur, #information, #buttonRessources, #mesTexto, .foot').css({'display': 'none'});
				if($("#mesObjets").css('display')!='none')
					$( "#mesObjets" ).toggle( "drop" );
			});
}

function afficheSpice(){
	var request = $.ajax({ 
				url: '/inforessourcesuser',
				type: "GET",
				data: { ajax: 1},
				});
	request.done(function(msg) {
				$("#ressources").empty(); 
				$("#ressources").html(msg);
			});
}


function replaceRepresentants(){
	var request = $.ajax({
				url: '/replaceRepresentants',
				type: "GET",
				});
	request.done(function(msg) {
			});
}

function afficheObject(){
	var request = $.ajax({
				url: '/objectsuser',
				type: "GET",
				data: { templateNoDisplay: 1}		
				});
	request.done(function(msg) {
				$("#mesObjets").empty();
				$("#mesObjets").html(msg);
				// $('#sortie_objet').css({'display': 'block'});
				// $('#buttonRessources, #infojoueur, #information, #buttonObjet, #mesTexto, .foot').css({'display': 'none'});
				// $( "#mesObjets" ).toggle( "drop" );
			});
}

function mouveLeft(idPerso){
			$( "#"+idPerso ).animate({
						left: -500
						}, {
						duration: 10000,
						step: function( now, fx ){
						$( ".block:gt(0)" ).css( "left", now );
						}
						})
}

function mouveVaisseau(){
			$( ".vaisseauAchat" ).attr('style', 'left:-145px;');
			$( ".vaisseauAchat" ).animate({
						left: 1050
						}, {
						duration: 5000,
						step: function( now, fx ){
						$( ".block:gt(0)" ).css( "left", now );
						}
						})
}

function vaisseauDisplay(){
	var request = $.ajax({
				url: '/affichetabvaisseau',
				type: "GET"
				});
	request.done(function(msg) {
				$("#forceTab").empty();
				$("#forceTab").html(msg);
			});
}

function planeteDisplay(id, name){
	var request = $.ajax({
				url:'/cartedataone',
				type: "GET",
				data: { idPlanete: id}		
				});
	request.done(function(msg) {
				$("#"+name+"-box").empty();
				$("#"+name+"-box").html(msg);
			});
}

function recompenseDisplayOld(html){
	$("#recompense #recompenseValue").html(html);
	$("#recompense").css({
	   opacity: 0,
	   visibility: 'visible'
	}).animate({ opacity: 0.9 }, 1000);
	
	setTimeout(function(){
		$("#recompense").css({
			   opacity: 0.9,
			   visibility: 'visible'
		}).animate({ opacity: 0 }, 1000);
	}, 5000);
	
	setTimeout(function(){
		$("#recompense").css('visibility', 'hidden');
	}, 6000);
  
	var request = $.ajax({
				url: '/journaladd',
				type: "GET",
				data: { htmlCell: html}
				});
	
}

function recompenseDisplay(html){
	//html = '<span class="recompense moins">Vous avez donné le Krys</span><span class="recompense plus">Vous avez reçu un distille</span>';
	if( html.indexOf('span') == -1)
		$('.msg p').addClass('text');
	else
		$('.msg p').removeClass('text');
	$(".msg p").html(html);

		if( $('#onTalk').val() == 1)
			$('#waitRecompense').val(1);
		else
			$("#checkMessage").prop( "checked", true );

	var request = $.ajax({
				url: '/journaladd',
				type: "GET",
				data: { htmlCell: html}
				});

}

function setIndice(){
	var request = $.ajax({
	url: '/indice',
	type: "GET"
	});
	request.done(function(msg) { 
		messagesDisplay();
		afficheObject();
	});
}

function setInscription(){
	var request = $.ajax({
	url: '/inscrit',
	type: "GET"
	});
	request.done(function(msg) { 
		messagesDisplay();
	});
}

function setLivre(){
	var request = $.ajax({
	url: '/livre',
	type: "GET"
	});
	request.done(function(msg) { 
		messagesDisplay();
		afficheObject();
	});
}

function addObject(idObjet, message){
	var request = $.ajax({
	url: '/addObject',
	type: "GET",
	data:{
		idObjet: idObjet,
		message: message
	}
	});
	request.done(function(msg) { 
		messagesDisplay();
		afficheObject();
	});
}

function setjournalprisonnier(){
	var request = $.ajax({
	url: '/journalprisonnier',
	type: "GET"
	});
	// changeQuest(1, 28, 1);
	request.done(function(msg) { 
		messagesDisplay();
		afficheObject();
	});
}

function verifTalk(){
	if($("#onTalk").val()==0 && $("#onMyTalk").val()==0)
		return true;
	else
		return false;
}

function envoiVaisseau(idPlanete, action){
	if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
		$("#onTalk").val(1);
		var request = $.ajax({
		url: '/ajaxcarte',
		type: "GET",
			data: { quid: action, idPerso: 9, talk: 'muetFonction()', stopTalk: 'parleFonction()', id: idPlanete, troupe: 0, diplomate: 0 },
		}); 
		request.done(function(msg) {
		$("#texto").html(msg); 
		});
	}
}

function envoiTroupe(idPlanete){
	if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
		$("#onTalk").val(1);
		var request = $.ajax({
		url: '/ajaxcarte',
		type: "GET",
			data: { quid: 0, idPerso: 9, talk: 'muetFonction()', stopTalk: 'parleFonction()', id: idPlanete, troupe: 1, diplomate: 0 },
		}); 
		request.done(function(msg) { 
		$("#texto").html(msg); 
		});
	}
}

function envoiDiplomate(idPlanete){
	if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
		$("#onTalk").val(1);
		var request = $.ajax({
		url: '/ajaxcarte',
		type: "GET",
			data: { quid: 0, idPerso: 9, talk: 'muetFonction()', stopTalk: 'parleFonction()', id: idPlanete, troupe: 0, diplomate: 1 },
		}); 
		request.done(function(msg) { 
		$("#texto").html(msg);
		});
	}
}

function messagesDisplay(){
	var request = $.ajax({
				url: '/messages',
				type: "GET",
				});
	request.done(function(msg) {
		$("#messages").html(msg);
		$("#messages").css({
		   opacity: 0,
		   visibility: 'visible'
		}).animate({ opacity: 0.9 }, 500);
		
		setTimeout(function(){
			$("#messages").css({
				   opacity: 0.9,
				   visibility: 'visible'
			}).animate({ opacity: 0 }, 500);
		}, 7000);
		
		setTimeout(function(){
			$("#messages").css('visibility', 'hidden');
		}, 8000);
	});
	
}

(function($) {
    $.fn.invisible = function() {
        return this.each(function() {
            $(this).css("visibility", "hidden");
        });
    };
    $.fn.visible = function() {
        return this.each(function() {
            $(this).css("visibility", "visible");
        });
    };
}(jQuery));

arret=0;

function musicBox(music){
	
	 // if(music==undefined)music='fond1.mp3';	
	
	if(music!=undefined){
		var audio = $("#mplayer");      
		$("#sourc").attr("src", '/music/'+music);
		/****************/
		audio[0].pause();
		audio[0].load();//suspends and restores all audio element
		audio[0].play();
		/****************/
		
	}
}
musicBox();
