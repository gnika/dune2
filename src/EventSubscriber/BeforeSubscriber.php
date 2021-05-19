<?php

namespace App\EventSubscriber;

use App\Controller\BeforeController;
use App\Utils\Messages;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RequestStack;


class BeforeSubscriber extends AbstractController implements EventSubscriberInterface
{
    private $security;
    private $requestStack;


    public function __construct(Security $security, RequestStack $requestStack)
    {
        $this->security = $security;
        $this->requestStack = $requestStack;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        // when a controller class defines multiple action methods, the controller
        // is returned as [$controllerInstance, 'methodName']
        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if ($controller instanceof BeforeController) {
            $session = new Session();
            if( $this->security->getUser() != '') {
                if ($this->security->getUser()->getImpot() >= 5) {
                    $request = $this->requestStack->getCurrentRequest();
                    $router = $this->get("router");
                    $route = $router->match($request->getPathInfo());

                    $redirect = $session->get('redirect');

                    if ($redirect != 'once') {

                        if (
                            $route['_route'] != 'trone' &&
                            $route['_route'] != 'desert1' &&
                            $route['_route'] != 'desert2' &&
                            $route['_route'] != 'desert3' &&
                            $route['_route'] != 'cellule' &&
                            $route['_route'] != 'village1' &&
                            $route['_route'] != 'village2' &&
                            $route['_route'] != 'village3' &&
                            $route['_route'] != 'village4' &&
                            $route['_route'] != 'marches' &&
                            $route['_route'] != 'app_jouer' &&
                            $route['_route'] != 'arbre' &&
                            $route['_route'] != 'habitat1' &&
                            $route['_route'] != 'prison_village' &&
                            $route['_route'] != 'tableaubord') {

                            $session->set('redirect', 'once');
                            Messages::setSuccessMessage("La cérémonie du partage d'épice commence. Vous êtes redirigé en salle du trône");
                            $response = $this->forward('App\Controller\JeuxController::trone');
                            echo $response->getContent();
                            die();

                        }
                    } else
                        $session->remove('redirect');

                    //print_r($request->query->all());die();recupere l'url
                    //return $this->redirectToRoute('trone', $request->query->all());
                    //print_r($request->getUri());die();
                }
            }else{
                $redirect = $session->get('redirect');
                if ($redirect != 'once') {
                    $session->set('redirect', 'once');
                    $response = $this->forward('App\Controller\JeuxController::index');
                    echo $response->getContent();
                    die();
                }else
                    $session->remove('redirect');
            }

        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}