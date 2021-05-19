<?php


namespace App\Controller;
use App\Entity\HumeurFaction;
use App\Entity\Personnage;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{

    private $security;
    private $em;

    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->em = $em;
    }

    public function infohumeur()
    {

        $humeurFaction       = $this->em->getRepository(HumeurFaction::class);
        $humeurs    =$humeurFaction->getHumeurFaction();
        $count      =count($humeurs);

        return $this->render('user/_infohumeur.html.twig', ['humeurs' => $humeurs, 'count' => $count]);
    }

    public function objectsuser()
    {

        $perso = $this->em->getRepository(Personnage::class);
        $objects =$perso->getAllObjet();

        return $this->render('user/_objectsuser.html.twig', ['myObjects' => $objects]);
    }

    public function inforessourcesuser()
    {

        return $this->render('user/_inforessourcesuser.html.twig');
    }

    public function jours()
    {

        return $this->render('user/_jours.html.twig');
    }

    public function tryagain()
    {
//pas complet remettre les quêtes et objets à 0 aussi
        $user=$this->security->getUser();

        $user->setHeure(1); $user->setVaisseau(15);
        $user->setJour(0); $user->setTroupe(1000);
        $user->setEpice(4000);$user->setCredit(0);
        $user->setEau(0); $user->setCorruption(0);
        $user->setImpot(3); $user->setSalle(1);
        $user->setSoin(0); $user->setRenommee(0);
        $user->setServiteur(2);$user->setNbVictime(2);
        $user->setInfluence(2);$user->setValeurServiteur(30);
        $user->setGardien(4);$user->setDelaiAttentat(3);
        $user->setValeurVaisseau(100);$user->setExploration(1);
        $user->setObjets('');
        $user->setRapport('');
        $user->setHeroesofpixel('');

        $this->em->persist($user);
        $this->em->flush();


        $this->em->getRepository(User::class)->inscription($user->getId());
        die();
    }
}