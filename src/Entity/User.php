<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */



    /**
     * @var string
     *
     * @ORM\Column(name="cuu_password", type="string", length=211, nullable=false)
     */
    private $cuuPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_name", type="string", length=211, nullable=false)
     */
    private $cuuName;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_email", type="string", length=211, nullable=false)
     */
    private $cuuEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_securitytoken", type="string", length=255, nullable=false)
     */
    private $cuuSecuritytoken;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_heure", type="string", length=8, nullable=false)
     */
    private $heure;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_jour", type="integer", nullable=false)
     */
    private $jour;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_epice", type="float", precision=10, scale=0, nullable=false)
     */
    private $epice;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_eau", type="integer")
     */
    private $eau;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_credit", type="integer")
     */
    private $credit;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_impot", type="float", precision=10, scale=0, nullable=false)
     */
    private $impot;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_soin", type="float", precision=10, scale=0, nullable=false)
     */
    private $soin;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_serviteur", type="float", precision=10, scale=0, nullable=false)
     */
    private $serviteur;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_influence", type="float", precision=10, scale=0, nullable=false)
     */
    private $influence;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_gardien", type="float", precision=10, scale=0, nullable=false)
     */
    private $gardien;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_vaisseau", type="integer", nullable=false)
     */
    private $vaisseau;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_troupe", type="integer", nullable=false)
     */
    private $troupe;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_corruption", type="integer", nullable=false)
     */
    private $corruption;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_entretien", type="string", length=121, nullable=false)
     */
    private $entretien;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_salle", type="integer", nullable=false)
     */
    private $salle;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_renommee", type="integer", nullable=false)
     */
    private $renommee;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_delai_attentat", type="integer", nullable=false)
     */
    private $delaiAttentat;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_nb_victime", type="integer", nullable=false)
     */
    private $nbVictime;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_valeur_serviteur", type="integer", nullable=false)
     */
    private $valeurServiteur;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_valeur_troupe", type="integer", nullable=false)
     */
    private $valeurTroupe;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_valeur_vaisseau", type="integer", nullable=false)
     */
    private $valeurVaisseau;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_entrainement", type="integer", nullable=false)
     */
    private $entrainement;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_exploration", type="integer", nullable=false)
     */
    private $exploration;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_objets", type="text", length=65535, nullable=false)
     */
    private $objets;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_rapport_planete", type="text", length=65535, nullable=false)
     */
    private $rapportPlanete;

    /**
     * @var string
     *
     * @ORM\Column(name="heroesofpixel", type="text", length=65535, nullable=false)
     */
    private $heroesofpixel;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_connexion", type="text", length=65535, nullable=false)
     */
    private $cuuConnexion;

    private $roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHeroesofpixel(): string
    {
        return $this->heroesofpixel;
    }

    /**
     * @param string $heroesofpixel
     */
    public function setHeroesofpixel(string $heroesofpixel): void
    {
        $this->heroesofpixel = $heroesofpixel;
    }



    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function setPassword(string $cuuPassword): self
    {
        $this->cuuPassword = $cuuPassword;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->cuuName;
    }

    public function setName(string $cuuName): self
    {
        $this->cuuName = $cuuName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->cuuEmail;
    }

    public function setEmail(string $cuuEmail): self
    {
        $this->cuuEmail = $cuuEmail;

        return $this;
    }

    public function getSecuritytoken(): ?string
    {
        return $this->cuuSecuritytoken;
    }

    public function setSecuritytoken(string $cuuSecuritytoken): self
    {
        $this->cuuSecuritytoken = $cuuSecuritytoken;

        return $this;
    }

    public function getHeure(): ?string
    {
        return $this->heure;
    }

    public function setHeure(string $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getJour(): ?int
    {
        return $this->jour;
    }

    public function setJour(int $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getEpice(): ?float
    {
        return $this->epice;
    }

    public function setEpice(float $epice): self
    {
        $this->epice = $epice;

        return $this;
    }

    /**
     * @return int
     */
    public function getEau(): int
    {
        return $this->eau;
    }

    /**
     * @param int $eau
     */
    public function setEau(int $eau): void
    {
        $this->eau = $eau;
    }

    /**
     * @return int
     */
    public function getCredit(): int
    {
        return $this->credit;
    }

    /**
     * @param int $credit
     */
    public function setCredit(int $credit): void
    {
        $this->credit = $credit;
    }





    public function getImpot(): ?float
    {
        return $this->impot;
    }

    public function setImpot(float $impot): self
    {
        $this->impot = $impot;

        return $this;
    }

    public function getSoin(): ?float
    {
        return $this->soin;
    }

    public function setSoin(float $soin): self
    {
        $this->soin = $soin;

        return $this;
    }

    public function getServiteur(): ?float
    {
        return $this->serviteur;
    }

    public function setServiteur(float $serviteur): self
    {
        $this->serviteur = $serviteur;

        return $this;
    }

    public function getInfluence(): ?float
    {
        return $this->influence;
    }

    public function setInfluence(float $influence): self
    {
        $this->influence = $influence;

        return $this;
    }

    public function getGardien(): ?float
    {
        return $this->gardien;
    }

    public function setGardien(float $gardien): self
    {
        $this->gardien = $gardien;

        return $this;
    }

    public function getVaisseau(): ?int
    {
        return $this->vaisseau;
    }

    public function setVaisseau(int $vaisseau): self
    {
        $this->vaisseau = $vaisseau;

        return $this;
    }

    public function getTroupe(): ?int
    {
        return $this->troupe;
    }

    public function setTroupe(int $troupe): self
    {
        $this->troupe = $troupe;

        return $this;
    }

    public function getCorruption(): ?int
    {
        return $this->corruption;
    }

    public function setCorruption(int $corruption): self
    {
        $this->corruption = $corruption;

        return $this;
    }

    public function getEntretien(): ?string
    {
        return $this->entretien;
    }

    public function setEntretien(string $entretien): self
    {
        $this->entretien = $entretien;

        return $this;
    }

    public function getSalle(): ?int
    {
        return $this->salle;
    }

    public function setSalle(int $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    public function getRenommee(): ?int
    {
        return $this->renommee;
    }

    public function setRenommee(int $renommee): self
    {
        $this->renommee = $renommee;

        return $this;
    }

    public function getDelaiAttentat(): ?int
    {
        return $this->delaiAttentat;
    }

    public function setDelaiAttentat(int $delaiAttentat): self
    {
        $this->delaiAttentat = $delaiAttentat;

        return $this;
    }

    public function getNbVictime(): ?int
    {
        return $this->nbVictime;
    }

    public function setNbVictime(int $nbVictime): self
    {
        $this->nbVictime = $nbVictime;

        return $this;
    }

    public function getValeurServiteur(): ?int
    {
        return $this->valeurServiteur;
    }

    public function setValeurServiteur(int $valeurServiteur): self
    {
        $this->valeurServiteur = $valeurServiteur;

        return $this;
    }

    public function getValeurTroupe(): ?int
    {
        return $this->valeurTroupe;
    }

    public function setValeurTroupe(int $valeurTroupe): self
    {
        $this->valeurTroupe = $valeurTroupe;

        return $this;
    }

    public function getValeurVaisseau(): ?int
    {
        return $this->valeurVaisseau;
    }

    public function setValeurVaisseau(int $valeurVaisseau): self
    {
        $this->valeurVaisseau = $valeurVaisseau;

        return $this;
    }

    public function getEntrainement(): ?int
    {
        return $this->entrainement;
    }

    public function setEntrainement(int $entrainement): self
    {
        $this->entrainement = $entrainement;

        return $this;
    }

    public function getExploration(): ?int
    {
        return $this->exploration;
    }

    public function setExploration(int $exploration): self
    {
        $this->exploration = $exploration;

        return $this;
    }

    public function getObjets(): ?string
    {
        return $this->objets;
    }

    public function setObjets(string $objets): self
    {
        $this->objets = $objets;

        return $this;
    }

    public function getRapport(): ?string
    {
        return $this->rapportPlanete;
    }

    public function setRapport(string $rapportPlanete): self
    {
        $this->rapportPlanete = $rapportPlanete;

        return $this;
    }

    public function getConnexion(): ?string
    {
        return $this->cuuConnexion;
    }

    public function setConnexion(string $cuuConnexion): self
    {
        $this->cuuConnexion = $cuuConnexion;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * This method is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return null;
    }

    /**
     * This method is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
