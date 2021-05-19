<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salle
 *
 * @ORM\Table(name="salle")
 * @ORM\Entity
 */
class Salle
{
    /**
     * @var int
     *
     * @ORM\Column(name="sa_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $saId;

    /**
     * @var string
     *
     * @ORM\Column(name="sa_nom", type="string", length=255, nullable=false)
     */
    private $saNom;

    /**
     * @var string
     *
     * @ORM\Column(name="sa_musique", type="string", length=211, nullable=false)
     */
    private $saMusique;

    public function getSaId(): ?int
    {
        return $this->saId;
    }

    public function getSaNom(): ?string
    {
        return $this->saNom;
    }

    public function setSaNom(string $saNom): self
    {
        $this->saNom = $saNom;

        return $this;
    }

    public function getSaMusique(): ?string
    {
        return $this->saMusique;
    }

    public function setSaMusique(string $saMusique): self
    {
        $this->saMusique = $saMusique;

        return $this;
    }


}
