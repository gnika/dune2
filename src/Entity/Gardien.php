<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gardien
 *
 * @ORM\Table(name="gardien")
 * @ORM\Entity
 */
class Gardien
{
    /**
     * @var int
     *
     * @ORM\Column(name="gar_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $garId;

    /**
     * @var int
     *
     * @ORM\Column(name="gar_id_user", type="integer", nullable=false)
     */
    private $garIdUser;

    /**
     * @var int
     *
     * @ORM\Column(name="gar_id_faction", type="integer", nullable=false)
     */
    private $garIdFaction;

    /**
     * @var int
     *
     * @ORM\Column(name="gar_nb_gardien", type="integer", nullable=false)
     */
    private $garNbGardien;

    public function getGarId(): ?int
    {
        return $this->garId;
    }

    public function getGarIdUser(): ?int
    {
        return $this->garIdUser;
    }

    public function setGarIdUser(int $garIdUser): self
    {
        $this->garIdUser = $garIdUser;

        return $this;
    }

    public function getGarIdFaction(): ?int
    {
        return $this->garIdFaction;
    }

    public function setGarIdFaction(int $garIdFaction): self
    {
        $this->garIdFaction = $garIdFaction;

        return $this;
    }

    public function getGarNbGardien(): ?int
    {
        return $this->garNbGardien;
    }

    public function setGarNbGardien(int $garNbGardien): self
    {
        $this->garNbGardien = $garNbGardien;

        return $this;
    }


}
