Game.dialogue = function(monstre) {	
	var idQuest = monstre.idQuete;
	Game['_quest'+idQuest](monstre);
}

Game._quest1 = function(monstre){
	dialogueText = "Nous refusons la domination du Ver.\n \n  Il nous impose une paix forcée que nous rejetons \n de toutes nos forces \n\n Nous ne croyons pas à la Grande Dispersion  !";																//conditions de quete
	supplyText = {'troupe': 300};
	//artefactText = {'cle': 1};
	artefactText = '';
	buildText = '';		//conditions de quete
	//recompenses = ["var index = Game.hero.artefact.indexOf(allArtefacts['cle'].name);Game.hero.artefact.splice(index, 1);"];//retirer la clé
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	texteRecompense = 'Nous nous inclinons devant la force !\n \n Le règne du Ver est cruel et si étriqué !';
}
Game._quest2 = function(monstre){
	dialogueText = "Longue vie à la maison Ix\n\n  Le ver à forme obscène doit périr !\n";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	supplyText = {'troupe': 400};
	artefactText = '';buildText = '';
	texteRecompense= 'C\'est une folie que de vouloir contenir l\'Humanité.\n\n Une paix forcée ne peux aboutir \n qu\'à plus d\'excès ';//conditions de quete

}
Game._quest3 = function(monstre){
	dialogueText = "A MORT LE TYRAN\n\n NON AU SENTIER D'OR !";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "Vous parlez de paix mais vous \n\n nous piétinez comme des animaux";
	supplyText = {'troupe': 500};
}
Game._quest4 = function(monstre){
	dialogueText = "Le peuple à le droit de vivre\n\n Rendez-nous la liberté de nous battre !";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "Le Ver sera un jour poussière comme nous.";
	supplyText = {'troupe': 900};
}
///aleatoire a partir de la
Game._quest5 = function(monstre){
	dialogueText = "Votre paix forcée n'est qu'un leurre \n qui ne peut mener qu'au chaos !";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "Nous mourons mais la Rébellion continue !.";
	supplyText = {'troupe': 600};
}
Game._quest6 = function(monstre){
	dialogueText = "La paix de LETO est une farce\n Abattons le palais !";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "Haaaa...Mort...au...Ver";
	supplyText = {'troupe': 500};
}
Game._quest7 = function(monstre){
	dialogueText = "MORT AU VER ! MORT AU VER !";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "MORT AU......";
	supplyText = {'troupe': 200};
}
//ETAPE DEUX
Game._quest8 = function(monstre){
	dialogueText = "Nous refusons de nous soumettre comme le font \n les principales maisons\n\nRegagnons notre honneur d'antan !";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "La mort appelle la mort, \n vous ne survivrez pas bien longtemps";
	supplyText = {'troupe': 300};
}

Game._quest9 = function(monstre){
	dialogueText = "La grandeur est une expérience passagère.\n Jamais elle n'est stable.\n Mort au Ver";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "Un jour ce palais ne sera plus que poussière.";
	supplyText = {'troupe': 200};
}

Game._quest10 = function(monstre){
	dialogueText = "Le peuple Fremen ne supporte plus ce joug abominable\n Au nom de notre vénéré ancêtre\n Stilgar, battons-nous !";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "Si les vœux étaient des poissons,\n nous lancerions tous des filets.\n.";
	supplyText = {'troupe': 400};
}
Game._quest11 = function(monstre){
	dialogueText = "Prenons le palais d'assaut ! \nPillons les richesses du Ver !";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "La puissance et la peur… \nLa puissance et la peur !";
	supplyText = {'troupe': 300};
}
Game._quest12 = function(monstre){
	dialogueText = "Détruisons Nayla et toute sa clique ! ";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "Ce sont ceux qui peuvent détruire \n une chose qui la contrôlent vraiment.";
	supplyText = {'troupe': 200};
}
Game._quest13 = function(monstre){
	dialogueText = "Le Ver infâme tient le monde connu\n sous son joug pour quoi ?\n nous éduquer ? \nNOUS NE VOULONS PAS ! ";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "La tristesse est le prix de la victoire.";
	supplyText = {'troupe': 200};
}
Game._quest14 = function(monstre){
	dialogueText = "Le Sentier d'or n'est qu'une excuse à \n une tyrannie que n'a fait que trop duré ";
	recompenses = ['kill'];
	updateFermetureDialogue = [monstre.name+"=60"];
	artefactText = '';buildText = '';
	texteRecompense= "Maudit soit le Ver";
	supplyText = {'troupe': 100};
}


////////////////////////////////////////////////////////////ancien
Game._quest50 = function(monstre){
	dialogueText = 'Bonjour étranger.\n Plantez du Maïs pour nourrir mes\n petits poussins trop mignons \n et je vous laisserai passer...\nBien sur, auparavant, vous devrez \n trouver la clé pour ouvrir cette barrière...\n  ';	
	
	supplyText = {'mais': 10};										
	// supplyText = '';										
	artefactText = {'cle': 1};	
	buildText = '';		//conditions de quete
	recompenses = ["abs2[445] = 0;var index = Game.hero.artefact.indexOf(allArtefacts['cle'].name);Game.hero.artefact.splice(index, 1);"];//retirer la clé
	updateFermetureDialogue = [monstre.name+"=6"];
	texteRecompense = 'Merci.\n Bon voyage, et soyez prudent !\n Servez-vous de la pioche\n pour casser des cailloux !';
}

Game._quest60 = function(monstre){
	dialogueText = "Bonjour étranger \n ";
	supplyText = '';																	//conditions de quete
	artefactText = '';														//conditions de quete
	buildText = '';	
}

Game._quest140 = function(monstre){
	dialogueText = "Bonjour étranger \n ";
	supplyText = '';																	//conditions de quete
	artefactText = '';														//conditions de quete
	buildText = '';
}

Game._quest70 = function(monstre){
	dialogueText = 'Bonjour étranger.\n Je peux vous fournir une épée\n pour seulement\n';	
	supplyText = {'farine': 500, 'ecu' : 5};																	//conditions de quete
	artefactText = {'corde': 1, 'manche': 1, 'silex': 1};														//conditions de quete
	// buildText = [{name: 'culture_ble', nombre:2, level:2}, {name: 'culture_raisin', nombre:2, level:2}];		//conditions de quete
	buildText = [{name: 'culture_ble', nombre:1, level:2}];		//conditions de quete
	recompenses = ["Game.hero.equipement['epee'].possession = 1;", "Game.hero.equipement['epee'].life = 100;"];
	// updateFermetureDialogue = ["monstre.idQuete = 2"];
	texteRecompense = 'Merci.\n Revenez me voir \n quand vous voulez';
}

Game._quest80 = function(monstre){
	dialogueText = 'Le pont est cassé !\n Créez des scieries pour fabriquer les planches\n nécessaires à la fabrication du pont !\n Fauchez les ronces pour\n fournir le bois à vos scieries';	
	supplyText = {'planche': 50};																	
	artefactText = '';	
	buildText = '';
	recompenses = ["abs2[777] = 84;"];
	updateFermetureDialogue = [monstre.name+"=9"];
	texteRecompense = 'Merci.\n Revenez me voir \n quand vous voulez';
}

Game._quest90 = function(monstre){
	dialogueText = "Le pont est réparé, merci pour votre aide \n ";
	supplyText = '';																	//conditions de quete
	artefactText = '';														//conditions de quete
	buildText = '';	
}

Game._quest100 = function(monstre){
	dialogueText = "Pour accéder directement à cette \n région, tapez le mot 'atreides'\n dans l'espace prévu à cet effet ";
	supplyText = '';																	//conditions de quete
	artefactText = '';														//conditions de quete
	buildText = '';	
}

Game._quest110 = function(monstre){
	dialogueText = "Vous avez remarqué?\n Toutes les semaines, les trous se rebouchent...\n et les créatures étranges apparaissent... ";
	supplyText = '';																	//conditions de quete
	artefactText = '';														//conditions de quete
	buildText = '';	
}
Game._quest120 = function(monstre){
	dialogueText = "Bienvenue dans cette région fleurie !\n Pour y accéder directement,\n  tapez le mot 'ordos' dans l'espace\n  prévu à cet effet";
	supplyText = '';																	//conditions de quete
	artefactText = '';														//conditions de quete
	buildText = '';	
}
Game._quest130 = function(monstre){
	dialogueText = "Mon jardin ne peut pas fleurir!\n J'ai besoin de deux bombes \npour faire sauter le barrage \n";					
	buildText = '';	
	supplyText = '';																	//conditions de quete
	artefactText = {'bombe': 2};		
	// artefactText = '';					
	// supplyText = {'ecu': 5};					
	recompenses = [
	"abs2[496] = 16;", "abs2[497] = 16;", "abs2[498] = 16;", "abs2[544] = 16;", "abs2[545] = 16;", "abs2[546] = 16;", "abs2[548] = 16;", "abs2[549] = 16;", "abs2[550] = 16;", "abs2[551] = 16;", "abs2[552] = 16;", "abs2[596] = 16;",
	"abs2[597] = 16;", "abs2[598] = 16;", "abs2[599] = 16;", "abs2[600] = 16;", "abs2[640] = 16;", "abs2[641] = 16;", "abs2[642] = 16;", "abs2[643] = 16;", "abs2[644] = 16;", "abs2[645] = 16;", "abs2[646] = 16;", "abs2[647] = 16;",, "abs2[648] = 16;",
	"abs2[688] = 16;", "abs2[689] = 16;", "abs2[690] = 16;", "abs2[691] = 16;", "abs2[692] = 16;", "abs2[693] = 16;", "abs2[694] = 16;", "abs2[695] = 16;", "abs2[696] = 16;", "abs2[736] = 16;", "abs2[737] = 16;", "abs2[743] = 16;",, "abs2[744] = 16;",
	"abs2[784] = 16;", "abs2[785] = 16;", "abs2[791] = 16;", "abs2[792] = 16;", "abs2[832] = 16;", "abs2[833] = 16;", "abs2[834] = 16;", "abs2[835] = 16;", "abs2[836] = 16;", "abs2[837] = 16;", "abs2[838] = 16;", "abs2[839] = 16;",, "abs2[840] = 16;",
	"abs2[738] = 82;", "abs2[739] = 82;", "abs2[740] = 82;", "abs2[741] = 82;", "abs2[742] = 82;", "abs2[786] = 82;", "abs2[787] = 82;", "abs2[788] = 82;", "abs2[789] = 82;", "abs2[790] = 82;",	
	"absobs2[496] = 16;", "absobs2[497] = 16;", "absobs2[498] = 16;", "absobs2[544] = 16;", "absobs2[545] = 16;", "absobs2[546] = 16;", "absobs2[548] = 16;", "absobs2[549] = 16;", "absobs2[550] = 16;", "absobs2[551] = 16;",
	"absobs2[552] = 16;", "absobs2[596] = 16;",
	"absobs2[597] = 16;", "absobs2[598] = 16;", "absobs2[599] = 16;", "absobs2[600] = 16;", "absobs2[640] = 16;", "absobs2[641] = 16;", "absobs2[642] = 16;", "absobs2[643] = 16;", "absobs2[644] = 16;", "absobs2[645] = 16;",
	"absobs2[646] = 16;", "absobs2[647] = 16;",, "absobs2[648] = 16;",
	"absobs2[688] = 16;", "absobs2[689] = 16;", "absobs2[690] = 16;", "absobs2[691] = 16;", "absobs2[692] = 16;", "absobs2[693] = 16;", "absobs2[694] = 16;", "absobs2[695] = 16;", "absobs2[696] = 16;", "absobs2[736] = 16;",
	"absobs2[737] = 16;", "absobs2[743] = 16;",, "absobs2[744] = 16;",
	"absobs2[784] = 16;", "absobs2[785] = 16;", "absobs2[791] = 16;", "absobs2[792] = 16;", "absobs2[832] = 16;", "absobs2[833] = 16;", "absobs2[834] = 16;", "absobs2[835] = 16;", "absobs2[836] = 16;", "absobs2[837] = 16;",
	"absobs2[838] = 16;", "absobs2[839] = 16;",, "absobs2[840] = 16;",
	"absobs2[738] = 82;", "absobs2[739] = 82;", "absobs2[740] = 82;", "absobs2[741] = 82;", "absobs2[742] = 82;", "absobs2[786] = 82;", "absobs2[787] = 82;", "absobs2[788] = 82;", "absobs2[789] = 82;", "absobs2[790] = 82;",

	"Game.hero.equipement['epee'].possession = 1;", "Game.hero.equipement['epee'].life = 100;"
	];				
	updateFermetureDialogue = [monstre.name+"=16"];
	texteRecompense = 'Merci beaucoup ! Je vais pouvoir\n arroser mes pétunias !\nPrenez cette épée en récompense\n de vos efforts !';
}

Game._quest160 = function(monstre){
	dialogueText = "Ces fleurs sont magnifiques, n'est-ce pas ? \n Vous avez remarqué que votre barre d'agilité\n apparaissait quand vous vous équipez de votre épée ?\n\n Pour vous servir de votre épée, placez-vous\n à côté du monstre que vous voulez combattre\n et utilisez l'épée. Plus votre agilité est\n haute, plus vous pouvez frapper vite ! ";
	supplyText = '';																	//conditions de quete
	artefactText = '';														//conditions de quete
	buildText = '';	
}

Game._quest140 = function(monstre){
	dialogueText = "Bienvenue chez les frères O'Tools \n Ici, vous aurez tout ce que vous\n ne pourrez pas avoir ailleurs !\n Pour un prix modique, je vous vends des bombes\n de premières qualités !";
	supplyText = {'ecu': 120, 'fer' : 50};		
	recompenses = ["Game.hero.artefact.push('bombe'); "];												//conditions de quete
	artefactText = '';															//conditions de quete
	buildText = '';
	updateFermetureDialogue = '';
	texteRecompense = '';
}
Game._quest150 = function(monstre){
	dialogueText = "Bienvenue chez les frères O'Tools \n Ici, vous aurez tout ce que vous\n ne pourrez pas avoir ailleurs !\n Pour un prix modique, je booste votre agilité !\n (utile lors des combats)";
	supplyText = {'ecu': 50, 'vigne' : 30};		
	// supplyText = {'ecu': 10};		
	recompenses = ["Game.hero.agilite+=	10; "];												//conditions de quete
	artefactText = '';										//conditions de quete
	buildText = '';
	updateFermetureDialogue = '';
	texteRecompense = 'Merci ! Votre agilité a augmenté de 10 points\n Vous pourrez frapper plus vite avec l\'épée';
}

Game._quest170 = function(monstre){
	dialogueText = "Merci !!! Merci pour votre dévouement !\n Pour le moment, il n'existe que trois régions !\n la quatrième arrive dans peu de temps !\nPour y accéder directement,\n  tapez le mot 'harkonnen' dans l'espace\n  prévu à cet effet  ";
	supplyText = '';
	artefactText = '';
	buildText = '';	
}

Game._quest180 = function(monstre){
	dialogueText = "Vous voilà bien loin dans la forêt...\n et vos outils me paraissent en piteux état...\n Ecoutez, je veux bien vous réparer\n tous vos outils, mais pour ça,\n il me faut des ressources ! ";
	supplyText = {'planche' : 30};				
	recompenses = ["Game.hero.equipement['epee'].life = 100;", "Game.hero.equipement['epee'].life = 100;", "Game.hero.equipement['pioche'].life = 100;", "Game.hero.equipement['faux'].life = 100;"];	
	artefactText = {'silex': 3, 'manche': 2};										//conditions de quete
	buildText = '';
	updateFermetureDialogue = '';
	texteRecompense = 'Voilà le travail !\n\n N\'hésitez pas à revenir me voir\n pour vos outils !';
}
 
Game._clickMonstre = function() {
	if(dialogue == 1){
		var canvas = document.getElementById('map_canvas');

		var width = canvas.width;
		var height = canvas.height;	
		// var height = screen.height;	
		// var tsizePar2 = map.tsize/2;
			
		if(width < 1300){
			batimentClickResponsive = 2;
			colonneBatimentClicResponsive = 70;
		}

		if(screen.width < 1400 && screen.width > 641){
			this.ctx.font = '14px Georgia';//marche sur les petits pc
			var sousTexte = 170;
			var sousRessource = 130;
		}else if(screen.width < 641){
			this.ctx.font = '11px Georgia';//marche sur les samsung
			var sousTexte = 170;
			var sousRessource = 130;
		}else{
			this.ctx.font = '18px Georgia';//marche sur les petits pc
			var sousTexte = 270;
			var sousRessource = 220;
			
		}
		
		this.ctx.fillStyle = 'black';
		this.ctx.beginPath();
		this.ctx.rect(width/4-5, height/4-5, width/batimentClickResponsive+10, height/2+10);
		
		this.ctx.fill();
		
		this.ctx.beginPath();
		this.ctx.rect(width/4, height/4, width/batimentClickResponsive, height/2);
		this.ctx.fillStyle = 'brown';
		this.ctx.fill();
		
		this.ctx.drawImage(Loader.getImage('ko'), width/4, height/4);

		var lines = dialogueText.split("\n");
		this.ctx.fillStyle = 'white';
		var u = 1;
		for (i = 0; i < lines.length; i++) {//TEXTE DU PERSONNAGE
					this.ctx.fillText(lines[i],width/4+35, u+height/4+30);
					u = u+25;
		}
		
		var n = 0;
		var error = 0;
		Game.hero.supply = Game._getSupply();
		Object.keys(supplyText).forEach(function(key) {	//CONDITIONS DES RESSOURCES DU PERSONNAGE

			if(Game.hero.supply[key] < supplyText[key]){
				error = 1;
				Game.ctx.fillStyle = 'gray';
			}else
				Game.ctx.fillStyle = 'white';
			
			
				Game.ctx.fillText(supplyText[key], width/4+5, height/4+sousTexte + n);
				Game.ctx.drawImage(Loader.getImage(key), width/4+45, height/4+sousRessource + n);
				n = n+40;
		})
		
		
		Game.ctx.fillStyle = 'white';
		var n = 0;
		Object.keys(artefactText).forEach(function(key) { //CONDITIONS DES ARTEFACTS DU PERSONNAGE
			var artefactsVoulus = 0;
			for(var i =0; i< Game.hero.artefact.length; i++){
				if(Game.hero.artefact[i] == key)
					artefactsVoulus++;
			}
			
			if(artefactsVoulus < artefactText[key]){
				error = 1;
				Game.ctx.fillStyle = 'gray';
			}else
				Game.ctx.fillStyle = 'white';
			
			Game.ctx.fillText(artefactText[key], width/4+100, height/4+sousTexte + n);
			Game.ctx.drawImage(Loader.getImage(key), width/4+130, height/4+sousRessource + n);
			n = n+40;
		})
		
		
		Game.ctx.fillStyle = 'white';
		var n = 0;
		
		for(var i =0; i< buildText.length; i++){//CONDITIONS DES BATIMENTS DU PERSONNAGE
			var buildVoulus = allBuilding[buildText[i].name].paramBuild['typeBatiment'];
			var nbVoulus = buildText[i].nombre;
			var levelVoulus = buildText[i].level;
			
			var nbBatimentPossedes = 0;
			var nbBatimentLevelPossedes = 0;
			
			Object.keys(builds).forEach(function(key) {
					if(JSON.stringify(builds[key].batiment)==JSON.stringify(buildVoulus)){
						nbBatimentPossedes++;
						if(builds[key].level == levelVoulus)
							nbBatimentLevelPossedes++;
					}				
				
			})
			
			
			if(nbBatimentPossedes != nbVoulus || nbBatimentLevelPossedes != nbBatimentPossedes){
				error = 1;
				Game.ctx.fillStyle = 'gray';
			}else
				Game.ctx.fillStyle = 'white';
			
			
			Game.ctx.fillText(buildText[i].nombre, width/4+215, height/4+sousTexte + n);
			Game.ctx.drawImage(Loader.getImage(buildText[i].name), width/4+245, height/4+sousRessource + n);
			Game.ctx.fillText('lvl '+buildText[i].level, width/4+280, height/4+sousRessource+25 + n);
			n = n+40;
			
		}
		
		if(error == 0 && (supplyText!='' || artefactText!='' || buildText!='' ))
			this.ctx.drawImage(Loader.getImage('ok'), width/4+290, height/4+20+200);

	}
}

Game._questClickPay = function() {

	var error = 0;
	Object.keys(supplyText).forEach(function(key) {//PAYE LE PRIX DE LA QUETE
		if(Game.hero.supply[key] < supplyText[key])
			error = 1;
	})
	if(error == 0){
		Object.keys(supplyText).forEach(function(key) {	//PAYE LES RESSOURCES
			Game.hero.supply[key]-= supplyText[key];

		})
		payeRessources(supplyText);


		Object.keys(artefactText).forEach(function(key) { //PAYE LES ARTEFACTS
			var artefactsVoulus = 0;
			for(var i =0; i< Game.hero.artefact.length; i++){		
				if(Game.hero.artefact[i] == key){
					artefactsVoulus++;
					if(artefactsVoulus <= artefactText[key]){
						Game.hero.artefact.splice(i, 1);
					}
				}
			}
		})

		for(var i =0; i< recompenses.length; i++){
			if(recompenses[i] != 'kill')
				eval(recompenses[i]);
		}

		console.log(updateFermetureDialogue);
		for (var i = 0; i < updateFermetureDialogue.length; i++) {
			var res = updateFermetureDialogue[i].split("=");
			var monstreName = res[0];
			var questUp = res[1];
			Object.keys(monsters).forEach(function (key) {
				if (monsters[key].name == monstreName) {
					monsters[key].idQuete = questUp;
					if (recompenses[0] == 'kill')
						delete monsters[key];
				}
			})
		}

		if(texteRecompense != ''){
			dialogueText = texteRecompense;
			supplyText = '';
			artefactText = '';
			buildText = '';
		}
	}
}