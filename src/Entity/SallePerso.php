<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SallePerso
 *
 * @ORM\Table(name="salle_perso")
 * @ORM\Entity
 */
class SallePerso
{
    /**
     * @var int
     *
     * @ORM\Column(name="sal_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $salId;

    /**
     * @var int
     *
     * @ORM\Column(name="sal_id_salle", type="integer", nullable=false)
     */
    private $salIdSalle;

    /**
     * @var int
     *
     * @ORM\Column(name="sal_id_user", type="integer", nullable=false)
     */
    private $salIdUser;

    /**
     * @var int
     *
     * @ORM\Column(name="sal_id_perso", type="integer", nullable=false)
     */
    private $salIdPerso;

    public function getSalId(): ?int
    {
        return $this->salId;
    }

    public function getSalIdSalle(): ?int
    {
        return $this->salIdSalle;
    }

    public function setSalIdSalle(int $salIdSalle): self
    {
        $this->salIdSalle = $salIdSalle;

        return $this;
    }

    public function getSalIdUser(): ?int
    {
        return $this->salIdUser;
    }

    public function setSalIdUser(int $salIdUser): self
    {
        $this->salIdUser = $salIdUser;

        return $this;
    }

    public function getSalIdPerso(): ?int
    {
        return $this->salIdPerso;
    }

    public function setSalIdPerso(int $salIdPerso): self
    {
        $this->salIdPerso = $salIdPerso;

        return $this;
    }


}
