<?php

namespace App\Repository;

use App\Entity\Batiment;

use App\Entity\BatimentUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;


class BatimentRepository extends ServiceEntityRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Batiment::class);
        $this->security = $security;
    }

    public function saveBatiments($batiments)
    {

        $entityManager = $this->getEntityManager();
        $conn = $entityManager->getConnection();
        $idUser = $this->security->getUser()->getId();

        $query='delete from App:BatimentUser u where u.idUser='.$idUser;
        $entityManager->createQuery($query)->execute();
        foreach( $batiments as $key=>$batiment){
            if( $key != 0 ) {//batiment palais, commun à tous

                $level = $batiment[11];
                $etat = $batiment[13];
                //$etat = 1;
                $name  = $batiment[12];
                if( isset($batiment[14]) && is_array($batiment[14]) && count($batiment[14]) > 0 )
                    $road = $batiment[14];
                else
                    $road = [];
                $route = $road;
                $vie   = $batiment[5];

                $sql = ' SELECT id FROM batiment WHERE nom = "'.$name.'"';

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $resultSet = $stmt->fetchAssociative();

                $batimentUser = new BatimentUser();
                $batimentUser->setDistance(count($route));
                $batimentUser->setIdUser($idUser);
                $batimentUser->setNiveau($level);
                $batimentUser->setVie($vie);
                $batimentUser->setIdBatiment($resultSet['id']);
                $batimentUser->setEtat($etat);
                $entityManager->persist($batimentUser);
                $entityManager->flush();
            }
        }
    }

    public function getRessources()
    {
        $entityManager = $this->getEntityManager();
        $conn = $entityManager->getConnection();
        $user = $this->security->getUser();
        $idUser = $user->getId();

        $sql = ' SELECT * FROM batiment b inner join batiment_user bu ON b.id = bu.id_batiment
        WHERE bu.etat=1 and bu.id_user = '.$idUser;

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAllAssociative();
        $typeDifferent = [];
        foreach( $resultSet as $batiment ){


            $epice    = 0;
            $renommee = 0;
            $eau      = 0;
            $credit   = 0;
            $troupe   = 0;

            $quota       =  $batiment['distance']/6 ; //6 cases de distances = 1h
            if( $quota == 0 )
                continue;
            $niveau       = $batiment['niveau'];
            if( $niveau == 2)
                $niveau = 1.5;
            elseif( $niveau == 3)
                $niveau = 2;

            //les niveaux des batiments n'augentent pas les couts
            if( $batiment['epice'] < 0)
                $epice       += ($batiment['epice']) / $quota;
            else
                $epice       += ($niveau * $batiment['epice']) / $quota;
            if( $batiment['renommee'] < 0)
                $renommee       += ($batiment['renommee']) / $quota;
            else
                $renommee       += ($niveau * $batiment['renommee']) / $quota;
            if( $batiment['eau'] < 0)
                $eau       += ($batiment['eau']) / $quota;
            else
                $eau       += ($niveau * $batiment['eau']) / $quota;
            if( $batiment['credit'] < 0)
                $credit       += ($batiment['credit']) / $quota;
            else
                $credit       += ($niveau * $batiment['credit']) / $quota;
            if( $batiment['troupe'] < 0)
                $troupe       += ($batiment['troupe']) / $quota;
            else
                $troupe       += ($niveau * $batiment['troupe']) / $quota;

            //separe les ressources donnees/recues par type de batiment
            if ( !isset ($typeDifferent[$batiment['id_batiment']]) ) {
                $typeDifferent[$batiment['id_batiment']] = [
                    'renommee' => round($renommee),
                    'eau' => round($eau),
                    'epice' => round($epice),
                    'credit' => round($credit),
                    'troupe' => round($troupe),
                ];
            }
            else{
                $typeDifferent[$batiment['id_batiment']] = [
                    'renommee' => (round($renommee) + $typeDifferent[$batiment['id_batiment']]['renommee']),
                    'eau' => (round($eau) + $typeDifferent[$batiment['id_batiment']]['eau']),
                    'epice' => (round($epice) + $typeDifferent[$batiment['id_batiment']]['epice']),
                    'credit' => (round($credit) + $typeDifferent[$batiment['id_batiment']]['credit']),
                    'troupe' => (round($troupe) + $typeDifferent[$batiment['id_batiment']]['troupe']),
                ];
            }
        }
    return $typeDifferent;

    }

}