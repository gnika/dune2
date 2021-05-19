<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CarteUser
 *
 * @ORM\Table(name="carte_user", uniqueConstraints={@ORM\UniqueConstraint(name="cau_id_user", columns={"cau_id_user", "cau_ca_id"})})
 * @ORM\Entity
 */
class CarteUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="cau_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cauId;

    /**
     * @var int
     *
     * @ORM\Column(name="cau_id_user", type="integer", nullable=false)
     */
    private $cauIdUser;

    /**
     * @var int
     *
     * @ORM\Column(name="cau_ca_id", type="integer", nullable=false)
     */
    private $cauCaId;

    /**
     * @var int
     *
     * @ORM\Column(name="cau_troupe", type="integer", nullable=true)
     */
    private $cauTroupe;

    /**
     * @var int
     *
     * @ORM\Column(name="cau_etat", type="integer", nullable=true)
     */
    private $cauEtat;

    /**
     * @var int
     *
     * @ORM\Column(name="cau_jour", type="integer", nullable=true)
     */
    private $cauJour;

    /**
     * @var int
     *
     * @ORM\Column(name="cau_heure", type="integer", nullable=true)
     */
    private $cauHeure;

    /**
     * @var int
     *
     * @ORM\Column(name="cau_envoi", type="integer", nullable=true)
     */
    private $cauEnvoi;

    /**
     * @var int
     *
     * @ORM\Column(name="cau_diplomate", type="integer", nullable=true)
     */
    private $cauDiplomate;

    public function getCauId(): ?int
    {
        return $this->cauId;
    }

    public function getCauIdUser(): ?int
    {
        return $this->cauIdUser;
    }

    public function setCauIdUser(int $cauIdUser): self
    {
        $this->cauIdUser = $cauIdUser;

        return $this;
    }

    public function getCauCaId(): ?int
    {
        return $this->cauCaId;
    }

    public function setCauCaId(int $cauCaId): self
    {
        $this->cauCaId = $cauCaId;

        return $this;
    }

    public function getCauTroupe(): ?int
    {
        return $this->cauTroupe;
    }

    public function setCauTroupe(int $cauTroupe): self
    {
        $this->cauTroupe = $cauTroupe;

        return $this;
    }

    public function getCauEtat(): ?int
    {
        return $this->cauEtat;
    }

    public function setCauEtat(int $cauEtat): self
    {
        $this->cauEtat = $cauEtat;

        return $this;
    }

    public function getCauJour(): ?int
    {
        return $this->cauJour;
    }

    public function setCauJour(int $cauJour): self
    {
        $this->cauJour = $cauJour;

        return $this;
    }

    public function getCauHeure(): ?int
    {
        return $this->cauHeure;
    }

    public function setCauHeure(int $cauHeure): self
    {
        $this->cauHeure = $cauHeure;

        return $this;
    }

    public function getCauEnvoi(): ?int
    {
        return $this->cauEnvoi;
    }

    public function setCauEnvoi(int $cauEnvoi): self
    {
        $this->cauEnvoi = $cauEnvoi;

        return $this;
    }

    public function getCauDiplomate(): ?int
    {
        return $this->cauDiplomate;
    }

    public function setCauDiplomate(int $cauDiplomate): self
    {
        $this->cauDiplomate = $cauDiplomate;

        return $this;
    }


}
