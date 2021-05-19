<?php


namespace App\Controller;


use App\Entity\Carte;
use App\Entity\User;
use App\Repository\CarteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class CarteController extends AbstractController
{
    private $security;
    private $em;

    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->em = $em;
    }

    public function cartedataone(Request $request)
    {
        $idPlanete=$request->query->get('idPlanete');
        $carte       = $this->em->getRepository(Carte::class);

        $myStar=$carte->getMyStar($idPlanete);
        return $this->render('carte/cartedataone.html.twig', ['myStar' => $myStar]);
    }

    public function cartedata(Request $request)
    {
        $cartes     =    $this->em->getRepository(Carte::class);
        $allStar    =    $cartes->getAllStar(0);

        return $this->render('carte/cartedata.html.twig',
            [
                'allStar'    => $allStar,
            ]);

    }



    public function ajaxcarte(Request $request)
    {

        $idPlanete	=	$request->query->get('id');
        $quid   	=	$request->query->get('quid');
        $troupe 	=	$request->query->get('troupe');
        $diplomate	=	$request->query->get('diplomate');
        $cartes     =   $this->em->getRepository(Carte::class);

        $planete    =   $cartes->getMyStar($idPlanete);

        return $this->render('carte/ajaxcarte.html.twig',
            [   'planete' => $planete,
                'quid' => $quid,
                'diplomate'  => $diplomate,
                'troupe'  => $troupe,
            ]);
    }

    public function envoiflotte(Request $request)
    {

        $idPlanete	=	$request->query->get('idPlanete');
        $action     =	$request->query->get('actionId');
        $cartes     =   $this->em->getRepository(Carte::class);
        $planete    =   $cartes->envoiVaisseau($idPlanete, $action);
            if($planete==3)
                echo 3;
            if($planete==4)
                echo 4;
            if($planete==5)
                echo 5;
        die();
    }

    public function envoidiplomate(Request $request)
    {
        $idPlanete	=	$request->query->get('idPlanete');
        $cartes     =   $this->em->getRepository(Carte::class);
            $waiting=$cartes->diplomateWait();
            if(!$waiting){
                if($cartes->verifPlaneteVierge($idPlanete)){
                    echo 3;
                }else{
                    $planete=$cartes->envoiDiplomate($idPlanete);
                    echo 1;
                }
            }else
                echo 2;
        die();
    }

    public function ajaxcarteenvoitroupe(Request $request)
    {

        $idPlanete	=	$request->query->get('id');
        $nb     	=	$request->query->get('nb');
        $cartes     =   $this->em->getRepository(Carte::class);

        $planete=$cartes->getMyStar($idPlanete);
            if($planete['cau_envoi'] >0)
                echo 1;
            elseif($planete['cau_etat']==1 ){
                if($cartes->envoiTroupe($planete['ca_id'], $nb))
                    echo 2;else return 4;
            }else
                echo 3;

        die();
    }

    public function affichetabvaisseau(Request $request)
    {

        $vaisseau= $this->em->getRepository(Carte::class);
        $myPlanetes=$vaisseau->getMyStars();
        $encoursExploration=$vaisseau->getActionVaisseau(4);//4==exploration
        $encoursAttaque=$vaisseau->getActionVaisseau(3);//3==attaque
        return $this->render('carte/affichetabvaisseau.html.twig',
            ['myPlanetes' => $myPlanetes,
             'encoursExploration' => $encoursExploration,
             'encoursAttaque'  => $encoursAttaque
            ]);
    }
}