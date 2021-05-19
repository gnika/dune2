<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\HumeurFactionRepository;

/**
 * HumeurFaction
 *
 * @ORM\Table(name="humeur_faction")
 * @ORM\Entity(repositoryClass=HumeurFactionRepository::class)
 */
class HumeurFaction
{
    /**
     * @var int
     *
     * @ORM\Column(name="hum_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $humId;

    /**
     * @var int
     *
     * @ORM\Column(name="hum_id_user", type="integer", nullable=false)
     */
    private $humIdUser;

    /**
     * @var int
     *
     * @ORM\Column(name="hum_id_faction", type="integer", nullable=false)
     */
    private $humIdFaction;

    /**
     * @var int
     *
     * @ORM\Column(name="hum_humeur", type="integer", nullable=false)
     */
    private $humHumeur;

    public function getHumId(): ?int
    {
        return $this->humId;
    }

    public function getHumIdUser(): ?int
    {
        return $this->humIdUser;
    }

    public function setHumIdUser(int $humIdUser): self
    {
        $this->humIdUser = $humIdUser;

        return $this;
    }

    public function getHumIdFaction(): ?int
    {
        return $this->humIdFaction;
    }

    public function setHumIdFaction(int $humIdFaction): self
    {
        $this->humIdFaction = $humIdFaction;

        return $this;
    }

    public function getHumHumeur(): ?int
    {
        return $this->humHumeur;
    }

    public function setHumHumeur(int $humHumeur): self
    {
        $this->humHumeur = $humHumeur;

        return $this;
    }


}
