<?php


namespace App\Controller;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/", name="app_homepage")
     */
    public function index( AuthenticationUtils $helper)
    {

        return $this->render('default/home.html.twig', ['error' => $helper->getLastAuthenticationError()]);

    }
    /**
     * @Route("/tuto", name="app_tuto")
     */
    public function tuto()
    {
        return $this->render('default/tuto.html.twig');

    }
    /**
     * @Route("/aidequetes", name="app_aidequetes")
     */
    public function aidequetes()
    {
        return $this->render('default/aidequetes.html.twig');

    }
    /**
     * @Route("/remerciements", name="app_remerciements")
     */
    public function remerciements()
    {
        return $this->render('default/remerciements.html.twig');

    }
    /**
     * @Route("/univers", name="app_univers")
     */
    public function univers()
    {
        return $this->render('default/univers.html.twig');

    }
    /**
     * @Route("/policy", name="app_policy")
     */
    public function policy()
    {
        return $this->render('default/policy.html.twig');

    }
    /**
     * @Route("/resume", name="app_resume")
     */
    public function resume()
    {
        return $this->render('default/resume.html.twig');

    }
    /**
     * @Route("/gesserit", name="app_gesserit")
     */
    public function gesserit()
    {
        return $this->render('default/gesserit.html.twig');

    }
    /**
     * @Route("/ix", name="app_ix")
     */
    public function ix()
    {
        return $this->render('default/ix.html.twig');

    }
    /**
     * @Route("/paul", name="app_paul")
     */
    public function paul()
    {
        return $this->render('default/paul.html.twig');

    }
    /**
     * @Route("/aide1", name="app_aide1")
     */
    public function aide1()
    {
        return $this->render('default/aide1.html.twig');

    }
    /**
     * @Route("/aide2", name="app_aide2")
     */
    public function aide2()
    {
        return $this->render('default/aide2.html.twig');

    }
    /**
     * @Route("/aide3", name="app_aide3")
     */
    public function aide3()
    {
        return $this->render('default/aide3.html.twig');

    }
    /**
     * @Route("/aide4", name="app_aide4")
     */
    public function aide4()
    {
        return $this->render('default/aide4.html.twig');

    }
    /**
     * @Route("/aide5", name="app_aide5")
     */
    public function aide5()
    {
        return $this->render('default/aide5.html.twig');

    }
    /**
     * @Route("/tleilax", name="app_tleilax")
     */
    public function tleilax()
    {
        return $this->render('default/tleilax.html.twig');

    }
    /**
     * @Route("/guilde", name="app_guilde")
     */
    public function guilde()
    {
        return $this->render('default/guilde.html.twig');

    }
    /**
     * @Route("/epice", name="app_epice")
     */
    public function epice()
    {
        return $this->render('default/epice.html.twig');

    }
    /**
     * @Route("/contexte", name="app_contexte")
     */
    public function contexte()
    {
        return $this->render('default/contexte.html.twig');

    }
    /**
     * @Route("/personnages", name="app_personnages")
     */
    public function personnages()
    {
        return $this->render('default/personnages.html.twig');

    }
    /**
     * @Route("/conquete", name="app_conquete")
     */
    public function conquete()
    {
        return $this->render('default/conquete.html.twig');

    }
    /**
     * @Route("/sendemail", name="app_sendemail")
     */
    public function sendemail(Request $request)
    {
        $email	=	$request->get('email');
        $name	=	$request->get('name');
        $message	=	$request->get('message');

        $to      = 'moneo.house.atreides@gmail.com';

        $subject = 'formulaire de contact de dune';
        $message = "j'ai reçu cet email du site dune empereur :<br/> de la part de : ".$name."<br/> email : ".$email."<br/> message : ".nl2br($message);
        $message.= '<HR/> le FROM du mail n\'est PAS celui qui a envoyé l\'email.';


        $headers = "From: mail-out.cluster003.hosting.ovh.net\r\n";
        $headers .= "Reply-To: ". strip_tags($email) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


        if( mail($to, $subject, $message, $headers))
            echo 'email envoyé avec succès';
        else
            echo 'Nous ne sommes pas parvenu à envoyer votre message';
        die();

    }

    public function deletejoueur(Request $request)
    {

        $user       = $this->em->getRepository(User::class);
        if($request->query->get('id')!=''){
            $params= explode(',', $request->query->get('id'));
            foreach($params as $param){
                $user->desinscription($param);
            }
        }

        $users = $user->findAll();
        return $this->render('default/deletejoueur.html.twig', [
            'tableUser' => $users,
            'count' => count($users)
        ]);


    }


}