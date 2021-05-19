<?php

namespace App\Utils;


use App\Entity\Personnage;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class Functions
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    public function setObject($idObjet, $display=null)
    {
        $perso = $this->em->getRepository(Personnage::class);
        $perso->addObjet($idObjet);
        if(!$display){
            echo "<script>recompenseDisplay('<tr><td>Vous avez reçu un objet</td></tr>');</script>";
            echo "<script>afficheObject();</script>";
        }
    }

    public function setCorruption($nb=1, $display=null)
    {
        $us = $this->security->getUser();
        $set=$us->getCorruption()+$nb;
        $us->setInfluence($set);
        $this->em->persist($us);
        $this->em->flush();
        if(!$display)
            echo "<script>recompenseDisplay('<tr><td>Votre corruption augmente</td></tr>');</script>";
    }
}
