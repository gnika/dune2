function Building(map, x, y, row, col, life, name, batiment, caracteristique, typeTile, solid, titre, level=1, etat= 1) {
    this.map = map;
    this.life = life;
    this.name = name;
    this.titre = titre;
     this.x = x;
     this.y = y;
    this.level = level;
    this.hour = hour;//heure de construction
    this.day = day;//jour de construction
    this.batiment = batiment;
    this.caracteristique=caracteristique;
    //si batiment envoit des projectiles
    this.xDelta=0;
    this.yDelta=0;
    this.row=row;
    this.col=col;
    this.cible=0;
    this.cibleMouvante=0;
    this.typeTile=typeTile;
    this.solid=solid;
    this.road = '';//ne change jamais au mouvement du paysan.
    this.roady = '';//change au cours du mouvement du paysan.
    this.paysan_position = 0;
    this.posPaysanInitial = 0;
    this.paysan_retour = 0;
    this.paysan_fois = 3;
    this.paysan_vitesse = 30;//30
    this.paysan_manque = '';
    this.etat = etat;
    this.animationBuild = 0;
	
    
    this.calculPortee = function(x, y, portee, rowMonstre, colMonstre)
    { 
    
        xLimiteMoins = x - portee;
        xLimitePlus = x + portee;
        
        yLimiteMoins = y - portee;
        yLimitePlus = y + portee;
        
        if(xLimiteMoins<0)
            xLimiteMoins = 0;
        if(yLimiteMoins<0)
            yLimiteMoins = 0;
        
        var porteeX = [x];
        var porteeY = [y];
        
        for(var i=1;i<=portee;i++){
            porteeX.push(x-i); 
            porteeX.push(x+i); 
            porteeY.push(y-i); 
            porteeY.push(y+i); 
        }
        
        if(porteeX.includes(rowMonstre) && porteeY.includes(colMonstre))
            return true;
        else 
            return false;
        
    }
 } 
 
 function setBuilding()
 {
	 
	 
		var supplyBuild 		= [];
		var caracteristique 	= [];
		var paramBuild 			= [];
		
		caracteristique['showLife'] = 1;
		caracteristique['maintenance'] = {'credit': 125};

        caracteristique['recompense'] = {'eau': 2};
		caracteristique['prixUpdate'] = {'credit': 10};

        caracteristique['updateNiveau'] = {'credit': 150, 'epice': 1000, 'eau': 0};
		supplyBuild['credit'] = 100;
		paramBuild['typeBatiment'] = [44, 45, 46, 47];
		paramBuild['typeTile'] = [186, 183];
		paramBuild['life'] = 60;
		paramBuild['titre'] = 'Piège à vent';//doit correspondre avec le titre en table "batiment" de BDD
        paramBuild['name'] = 'hydraulique';
		paramBuild['solid'] = 0;
		
		menussclickTitre = 'Piège à eau';
		description_fr = "Génère de l'eau";
		description_en = 'EN supply water';

		allBuilding['hydraulique']  = {
		 'caracteristique'	: caracteristique,
		 'supplyBuild' 		: supplyBuild,
		 'paramBuild' 		: paramBuild,
		 'menussclickTitre' : menussclickTitre,
		 'description_fr'	: description_fr,
		 'description_en'	: description_en
		};

     var supplyBuild 		= [];		//boucherie
     var caracteristique 	= [];
     var paramBuild 			= [];

     caracteristique['showLife'] = 1;

     caracteristique['recompense'] = {'troupe': 50};
     caracteristique['prixUpdate'] = {'eau': 10};

     caracteristique['maintenance'] = {'credit': 25};
     caracteristique['updateNiveau'] = {'credit': 200, 'epice': 1000, 'eau': 0};
     supplyBuild['credit'] = 150;
     paramBuild['typeBatiment'] = [63, 64, 65, 66];
     paramBuild['typeTile'] = [186, 170];
     paramBuild['life'] = 60;
     paramBuild['titre'] = 'Caserne';//doit correspondre avec le titre en table "batiment" de BDD
     paramBuild['name'] = 'caserne';
     paramBuild['solid'] = 0;

     menussclickTitre = 'Caserne';
     description_fr = 'Génère des truitesses';
     description_en = 'EN génère des truitesses';

     allBuilding['caserne']  = {
         'caracteristique'	: caracteristique,
         'supplyBuild' 		: supplyBuild,
         'paramBuild' 		: paramBuild,
         'menussclickTitre' : menussclickTitre,
         'description_fr'	: description_fr,
         'description_en'	: description_en
     };

     var supplyBuild 		= [];		//ecole
     var caracteristique 	= [];
     var paramBuild 			= [];

     caracteristique['showLife'] = 1;

     caracteristique['recompense'] = {'renommee': 10};
     caracteristique['prixUpdate'] = {'eau': 25};

     caracteristique['maintenance'] = {'credit': 50};
     caracteristique['updateNiveau'] = {'credit': 250, 'epice': 1000, 'eau': 0};
     supplyBuild['credit'] = 200;
     paramBuild['typeBatiment'] = [28, 29, 30, 31];//image du batiment
     paramBuild['typeTile'] = [186, 172];
     paramBuild['life'] = 60;
     paramBuild['titre'] = 'Ecole';//doit correspondre avec le titre en table "batiment" de BDD
     paramBuild['name'] = 'ecole';
     paramBuild['solid'] = 0;

     menussclickTitre = 'Ecole';
     description_fr = 'Génère de la renommée';
     description_en = 'EN génère de la renommée';

     allBuilding['ecole']  = {
         'caracteristique'	: caracteristique,
         'supplyBuild' 		: supplyBuild,
         'paramBuild' 		: paramBuild,
         'menussclickTitre' : menussclickTitre,
         'description_fr'	: description_fr,
         'description_en'	: description_en
     };
	 
	 
	 
	 
 }