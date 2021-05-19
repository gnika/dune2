<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObjetUser
 *
 * @ORM\Table(name="objet_user", uniqueConstraints={@ORM\UniqueConstraint(name="obu_id_objet", columns={"obu_id_objet", "obu_id_user"})})
 * @ORM\Entity
 */
class ObjetUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="obu_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $obuId;

    /**
     * @var int
     *
     * @ORM\Column(name="obu_id_objet", type="integer", nullable=false)
     */
    private $obuIdObjet;

    /**
     * @var int
     *
     * @ORM\Column(name="obu_id_user", type="integer", nullable=false)
     */
    private $obuIdUser;

    public function getObuId(): ?int
    {
        return $this->obuId;
    }

    public function getObuIdObjet(): ?int
    {
        return $this->obuIdObjet;
    }

    public function setObuIdObjet(int $obuIdObjet): self
    {
        $this->obuIdObjet = $obuIdObjet;

        return $this;
    }

    public function getObuIdUser(): ?int
    {
        return $this->obuIdUser;
    }

    public function setObuIdUser(int $obuIdUser): self
    {
        $this->obuIdUser = $obuIdUser;

        return $this;
    }


}
