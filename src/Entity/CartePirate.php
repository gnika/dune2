<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CartePirate
 *
 * @ORM\Table(name="carte_pirate")
 * @ORM\Entity
 */
class CartePirate
{
    /**
     * @var int
     *
     * @ORM\Column(name="cap_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $capId;

    /**
     * @var string
     *
     * @ORM\Column(name="cap_coordonnees", type="string", length=211, nullable=false)
     */
    private $capCoordonnees;

    /**
     * @var string
     *
     * @ORM\Column(name="cap_race", type="string", length=211, nullable=false)
     */
    private $capRace;

    public function getCapId(): ?int
    {
        return $this->capId;
    }

    public function getCapCoordonnees(): ?string
    {
        return $this->capCoordonnees;
    }

    public function setCapCoordonnees(string $capCoordonnees): self
    {
        $this->capCoordonnees = $capCoordonnees;

        return $this;
    }

    public function getCapRace(): ?string
    {
        return $this->capRace;
    }

    public function setCapRace(string $capRace): self
    {
        $this->capRace = $capRace;

        return $this;
    }


}
