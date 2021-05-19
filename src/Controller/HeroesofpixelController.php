<?php


namespace App\Controller;
use App\Entity\Heroesofpixel;
use App\Entity\HumeurFaction;
use App\Entity\Personnage;
use App\Entity\Quote;
use App\Entity\User;
use App\Utils\Messages;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HeroesofpixelController extends AbstractController
{
    private $security;
    private $em;

    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->em = $em;
    }

    public function getsave(){
        $us = $this->security->getUser();
        echo $us->getHeroesOfPixel();
        die();
    }

    public function payeheroes(Request $request){

        $user = $this->security->getUser();

        $ajout      = $request->query->get('ajout');
        if( $ajout == 1){
            $epice = $user->getEpice() + $request->query->get('epice');
            $renommee = $user->getRenommee() + $request->query->get('renommee');
            $eau = $user->getEau() + $request->query->get('eau');
            $credit = $user->getCredit() + $request->query->get('credit');
            $troupe = $user->getTroupe() + $request->query->get('troupe');

        }else {
            $epice = $user->getEpice() - $request->query->get('epice');
            $renommee = $user->getRenommee() ;//On ne peut pas perdre de renommee
            $eau = $user->getEau() - $request->query->get('eau');
            $credit = $user->getCredit() - $request->query->get('credit');
            $troupe = $user->getTroupe() - $request->query->get('troupe');
        }

        if( $epice < 0)
            $epice = 0;
        if( $renommee < 0)
            $renommee = 0;
        if( $eau < 0)
            $eau = 0;
        if( $credit < 0)
            $credit = 0;
        if( $troupe < 0)
            $troupe = 0;
        $user->setEpice( $epice);
        $user->setRenommee( $renommee);
        $user->setEau(  $eau );
        $user->setCredit(  $credit );
        $user->setTroupe(  $troupe );


        $this->em->persist($user);
        $this->em->flush();
        echo sprintf("%05d",$epice).' ::: '.sprintf("%04d",$renommee).' ::: '.sprintf("%04d",$eau).' ::: '.sprintf("%04d",$credit).' ::: '.sprintf("%04d",$troupe);
        die();
    }

    public function achatheroes( Request $request)
    {
        $users   = $this->em->getRepository(User::class);
        $user = $this->security->getUser();
        $idOb      = $request->query->get('idOb');
        $objets    = $this->em->getRepository(Heroesofpixel::class);
        $quetes    = $this->em->getRepository(Quote::class);
        $objet     = $objets->find($idOb);
        $carte     = json_decode($user->getHeroesofpixel(), true);
        $prix      = json_decode($objet->getPrix());
        $error     = 0;

        if( (isset($prix->credit) && $prix->credit > $user->getCredit()) ||
            (isset($prix->eau) && $prix->eau > $user->getEau()) ||
            (isset($prix->epice) && $prix->epice > $user->getEpice()) )
            $error = 1;

        if($error == 1){
            Messages::setWarningMessage('Vous ne possédez pas assez de ressource pour faire cet achat !');
        }
        else {

            if( isset($prix->credit))
                $users->majEpice(-$prix->credit);

            if( isset($prix->eau))
                $users->majEau(-$prix->eau);

            if( isset($prix->credit))
                $users->majCredit(-$prix->credit);

            if ($objet->getType() == 'equipe') {
                $name = $objet->getNom();
                if( $name == 'depierre' ){//PREMIERE FOIS QU'ON ACHETE DEPIERRE CONVOQUE
                    $dejaAchete = $quetes->getQuesteGlobal(24, 2);
                    if( !$dejaAchete)
                        $quetes->majQuete( 1, 24, 2);
                }
                $objsActuels = $carte[3];
                $objVoulu = array_search($name, $objsActuels[12], true);
                $carte[3][13][$objVoulu]['possession'] = 1;
                $carte[3][13][$objVoulu]['life'] = 100;
            }
            if ($objet->getType() == 'artefact') {
                $name = $objet->getNom();
                $carte[3][9][] = $name;
            }

            Messages::setSuccessMessage('Vous pourrez voir votre achat lorsque vous sortirez hors du palais');
            $user->setHeroesofpixel(json_encode($carte));
            $this->em->persist($user);
            $this->em->flush();
        }


        die();

    }


}