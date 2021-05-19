<?php

namespace App\Repository;

use App\Entity\Gardien;
use App\Entity\HumeurFaction;
use App\Entity\Influence;
use App\Entity\PorteUser;
use App\Entity\SallePerso;
use App\Entity\Serviteur;
use App\Entity\SuggestionEpice;
use App\Entity\User;
use App\Utils\Messages;
use App\Entity\UserQuete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, User::class);
        $this->security = $security;
    }

    public function addDay(){
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();

        $conn->executeQuery('
                        update user set cuu_impot = cuu_impot + 1 where id = '.$idUser
        );

    }


    public function setEpices($spice, $display=null)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();

        if($spice=='-half')$spice=-(round($us->getEpice()/2));
        if($spice=='half')$spice=(round($us->getEpice()/2));
        $us->setEpice($us->getEpice()+$spice);

        $this->getEntityManager()->persist($us);
        $this->getEntityManager()->flush();

        if($spice>=0)$word='plus';else $word='moins';
        if(!$display)
            echo "<script>recompenseDisplay('<span class=\"recompense  $word  epice \" > $spice </span>');</script>";
        echo "<script>afficheSpice();</script>";
    }


    public function setRenommees($spice, $display=null)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();

        $us->setRenommee($us->getRenommee()+$spice);

        $this->getEntityManager()->persist($us);
        $this->getEntityManager()->flush();

        if($spice>=0)$word='plus';else $word='moins';
        if(!$display)
            echo "<script>recompenseDisplay('<span class=\"recompense  $word  renommee \" > $spice </span>');</script>";
        echo "<script>afficheSpice();</script>";
    }


    public function setEaux($spice, $display=null)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();

        $us->setEau($us->getEau()+$spice);

        $this->getEntityManager()->persist($us);
        $this->getEntityManager()->flush();

        if($spice>=0)$word='plus';else $word='moins';
        if(!$display)
            echo "<script>recompenseDisplay('<span class=\"recompense  $word  eau \" > $spice </span>');</script>";
        echo "<script>afficheSpice();</script>";
    }

    public function setServiteurs($nb=1, $display=null, $house=null)
    {
        $us = $this->security->getUser();
        if($us->getServiteur()+$nb<0)$set=0;else $set=$us->getServiteur()+$nb;
        $us->setServiteur($set);
        $this->getEntityManager()->persist($us);
        $this->getEntityManager()->flush();
        if(!$display)
            echo "<script>recompenseDisplay('\'<span class=\"recompense plus serviteur\"> '.$nb.'</span>\'');</script>";
    }

    public function setValeurVaisseau($spice)
    {

        $us = $this->security->getUser();
        $us->setValeurVaisseau($spice);
        $this->getEntityManager()->persist($us);
        $this->getEntityManager()->flush();
    }

    public function setZeroCorruption()
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();
        $us->setCorruption(0);
        $this->getEntityManager()->persist($us);
        $this->getEntityManager()->flush();
    }

    function getSuggestionFaction($id_faction = null)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();

        if($id_faction){

            $sql = 'SELECT sug_nb_suggestion FROM suggestion_epice
            WHERE sug_id_faction='.$id_faction.' AND sug_id_user='.$idUser;
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAssociative();
            return $result['sug_nb_suggestion'];
        }else{
            $sql = 'SELECT * FROM suggestion_epice
            WHERE  sug_id_user='.$idUser;
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAllAssociative();
            $entries   = array();

            foreach ($results as $row) {
                $entries[$row['sug_id_faction']] = $row['sug_nb_suggestion'];
            }
            return $entries;
        }

    }

    function majCorruption($value)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();

        $stmt = $conn->prepare('update user set cuu_corruption = cuu_corruption +'.$value.' where id = '.$idUser);
        $stmt->execute();

    }

    function majImpot($value = 0)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();

        if($value!=0)
            $stmt = $conn->prepare('update user set cuu_impot = cuu_impot +'.$value.' where id = '.$idUser);
        else
            $stmt = $conn->prepare('update user set cuu_impot = 0 where id = '.$idUser);
        $stmt->execute();
    }

    function majEpice($value)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();
        if($us->getEpice()+$value < 0)
            return false;
        $stmt = $conn->prepare('update user set cuu_epice = cuu_epice +'.$value.' where id = '.$idUser);
        $stmt->execute();
    }

    function majEau($value)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();
        if($us->getEpice()+$value < 0)
            return false;
        $stmt = $conn->prepare('update user set cuu_eau = cuu_eau +'.$value.' where id = '.$idUser);
        $stmt->execute();
    }

    function majCredit($value)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();

        if($us->getCredit()+$value < 0) {
            $value = $us->getCredit();
            $value = - $value;
        }

        $stmt = $conn->prepare('update user set cuu_credit = cuu_credit +'.$value.' where id = '.$idUser);
        $stmt->execute();

    }



    public function majVaisseau($nbVaisseau)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();
        $stmt = $conn->prepare('update user set cuu_vaisseau = cuu_vaisseau +'.$nbVaisseau.' where id = '.$idUser);
        $stmt->execute();
    }

    function getAllInfluence()
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();

        $sql = 'SELECT * FROM influence
            WHERE  inf_id_user='.$idUser;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAllAssociative();
        $entries   = array();

        foreach ($results as $row) {
            $entries[$row['inf_id_faction']] = $row['inf_nb_influence'];
        }
        return $entries;
    }

    public function setInfluence($nb=1, $display=null, $house=null)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();
        if($us->getInfluence()+$nb<0)$set=0;else $set=$us->getInfluence()+$nb;
        $us->setInfluence($set);
        $this->getEntityManager()->persist($us);
        $this->getEntityManager()->flush();
        if(!$display)
            echo '<script>recompenseDisplay(\'<span class="recompense plus influence"> '.$nb.'</span>\');</script>';
    }

    function majHeure($cleHeure, $heure)
    {

        $us = $this->security->getUser();
        $epiceJour=0;
        $msg='';
        $def=0;
        $rebellion = '';

        if($us->getImpot() < 5){
            $conn = $this->getEntityManager()->getConnection();
            $carte = $this->getEntityManager()->getRepository('App:Carte');
            $batiment = $this->getEntityManager()->getRepository('App:Batiment');
            $quete = $this->getEntityManager()->getRepository('App:Quote');
            $mesTroupeEnCours=$carte->getAllEnvoiTroupe();

            foreach ($mesTroupeEnCours as $row) {
                $days=$row['cau_jour'];

                if($cleHeure==0){
                    $stmt = $conn->prepare('update carte_user set cau_jour = cau_jour +1 where cau_id = '.$row['cau_id']);
                    $stmt->execute();
                    $days=$row['cau_jour']+1;
                }

                if(($days >=1 && $row['ca_zoom']==0) || ($days>=2 && $row['ca_zoom'] > 0)){

                    $envoi=$row['cau_envoi'];

                    $stmt = $conn->prepare('
                        update carte_user set cau_troupe = cau_troupe +'.$envoi.',
                         cau_envoi = 0,
                          cau_jour= 0,
                           cau_heure= 0
                        where cau_id = '.$row['cau_id']
                    );
                    $stmt->execute();

                    Messages::setSuccessMessage('Nos '.$envoi.' troupes sont arrivés sur la planète '.$row['ca_nom']);
                    ?><script>planeteDisplay(<?php echo $row['ca_id'];?>, '<?php echo $row['ca_nom'];?>');</script><?php
                }
            }

            $mesVaisseauxEnCours=$carte->getAllVaisseauEnCours();

            foreach ($mesVaisseauxEnCours as $row) {
                $days=$row['cau_jour'];
                if($cleHeure==0){
                    $conn->executeQuery('
                        update carte_user set cau_jour = cau_jour + 1 where cau_id = '.$row['cau_id']
                    );
                    $days=$row['cau_jour']+1;
                }

                if(($row['cau_heure'] - $heure<=10)&& (($days >0 && $row['ca_zoom']==0) || ($days>=2 && $row['ca_zoom'] > 0))){

                    if($row['cau_etat']==3){//si attaque
                        $degat=1;
                        $flotteEnnemi=$row['ca_flotte'];
                        if($us->getValeurVaisseau()==100)
                            $nbVaisseau=$us->getVaisseau();
                        elseif($us->getValeurVaisseau() > 100){//si on veut rajouter des trucs plus tard
                            // $nbVaisseau=$us->getVaisseau()*2;
                            $nbVaisseau=$us->getVaisseau();
                            // $degat=0.5;
                        }elseif($us->getValeurVaisseau() < 100){//si on veut rajouter des trucs plus tard
                            // $nbVaisseau=$us->getVaisseau()*2;
                            $nbVaisseau=$us->getVaisseau();
                            // $degat=0.5;
                        }
                        if($flotteEnnemi>$nbVaisseau){
                            $etat=0;$defaite=1;
                        }else{
                            $etat=1;
                        }
                        $perte=$us->getVaisseau()-floor(($flotteEnnemi*$degat));
                        if($perte < 0)
                            $perte=0;
                        $us->setVaisseau($perte);

                    }elseif($row['cau_etat']==4)//exploration
                        $etat=0;
                    elseif($row['cau_etat']==2){//diplomate
                        $diplo=1;
                        if( !isset($etat) ) $etat = 0;

                        //A DECOMMENTER
                        $conn->executeQuery('update carte_user set cau_etat = '.$etat.', cau_jour = 0, cau_heure = 0, cau_diplomate = 1 where cau_id = '.$row['cau_id']);


                        $msg.='Le diplomate Atreïdes revient de la Planète '.$row['ca_nom'].' Il attend son débriefing<br/>';

                        ?><script>vaisseauDisplay();planeteDisplay(<?php echo $row['ca_id'];?>, '<?php echo $row['ca_nom'];?>');</script><?php
                    }

                    $conn->executeQuery('update carte_user set cau_etat = '.$etat.',cau_jour = 0, cau_heure = 0 where cau_id = '.$row['cau_id']);

                    if($etat==1 && !isset( $diplo ) ){
                        $us->setEpice($us->getEpice()+$row['ca_epice']);
                        $epiceJour=$row['ca_epice_jour'];
                        $msg.='Planète '.$row['ca_nom'].' conquise !  + '.$row['ca_epice'].' épice ! vaisseaux restant : '.$us->getVaisseau().'<br/>';
                        ?><script>vaisseauDisplay();planeteDisplay(<?php echo $row['ca_id'];?>, '<?php echo $row['ca_nom'];?>');</script><?php
                    }elseif($etat==0 && !isset($defaite) && !isset($diplo)){
                        $msg.='Retour d\'un vaisseau d\'exploration de la planète '.$row['ca_nom'].'<br/>';
                        ?><script>planeteDisplay(<?php echo $row['ca_id'];?>, '<?php echo $row['ca_nom'];?>');</script><?php
                    }elseif(isset($defaite) && !isset($diplo)){
                        $def=1;
                        $msg.='Votre flotte a échouée ! Vous n\'avez pas réussi à conquérir '.$row['ca_nom'].'<br/>';
                        ?><script>vaisseauDisplay();planeteDisplay(<?php echo $row['ca_id'];?>, '<?php echo $row['ca_nom'];?>');</script><?php
                    }

                }

            }
            if($msg!=''){
                if($def==1)
                    Messages::setWarningMessage($msg);
                else
                    Messages::setSuccessMessage($msg);

            }
        if($cleHeure==0){
            $us->setJour($us->getJour()+1);
            $us->setImpot($us->getImpot()+1);
            $us->setSoin($us->getSoin()+1);
            $myStar=$carte->getMyStars();
            $epice=0;
            foreach($myStar as $star){
                if($star['cau_etat']==1)
                    $epice+=$star['ca_epice_jour'];
            }
            $us->setEpice($us->getEpice()+$epice+$epiceJour);


            //SI QUETE CHAMBRE DIPLOMATE ACTIVE ALORS REBELLION TOUS LES TOURS
            if ( $quete->getMajQuete(7, 24, 2) ){

                //n'est pas aux marches, au premier village et sous l'arbre
                if( $us->getSalle() != 23 && $us->getSalle() != 24 && $us->getSalle() != 40 ) {
                    $pixels = json_decode($us->getHeroesOfPixel(), true);


                    $ennemis = $pixels[0];
                    if (count($ennemis) > 6) {
                        $us->setSalle(44);
                    }
//echo '<pre>';print_r($ennemis);die();
                    $positions[] = '4,1,64,256';
                    $positions[] = '5,3,192,320';
                    $positions[] = '2,6,384,128';
                    $positions[] = '5,7,448,320';
                    $positions[] = '6,6,384,384';
                    $positions[] = '8,10,640,512';
                    $positions[] = '3,11,704,192';
                    $positions[] = '5,12,768,320';
                    $positions[] = '8,5,320,512';
                    $positions[] = '4,6,384,256';
                    $positions[] = '7,9,576,448';
                    $positions[] = '4,9,256,128';
                    $positions[] = '5,4,256,320';
                    $positions[] = '8,3,192,512';
                    $positions[] = '2,1,64,128';

                    foreach ($ennemis as $ennemi) {
                        unset($ennemi[0]);
                        unset($ennemi[1]);
                        unset($ennemi[2]);
                        unset($ennemi[7]);
                        unset($ennemi[8]);
                        $string = implode(',', $ennemi);
                        $key = array_search($string, $positions);
                        if ($key != false)
                            unset($positions[$key]);
                    }

                    if ($quete->getMajQuete(4, 29, 1))//a modifier
                        $quetes = [8, 9, 10, 11, 12, 13, 14];//easy
                    else
                        $quetes = [1, 2, 3, 4, 5, 6, 7];//hard

                    $image = ['parrain', 'ami', 'friend', 'jailor'];
                    $positions = array_values($positions);

                    $position = $positions[rand(0, (count($positions) - 1))];
                    $queteJour = $quetes[rand(0, 6)];
                    $image = $image[rand(0, 3)];

                    $string = '0,0,0,' . $position . ',' . $queteJour . ',' . $image;
                    $explode = explode(',', $string);
                    $newEnnemi = [];
                    foreach ($explode as $item) {
                        if (is_numeric($item))
                            $item = intval($item);
                        $newEnnemi[] = $item;
                    }

                    $ennemis[] = $newEnnemi;
                    $pixels[0] = $ennemis;
                    $us->setHeroesOfPixel(json_encode($pixels));
                    $this->getEntityManager()->persist($us);
                    $this->getEntityManager()->flush();
                    //test si groupe existe deja à l'emplacement
                    $rebellion = 'Un groupe rebelle apparaît sur la carte. Votre popularité baisse<br/>';


                }
            }

        }

        //MAJ DES BATIMENTS SEULEMENT SI USER != VILLAGE1 ou MARCHES ou ARBRE
            if( $us->getSalle() != 23 && $us->getSalle() != 24 && $us->getSalle() != 40 ) {
                $ressourcesBatiments = $batiment->getRessources();
                foreach ($ressourcesBatiments as $ressourceBat) {
                    if( $us->getEpice() + $ressourceBat['epice'] < 0 ||
                        $us->getRenommee() + $ressourceBat['renommee'] < 0 ||
                        $us->getEau() + $ressourceBat['eau'] < 0 ||
                        $us->getCredit() + $ressourceBat['credit'] < 0 ||
                        $us->getTroupe() + $ressourceBat['troupe'] < 0
                    )
                        continue;

                    $us->setEpice($us->getEpice() + $ressourceBat['epice']);
                    $us->setRenommee($us->getRenommee() + $ressourceBat['renommee']);
                    $us->setEau($us->getEau() + $ressourceBat['eau']);
                    $us->setCredit($us->getCredit() + $ressourceBat['credit']);
                    $us->setTroupe($us->getTroupe() + $ressourceBat['troupe']);
                }
            }
        $us->setHeure($heure);
        $us->setConnexion(date('d-m-Y H:i'));

        $this->getEntityManager()->persist($us);
        $this->getEntityManager()->flush();
        ?><script>afficheSpice()</script><?php
        }

        return [$us->getJour(), $rebellion];


    }

    function majuserinfluence($idFaction)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();

        $stmt = $conn->prepare('update user set cuu_influence = cuu_influence - 1 
        where id = '.$idUser);
        $stmt->execute();

        $stmt = $conn->prepare('update influence set inf_nb_influence = inf_nb_influence + 1 
        where inf_id_user = '.$idUser.' and inf_id_faction = '.$idFaction);
        $stmt->execute();

    }

    public function majuserServiteur($idFaction)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();
        $valueServiteur=$us->getValeurServiteur();

        $stmt = $conn->prepare('update user set cuu_serviteur = cuu_serviteur - 1 
        where id = '.$idUser);
        $stmt->execute();

        $stmt = $conn->prepare('update serviteur set ser_nb_serviteur = ser_nb_serviteur + 1 
        where ser_id_user = '.$idUser.' and ser_id_faction = '.$idFaction);
        $stmt->execute();

        $stmt = $conn->prepare('update humeur_faction set hum_humeur = hum_humeur + '.$valueServiteur .' 
        where hum_id_user = '.$idUser.' and hum_id_faction = '.$idFaction);
        $stmt->execute();

    }

    function majObjet($idOb)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();
//echo $us->getObjets();
        if($us->getObjets()!='')
            $tempArray = json_decode($us->getObjets(), true);
        else
            $tempArray = array();

        array_push($tempArray, $idOb);
        $tempArray = json_encode($tempArray);

        $stmt = $conn->prepare("update user set cuu_objets =  '".$tempArray ."'
        where id = ".$idUser);
        $stmt->execute();

    }

    public function majuserEscorte($idFaction)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();

        $stmt = $conn->prepare('update user set cuu_gardien = cuu_gardien - 1 
        where id = '.$idUser);
        $stmt->execute();

        $stmt = $conn->prepare('update gardien set gar_nb_gardien = gar_nb_gardien + 1 
        where gar_id_user = '.$idUser.' and gar_id_faction = '.$idFaction);
        $stmt->execute();

    }

    function majSuggestionFaction($id_faction, $value)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();

        $stmt = $conn->prepare('update suggestion_epice set sug_nb_suggestion = '.$value.'
        where sug_id_user = '.$idUser.' and sug_id_faction = '.$id_faction);
        $stmt->execute();

    }

    function getServiteurFaction($id_faction = null)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();

        if($id_faction){

            $sql = '
            SELECT ser_nb_serviteur
            FROM serviteur
            WHERE ser_id_user= :idUser and ser_id_faction= :idPFaction
            ';

            $stmt = $conn->prepare($sql);
            $stmt->execute(array('idUser' => $idUser, 'idPFaction' => $id_faction));
            $result = $stmt->fetchAssociative();

            return $result['ser_nb_serviteur'];
        }else
            return $us->getServiteur();
    }

    function getEscorteFaction($id_faction = null)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();

        if($id_faction){

            $sql = '
            SELECT gar_nb_gardien
            FROM gardien
            WHERE gar_id_user= :idUser and gar_id_faction= :idPFaction
            ';

            $stmt = $conn->prepare($sql);
            $stmt->execute(array('idUser' => $idUser, 'idPFaction' => $id_faction));
            $result = $stmt->fetchAssociative();

            return $result['gar_nb_gardien'];
        }else
            return $us->getGardien();

    }

    public function majEscorte($value, $idFaction, $attentat)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();

        $escActuelle=$this->getEscorteFaction($idFaction);
        if($escActuelle+$value < 0){
            $value=$escActuelle+$value;
            if($attentat){
                $servs=$escActuelle+$value;
                $this->majServiteur($servs, $idFaction);
            }
        }

        if($escActuelle+$value<0)
            $value=-$escActuelle;
        $stmt = $conn->prepare('update gardien set gar_nb_gardien = gar_nb_gardien +'.$value.' 
        where gar_id_user = '.$idUser.' and gar_id_faction ='.$idFaction);
        $stmt->execute();
    }

    public function majServiteurValeur($multiplicateur)
    {
        $us = $this->security->getUser();
        $conn = $this->getEntityManager()->getConnection();

        $oldValue=$us->getValeurServiteur();
        $newValeur = $oldValue * $multiplicateur;
        $stmt = $conn->prepare('update user set cuu_valeur_serviteur = '.$newValeur.' 
        where id = '.$us->getId());
        $stmt->execute();
    }

    public function majServiteur($value, $idFaction)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();
        $valueServiteur=$us->getValeurServiteur();

        $servActuelle=$this->getServiteurFaction($idFaction);
        $humActuelle=$this->getHumeurFaction($idFaction);
        if($servActuelle+$value < 0)
            $value=-$servActuelle;

        $humeurAjout=$value*$valueServiteur;
        if($humActuelle+$humeurAjout < 0)
            $humeurAjout=-$humActuelle;

        $stmt = $conn->prepare('update serviteur set ser_nb_serviteur = ser_nb_serviteur +'.$value.' 
        where ser_id_user = '.$idUser.' and ser_id_faction ='.$idFaction);
        $stmt->execute();

        $stmt = $conn->prepare('update humeur_faction set hum_humeur = hum_humeur +'.$humeurAjout.' 
        where hum_id_user = '.$idUser.' and hum_id_faction ='.$idFaction);
        $stmt->execute();

    }

    function getHumeurFaction($id_faction = null)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();

        if($id_faction){

            $sql = '
            SELECT *
            FROM humeur_faction hum
            INNER JOIN faction fa ON fa.fac_id = hum.hum_id_faction
            WHERE hum.hum_id_user = :idUser and hum.hum_id_faction =  :idPFaction
            ';

            $stmt = $conn->prepare($sql);
            $stmt->execute(array('idUser' => $idUser, 'idPFaction' => $id_faction));
            $result = $stmt->fetchAssociative();
            return $result['hum_humeur'];

        }else{

            $sql = '
            SELECT *
            FROM humeur_faction hum
            INNER JOIN faction fa ON fac.fac_id = hum.hum_id_faction
            WHERE hum.hum_id_user = :idUser
            ';

            $stmt = $conn->prepare($sql);
            $stmt->execute(array('idUser' => $idUser));
            $results = $stmt->fetchAllAssociative();

            $entries   = array();

            foreach ($results as $row) {
                if($row['fac_id'] !=1  && $row['fac_id'] != 2)
                    $entries[$row['fac_nom']] = $row['hum_humeur'];
            }
            return $entries;
        }


    }

    public function majSalle($idSalle)
    {

        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare('update user set cuu_salle = '.$idSalle.' where id = '.$idUser);
        $stmt->execute();

    }

    public function majEntretien($idE=null)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();
        $entretien = $us->getEntretien();

        if($idE==null){
            $stmt = $conn->prepare('update user set cuu_entretien = "0" where id = '.$idUser);
        }
        else{
            $newValue = $entretien.','.$idE;
            $stmt = $conn->prepare('update user set cuu_entretien =  "'.$newValue.'" where id = '.$idUser);
        }
        $stmt->execute();
    }

    public function majInfluence($value, $idFaction)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();

        $valueServiteur=$us->getValeurServiteur();


        $infActuelle=$this->getInfluenceFaction($idFaction);
        if($infActuelle+$value < 0)
            $value=-$infActuelle;

        $stmt = $conn->prepare('update influence set inf_nb_influence = inf_nb_influence +'.$value.'
         where inf_id_user = '.$idUser.' and inf_id_faction = '.$idFaction);
        $stmt->execute();
    }

    function getInfluenceFaction($id_faction = null)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();

        if($id_faction){

            $stmt = $conn->prepare('select inf_nb_influence from
            influence where inf_id_faction='.$id_faction.' and inf_id_user = '.$idUser);
            $stmt->execute();
            $resultSet = $stmt->fetchAssociative();

            return $resultSet['inf_nb_influence'];
        }
        else
            return $us->getInfluence();
    }

    function getUserUpdated()
    {
        $us = $this->security->getUser();
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare('select * from user where id = '.$us->getId());
        $stmt->execute();
        $resultSet = $stmt->fetchAssociative();
        return $resultSet;
    }


    public function inscription($idUser){

        $entityManager = $this->getEntityManager();

        $query='delete from App:PorteUser u where u.poruIdUser='.$idUser;
        $entityManager->createQuery($query)->execute();
        $entityManager->createQuery('delete from App:ObjetUser u where u.obuIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:SallePerso u where u.salIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:UserQuete u where u.usIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:Serviteur u where u.serIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:SuggestionEpice u where u.sugIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:Influence u where u.infIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:Gardien u where u.garIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:HumeurFaction u where u.humIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:ArretQuote u where u.arrIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:CarteUser u where u.cauIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:ArretRecompense u where u.idUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:BatimentUser u where u.idUser='.$idUser)->execute();

        $porteUser = new PorteUser();
        $porteUser->setPoruIdPorte(1);
        $porteUser->setPoruIdUser($idUser);
        $porteUser->setPoruEtat(0);
        $entityManager->persist($porteUser);

        $porteUser = new PorteUser();
        $porteUser->setPoruIdPorte(2);
        $porteUser->setPoruIdUser($idUser);
        $porteUser->setPoruEtat(0);
        $entityManager->persist($porteUser);

        $porteUser = new PorteUser();
        $porteUser->setPoruIdPorte(3);
        $porteUser->setPoruIdUser($idUser);
        $porteUser->setPoruEtat(0);
        $entityManager->persist($porteUser);

        $porteUser = new PorteUser();
        $porteUser->setPoruIdPorte(9);
        $porteUser->setPoruIdUser($idUser);
        $porteUser->setPoruEtat(0);
        $entityManager->persist($porteUser);

        $porteUser = new PorteUser();
        $porteUser->setPoruIdPorte(4);
        $porteUser->setPoruIdUser($idUser);
        $porteUser->setPoruEtat(0);
        $entityManager->persist($porteUser);

        $porteUser = new PorteUser();
        $porteUser->setPoruIdPorte(5);
        $porteUser->setPoruIdUser($idUser);
        $porteUser->setPoruEtat(0);
        $entityManager->persist($porteUser);

        $porteUser = new PorteUser();
        $porteUser->setPoruIdPorte(6);
        $porteUser->setPoruIdUser($idUser);
        $porteUser->setPoruEtat(1);
        $entityManager->persist($porteUser);

        $porteUser = new PorteUser();
        $porteUser->setPoruIdPorte(7);
        $porteUser->setPoruIdUser($idUser);
        $porteUser->setPoruEtat(1);
        $entityManager->persist($porteUser);

        $porteUser = new PorteUser();
        $porteUser->setPoruIdPorte(8);
        $porteUser->setPoruIdUser($idUser);
        $porteUser->setPoruEtat(1);
        $entityManager->persist($porteUser);

        $entityManager->flush();

        //2021

        $porteUser = new PorteUser();
        $porteUser->setPoruIdPorte(10);
        $porteUser->setPoruIdUser($idUser);
        $porteUser->setPoruEtat(0);
        $entityManager->persist($porteUser);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(40);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(29);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(41);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(30);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(42);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(31);
        $entityManager->persist($sallePerso);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(29);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(30);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(31);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        ////2021

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(1);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(1);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(1);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(2);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(9);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(3);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(1);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(4);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(1);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(5);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(1);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(6);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(1);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(7);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(1);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(8);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(5);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(9);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(3);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(10);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(7);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(11);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(2);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(12);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(13);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(13);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(13);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(14);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(15);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(15);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(10);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(16);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(13);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(17);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(9);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(18);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(14);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(19);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(13);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(27);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(38);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(28);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(33);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(20);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(11);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(21);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(34);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(22);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(333);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(23);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(23);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(24);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(777);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(25);
        $entityManager->persist($sallePerso);

        $sallePerso = new SallePerso();
        $sallePerso->setSalIdSalle(34);
        $sallePerso->setSalIdUser($idUser);
        $sallePerso->setSalIdPerso(26);
        $entityManager->persist($sallePerso);

        $entityManager->flush();


        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(1);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(2);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(3);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(4);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(5);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(6);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(7);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(8);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(9);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(10);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(11);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(12);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(13);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(14);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(15);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(16);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(17);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(18);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(19);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(20);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(21);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(22);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(23);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(24);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(25);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(26);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(27);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $userQuete = new UserQuete();
        $userQuete->setUsIdUser($idUser);
        $userQuete->setUsIdQuete(0);
        $userQuete->setUsIdPerso(28);
        $userQuete->setUsIdExt(0);
        $entityManager->persist($userQuete);

        $entityManager->flush();

        $serviteur = new Serviteur();
        $serviteur->setSerIdUser($idUser);
        $serviteur->setSerIdFaction(3);
        $serviteur->setSerNbServiteur(0);
        $entityManager->persist($serviteur);


        $serviteur = new Serviteur();
        $serviteur->setSerIdUser($idUser);
        $serviteur->setSerIdFaction(4);
        $serviteur->setSerNbServiteur(0);
        $entityManager->persist($serviteur);


        $serviteur = new Serviteur();
        $serviteur->setSerIdUser($idUser);
        $serviteur->setSerIdFaction(5);
        $serviteur->setSerNbServiteur(0);
        $entityManager->persist($serviteur);


        $serviteur = new Serviteur();
        $serviteur->setSerIdUser($idUser);
        $serviteur->setSerIdFaction(6);
        $serviteur->setSerNbServiteur(0);
        $entityManager->persist($serviteur);

        $entityManager->flush();


        $suggestionEpice = new SuggestionEpice();
        $suggestionEpice->setSugIdUser($idUser);
        $suggestionEpice->setSugIdFaction(3);
        $suggestionEpice->setSugNbSuggestion(40);
        $entityManager->persist($suggestionEpice);

        $suggestionEpice = new SuggestionEpice();
        $suggestionEpice->setSugIdUser($idUser);
        $suggestionEpice->setSugIdFaction(4);
        $suggestionEpice->setSugNbSuggestion(40);
        $entityManager->persist($suggestionEpice);

        $suggestionEpice = new SuggestionEpice();
        $suggestionEpice->setSugIdUser($idUser);
        $suggestionEpice->setSugIdFaction(5);
        $suggestionEpice->setSugNbSuggestion(40);
        $entityManager->persist($suggestionEpice);

        $suggestionEpice = new SuggestionEpice();
        $suggestionEpice->setSugIdUser($idUser);
        $suggestionEpice->setSugIdFaction(6);
        $suggestionEpice->setSugNbSuggestion(40);
        $entityManager->persist($suggestionEpice);

        $entityManager->flush();

        $influence = new Influence();
        $influence->setInfIdUser($idUser);
        $influence->setInfIdFaction(3);
        $influence->setInfNbInfluence(0);
        $entityManager->persist($influence);

        $influence = new Influence();
        $influence->setInfIdUser($idUser);
        $influence->setInfIdFaction(4);
        $influence->setInfNbInfluence(0);
        $entityManager->persist($influence);

        $influence = new Influence();
        $influence->setInfIdUser($idUser);
        $influence->setInfIdFaction(5);
        $influence->setInfNbInfluence(0);
        $entityManager->persist($influence);

        $influence = new Influence();
        $influence->setInfIdUser($idUser);
        $influence->setInfIdFaction(6);
        $influence->setInfNbInfluence(0);
        $entityManager->persist($influence);

        $entityManager->flush();

        $gardien = new Gardien();
        $gardien->setGarIdUser($idUser);
        $gardien->setGarIdFaction(3);
        $gardien->setGarNbGardien(0);
        $entityManager->persist($gardien);

        $gardien = new Gardien();
        $gardien->setGarIdUser($idUser);
        $gardien->setGarIdFaction(4);
        $gardien->setGarNbGardien(0);
        $entityManager->persist($gardien);

        $gardien = new Gardien();
        $gardien->setGarIdUser($idUser);
        $gardien->setGarIdFaction(5);
        $gardien->setGarNbGardien(0);
        $entityManager->persist($gardien);

        $gardien = new Gardien();
        $gardien->setGarIdUser($idUser);
        $gardien->setGarIdFaction(6);
        $gardien->setGarNbGardien(0);
        $entityManager->persist($gardien);

        $entityManager->flush();

        $humeurFaction = new HumeurFaction();
        $humeurFaction->setHumIdUser($idUser);
        $humeurFaction->setHumIdFaction(3);
        $humeurFaction->setHumHumeur(0);
        $entityManager->persist($humeurFaction);

        $humeurFaction = new HumeurFaction();
        $humeurFaction->setHumIdUser($idUser);
        $humeurFaction->setHumIdFaction(4);
        $humeurFaction->setHumHumeur(0);
        $entityManager->persist($humeurFaction);

        $humeurFaction = new HumeurFaction();
        $humeurFaction->setHumIdUser($idUser);
        $humeurFaction->setHumIdFaction(5);
        $humeurFaction->setHumHumeur(0);
        $entityManager->persist($humeurFaction);

        $humeurFaction = new HumeurFaction();
        $humeurFaction->setHumIdUser($idUser);
        $humeurFaction->setHumIdFaction(6);
        $humeurFaction->setHumHumeur(0);
        $entityManager->persist($humeurFaction);

        $humeurFaction = new HumeurFaction();
        $humeurFaction->setHumIdUser($idUser);
        $humeurFaction->setHumIdFaction(1);
        $humeurFaction->setHumHumeur(0);
        $entityManager->persist($humeurFaction);

        $humeurFaction = new HumeurFaction();
        $humeurFaction->setHumIdUser($idUser);
        $humeurFaction->setHumIdFaction(2);
        $humeurFaction->setHumHumeur(0);
        $entityManager->persist($humeurFaction);

        $entityManager->flush();
    }

    public function desinscription($idUser){
        $entityManager = $this->getEntityManager();


        $query='delete from App:PorteUser u where u.poruIdUser='.$idUser;
        $entityManager->createQuery($query)->execute();
        $entityManager->createQuery('delete from App:ObjetUser u where u.obuIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:SallePerso u where u.salIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:UserQuete u where u.usIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:Serviteur u where u.serIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:SuggestionEpice u where u.sugIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:Influence u where u.infIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:Gardien u where u.garIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:HumeurFaction u where u.humIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:ArretQuote u where u.arrIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:CarteUser u where u.cauIdUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:ArretRecompense u where u.idUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:BatimentUser u where u.idUser='.$idUser)->execute();
        $entityManager->createQuery('delete from App:User u where u.id='.$idUser)->execute();



    }
}
