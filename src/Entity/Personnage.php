<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonnageRepository;

/**
 * Personnage
 *
 * @ORM\Table(name="personnage")
 * @ORM\Entity(repositoryClass=PersonnageRepository::class)
 */
class Personnage
{
    /**
     * @var int
     *
     * @ORM\Column(name="pers_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $persId;

    /**
     * @var string
     *
     * @ORM\Column(name="pers_nom", type="string", length=255, nullable=false)
     */
    private $persNom;

    /**
     * @var int
     *
     * @ORM\Column(name="pers_faction", type="integer", nullable=false)
     */
    private $persFaction;

    public function getPersId(): ?int
    {
        return $this->persId;
    }

    public function getPersNom(): ?string
    {
        return $this->persNom;
    }

    public function setPersNom(string $persNom): self
    {
        $this->persNom = $persNom;

        return $this;
    }

    public function getPersFaction(): ?int
    {
        return $this->persFaction;
    }

    public function setPersFaction(int $persFaction): self
    {
        $this->persFaction = $persFaction;

        return $this;
    }


}
