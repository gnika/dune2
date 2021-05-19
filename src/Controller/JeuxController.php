<?php


namespace App\Controller;
use App\Entity\Carte;
use App\Entity\Batiment;
use App\Entity\Heroesofpixel;
use App\Entity\Objet;
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
use App\Controller\BeforeController;


class JeuxController extends AbstractController implements BeforeController
{
    private $security;
    private $em;

    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->em = $em;
    }



    /**
     * @Route("/jouer", name="app_jeux")
     */
    public function index()
    {
        $user = $this->security->getUser();

        if( $this->security->getUser() == '')
            return $this->redirectToRoute('homepage');
        $perso   =    $this->em->getRepository(Personnage::class);
        $musique =    'silence.mp3';
        $nomSalle=    $perso->getSalle($user->getSalle());
        $user->setSecurityToken(1);
        $this->em->persist($user);
        $this->em->flush($user);

        return $this->render('jeux/index.html.twig',
            [
                'nomMusique_old' => $musique,
                'nomSalle'       => $nomSalle
            ]);

    }

    public function verifimpotAction()
    {

        $us      =    $this->security->getUser();
        $persos  =    $this->em->getRepository(Personnage::class);
        $quotes  =    $this->em->getRepository(Quote::class);


        if($us->getImpot() >=5)$salle=1;else $salle=3;
        //si plus tard je veux changer, rendre dynamique avec appel bdd $salle
        if($salle!=1){
            $persos->mouveSalle(5, 17);
            $persos->mouveSalle(6, 18);
            $persos->mouveSalle(7, 19);
            $persos->mouveSalle(8, 20);
        }else{
            $persos->mouveSalle(5, $salle);
            $persos->mouveSalle(6, $salle);
            $persos->mouveSalle(7, $salle);
            $persos->mouveSalle(8, $salle);
        }
    }

    public function trone()
    {
        $user    =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes  =    $this->em->getRepository(Quote::class);
        $heroes   =    $this->em->getRepository(Heroesofpixel::class);


        $checkHeros   = $heroes->checkAttribut('exploration');
        $lunette = $quotes->getMajQuete(1, 4, 1);//demande de sortir du palais

        if( $checkHeros >1 && $lunette  ){
            $quotes->majQuete(2, 4, 1);
        }

        $idSalle=1;
        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);
        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }


        $user->majSalle($idSalle);
        $this->verifimpotAction();

        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        return $this->render('jeux/trone.html.twig',
            [
                'salle'          => $nomSalle,
                'persoDansSalle' => $persoDansSalle,
                'porteDansSalle' => $porteDansSalle

            ]);
    }



    public function couloir3()
    {

        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);
        $idSalle=11;
        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);
        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        $user->majSalle($idSalle);

        return $this->render('jeux/couloir3.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle
            ]);
    }

    public function couloir4()
    {

        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);

        $idSalle=16;
        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);
        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        $user->majSalle($idSalle);

        return $this->render('jeux/couloir4.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle
            ]);
    }

    public function couloir()
    {
        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);
        $idSalle=2;

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);
        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        $user->majSalle($idSalle);

        return $this->render('jeux/couloir.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle
            ]);
    }



    public function barfond()
    {
        $idSalle=21;
        $user    =    $this->em->getRepository(User::class);
        $persoCuisine   =    $this->em->getRepository(Personnage::class);
        $quotes  =    $this->em->getRepository(Quote::class);

        $nomMusique_old=$persoCuisine->getMusiqueSalle();
        $nomMusique=$persoCuisine->getMusiqueSalle($idSalle);
        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persoCuisine->getSalle($idSalle);

        $user->majSalle($idSalle);

        $fum=$quotes->getMajQuete(1, 17, 1);
        if(!$fum)
            $fum=$quotes->getMajQuete(4, 17, 1);

        return $this->render('jeux/barfond.html.twig',
            [
                'salle'             => $nomSalle,
                'fumee'    => $fum,
            ]);

    }

    public function bar()
    {
        $idSalle=13;
        $user    =    $this->em->getRepository(User::class);
        $persoCuisine   =    $this->em->getRepository(Personnage::class);
        $quotes  =    $this->em->getRepository(Quote::class);

        $nomMusique_old=$persoCuisine->getMusiqueSalle();
        $nomMusique=$persoCuisine->getMusiqueSalle($idSalle);
        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persoCuisine->getSalle($idSalle);
        $persoDansSalle=$persoCuisine->getPersonnages($idSalle);
        $porteDansSalle=$persoCuisine->getPortes($idSalle);

        $user->majSalle($idSalle);

        $getMaj=$quotes->getMajQuete(1,17,0);
        $pendu = 0;
        if($getMaj)
            $pendu=1;


        return $this->render('jeux/bar.html.twig',
            [
                'salle'          => $nomSalle,
                'pendu'          => $pendu,
                'persoDansSalle' => $persoDansSalle,
                'porteDansSalle' => $porteDansSalle

            ]);

    }

    public function couloir2()
    {
        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);
        $quotes  =    $this->em->getRepository(Quote::class);
        $idSalle=8;

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);
        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        $user->majSalle($idSalle);

        return $this->render('jeux/couloir2.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle
            ]);
    }

    public function chambre1()
    {
        $idSalle=17;

        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);

        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);

        $user->majSalle($idSalle);


        return $this->render('jeux/chambre1.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
            ]);
    }

    public function chambre2()
    {
        $idSalle = 18;
        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);

        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);

        $quotes  =    $this->em->getRepository(Quote::class);
        //si docs brulés
        $docBrules = $quotes->getMajQuete(4, 30, 3);

        $user->majSalle($idSalle);


        return $this->render('jeux/chambre2.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
            ]);
    }



    public function openindice()
    {
        $idSalle=22;
        $us  =    $this->security->getUser();
        $persos  =    $this->em->getRepository(Personnage::class);
        $user  =    $this->em->getRepository(User::class);

        $nomSalle=$persos->getSalle($idSalle);


        return $this->render('jeux/openindice.html.twig',
            [
                'salle'             => $nomSalle,
                'salleU'             => $persos->getSalle($us->getSalle()),
            ]);
    }

    public function bureaucachot()
    {
        $idSalle=38;

        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        return $this->render('jeux/bureaucachot.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle
            ]);
    }

    public function couloircachot()
    {
        $idSalle=37;
        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);
        $quotes  =    $this->em->getRepository(Quote::class);

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        $return =$quotes->getMajQuete(1,27,9);
        $rat =$quotes->getMajQuete(1,27,2);
        $ratMort =$quotes->getMajQuete(2,27,2);

        if( $return ) $return = 1; else $return = 0;
        if( $rat ) $rat = 1; else $rat = 0;
        if( $ratMort ) $ratMort = 1; else $ratMort = 0;

        return $this->render('jeux/couloircachot.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
                'return'            => $return,
                'ratMort'           => $ratMort,
                'rat'           => $rat
            ]);
    }

    public function cellule()
    {
        $idSalle=39;
        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);
        $quotes  =    $this->em->getRepository(Quote::class);

        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);
        $return= $quotes->getMajQuete(1,28,9);//si la porte de serrure a déjà été explosée
        if( $return ) $return = 1; else $return = 0;
        $user->majSalle($idSalle);


        return $this->render('jeux/cellule.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
                'return'    => $return
            ]);
    }

    public function chambre3()
    {
        $idSalle=19;
        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);

        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);

        $user->majSalle($idSalle);


        return $this->render('jeux/chambre3.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
            ]);
    }

    public function chambre4()
    {
        $idSalle=20;

        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);

        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);

        $user->majSalle($idSalle);


        return $this->render('jeux/chambre4.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
            ]);
    }

    public function magasinpalais()
    {
        $idSalle=10;

        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes   =    $this->em->getRepository(Quote::class);
        $heroes   =    $this->em->getRepository(Heroesofpixel::class);

        $objetsDesert = $heroes->findAll();


        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        $tournevis=$quotes->getMajQuete(9, 18, 1);
        $reacteur=$quotes->getQuesteGlobal(21, 1);
        $boussole=$quotes->getMajQuete(6, 16, 1);
        if(!$reacteur)$reacteur=0;else $reacteur=1;
        if(!$tournevis)$tournevis=0;else $tournevis=1;
        if(!$boussole)$boussole=1;else $boussole=0;

        return $this->render('jeux/magasinpalais.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
                'tournevis'         => $tournevis,
                'reacteur'          =>  $reacteur,
                'objetsDesert'      =>  $objetsDesert,
                'boussole'          => $boussole

            ]);
    }



    public function commune()
    {

        $idSalle=9;

        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes   =    $this->em->getRepository(Quote::class);


        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        $user->majSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);

        $planeteGuilde=$quotes->getMajQuete(4,7,1);//si commandant a dit planète appartient à la guilde
        if($planeteGuilde)
            $persos->mouveSalle(23, $idSalle);

        $nop=0;
        $nopEntree = 0;
        $encoursFirst    = $quotes->getQuesteGlobal(4,1);//Premiere quete en cours
        $firstAc         = $quotes->getMajQuete(1,2,0);
        $firstAc2        = $quotes->getMajQuete(1,4,0);
        if(!$firstAc || !$firstAc2)
            $nop=1;
        if( $encoursFirst)
            $nopEntree = 1;
        $user->majSalle($idSalle);

        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        return $this->render('jeux/commune.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
                'nop'               => $nop,
                'nopEntree'         => $nopEntree

            ]);
    }

    public function bibliotheque()
    {
        $idSalle=12;

        $us       =    $this->security->getUser();
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes   =    $this->em->getRepository(Quote::class);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $mapgetbene=$quotes->getMajQuete(1,15,1);//si soeur_1 a donné rdv biblio
        $danseurVisageTrouve=$quotes->getMajQuete(1,17,0);
        if($mapgetbene)
            $persos->mouveSalle(15, $idSalle);


        $user->majSalle($idSalle);
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        $renom=$us->getRenommee();
        if($danseurVisageTrouve && $renom >=500)
            $vol=1;
        else
            $vol='';
        return $this->render('jeux/bibliotheque.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
                'vol'               => $vol

            ]);
    }

    public function arbre(Request $request)
    {
        $idSalle=40;

        $us       =    $this->security->getUser();
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes   =    $this->em->getRepository(Quote::class);
        $bat           =    $this->em->getRepository(Batiment::class);




        $user->majSalle($idSalle);
        $malkiKilled = $quotes->getMajQuete(3, 31, 2);
        if($malkiKilled){
            $malkiKilled =1;
            $quotes->majQuete(4, 31, 2);
        }else $malkiKilled=0;

        $docs = $persos->getObjet(28);
        if( $docs)
            $persos->mouveSalle(29, $idSalle);
        else
            $persos->mouveSalle(29, 999);


        $malkiKilled2 = $quotes->getMajQuete(4, 31, 2);
        $malkiKilled3 = $quotes->getMajQuete(5, 31, 2);
        if( $malkiKilled || $malkiKilled2 || $malkiKilled3) {
            $persos->mouveSalle(29, 999);
            $malkiKilled = 1;
        }

        $heroesofpixel =    $request->get('heroesofpixel');
        $batiments     =    $request->get('batiments');



        if( $heroesofpixel ) {//s'il revient du desert
            $us->setHeroesOfPixel($heroesofpixel);
            $this->em->persist($us);
            $this->em->flush();
            $bat->saveBatiments($batiments);

        }


        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }


        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);

        return $this->render('jeux/arbre.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'malkiKilled'       => $malkiKilled

            ]);
    }

    public function chambrepolitique(Request $request)
    {
        $idSalle=41;

        $us       =    $this->security->getUser();
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes   =    $this->em->getRepository(Quote::class);
        $bat           =    $this->em->getRepository(Batiment::class);

        $user->majSalle($idSalle);


        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }

        $openSafe = $quotes->getMajQuete(2, 30, 3);//coffre deja ouvert avec la clé
        $openSafeLaser = $quotes->getMajQuete(3, 30, 3);//coffre deja ouvert au laser
        $openSafeLaserDocPris = $quotes->getMajQuete(4, 30, 3);//coffre deja ouvert au laser
        if(!$openSafe && !$openSafeLaser && !$openSafeLaserDocPris)
            $openSafe=0;else $openSafe=1;


        if($openSafeLaser)$docBrule =1;else $docBrule=0;
        if($openSafeLaserDocPris)$docpris =1;else $docpris=0;

        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        //si possede les documents on ne les affiche plus
        $docs = $persos->getObjet(28);
        if( $docs) $docs = 1; else $docs = 0;

        return $this->render('jeux/chambrepolitique.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'openSafe'          => $openSafe,
                'docs'              => $docs,
                'docBrule'          => $docBrule,
                'docpris'           => $docpris

            ]);
    }

    public function prisonvillage(Request $request)
    {
        $idSalle=42;

        $us       =    $this->security->getUser();
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes   =    $this->em->getRepository(Quote::class);
        $bat      =    $this->em->getRepository(Batiment::class);

        $user->majSalle($idSalle);


        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }


        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);

        return $this->render('jeux/prisonvillage.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,

            ]);
    }

    public function diplomate()
    {

        $idSalle=7;
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $cartes   =    $this->em->getRepository(Carte::class);

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);
        $debrief=$cartes->diplobriefing();

        return $this->render('jeux/diplomate.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
                'debrief'           => $debrief,
            ]);
    }

    public function hangar()
    {
        $idSalle=6;

        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quetes   =    $this->em->getRepository(Quote::class);

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);
        $indice=$quetes->getMajQuete(4, 6, 1);
        if(!$indice)$indice=0;else $indice=1;

        return $this->render('jeux/hangar.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
                'indice'           => $indice,
            ]);
    }

    public function entree()
    {
        $idSalle=14;
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes   =    $this->em->getRepository(Quote::class);

        $nomMusique_old=$persos->getMusiqueSalle();

        $nop=0;
        $firstAc=$quotes->getMajQuete(1,2,0);
        $firstAc2=$quotes->getMajQuete(1,4,0);
        if(!$firstAc || !$firstAc2)
            $nop=1;
        $user->majSalle($idSalle);

        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);

        return $this->render('jeux/entree.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'nop'               => $nop
            ]);
    }



    public function representants()
    {
        $idSalle=15;

        $user  =    $this->em->getRepository(User::class);
        $persos  =    $this->em->getRepository(Personnage::class);

        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        $user->majSalle($idSalle);


        return $this->render('jeux/representants.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle
            ]);

    }

    public function marches(Request $request)
    {
        $idSalle=23;
        $heroesofpixel =    $request->get('heroesofpixel');
        $batiments     =    $request->get('batiments');

        $user          =    $this->em->getRepository(User::class);
        $persos        =    $this->em->getRepository(Personnage::class);
        $quete         =    $this->em->getRepository(Quote::class);
        $us            =    $this->security->getUser();
        $bat           =    $this->em->getRepository(Batiment::class);


        if( $heroesofpixel ) {//s'il revient du desert
            $us->setHeroesOfPixel($heroesofpixel);
            $this->em->persist($us);
            $this->em->flush();
            $bat->saveBatiments($batiments);

        }
        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $user->majSalle($idSalle);
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);
        $politologue = 0;

        if( $quete->getMajQuete(1, 24, 2 )){    //vient d'acheter le depierre
            $politologue = 256;
        }
        if( $quete->getMajQuete(2, 24, 2 )){
            $politologue = 257;
        }

        return $this->render('jeux/marches.html.twig',
        [
            'salle'             => $nomSalle,
            'persoDansSalle'    => $persoDansSalle,
            'politologue'       => $politologue
        ]);
    }

    public function village1(Request $request)
    {
        $idSalle=24;

        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quetes   =    $this->em->getRepository(Quote::class);
        $us            =    $this->security->getUser();
        $bat           =    $this->em->getRepository(Batiment::class);

        $heroesofpixel =    $request->get('heroesofpixel');
        $batiments     =    $request->get('batiments');


        if( $heroesofpixel ) {//s'il revient du desert
            $us->setHeroesOfPixel($heroesofpixel);
            $this->em->persist($us);
            $this->em->flush();
            $bat->saveBatiments($batiments);

        }

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        return $this->render('jeux/village1.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
            ]);
    }

    public function village2()
    {
        $idSalle=25;

        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        return $this->render('jeux/village2.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
            ]);
    }

    public function village3()
    {
        $idSalle=26;

        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        return $this->render('jeux/village3.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
            ]);
    }

    public function village4(Request $request)
    {
        $idSalle=33;
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes   =    $this->em->getRepository(Quote::class);
        $returnBoussole	=	$request->get('returnBoussole');

        $us       = $this->security->getUser();

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);


        $traitr=$persos->getPersonnage(19);
        if($traitr['tarhani']['pers_salle']==27)
            $persos->mouveSalle(19, 99);


        if($returnBoussole)
            $user->majEntretien();

        if($us->getEntretien() != '0' && !$returnBoussole){
            $user->majSalle(28);

            ?>
            <script>
                location.reload();
                var request = jQuery.ajax({
                    url: '/desert2',
                    type: "GET"
                });
                request.done(function(msg) {
                    jQuery("#inThePlace").html(msg);
                });
            </script>
            <?php
        }

        $distille=$persos->getObjet(8);
        if($distille)$distille=1;else $distille=0;
        $persoDansSalle=$persos->getPersonnages($idSalle);

        return $this->render('jeux/village4.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
                'distille'          => $distille,
            ]);
    }

    public function habitat1()
    {

        $idSalle=34;

        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        return $this->render('jeux/habitat1.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
            ]);
    }

    public function desert1()
    {
        $idSalle=27;
        $nb = rand(0,6);
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes   =    $this->em->getRepository(Quote::class);
        $us       = $this->security->getUser();

        $user->majSalle($idSalle);

        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($us->getEntretien()=='0,1'){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);


        $user->majEntretien(1);
        $userUpdated = $user->getUserUpdated();
        $expl=$userUpdated['cuu_entretien'];

        $traitr=$quotes->getMajQuete(5, 6, 1);

        if($traitr && $expl=='0,2,2,3,2,2,1,1'){

            $persos->mouveSalle(19, $idSalle);
            $traitr2=$quotes->getMajQuete(1, 19, 1);
            if(!$traitr2)
                $traitr=$quotes->majQuete(1, 19, 1);
        }


        $persoDansSalle=$persos->getPersonnages($idSalle);

        return $this->render('jeux/desert1.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
                'nb'    => $nb,
            ]);
    }

    public function desert2()
    {
        $idSalle=28;
        $nb = rand(0,6);
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes   =    $this->em->getRepository(Quote::class);
        $us       = $this->security->getUser();
        $user->majEntretien(2);

        $user->majSalle($idSalle);

        $nomMusique=$persos->getMusiqueSalle($idSalle);

        $nomSalle=$persos->getSalle($idSalle);

        if($us->getEntretien()=='0,2'){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }


        $siona=$quotes->getMajQuete(2, 24, 1);
        $siona=1;

        $expl=$us->getEntretien();


        if($siona && $expl=='0,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2'){
            $persos->mouveSalle(25, $idSalle);
        }

        $persoDansSalle=$persos->getPersonnages($idSalle);
        return $this->render('jeux/desert2.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'nb'    => $nb,
            ]);
    }

    public function desert3()
    {
        $idSalle=29;
        $nb = rand(0,6);
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $quotes   =    $this->em->getRepository(Quote::class);
        $us       = $this->security->getUser();

        $user->majEntretien(3);
        $nomMusique=$persos->getMusiqueSalle($idSalle);
        if($us->getEntretien()=='0,3'){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);

        return $this->render('jeux/desert3.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'nb'                => $nb
            ]);

    }

    public function siaynoq()
    {
        $idSalle=35;
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);

        return $this->render('jeux/siaynoq.html.twig',
            [
                'salle'             => $nomSalle
            ]);
    }

    public function vaisseaux()
    {

        $idSalle=3;
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);

        return $this->render('jeux/vaisseaux.html.twig',
            [
                'salle'             => $nomSalle,
                'persoDansSalle'    => $persoDansSalle,
                'porteDansSalle'    => $porteDansSalle,
            ]);
    }

    public function carte()
    {
        $idSalle=5;
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $cartes   =    $this->em->getRepository(Carte::class);

        $user->majSalle($idSalle);

        $nomMusique_old=$persos->getMusiqueSalle();
        $nomMusique=$persos->getMusiqueSalle($idSalle);

        if($nomMusique_old!=$nomMusique){
            ?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
        }
        $nomSalle=$persos->getSalle($idSalle);
        $persoDansSalle=$persos->getPersonnages($idSalle);
        $porteDansSalle=$persos->getPortes($idSalle);
        $myPlanetes=$cartes->getMyStars();
        $encoursExploration=$cartes->getActionVaisseau(4);//4==exploration
        $encoursAttaque=$cartes->getActionVaisseau(3);//3==attaque

        return $this->render('jeux/carte.html.twig',
            [
                'salle'              => $nomSalle,
                'persoDansSalle'     => $persoDansSalle,
                'porteDansSalle'     => $porteDansSalle,
                'encoursExploration' => $encoursExploration,
                'encoursAttaque'     => $encoursAttaque,
                'myPlanetes'         => $myPlanetes,
            ]);
    }

    public function cartezoom1data()
    {

        $cartes   =    $this->em->getRepository(Carte::class);
        $us       = $this->security->getUser();

        $allStar= $cartes->getAllStar(1);

        return $this->render('jeux/cartezoom1data.html.twig',
            [
                'allStar'             => $allStar
            ]);
    }

    public function cartezoom2data()
    {
        return $this->render('jeux/cartezoom2data.html.twig',
            [
            ]);
    }

    public function indice()
    {
        $idSalle=22;

        $us     =    $this->security->getUser();
        $persos   =    $this->em->getRepository(Personnage::class);

        $salleU=$us->getSalle();
        $nomSalleU=$persos->getSalle($salleU);
        $nomSalle=$persos->getSalle($idSalle);

        return $this->render('jeux/indice.html.twig',
            [
                'salle'             => $nomSalle,
                'nomSalleU'    => $nomSalleU
            ]);
    }

    public function documents()
    {
        $idSalle=43;
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);


        $us     =    $this->security->getUser();
        $persos   =    $this->em->getRepository(Personnage::class);

        $salleU=$us->getSalle();
        $nomSalleU=$persos->getSalle($salleU);
        $nomSalle=$persos->getSalle($idSalle);

        return $this->render('jeux/documents.html.twig',
            [
                'salle'             => $nomSalle,
                'nomSalleU'    => $nomSalleU
            ]);
    }

    public function tableaubord()
    {
        $user    =    $this->em->getRepository(User::class);
        $iIx=$user->getInfluenceFaction(5);
        $sIx=$user->getServiteurFaction(5);
        $eIx=$user->getEscorteFaction(5);

        $iGu=$user->getInfluenceFaction(6);
        $sGu=$user->getServiteurFaction(6);
        $eGu=$user->getEscorteFaction(6);

        $iTl=$user->getInfluenceFaction(4);
        $sTl=$user->getServiteurFaction(4);
        $eTl=$user->getEscorteFaction(4);

        $iBe=$user->getInfluenceFaction(3);
        $sBe=$user->getServiteurFaction(3);
        $eBe=$user->getEscorteFaction(3);

        $inf=$user->getInfluenceFaction();
        $ser=$user->getServiteurFaction();
        $esc=$user->getEscorteFaction();

        $suggIx=$user->getSuggestionFaction(5);
        $suggGu=$user->getSuggestionFaction(6);
        $suggTl=$user->getSuggestionFaction(4);
        $suggBe=$user->getSuggestionFaction(3);

        return $this->render('jeux/tableaubord.html.twig',
            [
                'iIx'            => $iIx,
                'sIx'            => $sIx,
                'eIx'            => $eIx,
                'iGu'            => $iGu,
                'sGu'            => $sGu,
                'eGu'            => $eGu,
                'iTl'            => $iTl,
                'sTl'            => $sTl,
                'eTl'            => $eTl,
                'iBe'            => $iBe,
                'sBe'            => $sBe,
                'eBe'            => $eBe,
                'inf'            => $inf,
                'ser'            => $ser,
                'esc'            => $esc,

                'suggIx'            => $suggIx,
                'suggGu'            => $suggGu,
                'suggTl'            => $suggTl,
                'suggBe'            => $suggBe,

            ]);

    }

    public function perdu(){
        $idSalle=44;
        $user     =    $this->em->getRepository(User::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $heroes   =    $this->em->getRepository(Heroesofpixel::class);
        $us       =    $this->security->getUser();

        $user->majSalle($idSalle);


        $nbEnnemis = $heroes->getNbEnnemies();
        $nomSalle=$persos->getSalle($idSalle);

        return $this->render('jeux/perdu.html.twig',
            [
                'salle'             => $nomSalle,
                'nbEnnemis'         => $nbEnnemis
            ]);
    }

    public function heroespixel(){

        return $this->render('heroesofpixel/heroesofpixel.html.twig');
    }
}