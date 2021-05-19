<?php

namespace App\Repository;


use App\Entity\Heroesofpixel;
use App\Entity\User;
use App\Utils\Messages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;


class HeroesofpixelRepository extends ServiceEntityRepository
{
    private $security;
    private $em;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Heroesofpixel::class);
        $this->security = $security;
        $this->em = $registry;
    }

    public function checkAttribut($attribut){
        $user = $this->security->getUser();
        $heros = json_decode($user->getHeroesofpixel(), true);

        if( $attribut == 'exploration')
            $case = 8;//selon ce qu'on save quand on sort du désert
        return $heros[3][8];
    }

    public function getNbEnnemies(){
        $user = $this->security->getUser();
        $heros = json_decode($user->getHeroesofpixel(), true);

        return count($heros[0]);
    }

    public function allowBatiment($batiment){
        $user = $this->security->getUser();
        $desert = json_decode($user->getHeroesofpixel(), true);
        $heros = $desert[3];

        $batiments = $heros[14];
        $valuesBatiments = $heros[15];

        $key = array_search($batiment, $batiments);
        $valuesBatiments[$key] = 1;

        $desert[3][15] = $valuesBatiments;

        $user->setHeroesofpixel(json_encode($desert));
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();


    }

}