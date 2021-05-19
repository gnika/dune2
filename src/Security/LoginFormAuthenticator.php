<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_homepage';

    private $entityManager;
    private $urlGenerator;
    private $csrfTokenManager;

    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function supports(Request $request)
    {
        return self::LOGIN_ROUTE === $request->attributes->get('_route')  && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
            'load' => $request->request->get('load'),
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['username']
        );

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $credentials['username']]);

        if (!$user) {

            if( $credentials['load'] == 'load'){//SI ON CHARGE UNE PARTIE, LE USER NE SE CREE PAS
                throw new CustomUserMessageAuthenticationException("Le numéro de session n'est pas bon.");
            }
            else {

                $user = new User();
                $user->setUsername($credentials['username']);
                $user->setName($credentials['username']);
                $user->setEmail($credentials['username']);
                $user->setPassword($credentials['username']);
                $user->setEntretien(0);
                $user->setEntrainement(0);
                $user->setValeurTroupe(0);
                $user->setSecuritytoken('');
                $user->setHeure(1);
                $user->setVaisseau(15);
                $user->setJour(0);
                $user->setTroupe(1000);
                $user->setEpice(4000);
                $user->setEau(0);
                $user->setCredit(0);
                $user->setCorruption(0);
                $user->setImpot(3);
                $user->setSalle(1);
                $user->setSoin(0);
                $user->setRenommee(0);
                $user->setServiteur(4);
                $user->setNbVictime(2);//ajout d'attentats plus fort si besoin
                $user->setInfluence(2);
                $user->setValeurServiteur(30);
                $user->setGardien(4);
                $user->setDelaiAttentat(3);
                $user->setValeurVaisseau(100);
                $user->setExploration(1);
                $user->setObjets('');
                $user->setRapport('');
                $user->setConnexion(date('d-m-Y H:i'));
                $user->setHeroesofpixel('');
                $user->setRoles(["ROLE_USER"]);//ne veut pas ???

                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $userId = $user->getId();
                $this->entityManager->getRepository(User::class)->inscription($userId);
            }

        }

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;//check uniquement le login pas besoin de check le password
        // Check the user's password or other credentials and return true or false
        // If there are no credentials to check, you can just return true
        throw new \Exception('TODO: check the credentials inside '.__FILE__);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }
        return new RedirectResponse($this->urlGenerator->generate('app_jeux'));
        // For example : return new RedirectResponse($this->urlGenerator->generate('some_route'));
        throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
