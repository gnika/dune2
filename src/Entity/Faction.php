<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faction
 *
 * @ORM\Table(name="faction")
 * @ORM\Entity
 */
class Faction
{
    /**
     * @var int
     *
     * @ORM\Column(name="fac_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $facId;

    /**
     * @var string
     *
     * @ORM\Column(name="fac_nom", type="string", length=255, nullable=false)
     */
    private $facNom;

    public function getFacId(): ?int
    {
        return $this->facId;
    }

    public function getFacNom(): ?string
    {
        return $this->facNom;
    }

    public function setFacNom(string $facNom): self
    {
        $this->facNom = $facNom;

        return $this;
    }


}
