<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Serviteur
 *
 * @ORM\Table(name="serviteur")
 * @ORM\Entity
 */
class Serviteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="ser_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $serId;

    /**
     * @var int
     *
     * @ORM\Column(name="ser_id_user", type="integer", nullable=false)
     */
    private $serIdUser;

    /**
     * @var int
     *
     * @ORM\Column(name="ser_id_faction", type="integer", nullable=false)
     */
    private $serIdFaction;

    /**
     * @var int
     *
     * @ORM\Column(name="ser_nb_serviteur", type="integer", nullable=false)
     */
    private $serNbServiteur;

    public function getSerId(): ?int
    {
        return $this->serId;
    }

    public function getSerIdUser(): ?int
    {
        return $this->serIdUser;
    }

    public function setSerIdUser(int $serIdUser): self
    {
        $this->serIdUser = $serIdUser;

        return $this;
    }

    public function getSerIdFaction(): ?int
    {
        return $this->serIdFaction;
    }

    public function setSerIdFaction(int $serIdFaction): self
    {
        $this->serIdFaction = $serIdFaction;

        return $this;
    }

    public function getSerNbServiteur(): ?int
    {
        return $this->serNbServiteur;
    }

    public function setSerNbServiteur(int $serNbServiteur): self
    {
        $this->serNbServiteur = $serNbServiteur;

        return $this;
    }


}
