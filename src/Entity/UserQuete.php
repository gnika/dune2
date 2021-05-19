<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserQuete
 *
 * @ORM\Table(name="user_quete", uniqueConstraints={@ORM\UniqueConstraint(name="us_id_user", columns={"us_id_user", "us_id_quete", "us_id_perso", "us_id_ext"})})
 * @ORM\Entity
 */
class UserQuete
{
    /**
     * @var int
     *
     * @ORM\Column(name="us_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $usId;

    /**
     * @var int
     *
     * @ORM\Column(name="us_id_user", type="integer", nullable=false)
     */
    private $usIdUser;

    /**
     * @var int
     *
     * @ORM\Column(name="us_id_quete", type="integer", nullable=false)
     */
    private $usIdQuete;

    /**
     * @var int
     *
     * @ORM\Column(name="us_id_perso", type="integer", nullable=false)
     */
    private $usIdPerso;

    /**
     * @var int
     *
     * @ORM\Column(name="us_id_ext", type="integer", nullable=false)
     */
    private $usIdExt;

    public function getUsId(): ?int
    {
        return $this->usId;
    }

    public function getUsIdUser(): ?int
    {
        return $this->usIdUser;
    }

    public function setUsIdUser(int $usIdUser): self
    {
        $this->usIdUser = $usIdUser;

        return $this;
    }

    public function getUsIdQuete(): ?int
    {
        return $this->usIdQuete;
    }

    public function setUsIdQuete(int $usIdQuete): self
    {
        $this->usIdQuete = $usIdQuete;

        return $this;
    }

    public function getUsIdPerso(): ?int
    {
        return $this->usIdPerso;
    }

    public function setUsIdPerso(int $usIdPerso): self
    {
        $this->usIdPerso = $usIdPerso;

        return $this;
    }

    public function getUsIdExt(): ?int
    {
        return $this->usIdExt;
    }

    public function setUsIdExt(int $usIdExt): self
    {
        $this->usIdExt = $usIdExt;

        return $this;
    }


}
