<?php

namespace App\Repository;

use App\Entity\HumeurFaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class HumeurFactionRepository extends ServiceEntityRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, HumeurFaction::class);
        $this->security = $security;
    }

    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Product p ORDER BY p.name ASC'
            )
            ->getResult();
    }

    function getHumeurFaction($id_faction = null)
    {

        $user = $this->security->getUser();

        $idUser= $user->getId();

        $conn = $this->getEntityManager()
            ->getConnection();

        if($id_faction){

            $sql = '
            SELECT *
            FROM humeur_faction fc
            INNER JOIN faction cat ON cat.fac_id = fc.hum_id_faction
            WHERE fc.hum_id_user = :idUser and fc.hum_id_faction = :idfaction
            ';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array('idUser' => $idUser, 'idfaction' => $id_faction));

            $results = $stmt->fetchAssociative();//pas testé
            return $results['hum_humeur'];
        }else{


            $sql = '
            SELECT *
            FROM humeur_faction fc
            INNER JOIN faction cat ON cat.fac_id = fc.hum_id_faction
            WHERE fc.hum_id_user = :idUser
            ';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array('idUser' => $idUser));
            $results = $stmt->fetchAllAssociative();

            $entries   = array();

            foreach ($results as $row) {

                if($row['hum_id_faction'] !=1  && $row['hum_id_faction'] != 2)
                    $entries[$row['fac_nom']] = $row['hum_humeur'];
            }

            return $entries;
        }


    }
}