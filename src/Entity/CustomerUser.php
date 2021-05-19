<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerUser
 *
 * @ORM\Table(name="customer_user")
 * @ORM\Entity
 */
class CustomerUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="cuu_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cuuId;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_login", type="string", length=150, nullable=false)
     */
    private $cuuLogin;

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
    private $cuuHeure;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_jour", type="integer", nullable=false)
     */
    private $cuuJour;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_epice", type="float", precision=10, scale=0, nullable=false)
     */
    private $cuuEpice;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_impot", type="float", precision=10, scale=0, nullable=false)
     */
    private $cuuImpot;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_soin", type="float", precision=10, scale=0, nullable=false)
     */
    private $cuuSoin;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_serviteur", type="float", precision=10, scale=0, nullable=false)
     */
    private $cuuServiteur;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_influence", type="float", precision=10, scale=0, nullable=false)
     */
    private $cuuInfluence;

    /**
     * @var float
     *
     * @ORM\Column(name="cuu_gardien", type="float", precision=10, scale=0, nullable=false)
     */
    private $cuuGardien;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_vaisseau", type="integer", nullable=false)
     */
    private $cuuVaisseau;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_troupe", type="integer", nullable=false)
     */
    private $cuuTroupe;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_corruption", type="integer", nullable=false)
     */
    private $cuuCorruption;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_entretien", type="string", length=121, nullable=false)
     */
    private $cuuEntretien;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_salle", type="integer", nullable=false)
     */
    private $cuuSalle;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_renommee", type="integer", nullable=false)
     */
    private $cuuRenommee;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_delai_attentat", type="integer", nullable=false)
     */
    private $cuuDelaiAttentat;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_nb_victime", type="integer", nullable=false)
     */
    private $cuuNbVictime;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_valeur_serviteur", type="integer", nullable=false)
     */
    private $cuuValeurServiteur;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_valeur_troupe", type="integer", nullable=false)
     */
    private $cuuValeurTroupe;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_valeur_vaisseau", type="integer", nullable=false)
     */
    private $cuuValeurVaisseau;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_entrainement", type="integer", nullable=false)
     */
    private $cuuEntrainement;

    /**
     * @var int
     *
     * @ORM\Column(name="cuu_exploration", type="integer", nullable=false)
     */
    private $cuuExploration;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_objets", type="text", length=65535, nullable=false)
     */
    private $cuuObjets;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_rapport_planete", type="text", length=65535, nullable=false)
     */
    private $cuuRapportPlanete;

    /**
     * @var string
     *
     * @ORM\Column(name="cuu_connexion", type="text", length=65535, nullable=false)
     */
    private $cuuConnexion;

    /**
     * @var json
     *
     * @ORM\Column(name="roles", type="json", nullable=false)
     */
    private $roles;

    public function getCuuId(): ?int
    {
        return $this->cuuId;
    }

    public function getCuuLogin(): ?string
    {
        return $this->cuuLogin;
    }

    public function setCuuLogin(string $cuuLogin): self
    {
        $this->cuuLogin = $cuuLogin;

        return $this;
    }

    public function getCuuPassword(): ?string
    {
        return $this->cuuPassword;
    }

    public function setCuuPassword(string $cuuPassword): self
    {
        $this->cuuPassword = $cuuPassword;

        return $this;
    }

    public function getCuuName(): ?string
    {
        return $this->cuuName;
    }

    public function setCuuName(string $cuuName): self
    {
        $this->cuuName = $cuuName;

        return $this;
    }

    public function getCuuEmail(): ?string
    {
        return $this->cuuEmail;
    }

    public function setCuuEmail(string $cuuEmail): self
    {
        $this->cuuEmail = $cuuEmail;

        return $this;
    }

    public function getCuuSecuritytoken(): ?string
    {
        return $this->cuuSecuritytoken;
    }

    public function setCuuSecuritytoken(string $cuuSecuritytoken): self
    {
        $this->cuuSecuritytoken = $cuuSecuritytoken;

        return $this;
    }

    public function getCuuHeure(): ?string
    {
        return $this->cuuHeure;
    }

    public function setCuuHeure(string $cuuHeure): self
    {
        $this->cuuHeure = $cuuHeure;

        return $this;
    }

    public function getCuuJour(): ?int
    {
        return $this->cuuJour;
    }

    public function setCuuJour(int $cuuJour): self
    {
        $this->cuuJour = $cuuJour;

        return $this;
    }

    public function getCuuEpice(): ?float
    {
        return $this->cuuEpice;
    }

    public function setCuuEpice(float $cuuEpice): self
    {
        $this->cuuEpice = $cuuEpice;

        return $this;
    }

    public function getCuuImpot(): ?float
    {
        return $this->cuuImpot;
    }

    public function setCuuImpot(float $cuuImpot): self
    {
        $this->cuuImpot = $cuuImpot;

        return $this;
    }

    public function getCuuSoin(): ?float
    {
        return $this->cuuSoin;
    }

    public function setCuuSoin(float $cuuSoin): self
    {
        $this->cuuSoin = $cuuSoin;

        return $this;
    }

    public function getCuuServiteur(): ?float
    {
        return $this->cuuServiteur;
    }

    public function setCuuServiteur(float $cuuServiteur): self
    {
        $this->cuuServiteur = $cuuServiteur;

        return $this;
    }

    public function getCuuInfluence(): ?float
    {
        return $this->cuuInfluence;
    }

    public function setCuuInfluence(float $cuuInfluence): self
    {
        $this->cuuInfluence = $cuuInfluence;

        return $this;
    }

    public function getCuuGardien(): ?float
    {
        return $this->cuuGardien;
    }

    public function setCuuGardien(float $cuuGardien): self
    {
        $this->cuuGardien = $cuuGardien;

        return $this;
    }

    public function getCuuVaisseau(): ?int
    {
        return $this->cuuVaisseau;
    }

    public function setCuuVaisseau(int $cuuVaisseau): self
    {
        $this->cuuVaisseau = $cuuVaisseau;

        return $this;
    }

    public function getCuuTroupe(): ?int
    {
        return $this->cuuTroupe;
    }

    public function setCuuTroupe(int $cuuTroupe): self
    {
        $this->cuuTroupe = $cuuTroupe;

        return $this;
    }

    public function getCuuCorruption(): ?int
    {
        return $this->cuuCorruption;
    }

    public function setCuuCorruption(int $cuuCorruption): self
    {
        $this->cuuCorruption = $cuuCorruption;

        return $this;
    }

    public function getCuuEntretien(): ?string
    {
        return $this->cuuEntretien;
    }

    public function setCuuEntretien(string $cuuEntretien): self
    {
        $this->cuuEntretien = $cuuEntretien;

        return $this;
    }

    public function getCuuSalle(): ?int
    {
        return $this->cuuSalle;
    }

    public function setCuuSalle(int $cuuSalle): self
    {
        $this->cuuSalle = $cuuSalle;

        return $this;
    }

    public function getCuuRenommee(): ?int
    {
        return $this->cuuRenommee;
    }

    public function setCuuRenommee(int $cuuRenommee): self
    {
        $this->cuuRenommee = $cuuRenommee;

        return $this;
    }

    public function getCuuDelaiAttentat(): ?int
    {
        return $this->cuuDelaiAttentat;
    }

    public function setCuuDelaiAttentat(int $cuuDelaiAttentat): self
    {
        $this->cuuDelaiAttentat = $cuuDelaiAttentat;

        return $this;
    }

    public function getCuuNbVictime(): ?int
    {
        return $this->cuuNbVictime;
    }

    public function setCuuNbVictime(int $cuuNbVictime): self
    {
        $this->cuuNbVictime = $cuuNbVictime;

        return $this;
    }

    public function getCuuValeurServiteur(): ?int
    {
        return $this->cuuValeurServiteur;
    }

    public function setCuuValeurServiteur(int $cuuValeurServiteur): self
    {
        $this->cuuValeurServiteur = $cuuValeurServiteur;

        return $this;
    }

    public function getCuuValeurTroupe(): ?int
    {
        return $this->cuuValeurTroupe;
    }

    public function setCuuValeurTroupe(int $cuuValeurTroupe): self
    {
        $this->cuuValeurTroupe = $cuuValeurTroupe;

        return $this;
    }

    public function getCuuValeurVaisseau(): ?int
    {
        return $this->cuuValeurVaisseau;
    }

    public function setCuuValeurVaisseau(int $cuuValeurVaisseau): self
    {
        $this->cuuValeurVaisseau = $cuuValeurVaisseau;

        return $this;
    }

    public function getCuuEntrainement(): ?int
    {
        return $this->cuuEntrainement;
    }

    public function setCuuEntrainement(int $cuuEntrainement): self
    {
        $this->cuuEntrainement = $cuuEntrainement;

        return $this;
    }

    public function getCuuExploration(): ?int
    {
        return $this->cuuExploration;
    }

    public function setCuuExploration(int $cuuExploration): self
    {
        $this->cuuExploration = $cuuExploration;

        return $this;
    }

    public function getCuuObjets(): ?string
    {
        return $this->cuuObjets;
    }

    public function setCuuObjets(string $cuuObjets): self
    {
        $this->cuuObjets = $cuuObjets;

        return $this;
    }

    public function getCuuRapportPlanete(): ?string
    {
        return $this->cuuRapportPlanete;
    }

    public function setCuuRapportPlanete(string $cuuRapportPlanete): self
    {
        $this->cuuRapportPlanete = $cuuRapportPlanete;

        return $this;
    }

    public function getCuuConnexion(): ?string
    {
        return $this->cuuConnexion;
    }

    public function setCuuConnexion(string $cuuConnexion): self
    {
        $this->cuuConnexion = $cuuConnexion;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }


}
