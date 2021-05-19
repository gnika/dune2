<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PorteUser
 *
 * @ORM\Table(name="porte_user")
 * @ORM\Entity
 */
class PorteUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="poru_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $poruId;

    /**
     * @var int
     *
     * @ORM\Column(name="poru_id_porte", type="integer", nullable=false)
     */
    private $poruIdPorte;

    /**
     * @var int
     *
     * @ORM\Column(name="poru_id_user", type="integer", nullable=false)
     */
    private $poruIdUser;

    /**
     * @var int
     *
     * @ORM\Column(name="poru_etat", type="integer", nullable=false)
     */
    private $poruEtat;

    public function getPoruId(): ?int
    {
        return $this->poruId;
    }

    public function getPoruIdPorte(): ?int
    {
        return $this->poruIdPorte;
    }

    public function setPoruIdPorte(int $poruIdPorte): self
    {
        $this->poruIdPorte = $poruIdPorte;

        return $this;
    }

    public function getPoruIdUser(): ?int
    {
        return $this->poruIdUser;
    }

    public function setPoruIdUser(int $poruIdUser): self
    {
        $this->poruIdUser = $poruIdUser;

        return $this;
    }

    public function getPoruEtat(): ?int
    {
        return $this->poruEtat;
    }

    public function setPoruEtat(int $poruEtat): self
    {
        $this->poruEtat = $poruEtat;

        return $this;
    }


}
