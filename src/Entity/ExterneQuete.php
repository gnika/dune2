<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExterneQuete
 *
 * @ORM\Table(name="externe_quete")
 * @ORM\Entity
 */
class ExterneQuete
{
    /**
     * @var int
     *
     * @ORM\Column(name="ext_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $extId;

    /**
     * @var int
     *
     * @ORM\Column(name="ext_id_perso", type="integer", nullable=false)
     */
    private $extIdPerso;

    /**
     * @var int
     *
     * @ORM\Column(name="ext_id_perso_concerne", type="integer", nullable=false)
     */
    private $extIdPersoConcerne;

    /**
     * @var int
     *
     * @ORM\Column(name="ext_id_perso_quete", type="integer", nullable=false)
     */
    private $extIdPersoQuete;

    /**
     * @var int
     *
     * @ORM\Column(name="ext_us_id_ext", type="integer", nullable=false)
     */
    private $extUsIdExt;

    /**
     * @var int
     *
     * @ORM\Column(name="ext_id_quote", type="integer", nullable=false)
     */
    private $extIdQuote;

    /**
     * @var int
     *
     * @ORM\Column(name="ext_moneo", type="smallint", nullable=false)
     */
    private $extMoneo;

    /**
     * @var int
     *
     * @ORM\Column(name="ext_arret", type="smallint", nullable=false)
     */
    private $extArret;

    public function getExtId(): ?int
    {
        return $this->extId;
    }

    public function getExtIdPerso(): ?int
    {
        return $this->extIdPerso;
    }

    public function setExtIdPerso(int $extIdPerso): self
    {
        $this->extIdPerso = $extIdPerso;

        return $this;
    }

    public function getExtIdPersoConcerne(): ?int
    {
        return $this->extIdPersoConcerne;
    }

    public function setExtIdPersoConcerne(int $extIdPersoConcerne): self
    {
        $this->extIdPersoConcerne = $extIdPersoConcerne;

        return $this;
    }

    public function getExtIdPersoQuete(): ?int
    {
        return $this->extIdPersoQuete;
    }

    public function setExtIdPersoQuete(int $extIdPersoQuete): self
    {
        $this->extIdPersoQuete = $extIdPersoQuete;

        return $this;
    }

    public function getExtUsIdExt(): ?int
    {
        return $this->extUsIdExt;
    }

    public function setExtUsIdExt(int $extUsIdExt): self
    {
        $this->extUsIdExt = $extUsIdExt;

        return $this;
    }

    public function getExtIdQuote(): ?int
    {
        return $this->extIdQuote;
    }

    public function setExtIdQuote(int $extIdQuote): self
    {
        $this->extIdQuote = $extIdQuote;

        return $this;
    }

    public function getExtMoneo(): ?int
    {
        return $this->extMoneo;
    }

    public function setExtMoneo(int $extMoneo): self
    {
        $this->extMoneo = $extMoneo;

        return $this;
    }

    public function getExtArret(): ?int
    {
        return $this->extArret;
    }

    public function setExtArret(int $extArret): self
    {
        $this->extArret = $extArret;

        return $this;
    }


}
