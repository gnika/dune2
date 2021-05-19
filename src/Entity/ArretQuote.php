<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArretQuote
 *
 * @ORM\Table(name="arret_quote")
 * @ORM\Entity
 */
class ArretQuote
{
    /**
     * @var int
     *
     * @ORM\Column(name="arr_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $arrId;

    /**
     * @var int
     *
     * @ORM\Column(name="arr_id_user", type="integer", nullable=false)
     */
    private $arrIdUser;

    /**
     * @var int
     *
     * @ORM\Column(name="arr_ext_id", type="integer", nullable=false)
     */
    private $arrExtId;

    /**
     * @var int
     *
     * @ORM\Column(name="arr_moneo", type="smallint", nullable=false)
     */
    private $arrMoneo;

    public function getArrId(): ?int
    {
        return $this->arrId;
    }

    public function getArrIdUser(): ?int
    {
        return $this->arrIdUser;
    }

    public function setArrIdUser(int $arrIdUser): self
    {
        $this->arrIdUser = $arrIdUser;

        return $this;
    }

    public function getArrExtId(): ?int
    {
        return $this->arrExtId;
    }

    public function setArrExtId(int $arrExtId): self
    {
        $this->arrExtId = $arrExtId;

        return $this;
    }

    public function getArrMoneo(): ?int
    {
        return $this->arrMoneo;
    }

    public function setArrMoneo(int $arrMoneo): self
    {
        $this->arrMoneo = $arrMoneo;

        return $this;
    }


}
