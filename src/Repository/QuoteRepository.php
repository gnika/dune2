<?php

namespace App\Repository;

use App\Entity\ArretQuote;
use App\Entity\ArretRecompense;
use App\Entity\Quote;
use App\Entity\UserQuete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class QuoteRepository extends ServiceEntityRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Quote::class);
        $this->security = $security;
    }

    public function getMajQuete($id_quete, $idPerso, $extIdPersoConcerne)
    {
        $conn = $this->getEntityManager()->getConnection();
        $user = $this->security->getUser();
        $idUser= $user->getId();

        $query = 'SELECT * 
			FROM `user_quete`
			
			WHERE (
				us_id_user  = "'.$idUser.'" 
				AND us_id_quete = "'.$id_quete.'"
				AND us_id_perso  = "'.$idPerso.'"
				AND us_id_ext  = "'.$extIdPersoConcerne.'"
			)';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->fetchAssociative();

        return $resultSet;
    }

    public function majQuete($id_quete, $idPerso, $extIdPersoConcerne)
    {
        //executeStatement count update
        if (!$extIdPersoConcerne)
            $extIdPersoConcerne = 0;

        $conn = $this->getEntityManager()->getConnection();
        $user = $this->security->getUser();
        $idUser = $user->getId();

        $update = $conn->executeStatement('update user_quete set us_id_quete = ' . $id_quete . '
         where us_id_user = ' . $idUser . ' and us_id_ext =' . $extIdPersoConcerne . ' and us_id_perso=' . $idPerso);


        if (!$update) {  //SI NOUVELLE QUETE (on check)
            $sql = 'SELECT count(*) as count from user_quete where us_id_quete=' . $id_quete . '
            and us_id_user=' . $idUser . ' and us_id_ext=' . $extIdPersoConcerne . ' and us_id_perso=' . $idPerso;

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $count = $stmt->fetchAssociative();

            if ($count['count'] < 1) {

                $userQuete = new UserQuete();
                $userQuete->setUsIdQuete($id_quete);
                $userQuete->setUsIdUser($idUser);
                $userQuete->setUsIdExt($extIdPersoConcerne);
                $userQuete->setUsIdPerso($idPerso);
                $this->getEntityManager()->persist($userQuete);
                $this->getEntityManager()->flush();
            }

        }
    }


    public function recompense($id_quete, $idPerso, $extIdPersoConcerne)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();
        $user = $this->getEntityManager()->getRepository('App:User');

        $query = 'SELECT `re`. * 
            FROM `recompense` AS `re`
            
            WHERE (
                re_id_ext  = "'.$extIdPersoConcerne.'" 
                AND re_id_quete = "'.$id_quete.'"
                AND re_id_perso  = "'.$idPerso.'"
            ) AND re.re_id NOT
				IN (
					SELECT arr2.rec_id
					FROM arret_recompense AS arr2
					LEFT JOIN recompense ext2 ON arr2.rec_id = ext2.re_id
					WHERE arr2.id_user = "'.$idUser.'"
				)  ';

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->fetchAssociative();

        if($resultSet){
            $arrayResult=array();
            $re_influence=$resultSet['re_influence'];
            $re_gardien=$resultSet['re_gardien'];
            $re_serviteur=$resultSet['re_serviteur'];
            $re_epice=$resultSet['re_epice'];
            $re_corruption=$resultSet['re_corruption'];
            $re_troupe=$resultSet['re_troupe'];
            $re_vaisseau=$resultSet['re_vaisseau'];
            $re_renommee=$resultSet['re_renommee'];
            $re_eau=$resultSet['re_eau'];
            $re_credit=$resultSet['re_credit'];

            if($resultSet['re_influence_faction']==0 )
                $arrayResult['cuu_influence'] = $us->getInfluence() + $re_influence;
            else{
                $user->majInfluence($re_influence, $resultSet['re_influence_faction']);
                $arrayResult['cuu_influence'] = $us->getInfluence();
            }
            if($resultSet['re_gardien_faction']==0 )
                $arrayResult['cuu_gardien'] = $us->getGardien() + $re_gardien;
            else{
                $user->majEscorte($re_gardien, $resultSet['re_gardien_faction']);
                $arrayResult['cuu_gardien'] = $us->getGardien();
            }
            if($resultSet['re_serviteur_faction']==0 )
                $arrayResult['cuu_serviteur'] = $us->getServiteur() + $re_serviteur;
            else{
                $user->majServiteur($re_serviteur, $resultSet['re_serviteur_faction']);
                $arrayResult['cuu_serviteur'] = $us->getServiteur();
            }
            $cuu_epice       =       $us->getEpice() + $re_epice;
            $cuu_renommee    =       $us->getRenommee() + $re_renommee;
            $cuu_corruption  =       $us->getCorruption() + $re_corruption;
            $cuu_troupe      =       $us->getTroupe() + $re_troupe;
            $cuu_vaisseau    =       $us->getVaisseau() + $re_vaisseau;
            $cuu_eau         =       $us->getEau() + $re_eau;
            $cuu_credit      =       $us->getCredit() + $re_credit;
            $cuu_serviteur   =       $arrayResult['cuu_serviteur'];
            $cuu_gardien     =       $arrayResult['cuu_gardien'];
            $cuu_influence   =       $arrayResult['cuu_influence'];

            $stmt = $conn->prepare('update user set 
            cuu_epice = ' . $cuu_epice . ',
            cuu_renommee = ' . $cuu_renommee . ',
            cuu_corruption = ' . $cuu_corruption . ',
            cuu_troupe = ' . $cuu_troupe . ',
            cuu_eau = ' . $cuu_eau . ',
            cuu_credit = ' . $cuu_credit . ',
            cuu_influence = ' . $cuu_influence . ',
            cuu_gardien = ' . $cuu_gardien . ',
            cuu_serviteur = ' . $cuu_serviteur . ',
            cuu_vaisseau = ' . $cuu_vaisseau . ' 
         where id=' . $idUser);
            $stmt->execute();

            $arretRecompense = new ArretRecompense();
            $arretRecompense->setIdUser($idUser);
            $arretRecompense->setRecId($resultSet['re_id']);
            $this->getEntityManager()->persist($arretRecompense);
            $this->getEntityManager()->flush();


            return array('function'=>$resultSet['re_fnctn'], 'display'=>$resultSet['re_display']);

        }
    }


    public function majMultiple($idMulti, $nbMulti)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();
//select mul.mu_id_lien
        $query = 'SELECT count(*) as count
            FROM multi_condition AS mul
            INNER JOIN user_quete AS uquo
            ON uquo.us_id_quete = mul.mu_id_quete and uquo.us_id_perso = mul.mu_id_perso and uquo.us_id_ext = mul.mu_id_ext
            WHERE mul.mu_id_lien='.$idMulti.' AND uquo.us_id_user='.$idUser;

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->fetchAssociative();
        $toutCorrespond=$resultSet['count'];


        if (!$resultSet || ($toutCorrespond != $nbMulti)) {
            return false;
        }

        $query = 'SELECT *
            FROM multi_maj AS mum
            WHERE mum.mum_id_lien = '.$idMulti;

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->fetchAllAssociative();

        foreach ($resultSet as $row) {

            $usIdQuete     = $row['mum_id_quete'];
            $usIdExt       = $row['mum_id_ext'];
            $usIdPerso    = $row['mum_id_perso'];

            $update = $conn->executeStatement('update user_quete set us_id_quete = ' . $usIdQuete . '
         where us_id_user = ' . $idUser . ' and us_id_ext =' . $usIdExt . ' and us_id_perso=' . $usIdPerso);

            if(!$update){

                $userQuete = new UserQuete();
                $userQuete->setUsIdQuete($usIdQuete);
                $userQuete->setUsIdUser($idUser);
                $userQuete->setUsIdExt($usIdExt);
                $userQuete->setUsIdPerso($usIdPerso);
                $this->getEntityManager()->persist($userQuete);
                $this->getEntityManager()->flush();
            }
        }

    }

    public function multiRecompense($rec_multi, $rec_nb_multi){

        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();
        $user = $this->getEntityManager()->getRepository('App:User');

        $query = 'SELECT count(*) as count
            FROM recompense_multi_condition AS remc
            INNER JOIN user_quete AS uquo
            ON uquo.us_id_quete = remc.remc_id_quete and uquo.us_id_perso = remc.remc_id_perso and uquo.us_id_ext = remc.remc_id_ext
            WHERE remc.remc_id_lien='.$rec_multi.' AND uquo.us_id_user='.$idUser;

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->fetchAssociative();
        $toutCorrespond=$resultSet['count'];


        if (!$resultSet || ($toutCorrespond != $rec_nb_multi)) {
            return false;
        }

        $query = 'SELECT *
            FROM recompense_multi AS remc
            WHERE remc.rem_id_lien='.$rec_multi;

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->fetchAssociative();

        if($resultSet){
            $arrayResult=array();
            $rem_influence=$resultSet['rem_influence'];
            $rem_gardien=$resultSet['rem_gardien'];
            $rem_serviteur=$resultSet['rem_serviteur'];
            $rem_epice=$resultSet['rem_epice'];
            $rem_credit=$resultSet['rem_credit'];
            $rem_eau=$resultSet['rem_eau'];
            $rem_corruption=$resultSet['rem_corruption'];
            $rem_troupe=$resultSet['rem_troupe'];
            $rem_vaisseau=$resultSet['rem_vaisseau'];
            $rem_renommee=$resultSet['rem_renommee'];

            if($resultSet['rem_influence_faction'] == 0 )
                $arrayResult['cuu_influence'] = $us->getInfluence() + $rem_influence;
            else{
                $user->majInfluence($rem_influence, $resultSet['rem_influence_faction']);
            }
            if($resultSet['rem_gardien_faction']==0 )
                $arrayResult['cuu_gardien'] = $us->getGardien() + $rem_gardien;
            else{
                $user->majEscorte($rem_serviteur, $resultSet['rem_gardien_faction']);
            }
            if($resultSet['rem_serviteur_faction']==0 )
                $arrayResult['cuu_serviteur'] = $us->getServiteur() + $rem_serviteur;
            else{
                $user->majServiteur($rem_serviteur, $resultSet['rem_serviteur_faction']);
            }
            $cuu_epice       =       $us->getEpice() + $rem_epice;
            $cuu_eau         =       $us->getEau() + $rem_eau;
            $cuu_credit      =       $us->getCredit() + $rem_credit;
            $cuu_renommee    =       $us->getRenommee() + $rem_renommee;
            $cuu_corruption  =       $us->getCorruption() + $rem_corruption;
            $cuu_troupe      =       $us->getTroupe() + $rem_troupe;
            $cuu_vaisseau    =       $us->getVaisseau() + $rem_vaisseau;

            $stmt = $conn->prepare('update user set 
            cuu_epice = ' . $cuu_epice . ',
            cuu_eau = ' . $cuu_eau . ',
            cuu_credit = ' . $cuu_credit . ',
            cuu_renommee = ' . $cuu_renommee . ',
            cuu_corruption = ' . $cuu_corruption . ',
            cuu_troupe = ' . $cuu_troupe . ',
            cuu_vaisseau = ' . $cuu_vaisseau . ' 
         where id=' . $idUser);
            $stmt->execute();


            return array('function'=>$resultSet['rem_fnctn'], 'display'=>$resultSet['rem_display']);
        }
    }



    public function putArretQuoteMoneo($ext_id)
    {

        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();



        $arretQuote = new ArretQuote();
        $arretQuote->setArrIdUser($idUser);
        $arretQuote->setArrExtId($ext_id);
        $arretQuote->setArrMoneo(1);
        $this->getEntityManager()->persist($arretQuote);
        $this->getEntityManager()->flush();
    }

    public function getQuoteByPerso($idPerso)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();

        $query = 'SELECT `ext`. * , `uquo`. * , `quo`. *, `hum`. *
			FROM `externe_quete` AS `ext`
			INNER JOIN `user_quete` AS `uquo` ON ext.ext_id_perso_concerne = uquo.us_id_perso
			AND ext.ext_id_perso_quete = uquo.us_id_quete
			AND ext.ext_us_id_ext = uquo.us_id_ext
			AND ext.ext_moneo =0
			INNER JOIN `quote` AS `quo` ON ext.ext_id_quote = quo.quo_id
			INNER JOIN `personnage` as `pers` ON pers.pers_id = ext.ext_id_perso
			INNER JOIN `humeur_faction` as `hum` ON hum.hum_id_faction = pers.pers_faction
			WHERE (
				uquo.us_id_user = "'.$idUser.'" 
				AND hum.hum_id_user = "'.$idUser.'"
				AND ext.ext_id_perso = "'.$idPerso.'"
				AND quo.quo_id_perso = "'.$idPerso.'"
				AND ext.ext_id NOT
				IN (
					SELECT arr2.arr_ext_id
					FROM arret_quote AS arr2
					LEFT JOIN externe_quete ext2 ON arr2.arr_ext_id = ext2.ext_id
					WHERE arr2.arr_id_user = "'.$idUser.'" 
					AND arr2.arr_moneo =0
				) 
			) order by ext.ext_us_id_ext DESC';//et humeur

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAssociative();


        if (!$row) {

        }else{
            $entree=array();
            $entree=array();
            $done=0;

            if($row['ext_arret']==1){

                $extId = $row['ext_id'];

                $arretQuote = new ArretQuote();
                $arretQuote->setArrIdUser($idUser);
                $arretQuote->setArrExtId($extId);
                $arretQuote->setArrMoneo(0);
                $this->getEntityManager()->persist($arretQuote);
                $this->getEntityManager()->flush();
            }
            $entree=array();
            $entree['quo_id']=$row['quo_id'];
            $entree['quo_id_perso']=$row['quo_id_perso'];
            $entree['quo_reponse']=$row['quo_reponse'];
            $entree['quo_quote']=$row['quo_quote'];
            $entree['quo_quote_en']=$row['quo_quote_en'];
            $entree['quo_humeur']=$row['quo_humeur'];
            $entree['quo_maj_quete']=$row['quo_maj_quete'];
            $entree['quo_maj_quete_perso']=$row['quo_maj_quete_perso'];
            $entree['quo_nb_multiple']=$row['quo_nb_multiple'];
            $entree['quo_id_multiple']=$row['quo_id_multiple'];
            $entree['quo_maj_quete_id_ext']=$row['quo_maj_quete_id_ext'];
            $entree['quo_recompense_multi']=$row['quo_recompense_multi'];
            $entree['quo_recompense_nb_multi']=$row['quo_recompense_nb_multi'];
            $entree['quo_fnctn']=$row['quo_fnctn'];

        }

        return $entree;
    }

    public function getQuoteById($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();
        $query =
            'SELECT * FROM quote AS quo INNER JOIN personnage AS pers ON pers.pers_id = quo.quo_id_perso 
            INNER JOIN humeur_faction AS hum ON hum.hum_id_faction =pers.pers_faction WHERE
            quo.quo_id='.$id.' AND hum.hum_id_user = '.$idUser.' AND quo.quo_humeur <= hum.hum_humeur
            ORDER BY hum_humeur DESC';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAssociative();

        if ( !$row ){
            return;
        }
        $entree=array();
        $entree['quo_id']=$row['quo_id'];
        $entree['quo_id_perso']=$row['quo_id_perso'];
        $entree['quo_reponse']=$row['quo_reponse'];
        $entree['quo_quote']=$row['quo_quote'];
        $entree['quo_quote_en']=$row['quo_quote_en'];
        $entree['quo_humeur']=$row['quo_humeur'];
        $entree['quo_maj_quete']=$row['quo_maj_quete'];
        $entree['quo_maj_quete_perso']=$row['quo_maj_quete_perso'];
        $entree['quo_nb_multiple']=$row['quo_nb_multiple'];
        $entree['quo_id_multiple']=$row['quo_id_multiple'];
        $entree['quo_maj_quete_id_ext']=$row['quo_maj_quete_id_ext'];
        $entree['quo_recompense_multi']=$row['quo_recompense_multi'];
        $entree['quo_recompense_nb_multi']=$row['quo_recompense_nb_multi'];
        $entree['quo_fnctn']=$row['quo_fnctn'];

        return $entree;
    }

    public function getReponsePerso($idPerso)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();


        $query = 'SELECT `ext`. * , `uquo`. * , `mon`. *, `hum`. *
			FROM `externe_quete` AS `ext`
			INNER JOIN `user_quete` AS `uquo` ON ext.ext_id_perso_concerne = uquo.us_id_perso
			AND ext.ext_id_perso_quete = uquo.us_id_quete
			AND ext.ext_us_id_ext = uquo.us_id_ext
			AND ext.ext_moneo =1
			INNER JOIN `moneo_quote` AS `mon` ON ext.ext_id_quote = mon.mon_id
			INNER JOIN `personnage` as `pers` ON pers.pers_id = ext.ext_id_perso
			INNER JOIN `humeur_faction` as `hum` ON hum.hum_id_faction = pers.pers_faction
			WHERE (
				uquo.us_id_user = "'.$idUser.'" 
				AND ext.ext_id_perso = "'.$idPerso.'"
				AND mon.mon_id_perso = "'.$idPerso.'"
				AND hum.hum_id_user = "'.$idUser.'"
				AND mon.mon_humeur <= hum.hum_humeur
				AND ext.ext_id NOT
				IN (
					SELECT arr2.arr_ext_id
					FROM arret_quote AS arr2
					LEFT JOIN externe_quete ext2 ON arr2.arr_ext_id = ext2.ext_id
					WHERE arr2.arr_id_user = "'.$idUser.'" 
					AND arr2.arr_moneo =1
				)
			)';

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->fetchAllAssociative();

        $entreefinal=array();
        if (!$resultSet) {

        }else{
            $entree=array();
            $entreefinalAlone=array();
            foreach ($resultSet as $row) {
                $entree['mon_quote']=$row['mon_quote'];
                $entree['mon_quote_en']=$row['mon_quote_en'];
                $entree['ext_id']=$row['ext_id'];
                $entree['ext_arret']=$row['ext_arret'];
                $entree['mon_reponse']=$row['mon_reponse'];
                $entree['mon_maj_quete']=$row['mon_maj_quete'];
                $entree['mon_maj_quete_perso']=$row['mon_maj_quete_perso'];
                $entree['mon_maj_quete_id_ext']=$row['mon_maj_quete_id_ext'];
                $entree['mon_id_multiple']=$row['mon_id_multiple'];
                $entree['mon_nb_multiple']=$row['mon_nb_multiple'];
                $entree['mon_recompense_multi']=$row['mon_recompense_multi'];
                $entree['mon_recompense_nb_multi']=$row['mon_recompense_nb_multi'];
                $entree['mon_fnctn']=$row['mon_fnctn'];
                if($row['mon_quote_seul']==1)
                    $entreefinalAlone[]=$entree;
                else
                    $entreefinal[]=$entree;
            }
        }

        if( isset($entreefinalAlone) && count($entreefinalAlone)!=0)
            return $entreefinalAlone;
        else
            return $entreefinal;
    }

    public function setArret($idExt, $idMoneo){

        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();

        $arretQuote = new ArretQuote();
        $arretQuote->setArrIdUser($idUser);
        $arretQuote->setArrExtId($idExt);
        $arretQuote->setArrMoneo($idMoneo);
        $this->getEntityManager()->persist($arretQuote);
        $this->getEntityManager()->flush();
    }

    public function getQuesteGlobal($idPerso, $extIdPersoConcerne)
    {
        $conn = $this->getEntityManager()->getConnection();
        $us = $this->security->getUser();
        $idUser= $us->getId();

        $query = 'SELECT * 
			FROM `user_quete`
			
			WHERE (
				us_id_user  = "'.$idUser.'" 
				AND us_id_perso  = "'.$idPerso.'"
				AND us_id_ext  = "'.$extIdPersoConcerne.'"
			)';

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->fetchAssociative();
        return $resultSet;
    }




}