<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MoneoQuote
 *
 * @ORM\Table(name="moneo_quote")
 * @ORM\Entity
 */
class MoneoQuote
{
    /**
     * @var int
     *
     * @ORM\Column(name="mon_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $monId;

    /**
     * @var int
     *
     * @ORM\Column(name="mon_id_perso", type="integer", nullable=false)
     */
    private $monIdPerso;

    /**
     * @var int
     *
     * @ORM\Column(name="mon_maj_quete", type="smallint", nullable=false)
     */
    private $monMajQuete;

    /**
     * @var int
     *
     * @ORM\Column(name="mon_maj_quete_perso", type="integer", nullable=false)
     */
    private $monMajQuetePerso;

    /**
     * @var int
     *
     * @ORM\Column(name="mon_maj_quete_id_ext", type="integer", nullable=false)
     */
    private $monMajQueteIdExt;

    /**
     * @var string
     *
     * @ORM\Column(name="mon_quote", type="text", length=65535, nullable=false)
     */
    private $monQuote;

    /**
     * @var string
     *
     * @ORM\Column(name="mon_quote_en", type="text", length=65535, nullable=false)
     */
    private $monQuoteEn;

    /**
     * @var int
     *
     * @ORM\Column(name="mon_humeur", type="integer", nullable=false)
     */
    private $monHumeur;

    /**
     * @var int
     *
     * @ORM\Column(name="mon_quote_seul", type="smallint", nullable=false)
     */
    private $monQuoteSeul;

    /**
     * @var int
     *
     * @ORM\Column(name="mon_reponse", type="integer", nullable=false)
     */
    private $monReponse;

    /**
     * @var int
     *
     * @ORM\Column(name="mon_id_multiple", type="integer", nullable=false)
     */
    private $monIdMultiple;

    /**
     * @var int
     *
     * @ORM\Column(name="mon_nb_multiple", type="integer", nullable=false)
     */
    private $monNbMultiple;

    /**
     * @var int
     *
     * @ORM\Column(name="mon_recompense_multi", type="integer", nullable=false)
     */
    private $monRecompenseMulti;

    /**
     * @var int
     *
     * @ORM\Column(name="mon_recompense_nb_multi", type="integer", nullable=false)
     */
    private $monRecompenseNbMulti;

    /**
     * @var string
     *
     * @ORM\Column(name="mon_fnctn", type="text", length=65535, nullable=false)
     */
    private $monFnctn;

    public function getMonId(): ?int
    {
        return $this->monId;
    }

    public function getMonIdPerso(): ?int
    {
        return $this->monIdPerso;
    }

    public function setMonIdPerso(int $monIdPerso): self
    {
        $this->monIdPerso = $monIdPerso;

        return $this;
    }

    public function getMonMajQuete(): ?int
    {
        return $this->monMajQuete;
    }

    public function setMonMajQuete(int $monMajQuete): self
    {
        $this->monMajQuete = $monMajQuete;

        return $this;
    }

    public function getMonMajQuetePerso(): ?int
    {
        return $this->monMajQuetePerso;
    }

    public function setMonMajQuetePerso(int $monMajQuetePerso): self
    {
        $this->monMajQuetePerso = $monMajQuetePerso;

        return $this;
    }

    public function getMonMajQueteIdExt(): ?int
    {
        return $this->monMajQueteIdExt;
    }

    public function setMonMajQueteIdExt(int $monMajQueteIdExt): self
    {
        $this->monMajQueteIdExt = $monMajQueteIdExt;

        return $this;
    }

    public function getMonQuote(): ?string
    {
        return $this->monQuote;
    }

    public function setMonQuote(string $monQuote): self
    {
        $this->monQuote = $monQuote;

        return $this;
    }

    public function getMonQuoteEn(): ?string
    {
        return $this->monQuoteEn;
    }

    public function setMonQuoteEn(string $monQuoteEn): self
    {
        $this->monQuoteEn = $monQuoteEn;

        return $this;
    }

    public function getMonHumeur(): ?int
    {
        return $this->monHumeur;
    }

    public function setMonHumeur(int $monHumeur): self
    {
        $this->monHumeur = $monHumeur;

        return $this;
    }

    public function getMonQuoteSeul(): ?int
    {
        return $this->monQuoteSeul;
    }

    public function setMonQuoteSeul(int $monQuoteSeul): self
    {
        $this->monQuoteSeul = $monQuoteSeul;

        return $this;
    }

    public function getMonReponse(): ?int
    {
        return $this->monReponse;
    }

    public function setMonReponse(int $monReponse): self
    {
        $this->monReponse = $monReponse;

        return $this;
    }

    public function getMonIdMultiple(): ?int
    {
        return $this->monIdMultiple;
    }

    public function setMonIdMultiple(int $monIdMultiple): self
    {
        $this->monIdMultiple = $monIdMultiple;

        return $this;
    }

    public function getMonNbMultiple(): ?int
    {
        return $this->monNbMultiple;
    }

    public function setMonNbMultiple(int $monNbMultiple): self
    {
        $this->monNbMultiple = $monNbMultiple;

        return $this;
    }

    public function getMonRecompenseMulti(): ?int
    {
        return $this->monRecompenseMulti;
    }

    public function setMonRecompenseMulti(int $monRecompenseMulti): self
    {
        $this->monRecompenseMulti = $monRecompenseMulti;

        return $this;
    }

    public function getMonRecompenseNbMulti(): ?int
    {
        return $this->monRecompenseNbMulti;
    }

    public function setMonRecompenseNbMulti(int $monRecompenseNbMulti): self
    {
        $this->monRecompenseNbMulti = $monRecompenseNbMulti;

        return $this;
    }

    public function getMonFnctn(): ?string
    {
        return $this->monFnctn;
    }

    public function setMonFnctn(string $monFnctn): self
    {
        $this->monFnctn = $monFnctn;

        return $this;
    }


}
