Game._drawMenu = function () {
	//menu
	var canvas = document.getElementById('map_canvas');
	var width = canvas.width;
	var height = canvas.height;	
	var tsizePar2 = map.tsize/2;
	
	//menu haut
	this.ctx.beginPath();
    this.ctx.rect(0, 0, width, map.tsize);
    this.ctx.fillStyle = '#5948ac';
    this.ctx.fill();
	
	this.ctx.font="20px Arial";
	this.ctx.fillStyle = 'black';

	var objX =0;
	Object.keys(objets).forEach(function(key) {

		if(Game.hero.equipement[key].possession == 1){
			if(Game.hero.equipement[key].equipe == 1)
				Game.ctx.drawImage(Loader.getImage(objets[key].img+'_use'), 150 + objX, 0);
			else
				Game.ctx.drawImage(Loader.getImage(objets[key].img), 150 + objX, 0);
			objX = objX + 200;
		}
	})

	
	//menu gauche
	this.ctx.beginPath();
    this.ctx.rect(0, tsizePar2+32, map.tsize, height);
    this.ctx.fillStyle = '#5c2400';
    this.ctx.fill();
	//menu droite
	this.ctx.beginPath();
    this.ctx.rect(width-25, tsizePar2+32, map.tsize, height);
    this.ctx.fillStyle = '#5c2400';
    this.ctx.fill();
	//menu bas
	this.ctx.beginPath();
    this.ctx.rect(0, height-20, width, 30);
    this.ctx.fillStyle = '#5c2400';
    this.ctx.fill();

	
	n = 0;
	var o = 0;
	//Game.ctx.drawImage(Loader.getImage('action'), 0, 70	);
	
	Game.ctx.drawImage(Loader.getImage('construire'),  0, 170);
	n = n+100;
	Game.ctx.drawImage(Loader.getImage('body'),  0, 270);
	
	
	if(menuclick == 1){
		
		this.ctx.beginPath();
		this.ctx.rect(map.tsize-2, map.tsize-2, map.tsize*2+4, height);
		this.ctx.fillStyle = 'black';
		this.ctx.fill();
		this.ctx.beginPath();
		this.ctx.rect(map.tsize, map.tsize, map.tsize*2, height);
		this.ctx.fillStyle = 'brown';
		this.ctx.fill();
		
		var incrementation = 1;
		var ligne = 1;
		Object.keys(allBuilding).forEach(function(key) {// building.js setBuilding
			if( Game.hero.batiments[allBuilding[key].paramBuild['name']] == 1 )
				Game.ctx.drawImage(Loader.getImage(key), incrementation * map.tsize, map.tsize*ligne);
			
			if(incrementation == 2){
				incrementation = 0;
				ligne ++;
			}
			incrementation ++;
		})
		
	}
	
	
	if(menussclick != 0){
		Game.hero.supply = Game._getSupply();
		// this.ctx.globalAlpha = 0.5;
		this.ctx.fillStyle = 'black';
		this.ctx.fillRect(map.tsize*3-2, map.tsize*2-2, 334, 164);
		this.ctx.fillStyle = '#ffcd88';
		this.ctx.fillRect(map.tsize*3, map.tsize*2, 330, 160);
		
		this.ctx.font="20px Arial";
		this.ctx.fillStyle = 'black';
		this.ctx.fillText(allBuilding[keySelected].menussclickTitre, map.tsize*3+tsizePar2/2, map.tsize*3-tsizePar2);	//titre du batiment
		
		this.ctx.drawImage(Loader.getImage('ok'), map.tsize*7, map.tsize*2+10);
		this.ctx.drawImage(Loader.getImage('ko'), map.tsize*7+32, map.tsize*2+10);
		
		this.ctx.font="15px Arial";
		var lines = allBuilding[keySelected].description_fr.split("\n");
		this.ctx.fillStyle = 'black';
		var u = 1;
		for (i = 0; i < lines.length; i++) {
			 		this.ctx.fillText(lines[i],map.tsize*3+10, u + map.tsize*3);
					u = u+15;
		}
		u = u+10;
		a = 15;
		
		Object.keys(allBuilding[keySelected].supplyBuild).forEach(function(key) {

			if(Game.hero.supply[key] >= allBuilding[keySelected].supplyBuild[key])
				Game.ctx.fillStyle = 'green';
			else
				Game.ctx.fillStyle = 'red';
			
			Game.ctx.fillText(allBuilding[keySelected].supplyBuild[key],map.tsize*3 + a, u+map.tsize*3);
			Game.ctx.drawImage(Loader.getImage(key),map.tsize*3 + a, 5+u+map.tsize*3);
			a = a+40;
		})
		
		Game.ctx.drawImage(
			Game.tileAtlas, // image
			(allBuilding[keySelected].paramBuild['typeTile'][0] - 1) * map.tsize, // source x
			0, // source y
			map.tsize, // source width
			map.tsize, // source height
			a + map.tsize*3,  // target x
			5+u+map.tsize*3, // target y
			map.tsize/2, // target width
			map.tsize/2 // target height
		);
		
		Game.ctx.drawImage(
			Game.tileAtlas, // image
			(allBuilding[keySelected].paramBuild['typeTile'][1] - 1) * map.tsize, // source x
			0, // source y
			map.tsize, // source width
			map.tsize, // source height
			a + map.tsize*3,  // target x
			5+u+map.tsize*3, // target y
			map.tsize/2, // target width
			map.tsize/2 // target height
		);
		
	}

		
};

Game._clickMenu = function (xClick, yClick, menuH, rect, tsizePar) {
	
	var tsizePar2 = tsizePar/2;

	if(xClick < map.tsize && yClick > 270 && yClick < 270+64 &&  menuclick == 0){	//fiche joueur
		Game._clickBody();
		if(menuBodyClick == 0){
			menuBodyClick = 1;
		}else{
			menuBodyClick =0;
		}
		
	}
	if(yClick > map.tsize && xClick > map.tsize && xClick < map.tsize*3 && menuclick==1){

		menussclick			= 1;
		keySelected 		= '';
		
		var xFois = 0;
		if(xClick < map.tsize * 2)
			xFois = 1;
		var yFois = Math.trunc(yClick / map.tsize);
		var incr2 = yFois * 2 - xFois;
		
		var incr1 = 1;
		Object.keys(allBuilding).forEach(function(key) {// building.js setBuilding
			if(incr1 == incr2)
				keySelected = key;
			incr1++;
		})
	}
}

Game._clickBatiment = function () {

	if(batimentclick == 1){ //detail batiment

		var canvas = document.getElementById('map_canvas');
		var width = canvas.width;
		var height = canvas.height;
		var tsizePar2 = map.tsize/2;

		if(width < 1300){
			batimentClickResponsive = 2;
			colonneBatimentClicResponsive = 70;
		}



		if(builds[map.getRow(this.hero.x)+'-'+map.getCol(this.hero.y)].batiment == 61){
			returnMarches = 1;
			//FAIT LA REQUETE AJAX POUR RENTRER DANS LE JEU
		}else if(builds[map.getRow(this.hero.x)+'-'+map.getCol(this.hero.y)].batiment == 191){
			returnVillages = 1;
		}else{


			this.ctx.fillStyle = 'black';
			this.ctx.beginPath();
			this.ctx.rect(width/4-5, height/4-5, width/batimentClickResponsive+10, height/2+10);
			this.ctx.fill();

			this.ctx.beginPath();
			this.ctx.rect(width/4, height/4, width/batimentClickResponsive, height/2);
			this.ctx.fillStyle = 'brown';
			this.ctx.fill();
			this.ctx.drawImage(Loader.getImage('ko'), width/4, height/4);


			this.ctx.fillStyle = 'black';

			//détail de tous les autres batiments
			var build = builds[map.getRow(this.hero.x)+'-'+map.getCol(this.hero.y)] ;
			var posB = map.getRow(build.y)*map.rows+map.getCol(build.x);
			var position = build.batiment.indexOf(abs2[posB]);
			if(position == 0)
				position = 3;
			else if(position == 1)
				position = 2;
			else if(position == 2)
				position = 1;
			
			this.ctx.fillStyle = 'white';

			this.ctx.fillText('level : '+build.level, width/4+128, height/4+32);
			this.ctx.fillText('vie : '+build.life, width/4+128, height/4+64);
			if(build.caracteristique.outilRecompense)
				this.ctx.drawImage(Loader.getImage(build.caracteristique.outilRecompense+'_bulle'), width/4+50, height/4+25);

			var n = 0;
			if( build.etat == 1 ) {
				this.ctx.fillStyle = 'orange';
				this.ctx.fillText('DESACTIVER ce bâtiment', width / 4 + 5, height / 4 + 100);
			}else{
				this.ctx.fillStyle = 'orange';
				this.ctx.fillText('ACTIVER ce bâtiment', width / 4 + 5, height / 4 + 100);
			}

			this.ctx.fillStyle = 'white';
			/*
			this.ctx.fillText('Maintenance / jour', width/4+5, height/4+100);

			Object.keys(build.caracteristique.maintenance).forEach(function(key) {
				Game.ctx.fillText(build.caracteristique.maintenance[key], width/4+5, height/4+138 + n);
				Game.ctx.drawImage(Loader.getImage(key), width/4+37, height/4+110 + n);
				n = n+40;
			})
			*/
			n = n+40;
			this.ctx.fillText('Ce batiment génère : ', width/4+5, height/4+100 + n);
			n = n+40;
			Object.keys(build.caracteristique['recompense']).forEach(function(keyRecompense) {
					Game.ctx.fillText(build.caracteristique['recompense'][keyRecompense] , width/4+5, height/4+100 + n);
					Game.ctx.drawImage(Loader.getImage(keyRecompense), width/4+50, height/4+75 + n);
					
				})

			if( build.level < 3){ //monter de level
				var error = 0; 
				this.ctx.fillText('Prochain', width/3+128+colonneBatimentClicResponsive, height/5+100);
				this.ctx.fillText('niveau', width/3+128+colonneBatimentClicResponsive, height/5+120);
				var n = 0;
				Object.keys(build.caracteristique.updateNiveau).forEach(function(key) {
					if(Game.hero.supply[key] >= build.caracteristique.updateNiveau[key] * build.level)
						Game.ctx.fillStyle = 'greenyellow';
					else{
						Game.ctx.fillStyle = 'red';
						error = 1;
					}
					
					Game.ctx.fillText(build.caracteristique.updateNiveau[key] * build.level, width/3+120+colonneBatimentClicResponsive, height/4+138 + n);
					Game.ctx.drawImage(Loader.getImage(key), width/3+167+colonneBatimentClicResponsive, height/4+110 + n);
					n = n+40;
				})
				
				if(error == 0){
					this.ctx.drawImage(Loader.getImage('ok'), width/3+128+colonneBatimentClicResponsive, height/5+35);
				}
			}else{
				this.ctx.fillText('Niveau', width/3+178, height/5+100);
				this.ctx.fillText('max', width/3+178, height/5+120);
			}
		}
	}
}

Game._clickBody = function () {	//MENU DES EQUIPEMENTS
	
	if(menuBodyClick == 1){
		var canvas = document.getElementById('map_canvas');
		var width = canvas.width;
		var height = canvas.height;	
		var tsizePar2 = map.tsize/2;
			
		if(width < 1300){
			batimentClickResponsive = 2;
			colonneBatimentClicResponsive = 70;
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
		
		this.ctx.fillStyle = 'white';

		this.ctx.fillText('Exploration : '+ this.hero.exploration, width/4+12, height/4+20+128);
		var outilEquipe = this._getToolEquipe();
		if(outilEquipe != '')
			this.ctx.fillText('Outil équipé : '+ Game.hero.equipement[outilEquipe].life + '/100', width/4+12, height/4+20+160);
		
		if(artefactSelectionne != ''){	//description de l'item sélectionné
			var lines = artefactSelectionne.description_fr.split("\n");
			this.ctx.fillStyle = 'white';
			var u = 1;
			for (var i = 0; i < lines.length; i++) {
						this.ctx.fillText(lines[i],width/4+170, u+height/4+20);
						u = u+25;
			}
			
			if(!artefactSelectionne.quete)// si l'objet peut être utilisé
				this.ctx.drawImage(Loader.getImage('ok'), width/4+170, height/4+20+100);
		
		}
		
		var incr 	= 0;
		var nbLigne = 0;
		for(var i =0; i< this.hero.artefact.length; i++){
			this.ctx.drawImage(Loader.getImage(this.hero.artefact[i]), width/4 + incr, height/4+20+180 + nbLigne);
			
			incr+= 32;
			if(i>6){
				nbLigne = 55;
				incr = 0;
			}
		}
		
	}else
		artefactSelectionne = '';
		
}