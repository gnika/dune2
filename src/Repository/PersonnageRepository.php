<?php

namespace App\Repository;

use App\Entity\ObjetUser;
use App\Entity\Personnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class PersonnageRepository extends ServiceEntityRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Personnage::class);
        $this->security = $security;
    }

    function getAllObjet()
    {
        $user = $this->security->getUser();

        $idUser= $user->getId();

        $conn = $this->getEntityManager()
            ->getConnection();

        $sql = '
            SELECT *
            FROM objet ob
            INNER JOIN objet_user obu ON ob.obj_id = obu.obu_id_objet
            WHERE obu.obu_id_user = :idUser
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idUser' => $idUser));
        $entreefinal = $stmt->fetchAllAssociative();

        return $entreefinal;
    }

    public function getMusiqueSalle($idSalle=null)
    {
        $user = $this->security->getUser();
        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        if($idSalle==null){
            $sql = '
            SELECT sa_musique
            FROM salle sa
            INNER JOIN user us ON us.cuu_salle = sa.sa_id
            WHERE us.id = :idUser
            ';

            $stmt = $conn->prepare($sql);
            $stmt->execute(array('idUser' => $idUser));

        }else{

            $sql = '
            SELECT sa_musique
            FROM salle 
            WHERE sa_id = :idSalle
            ';

            $stmt = $conn->prepare($sql);
            $stmt->execute(array('idSalle' => $idSalle));

        }

        $resultSet = $stmt->fetchAssociative();

        if( $user->getSecurityToken() == 1 ){//Si on vient de la page d'accueil
            $resultSet['sa_musique'] = 'silence.mp3';
            $user->setSecurityToken('');
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush($user);
        }
        return $resultSet['sa_musique'];
    }

    function getFaction($id_faction)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT fac_nom
            FROM faction 
            WHERE fac_id = :idFaction
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idFaction' => $id_faction));
        $resultSet = $stmt->fetchAssociative();

        return $resultSet['fac_nom'];
    }

    public function getSalle($idSalle)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT sa_nom
            FROM salle 
            WHERE sa_id = :idSalle
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idSalle' => $idSalle));
        $resultSet = $stmt->fetchAssociative();

        return $resultSet['sa_nom'];
    }

    public function getPersonnages($idSalle = null)
    {
        $conn = $this->getEntityManager()->getConnection();
        $user = $this->security->getUser();
        $idUser= $user->getId();

        if($idSalle) {

            $sql = '
            SELECT *
            FROM personnage pers
            INNER JOIN salle_perso sper ON pers.pers_id = sper.sal_id_perso
            WHERE sper.sal_id_salle= :idSale and sper.sal_id_user= :idUser
            ';

            $stmt = $conn->prepare($sql);
            $stmt->execute(array('idSale' => $idSalle, 'idUser' => $idUser));

        }
        else {
            $sql = '
            SELECT *
            FROM personnage pers
            INNER JOIN salle_perso sper ON pers.pers_id = sper.sal_id_perso
            WHERE sper.sal_id_user= :idUser
            ';

            $stmt = $conn->prepare($sql);
            $stmt->execute(array('idUser' => $idUser));
        }


        $resultSet = $stmt->fetchAllAssociative();

        if (!$resultSet) {
            return;
        }
        $entree=array();
        $entreefinal=array();
        foreach ($resultSet as $row) {
            $entree['pers_id']=$row['pers_id'];
            $entree['pers_nom']=$row['pers_nom'];
            $entree['pers_faction']=$row['pers_faction'];
            $entreefinal[strtolower (str_replace (' ', '_', $row['pers_nom']))]=$entree;
        }
        return $entreefinal;

    }

    public function getPersonnage($idPerso)
    {
        $conn = $this->getEntityManager()->getConnection();
        $user = $this->security->getUser();
        $idUser= $user->getId();

        $sql = '
            SELECT *
            FROM personnage pers
            INNER JOIN salle_perso sper ON pers.pers_id = sper.sal_id_perso
            WHERE sper.sal_id_user= :idUser and sper.sal_id_perso = :idPerso
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idUser' => $idUser, 'idPerso' => $idPerso));

        $resultSet = $stmt->fetchAllAssociative();

        if (!$resultSet) {
            return;
        }
        $entree=array();
        $entreefinal=array();
        foreach ($resultSet as $row) {
            $entree['pers_id']=$row['pers_id'];
            $entree['pers_nom']=$row['pers_nom'];
            $entree['pers_salle']=$row['sal_id_salle'];
            $entree['pers_faction']=$row['pers_faction'];
            $entreefinal[strtolower (str_replace (' ', '_', $row['pers_nom']))]=$entree;
        }
        return $entreefinal;

    }

    function getPortes($idSalle)
    {
        $conn = $this->getEntityManager()->getConnection();
        $user = $this->security->getUser();
        $idUser= $user->getId();


        $sql = '
        SELECT *
        FROM porte por
        INNER JOIN porte_user poru ON por.por_id = poru.poru_id_porte
        WHERE por.por_id_salle= :idSale and poru.poru_id_user= :idUser
        ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idSale' => $idSalle, 'idUser' => $idUser));



        $resultSet = $stmt->fetchAllAssociative();

        if (!$resultSet) {
            return;
        }
        $entree=array();
        $entreefinal=array();
        foreach ($resultSet as $row) {
            $entree['por_id']=$row['por_id'];
            $entree['por_id_type']=$row['por_id_type'];
            $entree['poru_etat']=$row['poru_etat'];
            $entree['por_title_ouvert']=$row['por_title_ouvert'];
            $entree['por_title_ferme']=$row['por_title_ferme'];
            $entree['por_direction']=$row['por_direction'];
            $entreefinal[]=$entree;
        }
        return $entreefinal;
    }

    function mouveSalle($idPerso, $idSalle)
    {
        $conn = $this->getEntityManager()->getConnection();
        $user = $this->security->getUser();
        $idUser= $user->getId();

        $stmt = $conn->prepare('update salle_perso set sal_id_salle = '.$idSalle.'
         where sal_id_user = '.$idUser.' and sal_id_perso = '.$idPerso);
        $stmt->execute();

    }



    function getObjet($idObjet)
    {
        $conn = $this->getEntityManager()->getConnection();
        $user = $this->security->getUser();
        $idUser= $user->getId();

        $sql = 'select obu_id_objet from objet_user where obu_id_user='.$idUser.' and obu_id_objet='.$idObjet;

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAssociative();
        if($row)
            return true;
        else
            return false;
    }

    function deleteobject($idObject)
    {
        $user = $this->security->getUser();
        $idUser= $user->getId();
        $this->getEntityManager()->createQuery('delete from App:ObjetUser u where
         u.obuIdUser='.$idUser.' and u.obuIdObjet='.$idObject)->execute();
    }

    function majPorte($idPorte, $etat)
    {
        $conn = $this->getEntityManager()->getConnection();
        $user = $this->security->getUser();
        $idUser= $user->getId();

        $stmt = $conn->prepare('update porte_user set poru_etat = '.$etat.'
         where poru_id_user = '.$idUser.' and poru_id_porte = '.$idPorte);
        $stmt->execute();
    }

    function addObjet($idObject)
    {
        $user = $this->security->getUser();
        $idUser= $user->getId();

        $objetUser = new ObjetUser();
        $objetUser->setObuIdObjet($idObject);
        $objetUser->setObuIdUser($idUser);
        $this->getEntityManager()->persist($objetUser);
        $this->getEntityManager()->flush();

    }
    function getNameObjet($idObjet)
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql = 'select obj_nom from objet where obj_id='.$idObjet;

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAssociative();
        return $row['obj_nom'];

    }


}