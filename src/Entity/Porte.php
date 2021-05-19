<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Porte
 *
 * @ORM\Table(name="porte")
 * @ORM\Entity
 */
class Porte
{
    /**
     * @var int
     *
     * @ORM\Column(name="por_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $porId;

    /**
     * @var int
     *
     * @ORM\Column(name="por_id_salle", type="integer", nullable=false)
     */
    private $porIdSalle;

    /**
     * @var int
     *
     * @ORM\Column(name="por_id_type", type="integer", nullable=false)
     */
    private $porIdType;

    /**
     * @var string
     *
     * @ORM\Column(name="por_title_ouvert", type="string", length=255, nullable=false)
     */
    private $porTitleOuvert;

    /**
     * @var string
     *
     * @ORM\Column(name="por_direction", type="string", length=255, nullable=false)
     */
    private $porDirection;

    /**
     * @var string
     *
     * @ORM\Column(name="por_title_ferme", type="string", length=255, nullable=false)
     */
    private $porTitleFerme;

    public function getPorId(): ?int
    {
        return $this->porId;
    }

    public function getPorIdSalle(): ?int
    {
        return $this->porIdSalle;
    }

    public function setPorIdSalle(int $porIdSalle): self
    {
        $this->porIdSalle = $porIdSalle;

        return $this;
    }

    public function getPorIdType(): ?int
    {
        return $this->porIdType;
    }

    public function setPorIdType(int $porIdType): self
    {
        $this->porIdType = $porIdType;

        return $this;
    }

    public function getPorTitleOuvert(): ?string
    {
        return $this->porTitleOuvert;
    }

    public function setPorTitleOuvert(string $porTitleOuvert): self
    {
        $this->porTitleOuvert = $porTitleOuvert;

        return $this;
    }

    public function getPorTitleFerme(): ?string
    {
        return $this->porTitleFerme;
    }

    public function setPorTitleFerme(string $porTitleFerme): self
    {
        $this->porTitleFerme = $porTitleFerme;

        return $this;
    }

    /**
     * @return string
     */
    public function getPorDirection(): string
    {
        return $this->porDirection;
    }

    /**
     * @param string $porDirection
     */
    public function setPorDirection(string $porDirection): void
    {
        $this->porDirection = $porDirection;
    }




}
