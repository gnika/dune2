<?php

namespace App\Repository;

use App\Entity\Carte;
use App\Entity\CarteUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class CarteRepository extends ServiceEntityRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Carte::class);
        $this->security = $security;
    }

    public static function fromArrayDynamic(iterable $data = []): self {
        $obj = new self;
        foreach ($data as $property => $value) {
            $obj->$property = $value;
        }
        return $obj;
    }

    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Product p ORDER BY p.name ASC'
            )
            ->getResult();
    }

    public function setTroupes($idPlanete, $troupe)
    {
        $us = $this->security->getUser();
        $idUser=$us->getId();
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare('update carte_user set cau_troupe = '.$troupe.' where 
        cau_ca_id = '.$idPlanete.' and cau_id_user='.$idUser);
        $stmt->execute();
    }

    public function getAllEnvoiTroupe()
    {
        $user = $this->security->getUser();

        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT *
            FROM carte_user cu
            INNER JOIN carte ca ON ca.ca_id = cu.cau_ca_id
            WHERE cu.cau_envoi <> 0 and cu.cau_id_user= :idUser
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idUser' => $idUser));
        return $results = $stmt->fetchAllAssociative();

    }

    public function getAllVaisseauEnCours()
    {
        $user = $this->security->getUser();

        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT *
            FROM carte_user cau
            INNER JOIN carte ca ON ca.ca_id = cau.cau_ca_id
            WHERE cau.cau_etat IN(2,3,4) and cau.cau_id_user= :idUser
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idUser' => $idUser));
        return $results = $stmt->fetchAllAssociative();

    }

    public function getMyStar($id)
    {
        $user = $this->security->getUser();

        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT *
            FROM carte ca
            INNER JOIN carte_user cu ON ca.ca_id = cu.cau_ca_id
            WHERE cu.cau_id_user= :idUser and ca.ca_id= :idPlanete
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idUser' => $idUser, 'idPlanete' => $id));
        $result = $stmt->fetchAssociative();

        if( $result == null )
            return $this->getStar($id);

        return $result;
    }

    public function deletePlanete($idP)
    {
        $user = $this->security->getUser();
        $entityManager = $this->getEntityManager();

        $idUser= $user->getId();
        $entityManager->createQuery('delete from App:CarteUser u 
        where u.cauIdUser='.$idUser.' and u.cauCaId='.$idP)->execute();

    }

    public function getMyStars($statut = null)
    {

        $user = $this->security->getUser();

        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        if ( $statut != null)
            $where = ' and cu.cau_etat = '.$statut;
        else
            $where = '';

        $sql = '
            SELECT *
            FROM carte ca
            INNER JOIN carte_user cu ON ca.ca_id = cu.cau_ca_id
            WHERE cu.cau_id_user= :idUser '.$where;

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idUser' => $idUser));
        $results = $stmt->fetchAllAssociative();

        return $results;
    }

    public function getActionVaisseau($action)
    {
        $user = $this->security->getUser();

        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT COUNT(*) as countId from carte_user 
            WHERE cau_etat= :etat and cau_id_user= :idUser
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('etat' => $action, 'idUser' => $idUser));
        $result = $stmt->fetchAssociative();

        return $result['countId'];
    }

    public function getStar($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT *
            FROM carte 
            WHERE ca_id= :idPlanete
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idPlanete' => $id));
        return $result = $stmt->fetchAssociative();
    }

    public function getAllStar()
    {
        $user = $this->security->getUser();

        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT *
            FROM carte ca
            LEFT JOIN carte_user cu ON ca.ca_id = cu.cau_ca_id and cu.cau_id_user= :idUser
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idUser' => $idUser));
        $results = $stmt->fetchAllAssociative();

        return $results;
    }



    public function envoiVaisseau($idPlanete, $action)
    {//action 3=attaque - 4=explore

        $user = $this->security->getUser();
        $entityManager = $this->getEntityManager();
        $conn = $this->getEntityManager()->getConnection();
        $idUser= $user->getId();

        $enCours=$this->getActionVaisseau($action);
        if($enCours >0 && $action==3)
            return 3;

        if($enCours >0 && $action==4){

            if($user->getExploration() <= $enCours )//3 <=1
                return 4;
        }

        $enCours=$this->verifPlaneteVierge($idPlanete);

        if($enCours >0)
            return 5;

        $entityManager->createQuery('delete from App:CarteUser u 
        where u.cauIdUser='.$idUser.' and u.cauCaId='.$idPlanete)->execute();

        $carteUser = new CarteUser();
        $carteUser->setCauIdUser($idUser);
        $carteUser->setCauCaId($idPlanete);
        $carteUser->setCauEtat($action);
        $carteUser->setCauHeure($user->getHeure());
        $carteUser->setCauDiplomate(0);
        $carteUser->setCauEnvoi(0);
        $carteUser->setCauJour(0);
        $carteUser->setCauTroupe(0);

        $this->getEntityManager()->persist($carteUser);
        $this->getEntityManager()->flush();

    }



    public function diplobriefing()
    {
        $user = $this->security->getUser();

        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT *
            FROM carte ca
            INNER JOIN carte_user cau ON ca.ca_id = cau.cau_ca_id
            WHERE cau.cau_id_user= :idUser  AND cau.cau_diplomate=1
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idUser' => $idUser));
        $resultSet = $stmt->fetchAssociative();


        return $resultSet;
    }

    public function getMyStarsStatutOne()
    {
        $user = $this->security->getUser();

        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT count(*) as count
            FROM carte ca
            INNER JOIN carte_user cau ON ca.ca_id = cau.cau_ca_id
            WHERE cau.cau_id_user= :idUser  AND cau.cau_etat = 1
            ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('idUser' => $idUser));
        $resultSet = $stmt->fetchAssociative();

        return $resultSet['count'];
    }

    public function verifPlaneteVierge($idPlanete, $expl=null)
    {
        $user = $this->security->getUser();
        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        if($expl!=null)
            $query	=	'select COUNT(*) as countId from carte_user WHERE cau_id_user="'.$idUser.'" AND cau_ca_id="'.$idPlanete.'"';
        else
            $query	=	'select COUNT(*) as countId from carte_user WHERE (cau_etat IN(2, 3, 4) OR cau_envoi<>0) and cau_id_user="'.$idUser.'" AND cau_ca_id="'.$idPlanete.'"';

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->fetchAssociative();
        return $resultSet['countId'];
    }

    public function explore($nb)
    {
        $user = $this->security->getUser();
        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        for($i=0;$i<$nb;$i++){
            $idPlanete=rand(1, 11);
            $vide=$this->verifPlaneteVierge($idPlanete, 1);
            if($vide==0){

                $carteUser = new CarteUser();
                $carteUser->setCauIdUser($idUser);
                $carteUser->setCauCaId($idPlanete);
                $carteUser->setCauEtat(0);
                $carteUser->setCauHeure(0);
                $carteUser->setCauDiplomate(0);
                $carteUser->setCauEnvoi(0);
                $carteUser->setCauJour(0);
                $carteUser->setCauTroupe(0);
                $this->getEntityManager()->persist($carteUser);
                $this->getEntityManager()->flush();

            }
        }
    }

    public function allDiplo($idSecteur)
    {
        $user = $this->security->getUser();
        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        $query='SELECT ca_id
			FROM carte c
			WHERE NOT EXISTS (SELECT 1 FROM carte_user 
			WHERE cau_ca_id = c.ca_id ) and c.ca_diplomate>15 and c.ca_zoom='.$idSecteur;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $all = $stmt->fetchAllAssociative();

        foreach($all as $res){
            $idPlanete = $res['ca_id'];

            $carteUser = new CarteUser();
            $carteUser->setCauIdUser($idUser);
            $carteUser->setCauCaId($idPlanete);
            $carteUser->setCauEtat(0);
            $carteUser->setCauHeure(0);
            $carteUser->setCauDiplomate(0);
            $carteUser->setCauEnvoi(0);
            $carteUser->setCauJour(0);
            $carteUser->setCauTroupe(0);
            $this->getEntityManager()->persist($carteUser);
            $this->getEntityManager()->flush();
        }
    }

    public function envoiTroupe($idPlanete, $nb)
    {
        $user = $this->security->getUser();
        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        if($user->getTroupe()-$nb < 0)
            return false;

        $stmt = $conn->prepare('update user set cuu_troupe = '.($user->getTroupe() - $nb).' where 
        id ='.$idUser);
        $update=$stmt->execute();

        $stmt = $conn->prepare('update carte_user set cau_envoi = '.$nb.', cau_heure = '.$user->getHeure().' where 
        cau_ca_id ='.$idPlanete.' and cau_etat = 1 and cau_id_user='.$idUser);
        $update=$stmt->execute();
        return $update;

    }

    public function diplomateWait()
    {
        $user = $this->security->getUser();
        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        $query	=	'select COUNT(*) as countId from carte_user WHERE (cau_etat =2 OR cau_diplomate=1) and cau_id_user="'.$idUser.'"';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $all = $stmt->fetchAssociative();
        return $all['countId'];
    }

    public function setdiplomateNull($idPlanete, $cau_etat)
    {
        $user = $this->security->getUser();
        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare('update carte_user set cau_diplomate = 0, cau_etat = '.$cau_etat.' where 
        cau_ca_id ='.$idPlanete.' and cau_id_user='.$idUser);
        $update=$stmt->execute();
    }

    public function envoiDiplomate($idPlanete)
    {
        $user = $this->security->getUser();
        $idUser= $user->getId();
        $conn = $this->getEntityManager()->getConnection();

        if($user->getEpice()>=500){
            $user->setEpice($user->getEpice()-500);
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();

            $dejaVisited=$this->getMyStar($idPlanete);

            if(!isset($dejaVisited['cau_id'])){
                $carteUser = new CarteUser();
                $carteUser->setCauIdUser($idUser);
                $carteUser->setCauCaId($idPlanete);
                $carteUser->setCauEtat(2);
                $carteUser->setCauHeure($user->getHeure());
                $carteUser->setCauDiplomate(0);
                $carteUser->setCauEnvoi(0);
                $carteUser->setCauJour(0);
                $carteUser->setCauTroupe(0);
                $this->getEntityManager()->persist($carteUser);

                return $this->getEntityManager()->flush();;
            }
            else{
                $stmt = $conn->prepare('update carte_user set cau_heure = '.$user->getHeure().', cau_etat = 2 where 
        cau_ca_id ='.$idPlanete.' and cau_id_user='.$idUser);
                $update=$stmt->execute();
                return $update;

            }
        }

    }

}