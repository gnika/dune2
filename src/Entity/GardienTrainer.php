<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GardienTrainer
 *
 * @ORM\Table(name="gardien_trainer")
 * @ORM\Entity
 */
class GardienTrainer
{
    /**
     * @var int
     *
     * @ORM\Column(name="gart_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $gartId;

    /**
     * @var int
     *
     * @ORM\Column(name="gart_id_user", type="integer", nullable=false)
     */
    private $gartIdUser;

    /**
     * @var int
     *
     * @ORM\Column(name="gart_id_niveau", type="integer", nullable=false)
     */
    private $gartIdNiveau;

    /**
     * @var int
     *
     * @ORM\Column(name="gart_nb_gardien", type="integer", nullable=false)
     */
    private $gartNbGardien;

    /**
     * @var int
     *
     * @ORM\Column(name="gart_time", type="integer", nullable=false)
     */
    private $gartTime;

    public function getGartId(): ?int
    {
        return $this->gartId;
    }

    public function getGartIdUser(): ?int
    {
        return $this->gartIdUser;
    }

    public function setGartIdUser(int $gartIdUser): self
    {
        $this->gartIdUser = $gartIdUser;

        return $this;
    }

    public function getGartIdNiveau(): ?int
    {
        return $this->gartIdNiveau;
    }

    public function setGartIdNiveau(int $gartIdNiveau): self
    {
        $this->gartIdNiveau = $gartIdNiveau;

        return $this;
    }

    public function getGartNbGardien(): ?int
    {
        return $this->gartNbGardien;
    }

    public function setGartNbGardien(int $gartNbGardien): self
    {
        $this->gartNbGardien = $gartNbGardien;

        return $this;
    }

    public function getGartTime(): ?int
    {
        return $this->gartTime;
    }

    public function setGartTime(int $gartTime): self
    {
        $this->gartTime = $gartTime;

        return $this;
    }


}
