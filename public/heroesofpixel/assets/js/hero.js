
function Hero(map, x, y, life, fatigue, attaque, defense, xp, equipement, batiments) {
    this.map = map;
    this.x = x;
    this.y = y;
    this.life = life;
    this.fatigue = fatigue;
    this.width = map.tsize;
    this.height = map.tsize;
    this.attaque = attaque;
    this.defense = defense;
    this.chance = 1;
    this.agilite = 10;
    this.attaqueEnCours = 60;
    this.exploration = 1;
    this.equipement = equipement;
    this.batiments = batiments;
    this.artefact = [];
    this.artefactEnCours = [];

    this.supply = {
        renommee:    	$('#nbRenom').html(),
        epice:   	$('#nbSpice').html(),
        eau: 	$('#nbEau').html(),
        credit: 	$('#nbCredit').html(),
        troupe: 	$('#nbTroupe').html(),

		};
    this.image = Loader.getImage('hero');
	
	this.addBuild = function (x, y, map, typeBatiment, caracteristique, supply, typeTile, life, titre, solid)
	{
		
		var dirx = 0;
		var diry = 0;
		if (Keyboard.isDown(Keyboard.LEFT)) { dirx = -1; }//pour ne pas pouvoir construire quand il se d?place
		else if (Keyboard.isDown(Keyboard.RIGHT)) { dirx = 1; }
		else if (Keyboard.isDown(Keyboard.UP)) { diry = -1; }
		else if (Keyboard.isDown(Keyboard.DOWN)) { diry = 1; }
		if(dirx!=0 || diry!=0) return false;
		
		var error = 0;
		Object.keys(supply).forEach(function(key) {
			if(Game.hero.supply[key] < supply[key])
				error = 1;
		})
		
		if(error!= 0) {
			return false;
		}
		
		pos = map.getRow(y)*map.rows+map.getCol(x);
		
		if( (abs1[pos+1] == typeTile[0] && abs2[pos + 1] == typeTile[1])
		|| (abs1[pos+1] == typeTile[1] && abs2[pos + 1] == 0)
		)
			PlaceBatiment['droite'] = {img: 'buildOn', pos: pos + 1};
		else
			PlaceBatiment['droite'] = {img: 'buildOff', pos: pos + 1};
		
		if( (abs1[pos-1] == typeTile[0] && abs2[pos - 1] == typeTile[1])
			|| (abs1[pos-1] == typeTile[1] && abs2[pos - 1] == 0))
			PlaceBatiment['gauche'] = {img: 'buildOn', pos: pos - 1};
		else
			PlaceBatiment['gauche'] = {img: 'buildOff', pos: pos - 1};
		
		if( (abs1[pos + map.rows] == typeTile[0] && abs2[pos + map.rows] == typeTile[1])
			|| (abs1[pos + map.rows] == typeTile[1] && abs2[pos + map.rows] == 0))
			PlaceBatiment['bas'] = {img: 'buildOn', pos: pos + map.rows};
		else
			PlaceBatiment['bas'] = {img: 'buildOff', pos: pos + map.rows};
		
		if( (abs1[pos - map.rows] == typeTile[0] && abs2[pos - map.rows] == typeTile[1])
			|| (abs1[pos - map.rows] == typeTile[1] && abs2[pos - map.rows] == 0) )
			PlaceBatiment['haut'] = {img: 'buildOn', pos: pos - map.rows};
		else
			PlaceBatiment['haut'] = {img: 'buildOff', pos: pos - map.rows};
		
		PlaceBatiment['batiment'] = {typeBatiment: typeBatiment, supply: supply, life: life, titre: titre, caracteristique: caracteristique, typeTile: typeTile, solid: solid};
		
		menussclickPlaceBatiment = 1;	//check emplacement disponible
		
		menuclick = 0;		
		menussclick = 0;	
	}
	
	this.checkBuildPlace = function(){
		posXBuildGauche = Game.hero.x - map.tsize - map.tsize/2;
		posYBuildGauche = Game.hero.y - map.tsize/2;
		
		posXBuildDroite = Game.hero.x + map.tsize - map.tsize/2;
		posYBuildDroite = Game.hero.y - map.tsize/2;
		
		posXBuildHaut = Game.hero.x - map.tsize/2;
		posYBuildHaut = Game.hero.y - map.tsize - map.tsize/2;
		
		posXBuildBas = Game.hero.x - map.tsize/2;
		posYBuildBas = Game.hero.y + map.tsize/2;
		
		
		Game.ctx.drawImage(
			Loader.getImage(PlaceBatiment['gauche'].img), // image
			0, // source x
			0, // source y
			map.tsize, // source width
			map.tsize, // source height
			posXBuildGauche - Game.camera.x,  // target x
			posYBuildGauche - Game.camera.y, // target y
			map.tsize, // target width
			map.tsize // target height
		);
		
		Game.ctx.drawImage(
			Loader.getImage(PlaceBatiment['droite'].img), // image
			0, // source x
			0, // source y
			map.tsize, // source width
			map.tsize, // source height
			posXBuildDroite - Game.camera.x,  // target x
			posYBuildDroite - Game.camera.y, // target y
			map.tsize, // target width
			map.tsize // target height
		);
		Game.ctx.drawImage(
			Loader.getImage(PlaceBatiment['haut'].img), // image
			0, // source x
			0, // source y
			map.tsize, // source width
			map.tsize, // source height
			posXBuildHaut - Game.camera.x,  // target x
			posYBuildHaut - Game.camera.y, // target y
			map.tsize, // target width
			map.tsize // target height
		);
		Game.ctx.drawImage(
			Loader.getImage(PlaceBatiment['bas'].img), // image
			0, // source x
			0, // source y
			map.tsize, // source width
			map.tsize, // source height
			posXBuildBas - Game.camera.x,  // target x
			posYBuildBas - Game.camera.y, // target y
			map.tsize, // target width
			map.tsize // target height
		);
		
		
	}
	
	this.creuse = function (x, y, map)	//quand on clique sur le bouton action
	{

		Object.keys(this.supply).forEach(function(key) {
			Game.hero[key] = Game.hero.supply[key];		
		})
		
        var equip 	= Game._getToolEquipe();
        var pos     = map.getRow(y)*map.rows+map.getCol(x);
		
		if(equip != ''){
			objets[equip].life = objets[equip].life - 1;
			if(objets[equip].life == 0 ){
				objets[equip].possession = 0;
				return false;
			}
		}
		
		if(abs2[pos] == 144){//mange pomme
			abs2[pos] = 145;
			absobs2[pos] = 145;
			this.life = this.life + 10;
			if(this.life > 60)
				this.life = 60;
		}
		// console.log(pos, abs1[pos], abs2[pos]);
		
		
		var vertical = map.getCol(x);
		var horizontal = map.getRow(y);


		//tiles
		if( equip == 'route_sable' && builds[vertical+'-'+horizontal] == null){

			Game.hero.supply = Game._getSupply();
			if(this.supply.epice >= 25 && this.supply.credit >= 25 && abs1[pos] == 186 && (abs2[pos] == 0 || abs2[pos] ==186) ){
				this.supply.epice = Game.hero.epice - 25;
				this.supply.credit = Game.hero.credit - 25;
				payeAjax(25, 0, 0, 25, 0);

				anim = new animation(map, x, y, ['epice', 'credit'], 'minus');
				abs2[pos] = 174;
				absobs2[pos] = 174;
			}else if(abs1[pos] == 186 && (abs2[pos] == 0 || abs2[pos] ==186)){
				if(this.supply.epice < 25)
					var img='no_epice';
				else if(this.supply.credit < 25)
					var img='no_credit';

				anim = new animation(map, Game.hero.x, Game.hero.y, img);
			}
		}

		if( equip == 'depierre' && builds[vertical+'-'+horizontal] == null){

			Game.hero.supply = Game._getSupply();
			if(this.supply.epice >= 25 && this.supply.credit >= 25 && abs2[pos] == 155 ){
				this.supply.epice = Game.hero.epice - 25;
				this.supply.credit = Game.hero.credit - 25;
				payeAjax(25, 0, 0, 25, 0);

				anim = new animation(map, x, y, ['epice', 'credit'], 'minus');
				abs2[pos] = 174;
				absobs2[pos] = 174;
			}else if(abs2[pos] == 155){
				if(this.supply.epice < 25)
					var img='no_epice';
				else if(this.supply.credit < 25)
					var img='no_credit';

				anim = new animation(map, Game.hero.x, Game.hero.y, img);
			}
		}

		if( equip == 'deracine' && builds[vertical+'-'+horizontal] == null){

			Game.hero.supply = Game._getSupply();
			if( abs2[pos] == 8 ){

				anim = new animation(map, x-10, y-30, 'cloud');
				abs2[pos] = 0;
				absobs2[pos] = 0;
			}
		}

		//tiles
		if( equip == 'route_dune' && builds[vertical+'-'+horizontal] == null){
			Game.hero.supply = Game._getSupply();
			if(this.supply.epice >= 25 && this.supply.credit >= 25 && abs1[pos] == 186 && abs2[pos] == 185){
				this.supply.epice = Game.hero.epice - 25;
				this.supply.credit = Game.hero.credit - 25;
				payeAjax(25, 25, 0, 25, 0);
				anim = new animation(map, x, y, ['epice', 'credit'], 'minus');
				abs2[pos] = 174;
				absobs2[pos] = 174;
			}else if(abs1[pos] == 186 && abs2[pos] == 185){
				if(this.supply.epice < 25)
					var img='no_epice';
				else if(this.supply.credit < 25)
					var img='no_credit';
				anim = new animation(map, Game.hero.x, Game.hero.y, img);
			}
		}
		else if (abs2[pos] == 0 && abs1[pos] ==1 && equip == 'pelle') {
			abs1[pos] = 2;
			abs2[pos] = 0;
			absobs1[pos] = 2;
			absobs2[pos] = 0;
			this.supply.ecu = Game.hero.ecu + 10;
		}
		else if (abs2[pos] == 57 && abs1[pos] != 2 && equip == 'pelle') {
			abs2[pos] = 58;
			absobs2[pos] = 58;
			this.supply.argile = Game.hero.argile + 10;
		} else if (abs2[pos] == 58  && equip == 'pelle'){
			this.supply.argile = Game.hero.argile + 1;
        }else if (map.tileRock.includes(abs2[pos]) && abs1[pos] != 2 && equip == 'pioche') {
			if(abs2[pos] == 59){
				abs2[pos] = 60;
				absobs2[pos] = 60;
			}else{
				abs2[pos] = 0;
				absobs2[pos] = 0;
			}
			this.supply.pierre = Game.hero.pierre + 10;
		} 
		else if ( map.tileWood.includes(abs2[pos])  && equip == 'faux') {
            abs1[pos] = 2;
            abs2[pos] = 0;
            absobs1[pos] = 2;
            absobs2[pos] = 0;
		}



		//actions buildings si ?quip? d'un outils
		if(typeof(builds[vertical+'-'+horizontal]) != "undefined" && builds[vertical+'-'+horizontal] !== null && menuclick== 0){
			if((typeof(builds[vertical+'-'+horizontal].caracteristique['outilRecompense']) === "undefined" ||
				builds[vertical+'-'+horizontal].caracteristique['outilRecompense'] == equip) &&
				abs2[pos] == builds[vertical+'-'+horizontal].batiment[3]){

				var recompense = builds[vertical+'-'+horizontal].caracteristique['recompense'];
				Object.keys(recompense).forEach(function(keyRecompense) {
					// Game.hero.supply[keyRecompense]+= recompense[keyRecompense] * builds[vertical+'-'+horizontal].level;
					Game.hero.supply[keyRecompense]+= recompense[keyRecompense];
				})

				if(	builds[vertical+'-'+horizontal].caracteristique['loseLife'] == 1)
					builds[vertical+'-'+horizontal].life = builds[vertical+'-'+horizontal].life-1;
				if(builds[vertical+'-'+horizontal].life==0){
					delete builds[vertical+'-'+horizontal];
					abs1[pos] = 2;
					abs2[pos] = 0;
				}else{
					abs2[pos]	=	builds[vertical+'-'+horizontal].batiment[0];
					builds[vertical+'-'+horizontal].day = day;
					builds[vertical+'-'+horizontal].hour = hour;
					builds[vertical+'-'+horizontal].paysan_fois = 3;
				}
			}else{
				batimentclick = 1;
				return false;
			}

		}


		//animation quand on gagne une ressource-- on ne peut plus le faire car majHeure
		var animRessources = [];
		Object.keys(this.supply).forEach(function(key) {
			//if(Game.hero.supply[key] > Game.hero[key])
			//	anim = new animation(map, x, y, key, 'plus');
			if(Game.hero.supply[key] < Game.hero[key]){
				animRessources.push(key);				
			}
		})
		//if(animRessources.length > 0)
		//	anim = new animation(map, x, y, animRessources, 'minus');
		
		if(this.attaqueEnCours  == 60 && Game._getToolEquipe() == 'epee')
			directionAttaque = 'bas';
		//attaque d'un ennemi 
		if(Game._getToolEquipe() == 'epee' && this.attaqueEnCours == 60){
			if(monsters[(1+vertical)+'-'+horizontal]){	//droite du heros
				var attaque = this.attaque - monsters[(1+vertical)+'-'+horizontal].defense;
				monsters[(1+vertical)+'-'+horizontal].life-= attaque; 
				directionAttaque = 'droite';
			}
			if(monsters[(vertical-1)+'-'+horizontal]){	//gauche du heros
				var attaque = this.attaque - monsters[(vertical-1)+'-'+horizontal].defense;
				monsters[(vertical-1)+'-'+horizontal].life-= attaque; 
				directionAttaque = 'gauche';
			}
			if(monsters[vertical+'-'+(horizontal+1)]){	//bas du heros
				var attaque = this.attaque - monsters[vertical+'-'+(horizontal+1)].defense;
				monsters[vertical+'-'+(horizontal+1)].life-= attaque; 
				directionAttaque = 'bas';
			}
			if(monsters[vertical+'-'+(horizontal-1)]){	//haut du heros
				var attaque = this.attaque - monsters[vertical+'-'+(horizontal-1)].defense;
				monsters[vertical+'-'+(horizontal-1)].life-= attaque; 
				directionAttaque = 'haut';
			}
			
			this.attaqueEnCours = 0;
		}
		
	}
	
}
Hero.SPEED = 150; // pixels per second
 
Hero.prototype.move = function (delta, dirx, diry, positionX, positionY, dirx2, diry2) {

    // move hero
	// console.log(positionX, positionY, diry);
	if(menussclick == 0 && batimentclick == 0 && menuBodyClick == 0 && dialogue == 0){
		if(positionX > 0 && positionY > 0){
			
			if(dirx == 1){//vers la droite
				if(this.x > positionX)
					this.x = positionX;
				else
					this.x += dirx * Hero.SPEED * delta;
			}
			if(dirx == -1){//vers la gauche
				if(this.x < positionX)
					this.x = positionX;
				else
					this.x += dirx * Hero.SPEED * delta;
			}
			if(dirx == 0){
				this.x = positionX;
			}
			if(diry == 1){//descend
				if(this.y > positionY)
					this.y = positionY;
				else
					this.y += diry * Hero.SPEED * delta;
			}
			if(diry == -1){//monte
				if(this.y < positionY)
					this.y = positionY;
				else
					this.y += diry * Hero.SPEED * delta;
			}
			if(diry == 0)
				this.y = positionY;
		}else{
			this.x += dirx * Hero.SPEED * delta;
			this.y += diry * Hero.SPEED * delta;
		}
	}    
	
	
	
	
	// if(dirx == 1|| diry == 1 || dirx == -1|| diry == -1)//si mouvement
   
   //SI ON VEUT UNE IMAGE SPECIALE SI LE HEROS MARCHE
   // if(Game.anim>=DUREE_ANIMATION/2){
		// this.image = Loader.getImage('hero2');
   // }
	// else{
		// this.image = Loader.getImage('hero');
	// }
	// console.log(this.y, positionY);
 
    // check if we walked into a non-walkable tile
    this._collide(dirx, diry);
    this._ennemy(dirx, diry);
    // check if he loses life
    this._loselifeTile(dirx, diry);
	
	
	if(Object.keys(this.artefactEnCours).length){	//SI ARTEFACT EN COURS DOIT SE TERMINER
		Object.keys(this.artefactEnCours).forEach(function(key) {
			if(Game.hero.artefactEnCours[key].heure == hour && Game.hero.artefactEnCours[key].jour == day){
				
				Game.hero.attaque-=		 Game.hero.artefactEnCours[key].artefact.attaque;
				Game.hero.defense-=		 Game.hero.artefactEnCours[key].artefact.defense;
				Game.hero.agilite-=		 Game.hero.artefactEnCours[key].artefact.agilite;
				Game.hero.exploration-=  Game.hero.artefactEnCours[key].artefact.exploration;
				
				delete(Game.hero.artefactEnCours[key]);
			}
		})
	}
	
	
    // clamp values
    var maxX = this.map.cols * this.map.tsize;
    var maxY = this.map.rows * this.map.tsize;
    this.x = Math.max(0, Math.min(this.x, maxX));
    this.y = Math.max(0, Math.min(this.y, maxY));
	
	var rowX = this.map.getRow(this.x);
	var colY = this.map.getCol(this.y);
	
	//EXPLORATION QUI PRENDS EN COMPTE LE POUVOIR D'EXPLORATION DU HEROS
	
	absobs1[colY*map.rows+rowX] = abs1[colY*map.rows+rowX];
	absobs2[colY*map.rows+rowX] = abs2[colY*map.rows+rowX];
	
	for(var i=1; i<=this.exploration; i++){
		
		absobs1[colY*map.rows+rowX+i] = abs1[colY*map.rows+rowX+i];
		absobs2[colY*map.rows+rowX+i] = abs2[colY*map.rows+rowX+i];
		
		absobs1[colY*map.rows+rowX-i] = abs1[colY*map.rows+rowX-i];
		absobs2[colY*map.rows+rowX-i] = abs2[colY*map.rows+rowX-i];
		
		absobs1[colY*map.rows+rowX+map.rows * i] = abs1[colY*map.rows+rowX+map.rows * i];
		absobs2[colY*map.rows+rowX+map.rows * i] = abs2[colY*map.rows+rowX+map.rows * i];
		
		for(var o=1; o<=this.exploration; o++){
			absobs1[colY*map.rows+rowX+map.rows * i+o] = abs1[colY*map.rows+rowX+map.rows * i+o];
			absobs2[colY*map.rows+rowX+map.rows * i+o] = abs2[colY*map.rows+rowX+map.rows * i+o];
			absobs1[colY*map.rows+rowX+map.rows * i-o] = abs1[colY*map.rows+rowX+map.rows * i-o];
			absobs2[colY*map.rows+rowX+map.rows * i-o] = abs2[colY*map.rows+rowX+map.rows * i-o];
		}
		
		absobs1[colY*map.rows+rowX-map.rows * i] = abs1[colY*map.rows+rowX-map.rows * i]; 
		absobs2[colY*map.rows+rowX-map.rows * i] = abs2[colY*map.rows+rowX-map.rows * i];
		
		for(var a=1; a<=this.exploration; a++){
			absobs1[colY*map.rows+rowX-map.rows * i-a] = abs1[colY*map.rows+rowX-map.rows * i-a]; 
			absobs2[colY*map.rows+rowX-map.rows * i-a] = abs2[colY*map.rows+rowX-map.rows * i-a];
			absobs1[colY*map.rows+rowX-map.rows * i+a] = abs1[colY*map.rows+rowX-map.rows * i+a]; 
			absobs2[colY*map.rows+rowX-map.rows * i+a] = abs2[colY*map.rows+rowX-map.rows * i+a];
		}
	}
	
	//FIN EXPLORATION
	
	//SE FAIRE ATTAQUER PAR UN ENNEMI QUI NE BOUGE PAS
	var ennemiStable = 0;
	var attaqueEnnemi = 0;
	if(monsters[(1+rowX)+'-'+colY] && monsters[(1+rowX)+'-'+colY].vitesse == 0){
				var attaque = monsters[(1+rowX)+'-'+colY].attaque - Game.hero.defense;
				attaqueEnnemi = monsters[(1+rowX)+'-'+colY].attaque;
				ennemiStable = 1;
			}
			if(monsters[(rowX-1)+'-'+colY] && monsters[(rowX-1)+'-'+colY].vitesse == 0){
				var attaque = monsters[(rowX-1)+'-'+colY].attaque - Game.hero.defense;
				attaqueEnnemi = monsters[(rowX-1)+'-'+colY].attaque;
				ennemiStable = 1;
			}
			if(monsters[rowX+'-'+(colY+1)] && monsters[rowX+'-'+(colY+1)].vitesse == 0){
				var attaque = monsters[rowX+'-'+(colY+1)].attaque - Game.hero.defense;
				attaqueEnnemi = monsters[rowX+'-'+(colY+1)].attaque;
				ennemiStable = 1;
			}
			if(monsters[rowX+'-'+(colY-1)] && monsters[rowX+'-'+(colY-1)].vitesse == 0){
				var attaque = monsters[rowX+'-'+(colY-1)].attaque - Game.hero.defense;
				attaqueEnnemi = monsters[rowX+'-'+(colY-1)].attaque;
				ennemiStable = 1;
			}
			
			if(ennemiStable == 1 && attaqueEnnemi > 0){//pour ne pas cibler les amis
				if (attaque <= 0)attaque = 0.4;
				
				if(dialogue != 1 && batimentclick !=1 && menuBodyClick != 1)
					Game.hero.life = Game.hero.life - attaque*0.05;//liaison avec monstre.js commentaire : //monstre attaque le h?ros
			}


	
	//RECUPERER UN ARTEFACT
	if(artefacts[rowX+'-'+colY]){
		if(artefacts[rowX+'-'+colY].inventaire == 1)
			this.artefact.push(artefacts[rowX+'-'+colY].name);
		else{
			this.attaque+= artefacts[rowX+'-'+colY].attaque;
			this.defense+= artefacts[rowX+'-'+colY].defense;
			this.exploration+= artefacts[rowX+'-'+colY].exploration;
			this.agilite+= artefacts[rowX+'-'+colY].agilite;
			this.xp+= artefacts[rowX+'-'+colY].xp;

			if(typeof(artefacts[rowX+'-'+colY].outils) != 'undefined')
				Game.hero.equipement[artefacts[rowX+'-'+colY].outils].possession = 1;//recup?rer un outils
			
			for (var key in artefacts[rowX+'-'+colY].supply) {
				Game.hero.supply[key]+= artefacts[rowX+'-'+colY].supply[key];
			}
		}
		
		// console.log(Game.hero.artefact);
		anim = new animation(map, artefacts[rowX+'-'+colY].x, artefacts[rowX+'-'+colY].y, artefacts[rowX+'-'+colY].image, '', artefacts[rowX+'-'+colY].text_prendre);
		delete artefacts[rowX+'-'+colY];
		
	}
	
	
	if(builds[rowX+'-'+colY]){	//si sur un batiment dont le statut est le dernier (par exemple, le bl? a pouss?) et qui n?cessite de porter un outil dont le h?ros n'est pas ?quip?
		var equip 	= Game._getToolEquipe();
		if(
		builds[rowX+'-'+colY].caracteristique['outilRecompense'] != null && 
		equip != builds[rowX+'-'+colY].caracteristique['outilRecompense'] &&
		abs2[colY*map.rows+rowX] == builds[rowX+'-'+colY].batiment[3]
		)
			animBack = new animBackground(this.map, builds[rowX+'-'+colY].x, builds[rowX+'-'+colY].y, builds[rowX+'-'+colY].caracteristique['outilRecompense']+'_bulle');
		else
			animBack	= null;
	}else
		animBack	= null;
	
	//regenerer la barre d'agilite
	if(this.attaqueEnCours < 60)
		this.attaqueEnCours+= this.agilite * 0.05;
		
};
 
Hero.prototype._loselifeTile = function (dirx, diry) {
    var row, col;
    // -1 in right and bottom is because image ranges from 0.63
    // and not up to 64
    var left = this.x - this.width / 2;
    var right = this.x + this.width / 2 - 1;
    var top = this.y - this.height / 2;
    var bottom = this.y + this.height / 2 - 1;
               
	// console.log(left, right, top, bottom);
	
                var collision =
        this.map.isLoseWinLife(left, top) ||
        this.map.isLoseWinLife(right, top) ||
        this.map.isLoseWinLife(right, bottom) ||
        this.map.isLoseWinLife(left, bottom);
                              
                // var tileActuelle = this.map.isLoseLife(this.x, this.y);
				if(collision=='life')
					if(this.life<60)
						this.life=this.life+0.1;
                if(collision==true){
				  // if(this.life>0)
					//	this.life=this.life-0.1;
                }
	var change = this.map.isChangeLevel(this.x, this.y);		
	
	if(change == 'next'){	// on a pass? de niveau
		if(niveauMapSelect == 0){
			builds		= [];
			monsters 	= [];
			artefacts 	= [];
			path		= [];
			niveauMap ++;
			this.map.mapNext(0);
		}
		niveauMapSelect =1;
	}else if(change == 'room'){	//on rentre dans une maison : il faut conserver toutes les donn?es de la carte
		if(niveauMapSelect == 0){
			if(layer1Tmp.length == 0){
				buildsTmp				= builds;
				layer1Tmp 				= abs1;
				layer2Tmp 				= abs2;
				layer1ExplTmp 			= absobs1;
				layer2ExplTmp 			= absobs2;
				artefactsTmp 			= artefacts;
				monstersTmp 			= monsters;
				xyHeroTmp['x']			= Game.hero.x;
				xyHeroTmp['y']			= Game.hero.y;
				builds			= [];
				monsters 		= [];
				artefacts 		= [];
				path		 	= [];
				this.map.mapNext(niveauMap);
			}else{
				builds 		= buildsTmp;
				abs1		= layer1Tmp;
				abs2 		= layer2Tmp;
				absobs1 	= layer1ExplTmp;
				absobs2 	= layer2ExplTmp;
				artefacts	= artefactsTmp;
				monsters 	= monstersTmp;
				map.layers  = [absobs1, absobs2];
				Game.hero.x		= xyHeroTmp['x'];
				Game.hero.y		= xyHeroTmp['y'];
				path		 	= [];
				
				layer1Tmp 	= [];
			}
		}
		niveauMapSelect =1;
	}else
		niveauMapSelect = 0;
                                              
};
 
Hero.prototype._upgradeBuild = function (build) {	// pour augmenter de 1 le niveau d'un batiment

	// paye le prix : je ne fais pas de v?rification car le bouton upgrade n'apparait que si c'est possible
	if(build.level < 3){
		Object.keys(build.caracteristique.updateNiveau).forEach(function(key) { 
			Game.hero.supply[key] =  Game.hero.supply[key] - build.caracteristique.updateNiveau[key];
		})
		payeAjax(build.caracteristique.updateNiveau.epice,
			build.caracteristique.updateNiveau.renommee,
			build.caracteristique.updateNiveau.eau,
			build.caracteristique.updateNiveau.credit,
			build.caracteristique.updateNiveau.troupe
			);
		build.level = build.level + 1;
	}
};
 

 
Hero.prototype._collide = function (dirx, diry) {
    var row, col;
    // -1 in right and bottom is because image ranges from 0..63
    // and not up to 64
    var left = this.x - this.width / 2;
    var right = this.x + this.width / 2 - 1;
    var top = this.y - this.height / 2;
    var bottom = this.y + this.height / 2 - 1;
               
 
    // check for collisions on sprite sides
    // var collision = false;
    var collision =
        this.map.isSolidTileAtXY(left, top) ||
        this.map.isSolidTileAtXY(right, top) ||
        this.map.isSolidTileAtXY(right, bottom) ||
        this.map.isSolidTileAtXY(left, bottom);
    if (!collision) { return; }
	// path		 = [];
    if (diry > 0) {
        row = this.map.getRow(bottom);
        this.y = -this.height / 2 + this.map.getY(row);
    }
    else if (diry < 0) {
        row = this.map.getRow(top);
        this.y = this.height / 2 + this.map.getY(row + 1);
    }
    else if (dirx > 0) {
        col = this.map.getCol(right);
        this.x = -this.width / 2 + this.map.getX(col);
    }
    else if (dirx < 0) {
        col = this.map.getCol(left);
        this.x = this.width / 2 + this.map.getX(col + 1);
    }
               
	
               
               
}; 

 
Hero.prototype._ennemy = function (dirx, diry) {
    var row, col;
    // -1 in right and bottom is because image ranges from 0..63
    // and not up to 64
    var left = this.x - this.width / 2;
    var right = this.x + this.width / 2 - 1;
    var top = this.y - this.height / 2;
    var bottom = this.y + this.height / 2 - 1;
               
 
    // check for collisions on sprite sides
    var collision =
        this.map.isEnnemyTileAtXY(left, top) ||
        this.map.isEnnemyTileAtXY(right, top) ||
        this.map.isEnnemyTileAtXY(right, bottom) ||
        this.map.isEnnemyTileAtXY(left, bottom);
    if (!collision) {
		
		Object.keys(monsters).forEach(function(key) {
			if(monsters[key].life<60)
				monsters[key].life = monsters[key].life+monsters[key].regeneration;
			if(monsters[key].life > 60)
				monsters[key].life = 60;
		})
		return;
	}
    if (diry > 0) {
        row = this.map.getRow(bottom);
        this.y = -this.height / 2 + this.map.getY(row);
    }
    else if (diry < 0) {
        row = this.map.getRow(top);
        this.y = this.height / 2 + this.map.getY(row + 1);
    }
    else if (dirx > 0) {
        col = this.map.getCol(right);
        this.x = -this.width / 2 + this.map.getX(col);
    }
    else if (dirx < 0) {
        col = this.map.getCol(left);
        this.x = this.width / 2 + this.map.getX(col + 1);
    }

	//ATTAQUER UN ENNEMI : A REVOIR POUR PLUS TARD : ENNEMI NE PERD DES POINTS DE VIE QUE QUAND ON ATTAQUE 
    // if(this.life >0){
		 
		// var lifeHero = collision.attaque-this.defense;
		// if(lifeHero < 0) lifeHero =0.1;
		// var lifeMonster = this.attaque-collision.defense;
		// if(lifeMonster < 0) lifeMonster =0.1;
		
		// this.life = this.life-(lifeHero);
		
		// var equip = Game._getToolEquipe();
		// if(collision.life >0 && equip=='epee'){
			// collision.life = collision.life-(lifeMonster);
		// }
			
    // }         
};


function renderHero(){
	// console.log(dirx, diry);//y = -1 == haut y = 1 == bas 	x = 1 == droit x = -1 == gauche
	
	var x1  = 14;
	var y1  = 9;
	var x2 = 62;
	var y2 = 8;
	var x3 = 110;
	var y3 = 9;
	var x4 = 158;
	var y4 = 8;
	xForm1 = 20;
	yForm1  = 30;
	xForm2 = 20;
	yForm2  = 30;
	xForm3 = 20;
	yForm3  = 30;
	xForm4 = 20;
	yForm4 = 30;
	
	if(dirx == -1){
		x1 = 16;
		y1 = 102;
		x2 = 64;
		y2 = 102;
		x3 = 112;
		y3 = 102;
		x4 = 160;
		y4 = 102;
		xForm1 = 18;
		yForm1  = 31;
		xForm2 = 18;
		yForm2  = 32;
		xForm3 = 18;
		yForm3  = 31;
		xForm4 = 18;
		yForm4  = 32;
	}else if(dirx == 1){
		x1 = 14;
		y1 = 150;
		x2 = 62;
		y2 = 150;
		x3 = 110;
		y3 = 150;
		x4 = 158;
		y4 = 150;
		xForm1 = 18;
		yForm1  = 31;
		xForm2 = 18;
		yForm2  = 32;
		xForm3 = 18;
		yForm3  = 31;
		xForm4 = 18;
		yForm4  = 32;
	}
	if(diry == -1){
		x1 = 14;
		y1 = 57;
		x2 = 62;
		y2 = 56;
		x3 = 110;
		y3 = 57;
		x4 = 158;
		y4 = 56;
		xForm1 = 20;
		yForm1  = 30;
		xForm2 = 20;
		yForm2  = 30;
		xForm3 = 20;
		yForm3  = 30;
		xForm4 = 20;
		yForm4 = 30;
	}
	
	//directionAttaque
	if(directionAttaque == 'droite'){
		x1 = 206;
		y1 = 150;
		x2 = 254;
		y2 = 150;
		x3 = 303;
		y3 = 150;
		x4 = 350;
		y4 = 145;
		xForm1 = 23;
		yForm1  = 37;
		xForm2 = 34;
		yForm2  = 32;
		xForm3 = 28;
		yForm3  = 32;
		xForm4 = 28;
		yForm4  = 37;
	}
	if(directionAttaque == 'gauche'){
		x1 = 203;
		y1 = 102;
		x2 = 240;
		y2 = 102;
		x3 = 293;
		y3 = 102;
		x4 = 346;
		y4 = 97;
		xForm1 = 23;
		yForm1  = 37;
		xForm2 = 34;
		yForm2  = 32;
		xForm3 = 28;
		yForm3  = 32;
		xForm4 = 24;
		yForm4  = 37;
	}
	
	if(directionAttaque == 'bas'){
		x1 = 205;
		y1 = 5;
		x2 = 253;
		y2 = 5;
		x3 = 288;
		y3 = 5;
		x4 = 337;
		y4 = 0;
		xForm1 = 31;
		yForm1  = 34;
		xForm2 = 26;
		yForm2  = 42;
		xForm3 = 35;
		yForm3  = 43;
		xForm4 = 34;
		yForm4  = 40;
	}
	
	if(directionAttaque == 'haut'){
		x1 = 196;
		y1 = 56;
		x2 = 249;
		y2 = 49;
		x3 = 303;
		y3 = 48;
		x4 = 350;
		y4 = 56;
		xForm1 = 31;
		yForm1  = 30;
		xForm2 = 25;
		yForm2  = 37;
		xForm3 = 26;
		yForm3  = 38;
		xForm4 = 28;
		yForm4  = 36;
	}
	
	
	Game.hero.clignote = 0;
	if(Game.hero.life < lifeHero){
		lifeHero = Game.hero.life;
		if(clignote == 1)
			clignote = 0;
		else
			clignote = 1;
					
	}else
		clignote = 0;
	
	if(clignote == 0){
		
		if(Game.animSprite <= DUREE_ANIMATION / 4 ){
			Game.ctx.drawImage(
				Game.hero.image,
				x1,
				y1,
				xForm1,
				yForm1,
				Game.hero.screenX - Game.hero.width / 4,
				Game.hero.screenY - Game.hero.height / 4,
				xForm1,
				yForm1
			);
		}
		
		if(Game.animSprite > DUREE_ANIMATION / 4 && Game.animSprite <= DUREE_ANIMATION / 3 ){
			Game.ctx.drawImage(
				Game.hero.image,
				x2,
				y2,
				xForm2,
				yForm2,
				Game.hero.screenX - Game.hero.width / 4,
				Game.hero.screenY - Game.hero.height / 4,
				xForm2,
				yForm2
			);
		}
		
		if(Game.animSprite > DUREE_ANIMATION / 3 && Game.animSprite <= DUREE_ANIMATION/2 ){
			Game.ctx.drawImage(
				Game.hero.image,
				x3,
				y3,
				xForm3,
				yForm3,
				Game.hero.screenX - Game.hero.width / 4,
				Game.hero.screenY - Game.hero.height / 4,
				xForm3,
				yForm3
			);
		}
		
		if(Game.animSprite > DUREE_ANIMATION / 2 && Game.animSprite <= DUREE_ANIMATION ){
			Game.ctx.drawImage(
				Game.hero.image,
				x4,
				y4,
				xForm4,
				yForm4,
				Game.hero.screenX - Game.hero.width / 4,
				Game.hero.screenY - Game.hero.height / 4,
				xForm4,
				yForm4
			);
		}
	}
	

	
	
	
	
	
	// Game.ctx.drawImage(
        // Game.hero.image,
        // Game.hero.screenX - Game.hero.width / 4,
        // Game.hero.screenY - Game.hero.height / 2
    // );
}